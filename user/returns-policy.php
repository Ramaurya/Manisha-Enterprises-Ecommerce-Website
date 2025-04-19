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
    <title>Returns Policy</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <!-- Custom Header for Returns Policy Page -->
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

    <div class="container mx-auto px-4 py-8 max-w-4xl">
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">Returns and Refunds Policy</h1>
        
        <div class="bg-white rounded-lg shadow-md p-6 space-y-6">
            <section class="space-y-4">
                <h2 class="text-xl font-semibold text-gray-700">1. Return Period</h2>
                <p class="text-gray-600">
                    You have 5 days from the date of delivery to return your item. To be eligible for a return, your item must be unused and in the same condition that you received it.
                </p>
            </section>

            <section class="space-y-4">
                <h2 class="text-xl font-semibold text-gray-700">2. Return Process</h2>
                <p class="text-gray-600">
                    To start a return, please follow these steps:
                </p>
                <ul class="list-disc pl-6 text-gray-600 space-y-2">
                    <li>Contact our customer service team</li>
                    <li>Pack the item securely in its original packaging</li>
                    <li>Include your order number and return reason</li>
                    <li>Ship to the provided return address</li>
                </ul>
            </section>

            <section class="space-y-4">
                <h2 class="text-xl font-semibold text-gray-700">3. Refund Process</h2>
                <p class="text-gray-600">
                    Once we receive your return:
                </p>
                <ul class="list-disc pl-6 text-gray-600 space-y-2">
                    <li>We will inspect the item within 48 hours</li>
                    <li>You will receive an email confirming the refund</li>
                    <li>The refund will be processed to your original payment method</li>
                    <li>Allow 5-10 business days for the refund to appear</li>
                </ul>
            </section>

            <section class="space-y-4">
                <h2 class="text-xl font-semibold text-gray-700">4. Non-Returnable Items</h2>
                <p class="text-gray-600">
                    The following items cannot be returned:
                </p>
                <ul class="list-disc pl-6 text-gray-600 space-y-2">
                    <li>Items marked as "Final Sale"</li>
                    <li>Personal care items</li>
                    <li>Damaged or used items</li>
                    <li>Gift cards</li>
                </ul>
            </section>

            <section class="space-y-4">
                <h2 class="text-xl font-semibold text-gray-700">5. Return Shipping</h2>
                <p class="text-gray-600">
                    Customers are responsible for return shipping costs unless the item received was defective or incorrect. In such cases, we will provide a prepaid shipping label.
                </p>
            </section>

            <div class="mt-8 flex justify-center space-x-4">
                <a href="terms.php" class="inline-block bg-gray-600 text-white px-6 py-2 rounded-md hover:bg-gray-700 transition duration-300">Back to Terms</a>
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