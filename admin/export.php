<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export Center - ManishaEnterprise</title>
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
                        'bounce-slow': 'bounce 3s infinite',
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
            background: linear-gradient(135deg, #3B82F6 0%, #8B5CF6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
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
<body class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-50 p-8">
    <!-- Main Container -->
    <div class="max-w-7xl mx-auto">
        <!-- Header Section -->
        <div class="text-center mb-12">
            <a href="mystore.php" class="inline-flex items-center text-gray-600 hover:text-gray-800 transition-colors mb-8">
                <i class="fas fa-arrow-left mr-2"></i>
                <span>Back to Dashboard</span>
            </a>
            <div class="relative inline-block animate-bounce-slow mb-6">
                <div class="absolute inset-0 bg-blue-500 rounded-full blur-lg opacity-20"></div>
                <div class="relative bg-white p-4 rounded-2xl shadow-lg">
                    <i class="fas fa-file-export text-4xl gradient-text"></i>
                </div>
            </div>
            <h1 class="text-4xl font-bold mb-4 gradient-text">Export Center</h1>
            <p class="text-gray-600 max-w-2xl mx-auto">Choose from our range of export options to download your data in your preferred format.</p>
        </div>

        <!-- Features Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
            <!-- Excel Export -->
            <div class="feature-card bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="p-6">
                    <div class="w-16 h-16 bg-green-50 rounded-2xl flex items-center justify-center mb-6 mx-auto">
                        <i class="fas fa-file-excel text-2xl text-green-500"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2 text-center">Excel Export</h3>
                    <p class="text-gray-500 text-sm text-center mb-4">Export your data in Excel format for spreadsheet analysis</p>
                    <div class="text-center">
                        <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-green-50 text-green-600">
                            Coming Soon
                        </span>
                    </div>
                </div>
                <div class="bg-green-50 px-6 py-4">
                    <div class="text-xs text-green-600 flex items-center justify-center">
                        <i class="fas fa-info-circle mr-2"></i>
                        Perfect for data analysis
                    </div>
                </div>
            </div>

            <!-- PDF Export -->
            <div class="feature-card bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="p-6">
                    <div class="w-16 h-16 bg-red-50 rounded-2xl flex items-center justify-center mb-6 mx-auto">
                        <i class="fas fa-file-pdf text-2xl text-red-500"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2 text-center">PDF Export</h3>
                    <p class="text-gray-500 text-sm text-center mb-4">Generate professional PDF reports and documents</p>
                    <div class="text-center">
                        <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-red-50 text-red-600">
                            Coming Soon
                        </span>
                    </div>
                </div>
                <div class="bg-red-50 px-6 py-4">
                    <div class="text-xs text-red-600 flex items-center justify-center">
                        <i class="fas fa-info-circle mr-2"></i>
                        Professional documentation
                    </div>
                </div>
            </div>

            <!-- CSV Export -->
            <div class="feature-card bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="p-6">
                    <div class="w-16 h-16 bg-blue-50 rounded-2xl flex items-center justify-center mb-6 mx-auto">
                        <i class="fas fa-file-csv text-2xl text-blue-500"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2 text-center">CSV Export</h3>
                    <p class="text-gray-500 text-sm text-center mb-4">Export data in CSV format for universal compatibility</p>
                    <div class="text-center">
                        <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-blue-50 text-blue-600">
                            Coming Soon
                        </span>
                    </div>
                </div>
                <div class="bg-blue-50 px-6 py-4">
                    <div class="text-xs text-blue-600 flex items-center justify-center">
                        <i class="fas fa-info-circle mr-2"></i>
                        Universal compatibility
                    </div>
                </div>
            </div>

            <!-- Print Reports -->
            <div class="feature-card bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="p-6">
                    <div class="w-16 h-16 bg-purple-50 rounded-2xl flex items-center justify-center mb-6 mx-auto">
                        <i class="fas fa-print text-2xl text-purple-500"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2 text-center">Print Reports</h3>
                    <p class="text-gray-500 text-sm text-center mb-4">Generate and print professional reports directly</p>
                    <div class="text-center">
                        <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-purple-50 text-purple-600">
                            Coming Soon
                        </span>
                    </div>
                </div>
                <div class="bg-purple-50 px-6 py-4">
                    <div class="text-xs text-purple-600 flex items-center justify-center">
                        <i class="fas fa-info-circle mr-2"></i>
                        Direct printing capability
                    </div>
                </div>
            </div>
        </div>

        <!-- Newsletter Section -->
        <div class="bg-white rounded-2xl shadow-lg p-8 text-center">
            <h3 class="text-2xl font-semibold mb-4 gradient-text">Stay Updated!</h3>
            <p class="text-gray-600 mb-6">We'll notify you when these features become available.</p>
            <div class="flex justify-center space-x-4">
                <a href="mystore.php" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-500 to-indigo-500 text-white font-medium rounded-lg hover:from-blue-600 hover:to-indigo-600 transition-all duration-200 shadow-lg hover:shadow-xl">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Return to Dashboard
                </a>
            </div>
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



