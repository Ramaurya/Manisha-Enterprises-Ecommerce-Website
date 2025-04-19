<?php
session_start();
require_once 'config.php';

// Check if user is logged in
if(!isset($_SESSION["user"])){
    echo "
    alert('Please login to view cart');
    
    window.location.href = 'form.php/login.php';
    ";
    
    exit();
 }

$user_id = $_SESSION["user"];




// Debug statement to check user_id
error_log("User ID in checkout: " . $user_id);

// First, verify the cart has items
$check_cart_sql = "SELECT COUNT(*) as count FROM tblcart WHERE idofuser = ?";
$check_stmt = $config->prepare($check_cart_sql);
$check_stmt->bind_param("s", $user_id);
$check_stmt->execute();
$check_result = $check_stmt->get_result();
$cart_count = $check_result->fetch_assoc()['count'];

error_log("Cart count: " . $cart_count); // Debug log

if ($cart_count == 0) {
    echo "
    <script>
        alert('Your cart is empty!');
        window.location.href = 'viewcart.php';
    </script>
    ";
    exit();
}

// Fetch cart items for the current user
$sql = "SELECT * FROM tblcart WHERE idofuser = ?";
$stmt = $config->prepare($sql);
$stmt->bind_param("s", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Calculate total
$total = 0;

// Process order submission
if(isset($_POST['place_order'])) {
    $payment_mode = $_POST['payment_mode'];
    $user_id = $_SESSION["user"];
    
    // Get delivery details from form
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $pincode = $_POST['pincode'];
    $country = $_POST['country'];
    
    // Store delivery details in session
    $_SESSION['address'] = $address;
    $_SESSION['city'] = $city;
    $_SESSION['state'] = $state;
    $_SESSION['pincode'] = $pincode;
    $_SESSION['country'] = $country;
    
    if($payment_mode == 'online') {
        // Show QR code and UTR form
        $show_utr_form = true;
    } else {
        // For COD, proceed with order placement
        placeOrder($user_id, $address, $city, $state, $pincode, $country, $payment_mode);
    }
}

if(isset($_POST['submit_utr'])) {
    $utr = trim($_POST['utr_number']);
    $user_id = $_SESSION["user"];
    
    // Validate UTR number
    if(empty($utr)) {
        echo "
        <script>
            alert('Please enter a valid UTR number');
            window.location.href = 'checkout.php';
        </script>
        ";
        exit();
    }
    
    // Get stored delivery details from session
    $address = $_SESSION['address'];
    $city = $_SESSION['city'];
    $state = $_SESSION['state'];
    $pincode = $_SESSION['pincode'];
    $country = $_SESSION['country'];
    
    // Place order with UTR
    placeOrder($user_id, $address, $city, $state, $pincode, $country, 'online', $utr);
}

function placeOrder($user_id, $address, $city, $state, $pincode, $country, $payment_mode, $utr = '') {
    global $config;
    
    // Get cart items
    $sql = "SELECT * FROM tblcart WHERE idofuser = ?";
    $stmt = $config->prepare($sql);
    if (!$stmt) {
        throw new Exception("Prepare failed for cart query: " . $config->error);
    }
    $stmt->bind_param("s", $user_id);
    $stmt->execute();
    $cart_result = $stmt->get_result();
    
    // Begin transaction
    $config->begin_transaction();
    
    try {
        // Insert each cart item as an order
        while($cart_item = $cart_result->fetch_assoc()) {
            $sql = "INSERT INTO tblorder (idofuser, pname, pprice, quantity, paymentmode, address, city, state, pincode, country, utr_number) 
                   VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $config->prepare($sql);
            if (!$stmt) {
                throw new Exception("Prepare failed for order insert: " . $config->error);
            }
            
            $stmt->bind_param("sssssssssss", 
                $user_id,
                $cart_item['pname'],
                $cart_item['pprice'],
                $cart_item['quantity'],
                $payment_mode,
                $address,
                $city,
                $state,
                $pincode,
                $country,
                $utr
            );
            
            if (!$stmt->execute()) {
                throw new Exception("Execute failed for order insert: " . $stmt->error);
            }
        }
        
        // Clear cart
        $clear_cart = "DELETE FROM tblcart WHERE idofuser = ?";
        $clear_stmt = $config->prepare($clear_cart);
        if (!$clear_stmt) {
            throw new Exception("Prepare failed for clear cart: " . $config->error);
        }
        
        $clear_stmt->bind_param("s", $user_id);
        if (!$clear_stmt->execute()) {
            throw new Exception("Execute failed for clear cart: " . $clear_stmt->error);
        }
        
        // Commit transaction
        $config->commit();
        
        // Clear session data
        unset($_SESSION['address']);
        unset($_SESSION['city']);
        unset($_SESSION['state']);
        unset($_SESSION['pincode']);
        unset($_SESSION['country']);
        unset($_SESSION['cart_total']);
        
        echo "
        <script>
            alert('Order placed successfully!');
            window.location.href = 'orders.php';
        </script>
        ";
        exit();
        
    } catch (Exception $e) {
        // Rollback transaction on error
        $config->rollback();
        error_log("Order processing error: " . $e->getMessage());
        echo "
        <script>
            alert('Error processing your order: " . addslashes($e->getMessage()) . "');
            window.location.href = 'checkout.php';
        </script>
        ";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <?php include 'header.php'; ?>

    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-8">Checkout</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Order Summary -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold mb-4">Order Summary</h2>
                <div class="space-y-4">
                    <?php 
                    // Reset the result set pointer
                    $stmt->execute();
                    $result = $stmt->get_result();
                    
                    while ($row = $result->fetch_assoc()): 
                        // Convert string values to numbers for calculation
                        $price = floatval($row['pprice']);
                        $quantity = intval($row['quantity']);
                        $item_total = $price * $quantity;
                        $total += $item_total;
                    ?>
                        <div class="flex justify-between items-center border-b pb-4">
                            <div>
                                <h3 class="font-medium"><?php echo htmlspecialchars($row['pname']); ?></h3>
                                <p class="text-sm text-gray-600">Quantity: <?php echo $quantity; ?></p>
                            </div>
                            <div class="text-right">
                                <p class="font-medium">₹<?php echo number_format($item_total, 2); ?></p>
                                <p class="text-sm text-gray-600">₹<?php echo number_format($price, 2); ?> each</p>
                            </div>
                        </div>
                    <?php endwhile; ?>
                    <div class="flex justify-between items-center pt-4">
                        <h3 class="font-semibold">Total Amount:</h3>
                        <p class="font-semibold">₹<?php echo number_format($total, 2); ?></p>
                    </div>
                </div>
            </div>

            <!-- Delivery Information -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold mb-4">Delivery Information</h2>
                <form action="" method="POST" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Payment Mode</label>
                        <select name="payment_mode" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="cod">Cash on Delivery</option>
                            <option value="online">Online Payment</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Delivery Address</label>
                        <textarea name="address" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Pincode</label>
                        <input type="text" name="pincode" required maxlength="20" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">City</label>
                        <input type="text" name="city" required maxlength="100" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">State</label>
                        <input type="text" name="state" required maxlength="100" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Country</label>
                        <input type="text" name="country" required maxlength="100" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                    <div class="pt-4">
                        <button type="submit" name="place_order" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            Place Order
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php if(isset($show_utr_form) && $show_utr_form): ?>
    <div class="mt-6 bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold mb-4">Complete Your Payment</h2>
        
        <div class="mb-6">
            <div class="text-center mb-4">
                <p class="text-lg font-semibold text-gray-800">Amount to Pay: ₹<?php echo number_format($total, 2); ?></p>
            </div>
            
            <!-- QR Code Section -->
            <div class="mb-6">
                <h3 class="text-lg font-semibold mb-3">Scan QR Code to Pay</h3>
                <div class="flex justify-center">
                    <img src="qr code raj.jpeg" alt="Payment QR Code" class="max-w-xs rounded-lg shadow-md">
                </div>
            </div>
            
            <!-- Payment Instructions -->
            <div class="bg-blue-50 p-4 rounded-lg mb-6">
                <h3 class="font-semibold text-blue-800 mb-2">Payment Instructions:</h3>
                <ol class="list-decimal list-inside text-blue-700 space-y-2">
                    <li>Scan the QR code using any UPI app</li>
                    <li>Pay the exact amount shown above</li>
                    <li>Copy the UTR number from your payment</li>
                    <li>Submit the UTR number below</li>
                </ol>
            </div>
            
            <!-- UTR Submission Form -->
            <form method="POST" class="mt-6">
                <div class="mb-4">
                    <label for="utr_number" class="block text-sm font-medium text-gray-700 mb-2">
                        Enter UTR Number
                    </label>
                    <input type="text" 
                           id="utr_number" 
                           name="utr_number" 
                           required 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Enter 12-digit UTR number">
                </div>
                
                <button type="submit" 
                        name="submit_utr" 
                        class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Verify Payment & Place Order
                </button>
            </form>
        </div>
    </div>
    <?php endif; ?>
</body>
</html>
?>
?>