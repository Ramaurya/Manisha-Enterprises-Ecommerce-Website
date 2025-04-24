<?php
// Test database connection
$con = mysqli_connect("sql12.freesqldatabase.com", "sql12774871", "BAADiPVYle", "sql12774871");

if (mysqli_connect_errno()) {
    die("MySQL Connection Failed: " . mysqli_connect_error());
}

echo "MySQL Connection Successful!<br>";

// Check if tbluser exists
$table_check = mysqli_query($con, "SHOW TABLES LIKE 'tbluser'");
if (mysqli_num_rows($table_check) > 0) {
    echo "Table 'tbluser' exists!<br>";
    
    // Check table structure
    $columns = mysqli_query($con, "SHOW COLUMNS FROM tbluser");
    echo "<br>Table structure:<br>";
    while ($column = mysqli_fetch_assoc($columns)) {
        echo $column['Field'] . " - " . $column['Type'] . "<br>";
    }
    
    // Check if table has any data
    $count = mysqli_query($con, "SELECT COUNT(*) as count FROM tbluser");
    $row = mysqli_fetch_assoc($count);
    echo "<br>Number of records in table: " . $row['count'];
} else {
    echo "Table 'tbluser' does not exist!";
}
?> 