<?php
session_start();

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

require_once 'config.php';

$user_id = $_SESSION["user"];

// Fetch orders for the current user
$sql = "SELECT * FROM tblorder WHERE idofuser = ? ORDER BY created_at DESC";
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
    <title>Your Orders - E-SHOPER</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .success-popup {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            animation: slideIn 0.5s ease-out;
        }

        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .success-icon {
            animation: scaleIn 0.5s ease-out;
        }

        @keyframes scaleIn {
            from {
                transform: scale(0);
            }
            to {
                transform: scale(1);
            }
        }
    </style>
</head>
<body class="bg-gray-100">
    <?php include 'header.php'; ?>

    <!-- Success Popup -->
    <div class="success-popup bg-white">
        <div class="flex items-center">
            <div class="success-icon flex-shrink-0 w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mr-4">
                <i class="fas fa-check-circle text-3xl text-green-600"></i>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-gray-900">Order Placed Successfully!</h3>
                <p class="text-sm text-gray-600">Thank you for shopping with us</p>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-8">Your Orders</h1>

        <?php if ($result->num_rows > 0): ?>
            <div class="grid gap-6">
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h2 class="text-xl font-semibold text-gray-900"><?php echo htmlspecialchars($row['pname']); ?></h2>
                                <p class="text-sm text-gray-600">Order Date: <?php echo date('d M Y, h:i A', strtotime($row['created_at'])); ?></p>
                            </div>
                            <div class="text-right">
                                <p class="text-lg font-semibold text-gray-900">₹<?php echo number_format($row['pprice'] * $row['quantity'], 2); ?></p>
                                <p class="text-sm text-gray-600">Qty: <?php echo $row['quantity']; ?></p>
                            </div>
                        </div>
                        <div class="border-t border-gray-200 pt-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <h3 class="text-sm font-medium text-gray-900">Delivery Address</h3>
                                    <p class="mt-1 text-sm text-gray-600">
                                        <?php echo htmlspecialchars($row['address']); ?><br>
                                        <?php echo htmlspecialchars($row['city']); ?>, <?php echo htmlspecialchars($row['state']); ?><br>
                                        <?php echo htmlspecialchars($row['pincode']); ?>, <?php echo htmlspecialchars($row['country']); ?>
                                    </p>
                                </div>
                                <div>
                                    <h3 class="text-sm font-medium text-gray-900">Payment Details</h3>
                                    <p class="mt-1 text-sm text-gray-600">
                                        Mode: <?php echo $row['paymentmode'] === 'cod' ? 'Cash on Delivery' : 'Online Payment'; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <div class="bg-white rounded-lg shadow-md p-6 text-center">
                <p class="text-gray-500">You haven't placed any orders yet.</p>
                <a href="index.php" class="text-blue-500 hover:text-blue-700 mt-4 inline-block">Start Shopping</a>
            </div>
        <?php endif; ?>
    </div>

    <!-- Confetti Animation -->
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.4.0/dist/confetti.browser.min.js"></script>
    <script>
        // Trigger confetti animation immediately
        confetti({
            particleCount: 100,
            spread: 70,
            origin: { y: 0.6 }
        });

        // Hide popup after 5 seconds
        setTimeout(() => {
            const popups = document.getElementsByClassName('success-popup');
            for (let popup of popups) {
                popup.style.animation = 'slideOut 0.5s ease-in forwards';
                setTimeout(() => {
                    popup.style.display = 'none';
                }, 500);
            }
        }, 5000);
    </script>
</body>
</html> 