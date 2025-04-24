<?php
// Database connection
$con = mysqli_connect("sql12.freesqldatabase.com", "sql12774871", "BAADiPVYle", "sql12774871");

// Check connection
if (mysqli_connect_errno()) {
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}

// Check if ID is provided
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($con, $_GET['id']);
    
    // Delete the user
    $query = "DELETE FROM tbluser WHERE id = '$id'";
    if (mysqli_query($con, $query)) {
        // Redirect back to user management page
        header("Location: user.php");
        exit();
    } else {
        die("Error deleting user: " . mysqli_error($con));
    }
} else {
    die("No user ID provided");
}
?>