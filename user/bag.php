<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bag Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <?php
        include "header.php"
    ?>
</head>
<body class="bg-gray-100">
    <h1 class="font-bold text-center text-3xl text-blue-700 mt-6">Bag</h1>

    <!-- Grid Container -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 p-6">
    <?php
        include "config.php";
        $Record = mysqli_query($config, "SELECT * FROM tblproduct");
        while($row = mysqli_fetch_array($Record)) {
            $checkpage = $row["pcategory"];
            if($checkpage === "Bag"){
            echo "
            <div class='h-96 w-full bg-white rounded-lg shadow-md flex flex-col items-center p-4 transform transition duration-300 hover:scale-105 hover:shadow-lg'>
            <form action='insertcart.php' method='POST'>
                <!-- Image Container -->
                <div class='mt-2'>
                    <img src='../admin/product/$row[image]' class='h-40 w-40 object-contain rounded-md' alt='$row[pname]'>
                </div>
                <!-- Product Name -->
                <div class='font-bold text-gray-800 text-xl text-center mt-4'>$row[pname]</div>
                <!-- Product Price -->
                <div class='font-bold text-green-600 text-lg text-center mt-2'>₹$row[pprice]</div>
                <!-- Quantity and Button -->
                <div class='mt-4 flex flex-col items-center'>
                    <input type='hidden' name='pname' value='$row[pname]'>
                    <input type='hidden' name='pprice' value='$row[pprice]'>
                    <input type='number' name='quantity' min='1' placeholder='Quantity' class='h-10 w-40 bg-gray-50 border border-gray-300 rounded-md text-center focus:ring-2 focus:ring-blue-500 focus:outline-none'>
                    <button type='submit' name='cart' class='font-bold bg-blue-600 text-white w-40 h-10 rounded-md mt-4 hover:bg-blue-700 transition duration-300'>Add to Cart</button>
                </div>
                </form>
            </div>
            ";
            }
        }
    ?>
</div>
<!-- fotter.php -->
<footer class="bg-gray-900 text-white pt-12 pb-6 mt-12">
        <div class="container mx-auto px-4">
            <!-- Main Footer Content -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-8">
                <!-- Company Info -->
                <div>
                    <div class="flex items-center mb-4">
                        <i class="fas fa-shopping-bag text-3xl text-indigo-500 mr-2"></i>
                        <span class="text-2xl font-bold bg-gradient-to-r from-indigo-400 to-indigo-600 bg-clip-text text-transparent">manishaenterprises</span>
                    </div>
                    <p class="text-gray-400 mb-4">Your one-stop destination for all your shopping needs. Quality products at affordable prices.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-indigo-500 transition duration-300">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-indigo-500 transition duration-300">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-indigo-500 transition duration-300">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-indigo-500 transition duration-300">
                            <i class="fab fa-pinterest"></i>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-lg font-semibold mb-4 text-white">Quick Links</h3>
                    <ul class="space-y-2">
                        <li>
                            <a href="index.php" class="text-gray-400 hover:text-indigo-500 transition duration-300 flex items-center">
                                <i class="fas fa-chevron-right text-xs mr-2 text-indigo-500"></i> Home
                            </a>
                        </li>
                        <li>
                            <a href="about.php" class="text-gray-400 hover:text-indigo-500 transition duration-300 flex items-center">
                                <i class="fas fa-chevron-right text-xs mr-2 text-indigo-500"></i> About Us
                            </a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-400 hover:text-indigo-500 transition duration-300 flex items-center">
                                <i class="fas fa-chevron-right text-xs mr-2 text-indigo-500"></i> Contact Us
                            </a>
                        </li>
                        <li>
                            <a href="FAQ.php" class="text-gray-400 hover:text-indigo-500 transition duration-300 flex items-center">
                                <i class="fas fa-chevron-right text-xs mr-2 text-indigo-500"></i> FAQ
                            </a>
                        </li>
                        <li>
                            <a href="terms.php" class="text-gray-400 hover:text-indigo-500 transition duration-300 flex items-center">
                                <i class="fas fa-chevron-right text-xs mr-2 text-indigo-500"></i> Terms & Conditions
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Categories -->
                <div>
                    <h3 class="text-lg font-semibold mb-4 text-white">Categories</h3>
                    <ul class="space-y-2">
                        <li>
                            <a href="laptop.php" class="text-gray-400 hover:text-indigo-500 transition duration-300 flex items-center">
                                <i class="fas fa-laptop mr-2 text-indigo-500"></i> Laptops
                            </a>
                        </li>
                        <li>
                            <a href="mobile.php" class="text-gray-400 hover:text-indigo-500 transition duration-300 flex items-center">
                                <i class="fas fa-mobile-alt mr-2 text-indigo-500"></i> Mobiles
                            </a>
                        </li>
                        <li>
                            <a href="bag.php" class="text-gray-400 hover:text-indigo-500 transition duration-300 flex items-center">
                                <i class="fas fa-shopping-bag mr-2 text-indigo-500"></i> Bags
                            </a>
                        </li>
                        <li>
                            <a href="accessories.php" class="text-gray-400 hover:text-indigo-500 transition duration-300 flex items-center">
                                <i class="fas fa-headphones mr-2 text-indigo-500"></i> Accessories
                            </a>
                        </li>
                        <li>
                            <a href="new-arrivals.php" class="text-gray-400 hover:text-indigo-500 transition duration-300 flex items-center">
                                <i class="fas fa-star mr-2 text-indigo-500"></i> New Arrivals
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div>
                    <h3 class="text-lg font-semibold mb-4 text-white">Contact Us</h3>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt mt-1 mr-3 text-indigo-500"></i>
                            <span class="text-gray-400">352 Gurunank Pura Modeltown Phagwara</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone-alt mr-3 text-indigo-500"></i>
                            <span class="text-gray-400">+91 9580584500</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-envelope mr-3 text-indigo-500"></i>
                            <span class="text-gray-400">support@manishaenterprises.com</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-clock mr-3 text-indigo-500"></i>
                            <span class="text-gray-400">Mon - Fri: 9:00 AM - 6:00 PM</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Newsletter Subscription -->
            <div class="border-t border-gray-800 pt-8 mb-8">
                <div class="max-w-2xl mx-auto text-center">
                    <h3 class="text-xl font-semibold mb-2">Subscribe to Our Newsletter</h3>
                    <p class="text-gray-400 mb-4">Stay updated with our latest products and offers</p>
                    <form class="flex flex-col sm:flex-row gap-2">
                        <input type="email" placeholder="Your email address" class="flex-1 px-4 py-2 rounded-lg bg-gray-800 border border-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition duration-300">
                            Subscribe
                        </button>
                    </form>
                </div>
            </div>

            <!-- Payment Methods -->
            <div class="border-t border-gray-800 pt-6 mb-6">
                <div class="flex flex-wrap justify-center items-center gap-4">
                    <span class="text-gray-400 text-sm">We Accept:</span>
                    <i class="fab fa-cc-visa text-2xl text-gray-400"></i>
                    <i class="fab fa-cc-mastercard text-2xl text-gray-400"></i>
                    <i class="fab fa-cc-amex text-2xl text-gray-400"></i>
                    <i class="fab fa-cc-paypal text-2xl text-gray-400"></i>
                    <i class="fab fa-cc-apple-pay text-2xl text-gray-400"></i>
                </div>
            </div>

            <!-- Copyright -->
            <div class="text-center text-gray-500 text-sm">
                <p>&copy; <?php echo date('Y'); ?> ManishaEnterprise. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <button id="back-to-top" class="fixed bottom-6 right-6 bg-indigo-600 text-white w-12 h-12 rounded-full flex items-center justify-center shadow-lg hover:bg-indigo-700 transition duration-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-900 hidden">
        <i class="fas fa-arrow-up"></i>
    </button>

    <script>
        // Back to Top Button
        const backToTopButton = document.getElementById('back-to-top');
        
        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                backToTopButton.classList.remove('hidden');
            } else {
                backToTopButton.classList.add('hidden');
            }
        });
        
        backToTopButton.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    </script>

    <script src="https://kit.fontawesome.com/cd899bf2d5.js" crossorigin="anonymous"></script>
</body>
</html>