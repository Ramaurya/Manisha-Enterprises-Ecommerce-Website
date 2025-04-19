<?php
include 'header.php';

// Check if user is logged in
if (!isset($_SESSION["user"])) {
    echo "<script>window.location.href = 'form.php/login.php';</script>";
    exit();
}
?>

<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 text-center">
        <div>
            <div class="mx-auto flex items-center justify-center h-24 w-24 rounded-full bg-indigo-100">
                <i class="fas fa-heart text-4xl text-indigo-600"></i>
            </div>
            <h2 class="mt-6 text-3xl font-extrabold text-gray-900">
                Wishlist Feature
            </h2>
            <p class="mt-2 text-sm text-gray-600">
                Coming Soon!
            </p>
        </div>
        <div class="mt-8">
            <p class="text-gray-500">
                We're working hard to bring you the wishlist feature. You'll be able to save your favorite items and access them later.
            </p>
        </div>
        <div class="mt-6">
            <a href="index.php" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to Home
            </a>
        </div>
    </div>
</div>

