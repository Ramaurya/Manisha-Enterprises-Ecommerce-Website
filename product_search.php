<?php
header('Content-Type: application/json');

$con = new mysqli("localhost", "root", "", "ecom");

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$search = isset($_GET['search']) ? $con->real_escape_string($_GET['search']) : '';

$query = "SELECT * FROM tblproduct WHERE 
          productname LIKE '%$search%' OR 
          productdescription LIKE '%$search%' 
          LIMIT 5";

$result = $con->query($query);

$suggestions = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $suggestions[] = array(
            'id' => $row['id'],
            'name' => $row['productname'],
            'description' => $row['productdescription'],
            'price' => $row['productprice'],
            'image' => $row['productimage']
        );
    }
}

echo json_encode($suggestions);
$con->close();
?> 