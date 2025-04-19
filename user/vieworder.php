<?php
session_start();

// Include database configuration
include 'config.php';

// Check if user is logged in
if(!isset($_SESSION["user"])){
    echo "
    <script>
        alert('Please login to view orders');
        window.location.href = 'form.php/login.php';
    </script>
    ";
    exit();
}

$user_id = $_SESSION["user"];

// Handle order cancellation
if(isset($_POST['cancel_order'])) {
    $order_id = $_POST['order_id'];
    
    // Only allow cancellation if status is 'Pending'
    $update_sql = "UPDATE tblorder SET status = 'Cancelled' WHERE id = ? AND idofuser = ? AND status = 'Pending'";
    $update_stmt = $config->prepare($update_sql);
    $update_stmt->bind_param("is", $order_id, $user_id);
    
    if($update_stmt->execute()) {
        echo "
        <script>
            alert('Order cancelled successfully!');
            window.location.href = 'vieworder.php';
        </script>
        ";
    } else {
        echo "
        <script>
            alert('Could not cancel order. Order might already be processed.');
            window.location.href = 'vieworder.php';
        </script>
        ";
    }
}

// Fetch orders for the current user
$sql = "SELECT * FROM tblorder WHERE idofuser = ? ORDER BY id DESC";
$stmt = $config->prepare($sql);
$stmt->bind_param("s", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Orders - E-SHOPER</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <?php include 'header.php'; ?>

    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">My Orders</h1>
            <a href="index.php" class="text-blue-600 hover:text-blue-800">
                <i class="fas fa-arrow-left mr-2"></i>Continue Shopping
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-md overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Payment Mode</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Delivery Address</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php if($result->num_rows > 0): ?>
                        <?php while($row = $result->fetch_assoc()): ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    #<?php echo $row['id']; ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?php echo htmlspecialchars($row['pname']); ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    ₹<?php echo number_format($row['pprice'], 2); ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?php echo $row['quantity']; ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    ₹<?php echo number_format($row['pprice'] * $row['quantity'], 2); ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?php 
                                    $badge_color = $row['paymentmode'] == 'online' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800';
                                    ?>
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?php echo $badge_color; ?>">
                                        <?php echo ucfirst($row['paymentmode']); ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?php
                                    $status = $row['status'] ?? 'Pending';
                                    $status_colors = [
                                        'Pending' => 'bg-yellow-100 text-yellow-800',
                                        'Confirmed' => 'bg-blue-100 text-blue-800',
                                        'Shipped' => 'bg-green-100 text-green-800',
                                        'Cancelled' => 'bg-red-100 text-red-800',
                                        'Payment Not Received' => 'bg-red-100 text-red-800'
                                    ];
                                    $status_color = $status_colors[$status] ?? $status_colors['Pending'];
                                    ?>
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?php echo $status_color; ?>">
                                        <?php echo $status; ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?php if($status == 'Pending'): ?>
                                        <a href="cancel.php?order_id=<?php echo $row['id']; ?>" 
                                           class="bg-red-500 text-white px-3 py-1 rounded text-xs hover:bg-red-600">
                                            Cancel Order
                                        </a>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    <?php 
                                    echo htmlspecialchars($row['address']) . ", " . 
                                         htmlspecialchars($row['city']) . ", " . 
                                         htmlspecialchars($row['state']) . ", " . 
                                         htmlspecialchars($row['pincode']) . ", " . 
                                         htmlspecialchars($row['country']); 
                                    ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="9" class="px-6 py-4 text-center text-sm text-gray-500">
                                No orders found
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html> 
 