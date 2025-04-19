<?php
session_start();
if(!isset($_SESSION['reset_mobile'])) {
    header("Location: login.php");
    exit();
}

if(isset($_POST['change_password'])) {
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    $phone = $_SESSION['phone'];

    // Validate passwords match
    if($new_password !== $confirm_password) {
        $error = "Passwords do not match!";
    } else {
        // Connect to database
        $conn = mysqli_connect("localhost", "root", "", "ecom");
        
        if(!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Update password in database
        $query = "UPDATE tbluser SET password = ?, repassword = ? WHERE number = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sss", $new_password, $new_password, $phone);
        
        if($stmt->execute()) {
            // Password updated successfully
            echo "<script>
                alert('Password changed successfully!');
                window.location.href = 'login.php';
            </script>";
            exit();
        } else {
            $error = "Failed to update password. Please try again.";
        }
        
        $stmt->close();
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password - ManishaEnterprise</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .animate-gradient {
            background: linear-gradient(-45deg, #4f46e5, #7c3aed, #9333ea, #6366f1);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
        }
        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
    </style>
</head>
<body class="animate-gradient min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <!-- Logo Section -->
        <div class="text-center mb-8">
            <div class="inline-block p-4 rounded-full bg-white/10 backdrop-blur-sm mb-4">
                <i class="fas fa-lock text-4xl text-white"></i>
            </div>
            <h1 class="text-4xl font-bold text-white mb-2">Change Password</h1>
            <p class="text-white/80">Create a new password for your account</p>
        </div>

        <!-- Change Password Form -->
        <div class="bg-white/95 backdrop-blur-md rounded-2xl shadow-2xl p-8">
            <?php if(isset($error)){ ?>
                <div class="mb-6 p-4 rounded-lg bg-red-100 text-red-700">
                    <?php echo $error; ?>
                </div>
            <?php } ?>

            <form action="" method="POST" class="space-y-6" id="passwordForm">
                <!-- New Password Input -->
                <div class="space-y-2">
                    <label for="new_password" class="block text-sm font-medium text-gray-700">New Password</label>
                    <div class="relative">
                        <input 
                            type="password" 
                            name="new_password" 
                            id="new_password" 
                            class="w-full h-12 pl-10 pr-4 rounded-lg border border-gray-300 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-200 outline-none" 
                            placeholder="Enter new password"
                            required
                            minlength="6">
                        <i class="fas fa-lock absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <button 
                            type="button"
                            onclick="togglePassword('new_password')"
                            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <!-- Confirm Password Input -->
                <div class="space-y-2">
                    <label for="confirm_password" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                    <div class="relative">
                        <input 
                            type="password" 
                            name="confirm_password" 
                            id="confirm_password" 
                            class="w-full h-12 pl-10 pr-4 rounded-lg border border-gray-300 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-200 outline-none" 
                            placeholder="Confirm new password"
                            required
                            minlength="6">
                        <i class="fas fa-lock absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <button 
                            type="button"
                            onclick="togglePassword('confirm_password')"
                            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <!-- Password Requirements -->
                <div class="text-sm text-gray-600 space-y-1">
                    <p class="flex items-center">
                        <i class="fas fa-check-circle text-green-500 mr-2"></i>
                        Minimum 6 characters
                    </p>
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit" 
                    name="change_password" 
                    class="w-full h-12 bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-medium rounded-lg hover:from-purple-700 hover:to-indigo-700 focus:ring-4 focus:ring-purple-300 transition-all duration-200 flex items-center justify-center space-x-2">
                    <i class="fas fa-check-circle"></i>
                    <span>Change Password</span>
                </button>
            </form>
        </div>

        <!-- Footer -->
        <div class="text-center mt-8 text-white/60 text-sm">
            © 2024 ManishaEnterprise. All rights reserved.
        </div>
    </div>

    <script src="https://kit.fontawesome.com/cd899bf2d5.js" crossorigin="anonymous"></script>
    <script>
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const button = input.nextElementSibling;
            const icon = button.querySelector('i');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }

        // Password validation
        document.getElementById('passwordForm').addEventListener('submit', function(e) {
            const newPassword = document.getElementById('new_password').value;
            const confirmPassword = document.getElementById('confirm_password').value;

            if (newPassword !== confirmPassword) {
                e.preventDefault();
                alert('Passwords do not match!');
            }
        });
    </script>
</body>
</html>
<?php
session_destroy();
?>
