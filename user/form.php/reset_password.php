<?php
include '../header.php';

$message = "";
$valid_token = false;

if (isset($_GET['token'])) {
    $token = $_GET['token'];
    
    // Connect to database
    $conn = mysqli_connect("sql108.infinityfree.com", "if0_38829304", " dvIBeeLAGDguR", "if0_38829304_ecom");
    
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    // Check if token exists
    $query = "SELECT * FROM tbluser WHERE reset_token = '$token'";
    $result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result) > 0) {
        $valid_token = true;
        $user = mysqli_fetch_assoc($result);
        
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
            $new_password = $_POST["new_password"];
            $confirm_password = $_POST["confirm_password"];
            
            if ($new_password === $confirm_password) {
                // Update password and clear reset token
                $update_query = "UPDATE tbluser SET password = '$new_password', repassword = '$new_password', reset_token = NULL WHERE id = " . $user["id"];
                
                if (mysqli_query($conn, $update_query)) {
                    $message = "<div class='bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4' role='alert'>
                                    <span class='block sm:inline'>Password has been reset successfully. You can now login with your new password.</span>
                                </div>";
                    $valid_token = false; // Prevent further use of this token
                } else {
                    $message = "<div class='bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4' role='alert'>
                                    <span class='block sm:inline'>Error resetting password. Please try again.</span>
                                </div>";
                }
            } else {
                $message = "<div class='bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4' role='alert'>
                                <span class='block sm:inline'>New passwords do not match!</span>
                            </div>";
            }
        }
    } else {
        $message = "<div class='bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4' role='alert'>
                        <span class='block sm:inline'>Invalid or expired reset link. Please request a new one.</span>
                    </div>";
    }
    
    mysqli_close($conn);
} else {
    $message = "<div class='bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4' role='alert'>
                    <span class='block sm:inline'>Invalid reset link. Please request a new one.</span>
                </div>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - E-SHOPER</title>
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
            <h1 class="text-4xl font-bold text-white mb-2">Reset Password</h1>
            <p class="text-white/80">Enter your new password</p>
        </div>

        <!-- Reset Password Form -->
        <div class="bg-white/95 backdrop-blur-md rounded-2xl shadow-2xl p-8">
            <?php echo $message; ?>
            
            <?php if ($valid_token): ?>
            <form action="reset_password.php?token=<?php echo $token; ?>" method="post" class="space-y-6">
                <!-- New Password Input -->
                <div class="space-y-2">
                    <label for="new_password" class="block text-sm font-medium text-gray-700">New Password</label>
                    <div class="relative">
                        <i class="fas fa-lock absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <input 
                            type="password" 
                            name="new_password" 
                            id="new_password" 
                            class="w-full h-12 pl-10 pr-12 rounded-lg border border-gray-300 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-200 outline-none" 
                            placeholder="Enter new password"
                            required>
                        <button 
                            type="button"
                            onclick="togglePassword('new_password', 'newPassToggle')"
                            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 focus:outline-none">
                            <i id="newPassToggle" class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <!-- Confirm Password Input -->
                <div class="space-y-2">
                    <label for="confirm_password" class="block text-sm font-medium text-gray-700">Confirm New Password</label>
                    <div class="relative">
                        <i class="fas fa-lock absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <input 
                            type="password" 
                            name="confirm_password" 
                            id="confirm_password" 
                            class="w-full h-12 pl-10 pr-12 rounded-lg border border-gray-300 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-200 outline-none" 
                            placeholder="Confirm new password"
                            required>
                        <button 
                            type="button"
                            onclick="togglePassword('confirm_password', 'confirmPassToggle')"
                            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 focus:outline-none">
                            <i id="confirmPassToggle" class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit" 
                    name="submit" 
                    class="w-full h-12 bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-medium rounded-lg hover:from-purple-700 hover:to-indigo-700 focus:ring-4 focus:ring-purple-300 transition-all duration-200 flex items-center justify-center space-x-2">
                    <i class="fas fa-save"></i>
                    <span>Reset Password</span>
                </button>
            </form>
            <?php else: ?>
            <div class="text-center">
                <a href="forgot_password.php" class="text-purple-600 font-medium hover:text-purple-700 transition-colors duration-200">
                    Request New Reset Link
                </a>
            </div>
            <?php endif; ?>

            <!-- Back to Login Link -->
            <div class="text-center mt-6">
                <p class="text-gray-600">
                    Remember your password? 
                    <a href="login.php" class="text-purple-600 font-medium hover:text-purple-700 transition-colors duration-200">
                        Login Here
                    </a>
                </p>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center mt-8 text-white/60 text-sm">
            © 2024 E-SHOPER. All rights reserved.
        </div>
    </div>

    <script src="https://kit.fontawesome.com/cd899bf2d5.js" crossorigin="anonymous"></script>
    <script>
        function togglePassword(inputId, toggleId) {
            const input = document.getElementById(inputId);
            const toggle = document.getElementById(toggleId);
            
            if (input.type === 'password') {
                input.type = 'text';
                toggle.classList.remove('fa-eye');
                toggle.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                toggle.classList.remove('fa-eye-slash');
                toggle.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html> 