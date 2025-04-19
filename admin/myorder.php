<?php
session_start();
include '../user/config.php';

// Check if admin is logged in
if(!isset($_SESSION["admin"])){
    echo "
    <script>
        alert('Please login as admin first');
        window.location.href = 'login.php';
    </script>
    ";
    exit();
}

// Handle status updates
if(isset($_POST['update_status'])) {
    $order_id = $_POST['order_id'];
    $new_status = $_POST['new_status'];
    
    $update_sql = "UPDATE tblorder SET status = ? WHERE id = ?";
    $update_stmt = $config->prepare($update_sql);
    $update_stmt->bind_param("si", $new_status, $order_id);
    
    if($update_stmt->execute()) {
        echo "
        <script>
            alert('Order status updated successfully!');
            window.location.href = 'myorder.php';
        </script>
        ";
    } else {
        echo "
        <script>
            alert('Error updating order status!');
            window.location.href = 'myorder.php';
        </script>
        ";
    }
}

// Handle order cancellation
if(isset($_POST['cancel_order'])) {
    $order_id = $_POST['order_id'];
    $reason = "Cancelled by admin";
    
    $update_sql = "UPDATE tblorder SET status = 'Cancelled', reason = ? WHERE id = ?";
    $update_stmt = $config->prepare($update_sql);
    $update_stmt->bind_param("si", $reason, $order_id);
    
    if($update_stmt->execute()) {
        echo "
        <script>
            alert('Order cancelled successfully!');
            window.location.href = 'myorder.php';
        </script>
        ";
    } else {
        echo "
        <script>
            alert('Error cancelling order!');
            window.location.href = 'myorder.php';
        </script>
        ";
    }
}

// Fetch all orders
$sql = "SELECT o.* 
        FROM tblorder o 
        ORDER BY o.id DESC";
$result = $config->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Management - Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <div class="flex items-center gap-4">
                <a href="mystore.php" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 flex items-center gap-2">
                    <i class="fas fa-arrow-left"></i>
                    Back to Dashboard
                </a>
                <h1 class="text-2xl font-bold">Order Management</h1>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Payment Mode</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">UTR Number</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Reason</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Delivery Address</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php if($result && $result->num_rows > 0): ?>
                        <?php while($row = $result->fetch_assoc()): ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    #<?php echo $row['id']; ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?php echo htmlspecialchars($row['idofuser']); ?>
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
                                    <?php echo $row['utr_number'] ? $row['utr_number'] : 'N/A'; ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?php
                                    $status_colors = [
                                        'Placed' => 'bg-purple-100 text-purple-800',
                                        'Pending' => 'bg-yellow-100 text-yellow-800',
                                        'Confirmed' => 'bg-blue-100 text-blue-800',
                                        'Shipped' => 'bg-green-100 text-green-800',
                                        'Payment Not Received' => 'bg-red-100 text-red-800'
                                    ];
                                    $status = $row['status'] ?? 'Placed';
                                    $status_color = $status_colors[$status] ?? $status_colors['Placed'];
                                    ?>
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?php echo $status_color; ?>">
                                        <?php echo $status; ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <div class="flex space-x-2">
                                        <form method="POST" class="inline">
                                            <input type="hidden" name="order_id" value="<?php echo $row['id']; ?>">
                                            <input type="hidden" name="new_status" value="Placed">
                                            <button type="submit" name="update_status" 
                                                class="bg-purple-500 text-white px-2 py-1 rounded text-xs hover:bg-purple-600">
                                                Placed
                                            </button>
                                        </form>
                                        <form method="POST" class="inline">
                                            <input type="hidden" name="order_id" value="<?php echo $row['id']; ?>">
                                            <input type="hidden" name="new_status" value="Confirmed">
                                            <button type="submit" name="update_status" 
                                                class="bg-blue-500 text-white px-2 py-1 rounded text-xs hover:bg-blue-600">
                                                Confirm
                                            </button>
                                        </form>
                                        <form method="POST" class="inline">
                                            <input type="hidden" name="order_id" value="<?php echo $row['id']; ?>">
                                            <input type="hidden" name="new_status" value="Shipped">
                                            <button type="submit" name="update_status" 
                                                class="bg-green-500 text-white px-2 py-1 rounded text-xs hover:bg-green-600">
                                                Shipped
                                            </button>
                                        </form>
                                        <form method="POST" class="inline">
                                            <input type="hidden" name="order_id" value="<?php echo $row['id']; ?>">
                                            <input type="hidden" name="new_status" value="Payment Not Received">
                                            <button type="submit" name="update_status" 
                                                class="bg-red-500 text-white px-2 py-1 rounded text-xs hover:bg-red-600">
                                                Payment Not Received
                                            </button>
                                        </form>
                                        <?php if($row['status'] != 'Cancelled' && $row['status'] != 'Shipped'): ?>
                                        <form method="POST" class="inline" onsubmit="return confirm('Are you sure you want to cancel this order?');">
                                            <input type="hidden" name="order_id" value="<?php echo $row['id']; ?>">
                                            <button type="submit" name="cancel_order" 
                                                class="bg-gray-500 text-white px-2 py-1 rounded text-xs hover:bg-gray-600">
                                                Cancel
                                            </button>
                                        </form>
                                        <?php endif; ?>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    <?php 
                                    if($row['status'] == 'Cancelled') {
                                        echo htmlspecialchars($row['reason'] ?? 'No reason provided');
                                    } else {
                                        echo '-';
                                    }
                                    ?>
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
                            <td colspan="12" class="px-6 py-4 text-center text-sm text-gray-500">
                                No orders found
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        // Add any JavaScript functionality here if needed
    </script>
</body>
</html> 