<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'config.php';

// Get cart count from database
$cart_count = 0;
if (isset($_SESSION["user"])) {
    $user_id = $_SESSION["user"];
    $cart_sql = "SELECT SUM(quantity) as total_items FROM tblcart WHERE idofuser = ?";
    $cart_stmt = $config->prepare($cart_sql);
    $cart_stmt->bind_param("i", $user_id);
    $cart_stmt->execute();
    $cart_result = $cart_stmt->get_result();
    if ($cart_row = $cart_result->fetch_assoc()) {
        $cart_count = $cart_row['total_items'] ?? 0;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ManishaEnterprise - Your Online Shopping Destination</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/cd899bf2d5.js" crossorigin="anonymous"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        body {
            font-family: 'Poppins', sans-serif;
        }
        .nav-link {
            position: relative;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 0;
            background-color: #818cf8;
            transition: width 0.9s ease;
        }
        .nav-link:hover::after {
            width: 100%;
        }
        .logo-text {
            background: linear-gradient(45deg, #4f46e5, #818cf8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .cart-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background-color: #ef4444;
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: bold;
        }
        .search-container {
            position: relative;
        }
        .search-results {
            max-height: 300px;
            overflow-y: auto;
        }
        .search-results::-webkit-scrollbar {
            width: 5px;
        }
        .search-results::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        .search-results::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 5px;
        }
        .search-results::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
    </style>
    <script>
        function checkLogin() {
            <?php if(!isset($_SESSION["user"])): ?>
                alert('Please login to view cart');
                window.location.href = 'form.php/login.php';
                return false;
            <?php endif; ?>
            return true;
        }
    </script>
</head>
<body class="bg-gray-50">
    <!-- Top Bar -->
    <div class="bg-indigo-900 text-white py-2 text-sm">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <span><i class="fas fa-phone-alt mr-2"></i> +91 9580584500</span>
                <span><i class="fas fa-envelope mr-2"></i> support@manishaenterprises.com</span>
            </div>
            <div class="flex items-center space-x-4">
                <a href="#" class="hover:text-indigo-300 transition duration-300"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="hover:text-indigo-300 transition duration-300"><i class="fab fa-twitter"></i></a>
                <a href="#" class="hover:text-indigo-300 transition duration-300"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </div>

    <!-- Main Navbar -->
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="index.php" class="flex items-center">
                        <i class="fas fa-shopping-bag text-4xl text-indigo-600 mr-2"></i>
                        <span class="text-2xl font-bold logo-text">manishaenterprises</span>
                    </a>
                </div>

                <!-- Search Bar -->
                <div class="hidden md:flex flex-1 max-w-xl mx-8">
                    <div class="relative w-full">
                        <input type="text" id="searchInput" placeholder="Search for products..." 
                               class="w-full py-2 px-4 border border-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        <button onclick="performSearch()" class="absolute right-0 top-0 h-full px-4 bg-indigo-600 text-white rounded-r-lg hover:bg-indigo-700 transition duration-300">
                            <i class="fas fa-search"></i>
                        </button>
                        <div id="searchResults" class="absolute top-full left-0 w-full mt-2 bg-white rounded-lg shadow-lg z-50 hidden">
                            <div class="max-h-96 overflow-y-auto">
                                <!-- Search results will be populated here -->
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="index.php" class="nav-link text-gray-700 hover:text-indigo-600 transition duration-300 flex items-center">
                        <i class="fas fa-home mr-2"></i> Home
                    </a>
                    <a href="viewcart.php" onclick="return checkLogin();" class="nav-link text-gray-700 hover:text-indigo-600 transition duration-300 flex items-center relative">
                        <i class="fas fa-shopping-cart mr-2"></i> Cart
                        <?php if(isset($_SESSION["user"]) && $cart_count > 0): ?>
                        <span class="cart-badge"><?php echo $cart_count; ?></span>
                        <?php endif; ?>
                    </a>
                    <div class="relative group">
                        <a href="#" class="nav-link text-gray-700 hover:text-indigo-600 transition duration-300 flex items-center">
                            <i class="fas fa-user mr-2"></i> 
                            <?php if(isset($_SESSION["user"])): ?>
                                <?php echo $_SESSION["user"]; ?>
                            <?php else: ?>
                                Hello Guest
                            <?php endif; ?>
                            <i class="fas fa-chevron-down ml-1 text-xs"></i>
                        </a>
                        <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform translate-y-1 group-hover:translate-y-0">
                            <?php if(isset($_SESSION["user"])): ?>
                                <a href="profile.php" class="block px-4 py-2 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition duration-150">
                                    <i class="fas fa-user-circle mr-2"></i> My Profile
                                </a>
                                <a href="vieworder.php" class="block px-4 py-2 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition duration-150">
                                    <i class="fas fa-box mr-2"></i> My Orders
                                </a>
                                <a href="form.php/logout.php" class="block px-4 py-2 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition duration-150">
                                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                                </a>
                            <?php else: ?>
                                <a href="form.php/login.php" class="block px-4 py-2 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition duration-150">
                                    <i class="fas fa-sign-in-alt mr-2"></i> Login
                                </a>
                                <a href="form.php/register.php" class="block px-4 py-2 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition duration-150">
                                    <i class="fas fa-user-plus mr-2"></i> Register
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <a href="../admin/mystore.php" class="nav-link text-gray-700 hover:text-indigo-600 transition duration-300 flex items-center">
                        <i class="fas fa-cog mr-2"></i> Admin
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden">
                    <button id="menu-toggle" class="text-gray-700 hover:text-indigo-600 focus:outline-none">
                        <i class="fas fa-bars text-2xl"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden md:hidden bg-white shadow-lg">
        <div class="container mx-auto px-4 py-4">
            <!-- Mobile Search -->
            <div class="mb-4">
                <div class="relative">
                    <input type="text" placeholder="Search for products..." class="w-full py-2 px-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    <button class="absolute right-0 top-0 h-full px-4 bg-indigo-600 text-white rounded-r-lg hover:bg-indigo-700 transition duration-300">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
            
            <!-- Mobile Navigation Links -->
            <div class="flex flex-col space-y-4">
                <a href="index.php" class="flex items-center text-gray-700 hover:text-indigo-600 py-2 border-b border-gray-100">
                    <i class="fas fa-home w-6"></i> Home
                </a>
                <a href="viewcart.php" onclick="return checkLogin();" class="flex items-center text-gray-700 hover:text-indigo-600 py-2 border-b border-gray-100">
                    <i class="fas fa-shopping-cart w-6"></i> Cart
                    <?php if(isset($_SESSION["user"]) && $cart_count > 0): ?>
                    <span class="ml-2 bg-red-500 text-white text-xs rounded-full px-2 py-1"><?php echo $cart_count; ?></span>
                    <?php endif; ?>
                </a>
                <?php if(isset($_SESSION["user"])): ?>
                    <a href="profile.php" class="flex items-center text-gray-700 hover:text-indigo-600 py-2 border-b border-gray-100">
                        <i class="fas fa-user w-6"></i> My Profile
                    </a>
                    <a href="orders.php" class="flex items-center text-gray-700 hover:text-indigo-600 py-2 border-b border-gray-100">
                        <i class="fas fa-box w-6"></i> My Orders
                    </a>
                    <a href="form.php/logout.php" class="flex items-center text-gray-700 hover:text-indigo-600 py-2 border-b border-gray-100">
                        <i class="fas fa-sign-out-alt w-6"></i> Logout
                    </a>
                <?php else: ?>
                    <a href="form.php/login.php" class="flex items-center text-gray-700 hover:text-indigo-600 py-2 border-b border-gray-100">
                        <i class="fas fa-sign-in-alt w-6"></i> Login
                    </a>
                    <a href="form.php/register.php" class="flex items-center text-gray-700 hover:text-indigo-600 py-2 border-b border-gray-100">
                        <i class="fas fa-user-plus w-6"></i> Register
                    </a>
                <?php endif; ?>
                <a href="../admin/mystore.php" class="flex items-center text-gray-700 hover:text-indigo-600 py-2 border-b border-gray-100">
                    <i class="fas fa-cog w-6"></i> Admin
                </a>
            </div>
        </div>
    </div>

    <!-- Category Navigation -->
    <div class="bg-indigo-600 text-white shadow-md">
        <div class="container mx-auto px-4">
            <div class="flex justify-center py-3 space-x-8 md:space-x-16">
                <a href="laptop.php" class="flex items-center hover:text-indigo-200 transition duration-300">
                    <i class="fas fa-laptop mr-2"></i> Laptops
                </a>
                <a href="mobile.php" class="flex items-center hover:text-indigo-200 transition duration-300">
                    <i class="fas fa-mobile-alt mr-2"></i> Mobiles
                </a>
                <a href="bag.php" class="flex items-center hover:text-indigo-200 transition duration-300">
                    <i class="fas fa-shopping-bag mr-2"></i> Bags
                </a>
            </div>
        </div>
    </div>

    <script>
        // Toggle mobile menu visibility
        const menuToggle = document.getElementById('menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');

        menuToggle.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>

    <script>
    // Add this script at the end of the file, before </body>
    let searchTimeout;
    const searchInput = document.getElementById('searchInput');
    const searchResults = document.getElementById('searchResults');

    searchInput.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        const query = this.value.trim();
        
        if (query.length >= 2) {
            searchTimeout = setTimeout(() => {
                fetch(`search_handler.php?query=${encodeURIComponent(query)}`)
                    .then(response => response.json())
                    .then(products => {
                        displaySearchResults(products);
                    })
                    .catch(error => console.error('Error:', error));
            }, 300);
        } else {
            searchResults.classList.add('hidden');
        }
    });

    function displaySearchResults(products) {
        const resultsContainer = searchResults.querySelector('.max-h-96');
        resultsContainer.innerHTML = '';
        
        if (products.length === 0) {
            resultsContainer.innerHTML = '<div class="p-4 text-gray-500">No products found</div>';
        } else {
            products.forEach(product => {
                const productElement = document.createElement('a');
                productElement.href = `product_details.php?id=${product.id}`;
                productElement.className = 'flex items-center p-4 hover:bg-gray-50 border-b border-gray-100';
                productElement.innerHTML = `
                    <img src="${product.productimage}" alt="${product.productname}" class="w-16 h-16 object-cover rounded">
                    <div class="ml-4">
                        <h3 class="text-gray-900 font-medium">${product.productname}</h3>
                        <p class="text-indigo-600 font-semibold">₹${product.productprice}</p>
                    </div>
                `;
                resultsContainer.appendChild(productElement);
            });
        }
        
        searchResults.classList.remove('hidden');
    }

    function performSearch() {
        const query = searchInput.value.trim();
        if (query.length >= 2) {
            window.location.href = `search_results.php?query=${encodeURIComponent(query)}`;
        }
    }

    // Close search results when clicking outside
    document.addEventListener('click', function(event) {
        if (!searchResults.contains(event.target) && event.target !== searchInput) {
            searchResults.classList.add('hidden');
        }
    });
    </script>

    <!-- Footer -->
    
</body>
</html> 
