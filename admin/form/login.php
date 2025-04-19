<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .animate-gradient {
            background: linear-gradient(-45deg, #1e40af, #3b82f6, #0ea5e9, #0284c7);
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
    </style>
</head>
<body class="min-h-screen animate-gradient flex items-center justify-center p-4">
    <div class="w-full max-w-lg">
        <!-- Logo Section -->
        <div class="text-center mb-8">
            <div class="inline-block p-4 rounded-full bg-white/10 backdrop-blur-sm mb-4">
                <i class="fas fa-user-shield text-4xl text-white"></i>
            </div>
            <h1 class="text-4xl font-bold text-white mb-2">Admin Portal</h1>
            <p class="text-white/80">Please login to access the dashboard</p>
        </div>

        <!-- Login Form -->
        <div class="bg-white rounded-2xl shadow-2xl p-8 hover-scale">
            <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">Welcome Back!</h2>
            
            <form action="login1.php" method="post" class="space-y-6">
                <!-- Username Input -->
                <div class="space-y-2">
                    <label for="name" class="block text-sm font-medium text-gray-700">Username</label>
                    <div class="relative">
                        <i class="fas fa-user absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <input 
                            type="text" 
                            name="username" 
                            id="name" 
                            required 
                            class="w-full h-12 pl-10 pr-4 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 outline-none" 
                            placeholder="Enter your username">
                    </div>
                </div>

                <!-- Password Input -->
                <div class="space-y-2">
                    <label for="pass" class="block text-sm font-medium text-gray-700">Password</label>
                    <div class="relative">
                        <i class="fas fa-lock absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <input 
                            type="password" 
                            name="userpassword" 
                            id="pass" 
                            required 
                            class="w-full h-12 pl-10 pr-4 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 outline-none" 
                            placeholder="Enter your password">
                    </div>
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit" 
                    name="submit" 
                    class="w-full h-12 bg-gradient-to-r from-blue-600 to-blue-800 text-white font-medium rounded-lg hover:from-blue-700 hover:to-blue-900 focus:ring-4 focus:ring-blue-300 transition-all duration-200 flex items-center justify-center space-x-2">
                    <i class="fas fa-sign-in-alt"></i>
                    <span>Login to Dashboard</span>
                </button>
            </form>

            

        <!-- Footer -->
        <div class="text-center mt-8 text-white/60 text-sm">
            © 2024 E-SHOPER Admin Portal. All rights reserved.
        </div>
    </div>

    <script src="https://kit.fontawesome.com/cd899bf2d5.js" crossorigin="anonymous"></script>
</body>
</html>