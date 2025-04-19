<?php
include 'header.php';

// Check if user is logged in
if (!isset($_SESSION["user"])) {
    // Use JavaScript for redirection instead of PHP header
    echo "<script>window.location.href = 'form.php/login.php';</script>";
    exit();
}

// Database connection
$conn = mysqli_connect("localhost", "root", "", "ecom");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get user data from database
$mobile = $_SESSION["user"];
$query = "SELECT * FROM tbluser WHERE number = '$mobile'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
} else {
    // User not found in database - use JavaScript for redirection
    echo "<script>window.location.href = 'form.php/logout.php';</script>";
    exit();
}

// Handle profile update
$update_message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update_profile"])) {
    $current_password = $_POST["current_password"];
    $new_password = $_POST["new_password"];
    $confirm_password = $_POST["confirm_password"];
    
    // Simple direct password comparison (plain text)
    if ($current_password === $user["password"]) {
        // Update user information - only password can be updated now
        $update_query = "UPDATE tbluser SET id = " . $user["id"];
        
        // Update password if provided
        if (!empty($new_password)) {
            if ($new_password === $confirm_password) {
                // Store password in plain text without any hashing
                $update_query .= ", password = '$new_password', repassword = '$new_password'";
            } else {
                $update_message = "<div class='bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4' role='alert'>
                                    <span class='block sm:inline'>New passwords do not match!</span>
                                </div>";
            }
        }
        
        $update_query .= " WHERE id = " . $user["id"];
        
        if (empty($update_message)) {
            if (mysqli_query($conn, $update_query)) {
                $update_message = "<div class='bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4' role='alert'>
                                    <span class='block sm:inline'>Profile updated successfully!</span>
                                </div>";
                
                // Refresh user data
                $result = mysqli_query($conn, "SELECT * FROM tbluser WHERE id = " . $user["id"]);
                $user = mysqli_fetch_assoc($result);
            } else {
                $update_message = "<div class='bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4' role='alert'>
                                    <span class='block sm:inline'>Error updating profile: " . mysqli_error($conn) . "</span>
                                </div>";
            }
        }
    } else {
        $update_message = "<div class='bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4' role='alert'>
                            <span class='block sm:inline'>Current password is incorrect!</span>
                        </div>";
    }
}

mysqli_close($conn);
?>

<!-- Profile Hero Section -->
<div class="bg-indigo-900 text-white py-12">
    <div class="container mx-auto px-4 text-center">
        <div class="flex justify-center mb-6">
            <div class="w-32 h-32 rounded-full bg-indigo-700 flex items-center justify-center text-5xl font-bold">
                <?php echo strtoupper(substr($user["username"], 0, 1)); ?>
            </div>
        </div>
        <h1 class="text-4xl md:text-5xl font-bold mb-4">My Profile</h1>
        <p class="text-xl text-indigo-200 max-w-3xl mx-auto">Manage your account information and preferences</p>
    </div>
</div>

<!-- Profile Content -->
<div class="container mx-auto px-4 py-12">
    <div class="max-w-4xl mx-auto">
        <?php echo $update_message; ?>
        
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-6">
                <h2 class="text-2xl font-bold mb-6 text-gray-800">Account Information</h2>
                
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="username" class="block text-gray-700 font-medium mb-2">Username</label>
                            <input type="text" id="username" value="<?php echo htmlspecialchars($user["username"]); ?>" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent" disabled>
                            <p class="text-sm text-gray-500 mt-1">Username cannot be changed</p>
                        </div>
                        
                        <div>
                            <label for="number" class="block text-gray-700 font-medium mb-2">Phone Number</label>
                            <input type="tel" id="number" name="number" value="<?php echo htmlspecialchars($user["number"]); ?>" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent" disabled>
                            <p class="text-sm text-gray-500 mt-1">Phone number cannot be changed</p>
                        </div>
                        
                        <div>
                            <label for="email" class="block text-gray-700 font-medium mb-2">Email Address</label>
                            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user["email"]); ?>" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent" disabled>
                            <p class="text-sm text-gray-500 mt-1">Email address cannot be changed</p>
                        </div>
                        
                        <div>
                            <label for="id" class="block text-gray-700 font-medium mb-2">User ID</label>
                            <input type="text" id="id" value="<?php echo htmlspecialchars($user["id"]+1000); ?>" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent" disabled>
                        </div>
                    </div>
                    
                    <div class="border-t border-gray-200 pt-6 mb-6">
                        <h3 class="text-xl font-bold mb-4 text-gray-800">Change Password</h3>
                        <p class="text-gray-600 mb-4">Leave these fields blank if you don't want to change your password</p>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="current_password" class="block text-gray-700 font-medium mb-2">Current Password</label>
                                <input type="password" id="current_password" name="current_password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            </div>
                            
                            <div>
                                <label for="new_password" class="block text-gray-700 font-medium mb-2">New Password</label>
                                <input type="password" id="new_password" name="new_password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            </div>
                            
                            <div>
                                <label for="confirm_password" class="block text-gray-700 font-medium mb-2">Confirm New Password</label>
                                <input type="password" id="confirm_password" name="confirm_password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex justify-end">
                        <button type="submit" name="update_profile" class="px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition duration-300">
                            <i class="fas fa-save mr-2"></i> Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Account Actions -->
        <div class="mt-8 bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-6">
                <h2 class="text-2xl font-bold mb-6 text-gray-800">Account Actions</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <a href="vieworder.php" class="flex items-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition duration-300">
                        <div class="w-12 h-12 bg-indigo-100 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-shopping-bag text-indigo-600 text-xl"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800">My Orders</h3>
                            <p class="text-gray-600 text-sm">View your order history and track shipments</p>
                        </div>
                    </a>
                    
                    <a href="viewcart.php" class="flex items-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition duration-300">
                        <div class="w-12 h-12 bg-indigo-100 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-shopping-cart text-indigo-600 text-xl"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800">Shopping Cart</h3>
                            <p class="text-gray-600 text-sm">View and manage items in your cart</p>
                        </div>
                    </a>
                    
                    <a href="wishlist.php" class="flex items-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition duration-300">
                        <div class="w-12 h-12 bg-indigo-100 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-heart text-indigo-600 text-xl"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800">Wishlist</h3>
                            <p class="text-gray-600 text-sm">View your saved items for later</p>
                        </div>
                    </a>
                    
                    <a href="form.php/logout.php" class="flex items-center p-4 bg-gray-50 rounded-lg hover:bg-red-50 transition duration-300">
                        <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-sign-out-alt text-red-600 text-xl"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800">Logout</h3>
                            <p class="text-gray-600 text-sm">Sign out of your account</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

