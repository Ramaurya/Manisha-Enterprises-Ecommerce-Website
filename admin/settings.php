<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings Hub - ManishaEnterprise</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        poppins: ['Poppins', 'sans-serif'],
                    },
                    animation: {
                        'spin-slow': 'spin 3s linear infinite',
                        'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f3f4f6;
        }
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .feature-card {
            transition: all 0.3s ease;
        }
        .feature-card:hover {
            transform: translateY(-5px);
        }
        .gradient-text {
            background: linear-gradient(135deg, #FF6B6B 0%, #FF8E53 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .progress-line {
            height: 3px;
            background: linear-gradient(to right, #FF6B6B, #FF8E53);
            animation: progress 2s ease-in-out infinite;
        }
        @keyframes progress {
            0% { width: 0%; }
            50% { width: 100%; }
            100% { width: 0%; }
        }
    </style>
    <?php
    session_start();
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
    if(!isset($_SESSION['admin'] )){
        header("location:form/login.php");
        exit();
    }
?>
</head>
<body class="min-h-screen bg-gradient-to-br from-orange-50 to-red-50 p-8">
    <!-- Main Container -->
    <div class="max-w-7xl mx-auto">
        <!-- Header Section -->
        <div class="text-center mb-12">
            <a href="mystore.php" class="inline-flex items-center text-gray-600 hover:text-gray-800 transition-colors mb-8">
                <i class="fas fa-arrow-left mr-2"></i>
                <span>Back to Dashboard</span>
            </a>
            <div class="relative inline-block mb-6">
                <div class="absolute inset-0 bg-orange-500 rounded-full blur-lg opacity-20"></div>
                <div class="relative bg-white p-4 rounded-2xl shadow-lg animate-spin-slow">
                    <i class="fas fa-cogs text-4xl gradient-text"></i>
                </div>
            </div>
            <h1 class="text-4xl font-bold mb-4 gradient-text">Settings Hub</h1>
            <p class="text-gray-600 max-w-2xl mx-auto">Customize and configure your store exactly the way you want it.</p>
            <div class="max-w-xs mx-auto mt-6 bg-white rounded-full h-1 overflow-hidden">
                <div class="progress-line"></div>
            </div>
        </div>

        <!-- Features Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
            <!-- Store Settings -->
            <div class="feature-card bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="p-6">
                    <div class="w-16 h-16 bg-orange-50 rounded-2xl flex items-center justify-center mb-6 mx-auto">
                        <i class="fas fa-store text-2xl text-orange-500"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2 text-center">Store Settings</h3>
                    <p class="text-gray-500 text-sm text-center mb-4">Customize your store's appearance and behavior</p>
                    <div class="text-center">
                        <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-orange-50 text-orange-600">
                            Coming Soon
                        </span>
                    </div>
                </div>
                <div class="bg-orange-50 px-6 py-4">
                    <div class="text-xs text-orange-600 flex items-center justify-center">
                        <i class="fas fa-palette mr-2"></i>
                        Theme & Layout Options
                    </div>
                </div>
            </div>

            <!-- Email Settings -->
            <div class="feature-card bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="p-6">
                    <div class="w-16 h-16 bg-blue-50 rounded-2xl flex items-center justify-center mb-6 mx-auto">
                        <i class="fas fa-envelope text-2xl text-blue-500"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2 text-center">Email Settings</h3>
                    <p class="text-gray-500 text-sm text-center mb-4">Configure email notifications and templates</p>
                    <div class="text-center">
                        <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-blue-50 text-blue-600">
                            Coming Soon
                        </span>
                    </div>
                </div>
                <div class="bg-blue-50 px-6 py-4">
                    <div class="text-xs text-blue-600 flex items-center justify-center">
                        <i class="fas fa-paper-plane mr-2"></i>
                        Notification Management
                    </div>
                </div>
            </div>

            <!-- Payment Settings -->
            <div class="feature-card bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="p-6">
                    <div class="w-16 h-16 bg-green-50 rounded-2xl flex items-center justify-center mb-6 mx-auto">
                        <i class="fas fa-credit-card text-2xl text-green-500"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2 text-center">Payment Settings</h3>
                    <p class="text-gray-500 text-sm text-center mb-4">Manage payment gateways and methods</p>
                    <div class="text-center">
                        <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-green-50 text-green-600">
                            Coming Soon
                        </span>
                    </div>
                </div>
                <div class="bg-green-50 px-6 py-4">
                    <div class="text-xs text-green-600 flex items-center justify-center">
                        <i class="fas fa-money-bill mr-2"></i>
                        Payment Integration
                    </div>
                </div>
            </div>

            <!-- Security Settings -->
            <div class="feature-card bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="p-6">
                    <div class="w-16 h-16 bg-purple-50 rounded-2xl flex items-center justify-center mb-6 mx-auto">
                        <i class="fas fa-shield-alt text-2xl text-purple-500"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2 text-center">Security</h3>
                    <p class="text-gray-500 text-sm text-center mb-4">Configure security and access controls</p>
                    <div class="text-center">
                        <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-purple-50 text-purple-600">
                            Coming Soon
                        </span>
                    </div>
                </div>
                <div class="bg-purple-50 px-6 py-4">
                    <div class="text-xs text-purple-600 flex items-center justify-center">
                        <i class="fas fa-lock mr-2"></i>
                        Advanced Protection
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Features Section -->
        <div class="bg-white rounded-2xl shadow-lg p-8 text-center mb-8">
            <h3 class="text-2xl font-semibold mb-6 gradient-text">More Features Coming Soon</h3>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <div class="p-4 rounded-xl bg-gray-50">
                    <i class="fas fa-users text-gray-400 text-xl mb-2"></i>
                    <p class="text-sm text-gray-600">User Management</p>
                </div>
                <div class="p-4 rounded-xl bg-gray-50">
                    <i class="fas fa-language text-gray-400 text-xl mb-2"></i>
                    <p class="text-sm text-gray-600">Language Settings</p>
                </div>
                <div class="p-4 rounded-xl bg-gray-50">
                    <i class="fas fa-box text-gray-400 text-xl mb-2"></i>
                    <p class="text-sm text-gray-600">Inventory Control</p>
                </div>
                <div class="p-4 rounded-xl bg-gray-50">
                    <i class="fas fa-chart-line text-gray-400 text-xl mb-2"></i>
                    <p class="text-sm text-gray-600">Analytics Setup</p>
                </div>
            </div>
        </div>

        <!-- Action Button -->
        <div class="text-center">
            <a href="mystore.php" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-orange-500 to-red-500 text-white font-medium rounded-lg hover:from-orange-600 hover:to-red-600 transition-all duration-200 shadow-lg hover:shadow-xl">
                <i class="fas fa-arrow-left mr-2"></i>
                Return to Dashboard
            </a>
        </div>

        <!-- Footer -->
        <div class="text-center mt-12 text-gray-500 text-sm">
            © 2024 ManishaEnterprise. All rights reserved.
        </div>
    </div>

    <!-- Floating Help Button -->
    <div class="fixed bottom-8 right-8">
        <button class="bg-white p-4 rounded-full shadow-lg hover:shadow-xl transition-all duration-200 text-gray-600 hover:text-gray-800">
            <i class="fas fa-question-circle text-xl"></i>
        </button>
    </div>
</body>
</html> 