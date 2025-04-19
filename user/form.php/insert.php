<?php
if(isset($_POST["submit"])){
    $username = $_POST["name"];
    $mobile = $_POST["number"];
    $email = $_POST["email"];
    $upass = $_POST["pass"];
    $urepass = $_POST["repass"];
    
    // Validate password match
    if($upass !== $urepass){
        echo "
            <script>
                alert('Passwords do not match!');
                window.location.href = 'register.php';
            </script>
        ";
        exit();
    }

    // Validate mobile number
    if(!preg_match('/^[0-9]{10}$/', $mobile)) {
        echo "
            <script>
                alert('Please enter a valid 10-digit mobile number!');
                window.location.href = 'register.php';
            </script>
        ";
        exit();
    }

    // Database connection
    $mycon = mysqli_connect("localhost","root","","ecom");
    if(!$mycon){
        echo "
            <script>
                alert('Database connection failed: " . mysqli_connect_error() . "');
                window.location.href = 'register.php';
            </script>
        ";
        exit();
    }

    // Check if mobile number already exists
    $check_mobile = "SELECT * FROM tbluser WHERE number = ?";
    $stmt = $mycon->prepare($check_mobile);
    $stmt->bind_param("s", $mobile);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        echo "
            <script>
                alert('Mobile number already registered!');
                window.location.href = 'register.php';
            </script>
        ";
        exit();
    }

    // Check if email already exists
    $check_email = "SELECT * FROM tbluser WHERE email = ?";
    $stmt = $mycon->prepare($check_email);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        echo "
            <script>
                alert('Email already registered!');
                window.location.href = 'register.php';
            </script>
        ";
        exit();
    }

    // Insert new user
    $sql = "INSERT INTO tbluser (username, number, email, password, repassword) VALUES (?, ?, ?, ?, ?)";
    $ps = $mycon->prepare($sql);
    $ps->bind_param("sssss", $username, $mobile, $email, $upass, $urepass);
    
    if($ps->execute()) {
        echo "
            <script>
                alert('Registration successful! Please login.');
                window.location.href = 'login.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Registration failed! Please try again.');
                window.location.href = 'register.php';
            </script>
        ";
    }
    $ps->close();
    $mycon->close();
}
?>
    
    
