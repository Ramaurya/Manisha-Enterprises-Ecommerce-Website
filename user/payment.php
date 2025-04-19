<?php
session_start();
include 'config.php';

if(!isset($_SESSION["user"])){
    echo "
    <script>
        alert('Please login first');
        window.location.href = 'form.php/login.php';
    </script>
    ";
    exit();
}

// Get cart total from session
$total = isset($_SESSION['cart_total']) ? $_SESSION['cart_total'] : 0;

// Handle UTR submission
if(isset($_POST['submit_utr'])) {
    $utr = trim($_POST['utr_number']);
    $user_id = $_SESSION["user"];
    
    // Validate UTR number
    if(empty($utr)) {
        echo "
        <script>
            alert('Please enter a valid UTR number');
            window.location.href = 'payment.php';
        </script>
        ";
        exit();
    }

    // Debug: Log the UTR number
    error_log("Processing UTR number: " . $utr);
    
    // Store order details from session
    $address = $_SESSION['address'];
    $city = $_SESSION['city'];
    $state = $_SESSION['state'];
    $pincode = $_SESSION['pincode'];
    $country = $_SESSION['country'];
    
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
            $sql = "INSERT INTO tblorder (idofuser, pname, pprice, quantity, paymentmode, address, city, state, pincode, country, utr_number, order_date) 
                   VALUES (?, ?, ?, ?, 'online', ?, ?, ?, ?, ?, ?, NOW())";
            $stmt = $config->prepare($sql);
            if (!$stmt) {
                throw new Exception("Prepare failed for order insert: " . $config->error);
            }
            
            // Debug: Log the values being inserted
            error_log("Inserting order with UTR: " . $utr . " for user: " . $user_id);
            
            $stmt->bind_param("ssssssssss", 
                $user_id,
                $cart_item['pname'],
                $cart_item['pprice'],
                $cart_item['quantity'],
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
            
            // Debug: Log successful insertion
            error_log("Order inserted successfully with UTR: " . $utr);
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
            alert('Order placed successfully! Your UTR number has been recorded.');
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
            window.location.href = 'payment.php';
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
    <title>Complete Payment - E-SHOPER</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <?php include 'header.php'; ?>

    <div class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h1 class="text-2xl font-bold mb-6">Complete Your Payment</h1>
                
                <div class="mb-6">
                    <div class="text-center mb-4">
                        <p class="text-lg font-semibold text-gray-800">Amount to Pay: ₹<?php echo number_format($total, 2); ?></p>
                    </div>
                    
                    <!-- QR Code Section -->
                    <div class="mb-6">
                        <h2 class="text-lg font-semibold mb-3">Scan QR Code to Pay</h2>
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
                
                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-600">
                        Having trouble? Contact our support at support@eshoper.com
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html> 