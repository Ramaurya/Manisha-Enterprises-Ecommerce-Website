<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - ManishaEnterprise</title>
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
        .password-requirements {
            display: none;
        }
        .password-requirements.show {
            display: block;
        }
        .requirement {
            color: #6b7280;
            font-size: 0.875rem;
            margin: 0.25rem 0;
        }
        .requirement.valid {
            color: #10b981;
        }
        .requirement.invalid {
            color: #ef4444;
        }
    </style>
</head>
<body class="animate-gradient min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-xl">
        <!-- Logo Section -->
        <div class="text-center mb-8">
            <div class="inline-block p-4 rounded-full bg-white/10 backdrop-blur-sm mb-4">
                <i class="fas fa-user-plus text-4xl text-white"></i>
            </div>
            <h1 class="text-4xl font-bold text-white mb-2">Create Account</h1>
            <p class="text-white/80">Join ManishaEnterprise and start shopping today</p>
        </div>

        <!-- Registration Form -->
        <div class="bg-white/95 backdrop-blur-md rounded-2xl shadow-2xl p-8 hover-scale">
            <form action="insert.php" method="POST" class="space-y-6" id="registerForm">
                <!-- Name Input -->
                <div class="space-y-2">
                    <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                    <div class="relative">
                        <i class="fas fa-user absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <input 
                            type="text" 
                            required 
                            name="name" 
                            id="name" 
                            class="w-full h-12 pl-10 pr-4 rounded-lg border border-gray-300 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-200 outline-none" 
                            placeholder="Enter your full name">
                    </div>
                </div>

                <!-- Mobile Number Input -->
                <div class="space-y-2">
                    <label for="number" class="block text-sm font-medium text-gray-700">Mobile Number</label>
                    <div class="relative">
                        <i class="fas fa-phone absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <input 
                            type="number" 
                            required 
                            name="number" 
                            id="number" 
                            class="w-full h-12 pl-10 pr-4 rounded-lg border border-gray-300 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-200 outline-none" 
                            placeholder="Enter your mobile number">
                        <p id="warning-mobile" class="hidden text-red-500 text-sm mt-1">Number should be exactly 10 digits</p>
                    </div>
                </div>

                <!-- Email Input -->
                <div class="space-y-2">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                    <div class="relative">
                        <i class="fas fa-envelope absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <input 
                            type="email" 
                            required 
                            name="email" 
                            id="email" 
                            class="w-full h-12 pl-10 pr-4 rounded-lg border border-gray-300 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-200 outline-none" 
                            placeholder="Enter your email address">
                    </div>
                </div>

                <!-- Password Input -->
                <div class="space-y-2">
                    <label for="pass" class="block text-sm font-medium text-gray-700">Password</label>
                    <div class="relative">
                        <i class="fas fa-lock absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <input 
                            type="password" 
                            required 
                            name="pass" 
                            id="pass" 
                            class="w-full h-12 pl-10 pr-12 rounded-lg border border-gray-300 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-200 outline-none" 
                            placeholder="Create a password">
                        <button 
                            type="button"
                            onclick="togglePassword('pass', 'passToggle')"
                            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 focus:outline-none">
                            <i id="passToggle" class="fas fa-eye"></i>
                        </button>
                    </div>
                    <div id="password-requirements" class="password-requirements mt-2">
                        <p id="length" class="requirement">At least 8 characters long</p>
                        <p id="uppercase" class="requirement">Contains at least one uppercase letter</p>
                        <p id="lowercase" class="requirement">Contains at least one lowercase letter</p>
                        <p id="number" class="requirement">Contains at least one number</p>
                        <p id="special" class="requirement">Contains at least one special character</p>
                    </div>
                </div>

                <!-- Confirm Password Input -->
                <div class="space-y-2">
                    <label for="repass" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                    <div class="relative">
                        <i class="fas fa-lock absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <input 
                            type="password" 
                            required 
                            name="repass" 
                            id="repass" 
                            class="w-full h-12 pl-10 pr-12 rounded-lg border border-gray-300 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-200 outline-none" 
                            placeholder="Confirm your password">
                        <button 
                            type="button"
                            onclick="togglePassword('repass', 'repassToggle')"
                            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 focus:outline-none">
                            <i id="repassToggle" class="fas fa-eye"></i>
                        </button>
                        <p id="warning-password" class="hidden text-red-500 text-sm mt-1">Passwords do not match</p>
                    </div>
                </div>

                <!-- Terms and Conditions -->
                <div class="flex items-start gap-3">
                    <div class="flex items-center h-5">
                        <input 
                            type="checkbox" 
                            name="terms" 
                            id="terms" 
                            required 
                            class="h-4 w-4 rounded border-gray-300 text-purple-600 focus:ring-purple-500">
                    </div>
                    <label for="terms" class="text-sm text-gray-600">
                        I agree to the <a href="../terms.php" class="text-purple-600 hover:text-purple-700 font-medium" target="_blank">Terms and Conditions</a>
                    </label>
                </div>
                <p id="warning_msg" class="hidden text-red-500 text-sm text-center">Please agree to the terms and conditions</p>

                <!-- Submit Button -->
                <button 
                    type="submit" 
                    class="w-full h-12 bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-medium rounded-lg hover:from-purple-700 hover:to-indigo-700 focus:ring-4 focus:ring-purple-300 transition-all duration-200 flex items-center justify-center space-x-2" 
                    id="btn" 
                    name="submit">
                    <i class="fas fa-user-plus"></i>
                    <span>Create Account</span>
                </button>

                <!-- Login Link -->
                <div class="text-center">
                    <p class="text-gray-600">
                        Already have an account? 
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

        const passwordInput = document.getElementById('pass');
        const confirmPasswordInput = document.getElementById('repass');
        const passwordRequirements = document.getElementById('password-requirements');
        const warningPassword = document.getElementById('warning-password');

        // Show password requirements when password field is focused
        passwordInput.addEventListener('focus', () => {
            passwordRequirements.classList.add('show');
        });

        // Hide password requirements when clicking outside
        document.addEventListener('click', (e) => {
            if (!passwordInput.contains(e.target)) {
                passwordRequirements.classList.remove('show');
            }
        });

        // Password validation
        passwordInput.addEventListener('input', () => {
            const password = passwordInput.value;
            
            // Check length
            document.getElementById('length').classList.toggle('valid', password.length >= 8);
            document.getElementById('length').classList.toggle('invalid', password.length < 8);
            
            // Check uppercase
            document.getElementById('uppercase').classList.toggle('valid', /[A-Z]/.test(password));
            document.getElementById('uppercase').classList.toggle('invalid', !/[A-Z]/.test(password));
            
            // Check lowercase
            document.getElementById('lowercase').classList.toggle('valid', /[a-z]/.test(password));
            document.getElementById('lowercase').classList.toggle('invalid', !/[a-z]/.test(password));
            
            // Check number
            document.getElementById('number').classList.toggle('valid', /[0-9]/.test(password));
            document.getElementById('number').classList.toggle('invalid', !/[0-9]/.test(password));
            
            // Check special character
            document.getElementById('special').classList.toggle('valid', /[!@#$%^&*(),.?":{}|<>]/.test(password));
            document.getElementById('special').classList.toggle('invalid', !/[!@#$%^&*(),.?":{}|<>]/.test(password));
        });

        // Password match validation
        confirmPasswordInput.addEventListener('input', () => {
            if (confirmPasswordInput.value !== passwordInput.value) {
                warningPassword.classList.remove('hidden');
            } else {
                warningPassword.classList.add('hidden');
            }
        });

        // Form submission validation
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            const password = passwordInput.value;
            const confirmPassword = confirmPasswordInput.value;
            const termsCheckbox = document.getElementById('terms');
            
            // Check password requirements
            const hasLength = password.length >= 8;
            const hasUppercase = /[A-Z]/.test(password);
            const hasLowercase = /[a-z]/.test(password);
            const hasNumber = /[0-9]/.test(password);
            const hasSpecial = /[!@#$%^&*(),.?":{}|<>]/.test(password);
            
            if (!hasLength || !hasUppercase || !hasLowercase || !hasNumber || !hasSpecial) {
                e.preventDefault();
                alert('Please ensure your password meets all requirements');
                return false;
            }
            
            if (password !== confirmPassword) {
                e.preventDefault();
                warningPassword.classList.remove('hidden');
                return false;
            }
            
            if (!termsCheckbox.checked) {
                e.preventDefault();
                document.getElementById('warning_msg').classList.remove('hidden');
                return false;
            }
            
            document.getElementById('warning_msg').classList.add('hidden');
        });
    </script>
</body>
</html>

