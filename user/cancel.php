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

$user_id = $_SESSION["user"];
$order_id = isset($_GET['order_id']) ? $_GET['order_id'] : 0;

// Verify order belongs to user and is pending
$check_sql = "SELECT * FROM tblorder WHERE id = ? AND idofuser = ? AND status = 'Pending'";
$check_stmt = $config->prepare($check_sql);
$check_stmt->bind_param("is", $order_id, $user_id);
$check_stmt->execute();
$result = $check_stmt->get_result();

if($result->num_rows === 0) {
    echo "
    <script>
        alert('Invalid order or order cannot be cancelled');
        window.location.href = 'vieworder.php';
    </script>
    ";
    exit();
}

$order = $result->fetch_assoc();

// Handle form submission
if(isset($_POST['confirm_cancel'])) {
    $reason = trim($_POST['reason']);
    
    if(empty($reason)) {
        echo "
        <script>
            alert('Please provide a reason for cancellation');
        </script>
        ";
    } else {
        // Update order status and reason
        $update_sql = "UPDATE tblorder SET status = 'Cancelled', reason = ? WHERE id = ? AND idofuser = ?";
        $update_stmt = $config->prepare($update_sql);
        $update_stmt->bind_param("sis", $reason, $order_id, $user_id);
        
        if($update_stmt->execute()) {
            echo "
            <script>
                alert('Order cancelled successfully');
                window.location.href = 'vieworder.php';
            </script>
            ";
            exit();
        } else {
            echo "
            <script>
                alert('Error cancelling order');
            </script>
            ";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cancel Order - E-SHOPER</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <?php include 'header.php'; ?>

    <div class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h1 class="text-2xl font-bold mb-6">Cancel Order #<?php echo $order_id; ?></h1>
                
                <div class="mb-6">
                    <h2 class="text-lg font-semibold mb-2">Order Details</h2>
                    <p class="text-gray-600">
                        Product: <?php echo htmlspecialchars($order['pname']); ?><br>
                        Quantity: <?php echo $order['quantity']; ?><br>
                        Total: ₹<?php echo number_format($order['pprice'] * $order['quantity'], 2); ?>
                    </p>
                </div>

                <form method="POST" class="space-y-4">
                    <div>
                        <label for="reason" class="block text-sm font-medium text-gray-700 mb-2">
                            Please provide a reason for cancellation
                        </label>
                        <textarea 
                            id="reason" 
                            name="reason" 
                            rows="4" 
                            required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Enter your reason for cancellation"
                        ></textarea>
                    </div>

                    <div class="flex justify-end space-x-4">
                        <a href="vieworder.php" 
                           class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500">
                            Back
                        </a>
                        <button 
                            type="submit" 
                            name="confirm_cancel"
                            class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500"
                        >
                            Confirm Cancellation
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html> 