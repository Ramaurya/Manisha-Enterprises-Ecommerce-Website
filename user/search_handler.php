<?php
require_once 'config.php';

if (isset($_GET['query']) && !empty($_GET['query'])) {
    $search_query = '%' . $_GET['query'] . '%';
    
    // Search in products table with correct column names
    $sql = "SELECT * FROM tblproduct WHERE 
            pname LIKE ? OR 
            pprice LIKE ? OR 
            pcategory LIKE ?";
    
    $stmt = $config->prepare($sql);
    $stmt->bind_param("sss", $search_query, $search_query, $search_query);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $products = [];
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
    
    // Return JSON response
    header('Content-Type: application/json');
    echo json_encode($products);
    exit;
}
?> 