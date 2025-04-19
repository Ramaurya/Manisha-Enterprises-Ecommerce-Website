<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | ManishaEnterprise</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://kit.fontawesome.com/cd899bf2d5.js" crossorigin="anonymous"></script>
    <style>
        .dashboard-card {
            transition: all 0.3s ease;
        }
        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
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
<body class="bg-gray-50 min-h-screen">
    <!-- Top Navigation Bar -->
    <nav class="w-full bg-gradient-to-r from-indigo-800 to-indigo-600 shadow-lg">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center h-20">
                <div class="flex items-center">
                    <h1 class="text-white font-bold text-3xl">ManishaEnterprise</h1>
                    <span class="ml-2 px-3 py-1 bg-indigo-700 text-white text-xs rounded-full">Admin</span>
                </div>
                <div class="flex items-center space-x-6">
                    <div class="flex items-center">
                        <i class="fa-solid fa-user text-white mr-2"></i>
                        <span class="text-white"><?php echo $_SESSION['admin']; ?></span>
            </div>
                    <div class="flex items-center">
                        <a href="form/logout.php" class="flex items-center text-white hover:text-indigo-200 transition duration-300">
                            <i class="fa-solid fa-right-from-bracket mr-2"></i>
                            <span>Logout</span>
                        </a>
            </div>
            <div>
                        <a href="../user/index.php" class="flex items-center text-white hover:text-indigo-200 transition duration-300">
                            <i class="fa-solid fa-users mr-2"></i>
                            <span>User Panel</span>
                        </a>
            </div>
            </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">Admin Dashboard</h2>
        
        <!-- Dashboard Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
            <!-- Products Card -->
            <div class="dashboard-card bg-white rounded-xl shadow-md p-6 border-l-4 border-indigo-500">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-semibold text-gray-800">Products</h3>
                    <div class="bg-indigo-100 p-3 rounded-full">
                        <i class="fas fa-box text-indigo-600 text-xl"></i>
                    </div>
                </div>
                <p class="text-gray-600 mb-4">Manage your product inventory, add new products, or update existing ones.</p>
                <a href="product/index.php" class="inline-flex items-center text-indigo-600 hover:text-indigo-800 transition duration-300">
                    <span>Manage Products</span>
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
            
            <!-- Users Card -->
            <div class="dashboard-card bg-white rounded-xl shadow-md p-6 border-l-4 border-green-500">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-semibold text-gray-800">Users</h3>
                    <div class="bg-green-100 p-3 rounded-full">
                        <i class="fas fa-users text-green-600 text-xl"></i>
                    </div>
                </div>
                <p class="text-gray-600 mb-4">View and manage user accounts, permissions, and activity.</p>
                <a href="user.php" class="inline-flex items-center text-green-600 hover:text-green-800 transition duration-300">
                    <span>Manage Users</span>
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
            
            <!-- Analytics Card -->
            <div class="dashboard-card bg-white rounded-xl shadow-md p-6 border-l-4 border-purple-500">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-semibold text-gray-800">Analytics</h3>
                    <div class="bg-purple-100 p-3 rounded-full">
                        <i class="fas fa-chart-line text-purple-600 text-xl"></i>
                    </div>
                </div>
                <p class="text-gray-600 mb-4">View sales reports, customer insights, and website performance metrics.</p>
                <a href="myorder.php" class="inline-flex items-center text-purple-600 hover:text-purple-800 transition duration-300">
                    <span>View Analytics</span>
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
        
        <!-- Quick Actions -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-8">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">Quick Actions</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <a href="product/index.php" class="flex items-center p-4 bg-indigo-50 rounded-lg hover:bg-indigo-100 transition duration-300">
                    <i class="fas fa-plus-circle text-indigo-600 mr-3 text-xl"></i>
                    <span class="text-gray-700">Add New Product</span>
                </a>
                <a href="product/index.php" class="flex items-center p-4 bg-green-50 rounded-lg hover:bg-green-100 transition duration-300">
                    <i class="fas fa-edit text-green-600 mr-3 text-xl"></i>
                    <span class="text-gray-700">Edit Products</span>
                </a>
                <a href="export.php" class="flex items-center p-4 bg-purple-50 rounded-lg hover:bg-purple-100 transition duration-300">
                    <i class="fas fa-file-export text-purple-600 mr-3 text-xl"></i>
                    <span class="text-gray-700">Export Data</span>
                </a>
                <a href="settings.php" class="flex items-center p-4 bg-red-50 rounded-lg hover:bg-red-100 transition duration-300">
                    <i class="fas fa-cog text-red-600 mr-3 text-xl"></i>
                    <span class="text-gray-700">Settings</span>
                </a>
    </div>
</div>
        
        <!-- Recent Activity -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">Recent Activity</h3>
            <div class="space-y-4">
                <?php
                // Include database connection
                include "product/config.php";
                
                // Fetch recent activities from the database
                $activity_query = "SELECT * FROM activities ORDER BY activity_date DESC LIMIT 5";
                $activity_result = mysqli_query($config, $activity_query);
                
                if (mysqli_num_rows($activity_result) > 0) {
                    while ($activity = mysqli_fetch_assoc($activity_result)) {
                        // Determine icon and color based on activity type
                        $icon_class = "fas fa-info-circle";
                        $bg_color = "bg-blue-100";
                        $text_color = "text-blue-600";
                        
                        if ($activity['activity_type'] == 'product_add') {
                            $icon_class = "fas fa-box";
                            $bg_color = "bg-indigo-100";
                            $text_color = "text-indigo-600";
                        } elseif ($activity['activity_type'] == 'product_delete') {
                            $icon_class = "fas fa-trash-alt";
                            $bg_color = "bg-red-100";
                            $text_color = "text-red-600";
                        } elseif ($activity['activity_type'] == 'user_register') {
                            $icon_class = "fas fa-user";
                            $bg_color = "bg-green-100";
                            $text_color = "text-green-600";
                        } elseif ($activity['activity_type'] == 'order') {
                            $icon_class = "fas fa-shopping-cart";
                            $bg_color = "bg-purple-100";
                            $text_color = "text-purple-600";
                        }
                        
                        // Format the date
                        $activity_date = new DateTime($activity['activity_date']);
                        $formatted_time = $activity_date->format('d M Y, h:i A');
                        
                        echo "
                        <div class='flex items-center p-3 bg-gray-50 rounded-lg'>
                            <div class='{$bg_color} p-2 rounded-full mr-4'>
                                <i class='{$icon_class} {$text_color}'></i>
                            </div>
                            <div>
                                <p class='text-gray-800 font-medium'>{$activity['activity_description']}</p>
                                <p class='text-gray-500 text-sm'>{$formatted_time}</p>
                            </div>
                        </div>
                        ";
                    }
                } else {
                    // If no activities found, show a message
                    echo "
                    <div class='text-center py-4 text-gray-500'>
                        <i class='fas fa-info-circle text-2xl mb-2'></i>
                        <p>No recent activities found.</p>
                    </div>
                    ";
                }
                ?>
            </div>
        </div>
    </div>
    
    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-6 mt-12">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; <?php echo date('Y'); ?> ManishaEnterprise Admin Panel. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>