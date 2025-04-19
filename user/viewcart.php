<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION["user"])) {
    echo "
    <script>
        alert('Please login to view cart');
        window.location.href = '../login.php';
    </script>
    ";
    exit();
}

require_once 'config.php';

$user_id = $_SESSION["user"];

// Debug log
error_log("ViewCart - User ID: " . $user_id);

// Fetch cart items for the current user
$sql = "SELECT * FROM tblcart WHERE idofuser = ?";
$stmt = $config->prepare($sql);
$stmt->bind_param("s", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Debug log
error_log("ViewCart - Cart Items Count: " . $result->num_rows);

// Calculate total
$total = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <?php include 'header.php'; ?>
    
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-8">Your Shopping Cart</h1>
        
        <?php if ($result->num_rows > 0): ?>
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php while ($row = $result->fetch_assoc()): 
                                $item_total = $row['pprice'] * $row['quantity'];
                                $total += $item_total;
                            ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900"><?php echo htmlspecialchars($row['pname']); ?></div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500">₹<?php echo number_format($row['pprice'], 2); ?></div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <form action="insertcart.php" method="POST" class="flex items-center space-x-2">
                                            <input type="hidden" name="item" value="<?php echo htmlspecialchars($row['pname']); ?>">
                                            <input type="number" name="quantity" value="<?php echo $row['quantity']; ?>" min="1" class="w-20 px-2 py-1 border rounded">
                                            <button type="submit" name="update" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">Update</button>
                                        </form>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">₹<?php echo number_format($item_total, 2); ?></div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <form action="insertcart.php" method="POST" class="inline">
                                            <input type="hidden" name="item" value="<?php echo htmlspecialchars($row['pname']); ?>">
                                            <button type="submit" name="remove" class="text-red-600 hover:text-red-900">Remove</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                        <tfoot class="bg-gray-50">
                            <tr>
                                <td colspan="3" class="px-6 py-4 text-right text-sm font-medium text-gray-500">Total Amount:</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">₹<?php echo number_format($total, 2); ?></td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <div class="mt-6 flex justify-end">
                <a href="checkout.php" class="bg-green-500 text-white px-6 py-2 rounded-md hover:bg-green-600">Proceed to Checkout</a>
            </div>
        <?php else: ?>
            <div class="bg-white rounded-lg shadow-md p-6 text-center">
                <p class="text-gray-500">Your cart is empty.</p>
                <a href="index.php" class="text-blue-500 hover:text-blue-700 mt-4 inline-block">Continue Shopping</a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>