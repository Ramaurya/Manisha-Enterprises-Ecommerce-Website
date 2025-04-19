<?php
session_start();
// Check if user is not logged in, set cart count to 0
if (!isset($_SESSION['user_id'])) {
    $_SESSION['cart'] = array();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms and Conditions</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <!-- Custom Header for Terms Page -->
    <nav class="h-20 w-full bg-gradient-to-r from-gray-900 via-gray-800 to-gray-900 flex justify-between items-center shadow-lg px-4 md:px-8">
        <!-- Logo -->
        <div>
            <h1 class="text-2xl md:text-4xl font-bold text-white border-2 border-indigo-600 w-fit h-fit bg-indigo-600 rounded-2xl px-4 py-1 shadow-md">
                ManishaEnterprise
            </h1>
        </div>
        <!-- Navigation Links -->
        <div class="hidden md:flex mr-4 flex-wrap space-x-7">
            <div class="flex items-center">
                <i class="fa-solid fa-house text-white"></i>
                <a href="form.php/register.php" class="pl-2 text-white hover:text-indigo-400">Home</a>
            </div>
            <div class="flex items-center">
                <i class="fa-solid fa-cart-shopping text-white"></i>
                <a href="form.php/register.php" class="pl-2 text-white hover:text-indigo-400">Cart(0)</a>
            </div>
            <div class="flex items-center">
                <i class="fa-solid fa-user text-white"></i>
                <a href="form.php/register.php" class="pl-2 text-white hover:text-indigo-400">Register</a>
            </div>
        </div>
    </nav>

    <!-- Panel -->
    <div class="h-10 w-full bg-gray-700 flex justify-center shadow-md">
        <div class="space-x-10 md:space-x-20 pt-1 text-sm md:text-xl font-bold text-white">
            <a href="form.php/register.php" class="hover:text-indigo-400">Laptop</a>
            <a href="form.php/register.php" class="hover:text-indigo-400">Mobile</a>
            <a href="form.php/register.php" class="hover:text-indigo-400">Bag</a>
        </div>
    </div>
    

    <div class="container mx-auto px-4 py-8 max-w-4xl">
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">Terms and Conditions</h1>
        
        <div class="bg-white rounded-lg shadow-md p-6 space-y-6">
            <section class="space-y-4">
                <h2 class="text-xl font-semibold text-gray-700">1. Introduction</h2>
                <p class="text-gray-600">
                    Welcome to ManishaEnterprise. By accessing and using our website, you accept and agree to be bound by the terms and conditions outlined below.
                </p>
            </section>

            <section class="space-y-4">
                <h2 class="text-xl font-semibold text-gray-700">2. Account Registration</h2>
                <p class="text-gray-600">
                    To use certain features of our website, you must register for an account. You agree to provide accurate, current, and complete information during registration and to update such information to keep it accurate, current, and complete.
                </p>
            </section>

            <section class="space-y-4">
                <h2 class="text-xl font-semibold text-gray-700">3. Privacy Policy</h2>
                <p class="text-gray-600">
                    Your privacy is important to us. Our Privacy Policy explains how we collect, use, and protect your personal information. By using our service, you agree to our Privacy Policy.
                </p>
            </section>

            <section class="space-y-4">
                <h2 class="text-xl font-semibold text-gray-700">4. Product Information</h2>
                <p class="text-gray-600">
                    We strive to provide accurate product descriptions and pricing. However, we do not warrant that product descriptions or prices are accurate, complete, reliable, current, or error-free.
                </p>
            </section>

            <section class="space-y-4">
                <h2 class="text-xl font-semibold text-gray-700">5. Order Acceptance</h2>
                <p class="text-gray-600">
                    We reserve the right to refuse or cancel any order for any reason at any time. We may require additional verification or information before accepting any order.
                </p>
            </section>

            <section class="space-y-4">
                <h2 class="text-xl font-semibold text-gray-700">6. Payment Terms</h2>
                <p class="text-gray-600">
                    All payments must be made in full at the time of purchase. We accept various payment methods as indicated on our website.
                </p>
            </section>

            <section class="space-y-4">
                <h2 class="text-xl font-semibold text-gray-700">7. Shipping and Delivery</h2>
                <p class="text-gray-600">
                    Delivery times are estimates only. We are not responsible for any delays caused by shipping carriers or circumstances beyond our control.
                </p>
            </section>

            <section class="space-y-4">
                <h2 class="text-xl font-semibold text-gray-700">8. Returns and Refunds</h2>
                <p class="text-gray-600">
                    Our Returns and Refunds Policy outlines the process for returning products and receiving refunds. 
                    <a href="returns-policy.php" class="text-blue-600 hover:underline">Click here to read our detailed Returns and Refunds Policy</a>.
                </p>
            </section>

            <div class="mt-8 text-center">
                <a href="form.php/register.php" class="inline-block bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition duration-300">Back to Registration</a>
            </div>
        </div>
    </div>

    <script>
    // Add click event listener to all navigation links
    document.addEventListener('DOMContentLoaded', function() {
        const navLinks = document.querySelectorAll('nav a, .panel a');
        navLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                // Redirect to registration page
                window.location.href = 'form.php/register.php';
            });
        });
    });
    </script>

    <script src="https://kit.fontawesome.com/cd899bf2d5.js" crossorigin="anonymous"></script>
</body>
</html> 