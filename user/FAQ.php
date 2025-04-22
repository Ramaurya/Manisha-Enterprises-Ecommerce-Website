<?php
include 'header.php';
?>

<!-- Hero Section -->
<div class="bg-indigo-900 text-white py-12">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Frequently Asked Questions</h1>
        <p class="text-xl text-indigo-200 max-w-3xl mx-auto">Find answers to common questions about our products, services, and policies.</p>
    </div>
</div>

<!-- Search Section -->
<!-- <div class="bg-white py-6 shadow-md">
    <div class="container mx-auto px-4">
        <div class="max-w-2xl mx-auto">
            <div class="relative">
                <input type="text" id="faq-search" placeholder="Search for a question..." class="w-full py-3 px-4 pr-12 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                <button class="absolute right-0 top-0 h-full px-4 text-gray-500 hover:text-indigo-600">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </div>
</div> -->

<!-- Main Content -->
<div class="container mx-auto px-4 py-12">
    <!-- FAQ Categories
    <div class="mb-12">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Browse by Category</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <a href="#orders" class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition duration-300 text-center">
                <div class="text-indigo-600 text-2xl mb-2">
                    <i class="fas fa-shopping-bag"></i>
                </div>
                <h3 class="font-semibold text-gray-800">Orders</h3>
            </a>
            <a href="#shipping" class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition duration-300 text-center">
                <div class="text-indigo-600 text-2xl mb-2">
                    <i class="fas fa-truck"></i>
                </div>
                <h3 class="font-semibold text-gray-800">Shipping</h3>
            </a>
            <a href="#returns" class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition duration-300 text-center">
                <div class="text-indigo-600 text-2xl mb-2">
                    <i class="fas fa-undo"></i>
                </div>
                <h3 class="font-semibold text-gray-800">Returns</h3>
            </a>
            <a href="#payment" class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition duration-300 text-center">
                <div class="text-indigo-600 text-2xl mb-2">
                    <i class="fas fa-credit-card"></i>
                </div>
                <h3 class="font-semibold text-gray-800">Payment</h3>
            </a>
        </div>
    </div> -->

    <!-- FAQ Accordion -->
    <div class="max-w-4xl mx-auto">
        <!-- Orders Section -->
        <div id="orders" class="mb-12">
            <h2 class="text-2xl font-bold mb-6 text-gray-800 flex items-center">
                <i class="fas fa-shopping-bag text-indigo-600 mr-3"></i> Orders
            </h2>
            <div class="space-y-4">
                <div class="faq-item bg-white rounded-lg shadow-md overflow-hidden">
                    <button class="faq-question w-full text-left px-6 py-4 flex justify-between items-center hover:bg-gray-50 focus:outline-none">
                        <span class="font-semibold text-gray-800">How do I place an order?</span>
                        <i class="fas fa-chevron-down text-indigo-600 transition-transform duration-300"></i>
                    </button>
                    <div class="faq-answer px-6 py-4 border-t border-gray-100 hidden">
                        <p class="text-gray-600">To place an order, simply browse our products, add items to your cart, and proceed to checkout. You'll need to create an account or sign in, provide your shipping information, select a payment method, and confirm your order.</p>
                    </div>
                </div>
                <div class="faq-item bg-white rounded-lg shadow-md overflow-hidden">
                    <button class="faq-question w-full text-left px-6 py-4 flex justify-between items-center hover:bg-gray-50 focus:outline-none">
                        <span class="font-semibold text-gray-800">Can I modify or cancel my order after it's placed?</span>
                        <i class="fas fa-chevron-down text-indigo-600 transition-transform duration-300"></i>
                    </button>
                    <div class="faq-answer px-6 py-4 border-t border-gray-100 hidden">
                        <p class="text-gray-600">You can modify or cancel your order within 1 hour of placing it by contacting our customer service. After that period, the order will be processed and cannot be changed. If you need to make changes after the order has shipped, you may need to return the item and place a new order.</p>
                    </div>
                </div>
                <div class="faq-item bg-white rounded-lg shadow-md overflow-hidden">
                    <button class="faq-question w-full text-left px-6 py-4 flex justify-between items-center hover:bg-gray-50 focus:outline-none">
                        <span class="font-semibold text-gray-800">How can I track my order?</span>
                        <i class="fas fa-chevron-down text-indigo-600 transition-transform duration-300"></i>
                    </button>
                    <div class="faq-answer px-6 py-4 border-t border-gray-100 hidden">
                        <p class="text-gray-600">Once your order ships, you'll receive a confirmation email with a tracking number. You can also track your order by logging into your account and visiting the "Order History" section. Click on the specific order to view its tracking details.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Shipping Section -->
        <div id="shipping" class="mb-12">
            <h2 class="text-2xl font-bold mb-6 text-gray-800 flex items-center">
                <i class="fas fa-truck text-indigo-600 mr-3"></i> Shipping
            </h2>
            <div class="space-y-4">
                <div class="faq-item bg-white rounded-lg shadow-md overflow-hidden">
                    <button class="faq-question w-full text-left px-6 py-4 flex justify-between items-center hover:bg-gray-50 focus:outline-none">
                        <span class="font-semibold text-gray-800">What are your shipping options and rates?</span>
                        <i class="fas fa-chevron-down text-indigo-600 transition-transform duration-300"></i>
                    </button>
                    <div class="faq-answer px-6 py-4 border-t border-gray-100 hidden">
                        <p class="text-gray-600">We offer standard shipping (3-5 business days) for $5.99, express shipping (1-2 business days) for $12.99, and free shipping on orders over $50. International shipping rates vary by location and are calculated at checkout.</p>
                    </div>
                </div>
                <div class="faq-item bg-white rounded-lg shadow-md overflow-hidden">
                    <button class="faq-question w-full text-left px-6 py-4 flex justify-between items-center hover:bg-gray-50 focus:outline-none">
                        <span class="font-semibold text-gray-800">How long does it take to ship my order?</span>
                        <i class="fas fa-chevron-down text-indigo-600 transition-transform duration-300"></i>
                    </button>
                    <div class="faq-answer px-6 py-4 border-t border-gray-100 hidden">
                        <p class="text-gray-600">Most orders are processed and shipped within 1-2 business days. Delivery times depend on your location and the shipping method you choose. Standard shipping typically takes 3-5 business days, while express shipping takes 1-2 business days.</p>
                    </div>
                </div>
                <div class="faq-item bg-white rounded-lg shadow-md overflow-hidden">
                    <button class="faq-question w-full text-left px-6 py-4 flex justify-between items-center hover:bg-gray-50 focus:outline-none">
                        <span class="font-semibold text-gray-800">Do you ship internationally?</span>
                        <i class="fas fa-chevron-down text-indigo-600 transition-transform duration-300"></i>
                    </button>
                    <div class="faq-answer px-6 py-4 border-t border-gray-100 hidden">
                        <p class="text-gray-600">Yes, we ship to most countries worldwide. International shipping rates and delivery times vary by location. You can see the available shipping options and rates for your country during checkout.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Returns Section -->
        <div id="returns" class="mb-12">
            <h2 class="text-2xl font-bold mb-6 text-gray-800 flex items-center">
                <i class="fas fa-undo text-indigo-600 mr-3"></i> Returns
            </h2>
            <div class="space-y-4">
                <div class="faq-item bg-white rounded-lg shadow-md overflow-hidden">
                    <button class="faq-question w-full text-left px-6 py-4 flex justify-between items-center hover:bg-gray-50 focus:outline-none">
                        <span class="font-semibold text-gray-800">What is your return policy?</span>
                        <i class="fas fa-chevron-down text-indigo-600 transition-transform duration-300"></i>
                    </button>
                    <div class="faq-answer px-6 py-4 border-t border-gray-100 hidden">
                        <p class="text-gray-600">We accept returns within 30 days of delivery for most items. Products must be unused, in their original packaging, and include all accessories. To initiate a return, log into your account, go to "Order History," select the order, and click "Return Item."</p>
                    </div>
                </div>
                <div class="faq-item bg-white rounded-lg shadow-md overflow-hidden">
                    <button class="faq-question w-full text-left px-6 py-4 flex justify-between items-center hover:bg-gray-50 focus:outline-none">
                        <span class="font-semibold text-gray-800">How do I return an item?</span>
                        <i class="fas fa-chevron-down text-indigo-600 transition-transform duration-300"></i>
                    </button>
                    <div class="faq-answer px-6 py-4 border-t border-gray-100 hidden">
                        <p class="text-gray-600">To return an item, log into your account, go to "Order History," select the order containing the item you want to return, and click "Return Item." Follow the instructions to print a return label and package the item. Drop off the package at your local post office or schedule a pickup.</p>
                    </div>
                </div>
                <div class="faq-item bg-white rounded-lg shadow-md overflow-hidden">
                    <button class="faq-question w-full text-left px-6 py-4 flex justify-between items-center hover:bg-gray-50 focus:outline-none">
                        <span class="font-semibold text-gray-800">How long does it take to process a refund?</span>
                        <i class="fas fa-chevron-down text-indigo-600 transition-transform duration-300"></i>
                    </button>
                    <div class="faq-answer px-6 py-4 border-t border-gray-100 hidden">
                        <p class="text-gray-600">Once we receive your return, we'll inspect the item and process your refund within 5-7 business days. The refund will be issued to the original payment method used for the purchase. The time it takes for the refund to appear in your account depends on your bank or credit card company.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment Section -->
        <div id="payment" class="mb-12">
            <h2 class="text-2xl font-bold mb-6 text-gray-800 flex items-center">
                <i class="fas fa-credit-card text-indigo-600 mr-3"></i> Payment
            </h2>
            <div class="space-y-4">
                <div class="faq-item bg-white rounded-lg shadow-md overflow-hidden">
                    <button class="faq-question w-full text-left px-6 py-4 flex justify-between items-center hover:bg-gray-50 focus:outline-none">
                        <span class="font-semibold text-gray-800">What payment methods do you accept?</span>
                        <i class="fas fa-chevron-down text-indigo-600 transition-transform duration-300"></i>
                    </button>
                    <div class="faq-answer px-6 py-4 border-t border-gray-100 hidden">
                        <p class="text-gray-600">We accept all major credit cards (Visa, MasterCard, American Express, Discover), PayPal, Apple Pay, Google Pay, and select regional payment methods. All payments are processed securely through our encrypted payment gateway.</p>
                    </div>
                </div>
                <div class="faq-item bg-white rounded-lg shadow-md overflow-hidden">
                    <button class="faq-question w-full text-left px-6 py-4 flex justify-between items-center hover:bg-gray-50 focus:outline-none">
                        <span class="font-semibold text-gray-800">Is my payment information secure?</span>
                        <i class="fas fa-chevron-down text-indigo-600 transition-transform duration-300"></i>
                    </button>
                    <div class="faq-answer px-6 py-4 border-t border-gray-100 hidden">
                        <p class="text-gray-600">Yes, we take security seriously. All payment information is encrypted using industry-standard SSL technology. We never store your full credit card details on our servers. Our payment processing is handled by trusted third-party providers who comply with PCI DSS requirements.</p>
                    </div>
                </div>
                <div class="faq-item bg-white rounded-lg shadow-md overflow-hidden">
                    <button class="faq-question w-full text-left px-6 py-4 flex justify-between items-center hover:bg-gray-50 focus:outline-none">
                        <span class="font-semibold text-gray-800">Do you offer installment payment options?</span>
                        <i class="fas fa-chevron-down text-indigo-600 transition-transform duration-300"></i>
                    </button>
                    <div class="faq-answer px-6 py-4 border-t border-gray-100 hidden">
                        <p class="text-gray-600">Yes, we offer installment payment options through services like Klarna, Afterpay, and Affirm for eligible purchases. These services allow you to split your payment into multiple installments. The availability of these options depends on your location and the total purchase amount.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Account Section -->
        <div id="account" class="mb-12">
            <h2 class="text-2xl font-bold mb-6 text-gray-800 flex items-center">
                <i class="fas fa-user text-indigo-600 mr-3"></i> Account
            </h2>
            <div class="space-y-4">
                <div class="faq-item bg-white rounded-lg shadow-md overflow-hidden">
                    <button class="faq-question w-full text-left px-6 py-4 flex justify-between items-center hover:bg-gray-50 focus:outline-none">
                        <span class="font-semibold text-gray-800">How do I create an account?</span>
                        <i class="fas fa-chevron-down text-indigo-600 transition-transform duration-300"></i>
                    </button>
                    <div class="faq-answer px-6 py-4 border-t border-gray-100 hidden">
                        <p class="text-gray-600">To create an account, click on the "Sign Up" or "Register" link in the top navigation bar. Fill out the registration form with your name, email address, and password. You can also create an account during the checkout process when placing your first order.</p>
                    </div>
                </div>
                <div class="faq-item bg-white rounded-lg shadow-md overflow-hidden">
                    <button class="faq-question w-full text-left px-6 py-4 flex justify-between items-center hover:bg-gray-50 focus:outline-none">
                        <span class="font-semibold text-gray-800">How do I reset my password?</span>
                        <i class="fas fa-chevron-down text-indigo-600 transition-transform duration-300"></i>
                    </button>
                    <div class="faq-answer px-6 py-4 border-t border-gray-100 hidden">
                        <p class="text-gray-600">If you've forgotten your password, click on the "Forgot Password" link on the login page. Enter your email address, and we'll send you a link to reset your password. Follow the instructions in the email to create a new password.</p>
                    </div>
                </div>
                <div class="faq-item bg-white rounded-lg shadow-md overflow-hidden">
                    <button class="faq-question w-full text-left px-6 py-4 flex justify-between items-center hover:bg-gray-50 focus:outline-none">
                        <span class="font-semibold text-gray-800">Can I change my account information?</span>
                        <i class="fas fa-chevron-down text-indigo-600 transition-transform duration-300"></i>
                    </button>
                    <div class="faq-answer px-6 py-4 border-t border-gray-100 hidden">
                        <p class="text-gray-600">Yes, you can update your account information at any time. Log into your account, go to "Account Settings," and you can update your personal information, shipping addresses, payment methods, and communication preferences.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Still Have Questions Section -->
    <div class="bg-indigo-50 rounded-lg p-8 text-center max-w-3xl mx-auto">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Still Have Questions?</h2>
        <p class="text-gray-600 mb-6">Can't find the answer you're looking for? Our customer service team is here to help.</p>
        <div class="flex flex-col sm:flex-row justify-center gap-4">
            <a href="#footer-contact" class="px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition duration-300">
                <i class="fas fa-envelope mr-2"></i> Contact Us
            </a>
            <a href="#footer-contact" class="px-6 py-3 bg-white text-indigo-600 border border-indigo-600 rounded-lg hover:bg-indigo-50 transition duration-300">
                <i class="fas fa-phone mr-2"></i> Call Us
            </a>
        </div>
    </div>
</div>

<script>
    // FAQ Accordion Functionality
    document.addEventListener('DOMContentLoaded', function() {
        const faqQuestions = document.querySelectorAll('.faq-question');
        
        faqQuestions.forEach(question => {
            question.addEventListener('click', () => {
                // Toggle the active class on the question
                question.classList.toggle('active');
                
                // Toggle the answer visibility
                const answer = question.nextElementSibling;
                answer.classList.toggle('hidden');
                
                // Rotate the chevron icon
                const icon = question.querySelector('i');
                icon.classList.toggle('rotate-180');
                
                // Close other open answers
                faqQuestions.forEach(otherQuestion => {
                    if (otherQuestion !== question && otherQuestion.classList.contains('active')) {
                        otherQuestion.classList.remove('active');
                        otherQuestion.nextElementSibling.classList.add('hidden');
                        otherQuestion.querySelector('i').classList.remove('rotate-180');
                    }
                });
            });
        });
        
        // FAQ Search Functionality
        const searchInput = document.getElementById('faq-search');
        const faqItems = document.querySelectorAll('.faq-item');
        
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            
            faqItems.forEach(item => {
                const question = item.querySelector('.faq-question span').textContent.toLowerCase();
                const answer = item.querySelector('.faq-answer p').textContent.toLowerCase();
                
                if (question.includes(searchTerm) || answer.includes(searchTerm)) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
        
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                
                const targetId = this.getAttribute('href');
                const targetElement = document.querySelector(targetId);
                
                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 100,
                        behavior: 'smooth'
                    });
                }
            });
        });
        
        // Highlight the contact section when scrolled to
        const footerContact = document.getElementById('footer-contact');
        if (footerContact) {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        footerContact.classList.add('bg-indigo-900', 'bg-opacity-20', 'rounded-lg', 'p-4', 'transition-all', 'duration-500');
                    } else {
                        footerContact.classList.remove('bg-indigo-900', 'bg-opacity-20', 'rounded-lg', 'p-4', 'transition-all', 'duration-500');
                    }
                });
            }, { threshold: 0.5 });
            
            observer.observe(footerContact);
        }
    });
</script>
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
                            <a href="aboutus.php" class="text-gray-400 hover:text-indigo-500 transition duration-300 flex items-center">
                                <i class="fas fa-chevron-right text-xs mr-2 text-indigo-500"></i> Home
                            </a>
                        </li>
                        <li>
                            <a href="aboutus.php" class="text-gray-400 hover:text-indigo-500 transition duration-300 flex items-center">
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
                <div id="footer-contact">
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

