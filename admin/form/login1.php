<?php
    $config = mysqli_connect("localhost","root","","ecom");

    $A_name = $_POST["username"];
    $A_pass = $_POST["userpassword"];

    $result = mysqli_query($config,"SELECT * FROM `admin` WHERE username = '$A_name' AND pass = '$A_pass'");

// session
    session_start();

    if(mysqli_num_rows($result)){  // check weather the data is present or not;

            $_SESSION['admin'] = $A_name;    // creating a session

        echo "
        <script>
        alert('Login Successfully');
        window.location.href = '../mystore.php';
        </script>
        ";
        

    }
    else{
        echo "
        <script>
        alert('Invalid Username or Password');
        window.location.href = 'login.php';
        </script>
        ";
        

    
    }
    
?>
