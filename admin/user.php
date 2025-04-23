<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
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
<body class="bg-gray-100 min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800">User Management</h1>
                <a href="mystore.php" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition duration-300">
                    <i class="fas fa-arrow-left mr-2"></i>Back
                </a>
            </div>

            <?php
            $con = new mysqli("sql12.freesqldatabase.com", "sql12774871", "BAADiPVYle", "ecom");
            $Record = mysqli_query($con, "SELECT * FROM `tbluser`");
            ?>

            <div class="overflow-x-auto">
                <table class="min-w-full bg-white rounded-lg overflow-hidden">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="py-3 px-4 text-left">S.No</th>
                            <th class="py-3 px-4 text-left">Name</th>
                            <th class="py-3 px-4 text-left">Email</th>
                            <th class="py-3 px-4 text-left">Phone</th>
                            <th class="py-3 px-4 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php
                        while($row = mysqli_fetch_array($Record)){
                            echo "
                            <tr class='hover:bg-gray-50 transition duration-150'>
                                <td class='py-3 px-4'>{$row['id']}</td>
                                <td class='py-3 px-4'>{$row['username']}</td>
                                <td class='py-3 px-4'>{$row['email']}</td>
                                <td class='py-3 px-4'>{$row['number']}</td>
                                <td class='py-3 px-4'>
                                    <div class='flex space-x-2'>
                                        
                                        <a href='delete_user.php?id={$row['id']}' 
                                           class='text-red-500 hover:text-red-700'
                                           onclick='return confirm(\"Are you sure you want to delete this user?\")'>
                                            <i class='fas fa-trash'></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>