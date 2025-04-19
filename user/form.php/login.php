<?php


if(isset($_POST["submited"])){
    $mobile = $_POST["num"];
    $password = $_POST["pass"];

    $mycon = mysqli_connect("localhost","root","","ecom");
    if(!$mycon){
        die("Connection failed: ".mysqli_connect_error());
    }
    else{
        $sql = "SELECT * FROM tbluser WHERE number = ? AND password= ?";
        $stmp = $mycon->prepare($sql);
        if(!$stmp){
            die("prepared statement failed: ".$mycon->error);
        }
        $stmp->bind_param("ss",$mobile,$password);
        $stmp->execute();
        $result = $stmp->get_result();

        //session start
        session_start();

        if($result->num_rows > 0){
            
            $_SESSION["user"] = $mobile;
            // $_SESSION["logged_in"] = true;
            header("Location: ../index.php");
            exit();
        }
        else{
            echo "
             <script>
            alert('invalid mobile number or password');
            window.location.href = 'login.php';
        </script>
            ";
            
        }
        $stmp->close();
        $mycon->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login - ManishaEnterprise</title>
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
        .hover-scale {
            transition: transform 0.2s ease;
        }
        .hover-scale:hover {
            transform: scale(1.02);
        }
        .input-icon {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            left: 1rem;
            color: #6b7280;
        }
    </style>
</head>
<body class="animate-gradient min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <!-- Logo Section -->
        <div class="text-center mb-8">
            <div class="inline-block p-4 rounded-full bg-white/10 backdrop-blur-sm mb-4">
                <i class="fas fa-shopping-bag text-4xl text-white"></i>
            </div>
            <h1 class="text-4xl font-bold text-white mb-2">Welcome Back!</h1>
            <p class="text-white/80">Login to access your ManishaEnterprise account</p>
        </div>

        <!-- Login Form -->
        <div class="bg-white/95 backdrop-blur-md rounded-2xl shadow-2xl p-8 hover-scale">
            <form action="login.php" method="post" class="space-y-6">
                <!-- Mobile Number Input -->
                <div class="space-y-2">
                    <label for="num" class="block text-sm font-medium text-gray-700">Mobile Number</label>
                    <div class="relative">
                        <i class="fas fa-phone absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <input 
                            type="number" 
                            name="num" 
                            id="num" 
                            class="w-full h-12 pl-10 pr-4 rounded-lg border border-gray-300 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-200 outline-none" 
                            placeholder="Enter your mobile number"
                            required>
                        <p class="hidden text-red-500 text-sm mt-1" id="warn">Please enter a valid number</p>
                    </div>
                </div>

                <!-- Password Input -->
                <div class="space-y-2">
                    <label for="pass" class="block text-sm font-medium text-gray-700">Password</label>
                    <div class="relative">
                        <i class="fas fa-lock absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <input 
                            type="password" 
                            name="pass" 
                            id="pass" 
                            class="w-full h-12 pl-10 pr-12 rounded-lg border border-gray-300 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-200 outline-none" 
                            placeholder="Enter your password"
                            required>
                        <button 
                            type="button"
                            onclick="togglePassword('pass', 'passToggle')"
                            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 focus:outline-none">
                            <i id="passToggle" class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between text-sm">
                    <label class="flex items-center">
                        <input type="checkbox" class="rounded border-gray-300 text-purple-600 shadow-sm focus:border-purple-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50">
                        <span class="ml-2 text-gray-600">Remember me</span>
                    </label>
                    <a href="forgot_password.php" class="text-purple-600 hover:text-purple-700 transition-colors duration-200">Forgot Password?</a>
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit" 
                    name="submited" 
                    id="btn"
                    class="w-full h-12 bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-medium rounded-lg hover:from-purple-700 hover:to-indigo-700 focus:ring-4 focus:ring-purple-300 transition-all duration-200 flex items-center justify-center space-x-2">
                    <i class="fas fa-sign-in-alt"></i>
                    <span>Login to Account</span>
                </button>

                <!-- Register Link -->
                <div class="text-center">
                    <p class="text-gray-600">
                        Don't have an account? 
                        <a href="register.php" class="text-purple-600 font-medium hover:text-purple-700 transition-colors duration-200">
                            Register Now
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
