<?php
include "config.php";
$id = $_GET['id'];

// Get product details before deletion
$product_query = mysqli_query($config, "SELECT pname FROM tblproduct WHERE id = $id");
$product = mysqli_fetch_assoc($product_query);
$product_name = $product['pname'];

// Delete the product
mysqli_query($config, "DELETE FROM tblproduct WHERE id = $id");

// Log the deletion activity
$activity_description = "Product deleted: \"$product_name\"";
mysqli_query($config, "INSERT INTO `activities` (`activity_type`, `activity_description`) VALUES ('product_delete', '$activity_description')");

header("location:index.php");
?>