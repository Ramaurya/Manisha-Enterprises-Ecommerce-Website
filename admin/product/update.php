<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://kit.fontawesome.com/cd899bf2d5.js" crossorigin="anonymous"></script>
</head>
<body class="min-h-screen bg-gray-50">
<?php
include "config.php";

// Handle form submission
if(isset($_POST['update'])) {
    $id = $_POST["id"];
    $pdname = $_POST["pdname"];
    $pdprice = $_POST["pdprice"];
    $page = $_POST["page"];
    
    // Handle image upload if a new image is provided
    if(isset($_FILES["pdimage"]) && $_FILES["pdimage"]["error"] == 0) {
        $image_loc = $_FILES["pdimage"]["tmp_name"];
        $image_name = $_FILES["pdimage"]["name"];
        $img_des = "Uploadimage/".$image_name;
        move_uploaded_file($image_loc, "Uploadimage/".$image_name);
        
        // Update with new image
        $query = "UPDATE `tblproduct` SET `pname`='$pdname', `pprice`='$pdprice', `image`='$img_des', `pcategory`='$page' WHERE id = $id";
    } else {
        // Update without changing image
        $query = "UPDATE `tblproduct` SET `pname`='$pdname', `pprice`='$pdprice', `pcategory`='$page' WHERE id = $id";
    }
    
    if(mysqli_query($config, $query)) {
        echo "<script>
            alert('Product updated successfully');
            window.location.href = 'index.php';
        </script>";
    } else {
        echo "<script>
            alert('Error updating product');
            window.location.href = 'index.php';
        </script>";
    }
    exit();
}

// Get product data for display
if (!isset($_GET["id"]) || empty($_GET["id"])) {
    echo "<script>
        alert('Invalid product ID');
        window.location.href = 'index.php';
    </script>";
    exit();
}

$id = $_GET["id"];
$record = mysqli_query($config, "SELECT * FROM `tblproduct` WHERE id = $id");

if (!$record || mysqli_num_rows($record) === 0) {
    echo "<script>
        alert('Product not found');
        window.location.href = 'index.php';
    </script>";
    exit();
}

$data = mysqli_fetch_array($record);
?>

    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
            <h2 class="text-center text-3xl font-bold text-gray-800 mb-6">Update Product</h2>
            <form action="" method="post" enctype="multipart/form-data" class="space-y-6">
                <!-- Product Name -->
                <div>
                    <label for="name" class="block text-md font-medium text-gray-700 mb-1">Product Name</label>
                    <input 
                        type="text" 
                        name="pdname" 
                        id="name" 
                        value="<?php echo htmlspecialchars($data['pname']); ?>"
                        required 
                        class="w-full h-10 rounded-md px-4 border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:outline-none transition duration-150 ease-in-out" 
                        placeholder="Enter Product Name" 
                        aria-label="Product Name">
                </div>

                <!-- Product Price -->
                <div>
                    <label for="number" class="block text-md font-medium text-gray-700 mb-1">Enter Price</label>
                    <input 
                        type="number" 
                        name="pdprice" 
                        id="number" 
                        value="<?php echo htmlspecialchars($data['pprice']); ?>"
                        required 
                        class="w-full h-10 rounded-md px-4 border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:outline-none transition duration-150 ease-in-out" 
                        placeholder="Product Price" 
                        aria-label="Product Price">
                </div>

                <!-- Product Image -->
                <div>
                    <label for="image" class="block text-md font-medium text-gray-700 mb-1">Product Image</label>
                    <div class="space-y-4">
                        <!-- Current Image Display -->
                        <div class="flex items-center space-x-4">
                            <div class="w-32 h-32 border-2 border-gray-200 rounded-lg overflow-hidden">
                                <img src="<?php echo htmlspecialchars($data['image']); ?>" alt="Current Product Image" class="w-full h-full object-cover">
                            </div>
                            <div class="text-sm text-gray-500">
                                <p>Current Image</p>
                            </div>
                        </div>
                        
                        <!-- Image Upload Input -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Upload New Image</label>
                            <input 
                                type="file" 
                                name="pdimage" 
                                id="image" 
                                class="w-full h-10 rounded-md px-4 border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:outline-none file:bg-indigo-50 file:text-indigo-700 file:font-medium file:h-full file:pl-0 file:border-none file:cursor-pointer file:mr-4 transition duration-150 ease-in-out" 
                                aria-label="Product Image">
                            <p class="mt-1 text-sm text-gray-500">Leave empty to keep the current image</p>
                        </div>
                    </div>
                </div>

                <!-- Category Selection -->
                <div>
                    <label for="cate" class="block text-md font-medium text-gray-700 mb-1">Select Page Category</label>
                    <select 
                        name="page" 
                        id="cate" 
                        required 
                        class="w-full h-10 rounded-md px-4 border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:outline-none transition duration-150 ease-in-out" 
                        aria-label="Page Category">
                        <option value="Home" <?php echo ($data['pcategory'] == 'Home') ? 'selected' : ''; ?>>Home</option>
                        <option value="Bag" <?php echo ($data['pcategory'] == 'Bag') ? 'selected' : ''; ?>>Bag</option>
                        <option value="Mobile" <?php echo ($data['pcategory'] == 'Mobile') ? 'selected' : ''; ?>>Mobile</option>
                        <option value="laptop" <?php echo ($data['pcategory'] == 'laptop') ? 'selected' : ''; ?>>Laptop</option>
                    </select>
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($data['id']); ?>">
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit" 
                    name="update" 
                    class="w-full h-12 bg-indigo-600 text-white font-medium rounded-md hover:bg-indigo-700 hover:cursor-pointer focus:ring-2 focus:ring-indigo-500 focus:outline-none transition duration-150 ease-in-out flex items-center justify-center">
                    <i class="fas fa-upload mr-2"></i> Update Product
                </button>
            </form>
        </div>
    </div>
</body>
</html>