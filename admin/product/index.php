<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Page</title>
    <link rel="stylesheet" href="output.css">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://kit.fontawesome.com/cd899bf2d5.js" crossorigin="anonymous"></script>
    <?php
    session_start();
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
    if(!isset($_SESSION['admin'] )){
        header("location:../form/login.php");
        exit();
    }

?>
</head>
<body class="min-h-screen bg-gray-50">
    <div class="container mx-auto px-4 py-8">
        <!-- Back Button -->
        <div class="mb-4">
            <a href="../mystore.php" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 transition duration-150 ease-in-out">
                <i class="fas fa-arrow-left mr-2"></i> Back to Store
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
            <h2 class="text-center text-3xl font-bold text-gray-800 mb-6">Product Management</h2>
            <form action="insert.php" method="post" enctype="multipart/form-data" class="space-y-6">
                <!-- Product Name -->
                <div>
                    <label for="name" class="block text-md font-medium text-gray-700 mb-1">Product Name</label>
                    <input 
                        type="text" 
                        name="pdname" 
                        id="name" 
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
                        required 
                        class="w-full h-10 rounded-md px-4 border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:outline-none transition duration-150 ease-in-out" 
                        placeholder="Product Price" 
                        aria-label="Product Price">
                </div>

                <!-- Product Image -->
                <div>
                    <label for="image" class="block text-md font-medium text-gray-700 mb-1">Add Product Image</label>
                    <div class="flex items-center space-x-4">
                        <input 
                            type="file" 
                            name="pdimage" 
                            id="image" 
                            required 
                            class="w-full h-10 rounded-md px-4 border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:outline-none file:bg-indigo-50 file:text-indigo-700 file:font-medium file:h-full file:pl-0 file:border-none file:cursor-pointer file:mr-4 transition duration-150 ease-in-out" 
                            aria-label="Product Image">
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
                        <option value="Home">Home</option>
                        <option value="Bag">Bag</option>
                        <option value="Mobile">Mobile</option>
                        <option value="laptop">Laptop</option>
                    </select>
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit" 
                    name="submit" 
                    class="w-full h-12 bg-indigo-600 text-white font-medium rounded-md hover:bg-indigo-700 hover:cursor-pointer focus:ring-2 focus:ring-indigo-500 focus:outline-none transition duration-150 ease-in-out flex items-center justify-center">
                    <i class="fas fa-upload mr-2"></i> Upload Product
                </button>
            </form>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6">
            <h3 class="text-2xl font-bold text-gray-800 mb-4">Product List</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                    <thead>
                        <tr class="bg-indigo-600 text-white">
                            <th class="px-4 py-3 border-b text-left">Id</th>
                            <th class="px-4 py-3 border-b text-left">Name</th>
                            <th class="px-4 py-3 border-b text-left">Price</th>
                            <th class="px-4 py-3 border-b text-left">Image</th>
                            <th class="px-4 py-3 border-b text-left">Category</th>
                            <th class="px-4 py-3 border-b text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            include "config.php";
                            $records = mysqli_query($config, "SELECT * FROM `tblproduct`");

                            while($row = mysqli_fetch_array($records)) {
                                echo "
                                <tr class='hover:bg-gray-50 transition duration-150 ease-in-out'>
                                    <td class='px-4 py-3 border-b'>$row[id]</td>
                                    <td class='px-4 py-3 border-b'>$row[pname]</td>
                                    <td class='px-4 py-3 border-b'>$row[pprice]</td>
                                    <td class='px-4 py-3 border-b'>
                                        <img src='$row[image]' alt='Product Image' class='h-20 w-auto object-cover rounded-md shadow-sm'>
                                    </td>
                                    <td class='px-4 py-3 border-b'>$row[pcategory]</td>
                                    <td class='px-4 py-3 border-b text-center'>
                                        <div class='flex justify-center space-x-2'>
                                            <a href='update.php?id=$row[id]' class='inline-flex items-center px-3 py-1 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 hover:cursor-pointer transition duration-150 ease-in-out'>
                                                <i class='fas fa-edit mr-1'></i> Update
                                            </a>
                                            <a href='delete.php?id=$row[id]' class='inline-flex items-center px-3 py-1 bg-red-600 text-white rounded-md hover:bg-red-700 hover:cursor-pointer transition duration-150 ease-in-out' onclick='return confirm(\"Are you sure you want to delete this product?\")'>
                                                <i class='fas fa-trash-alt mr-1'></i> Delete
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                ";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>