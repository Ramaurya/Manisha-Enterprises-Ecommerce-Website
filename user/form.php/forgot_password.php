<?php
session_start();

if(isset($_POST['submit'])) {
    $mobile = $_POST['mobile'];
    
    // Database connection
    $conn = mysqli_connect("sql12.freesqldatabase.com", "sql12774871", "BAADiPVYle", "sql12774871");
    
    // Check if mobile number exists
    $query = "SELECT * FROM tbluser WHERE number = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $mobile);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        // Mobile number exists, generate OTP and proceed
        $_SESSION['reset_mobile'] = $mobile;
        $_SESSION['OTP'] = rand(1111, 9999); // Generate 4-digit OTP
        echo "<script>window.location.href = 'send-otp.php';</script>";
        exit();
    } else {
        // Mobile number doesn't exist
        echo "<script>alert('Mobile number does not exist in our records!');</script>";
    }
    
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - ManishaEnterprise</title>
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
                <i class="fas fa-key text-4xl text-white"></i>
            </div>
            <h1 class="text-4xl font-bold text-white mb-2">Forgot Password</h1>
            <p class="text-white/80">Enter your mobile number to reset your password</p>
        </div>

        <!-- Forgot Password Form -->
        <div class="bg-white/95 backdrop-blur-md rounded-2xl shadow-2xl p-8">
            <form action="" method="post" class="space-y-6">
                <!-- Mobile Number Input -->
                <div class="space-y-2">
                    <label for="mobile" class="block text-sm font-medium text-gray-700">Mobile Number</label>
                    <div class="relative">
                        <i class="fas fa-phone absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <input 
                            type="number" 
                            name="mobile" 
                            id="mobile" 
                            class="w-full h-12 pl-10 pr-4 rounded-lg border border-gray-300 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-200 outline-none" 
                            placeholder="Enter your mobile number"
                            required>
                    </div>
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit" 
                    name="submit" 
                    class="w-full h-12 bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-medium rounded-lg hover:from-purple-700 hover:to-indigo-700 focus:ring-4 focus:ring-purple-300 transition-all duration-200 flex items-center justify-center space-x-2">
                    <i class="fas fa-paper-plane"></i>
                    <span>Continue</span>
                </button>

                <!-- Back to Login Link -->
                <div class="text-center">
                    <p class="text-gray-600">
                        Remember your password? 
                        <a href="login.php" class="text-purple-600 font-medium hover:text-purple-700 transition-colors duration-200">
                            Login Here
                        </a>
                    </p>
                </div>
            </form>
        </div>

        <!-- Footer -->
        <div class="text-center mt-8 text-white/60 text-sm">
            © 2024 ManishaEnterprise. All rights reserved.
        </div>
    </div>

    <script src="https://kit.fontawesome.com/cd899bf2d5.js" crossorigin="anonymous"></script>
</body>
</html>
