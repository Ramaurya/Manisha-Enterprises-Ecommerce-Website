<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'config.php';

if(isset($_SESSION["user"])){
    $user_id = $_SESSION["user"]; // Get user ID from session
    error_log("User ID in insertcart: " . $user_id); // Debug log

    // Only try to get POST data if the form was submitted
    if(isset($_POST["cart"]) || isset($_POST["remove"]) || isset($_POST["update"])) {
        $product_name = $_POST['pname'] ?? '';
        $product_price = $_POST['pprice'] ?? '';
        $product_qty = $_POST['quantity'] ?? '';
    }

    if (isset($_POST["cart"])) {
        // Validate quantity
        if ($product_qty <= 0) {
            echo "
                <script>
                alert('Quantity must be greater than 0');
                window.location.href = 'index.php'; 
                </script>
            ";
            exit;
        }

        // Check if product already exists in cart for this user
        $check_sql = "SELECT * FROM tblcart WHERE idofuser = ? AND pname = ?";
        $check_stmt = $config->prepare($check_sql);
        $check_stmt->bind_param("ss", $user_id, $product_name); // Changed to string parameter
        $check_stmt->execute();
        $result = $check_stmt->get_result();

        if ($result->num_rows > 0) {
            // If product exists, update quantity
            $row = $result->fetch_assoc();
            $new_qty = $row['quantity'] + $product_qty;
            $update_sql = "UPDATE tblcart SET quantity = ? WHERE idofuser = ? AND pname = ?";
            $update_stmt = $config->prepare($update_sql);
            $update_stmt->bind_param("iss", $new_qty, $user_id, $product_name); // Changed parameter order
            
            if ($update_stmt->execute()) {
                echo "
                    <script>
                    alert('Cart updated successfully');
                    window.location.href = 'viewcart.php'; 
                    </script>
                ";
            } else {
                echo "
                    <script>
                    alert('Error updating cart');
                    window.location.href = 'index.php'; 
                    </script>
                ";
            }
        } else {
            // Insert new product into cart
            $insert_sql = "INSERT INTO tblcart (idofuser, pname, pprice, quantity) VALUES (?, ?, ?, ?)";
            $insert_stmt = $config->prepare($insert_sql);
            $insert_stmt->bind_param("ssdi", $user_id, $product_name, $product_price, $product_qty); // Changed first parameter to string
            
            if ($insert_stmt->execute()) {
                echo "
                    <script>
                    alert('Product added to cart successfully');
                    window.location.href = 'viewcart.php'; 
                    </script>
                ";
            } else {
                echo "
                    <script>
                    alert('Error adding product to cart');
                    window.location.href = 'index.php'; 
                    </script>
                ";
            }
        }
    }

    // Remove product
    if (isset($_POST["remove"])) {
        $remove_sql = "DELETE FROM tblcart WHERE idofuser = ? AND pname = ?";
        $remove_stmt = $config->prepare($remove_sql);
        $remove_stmt->bind_param("ss", $user_id, $_POST['item']); // Changed to string parameter
        
        if ($remove_stmt->execute()) {
            header("location:viewcart.php");
        } else {
            echo "
                <script>
                alert('Error removing product from cart');
                window.location.href = 'viewcart.php'; 
                </script>
            ";
        }
        exit;
    }

    // Update product quantity
    if (isset($_POST["update"])) {
        $new_qty = $_POST['quantity'];
        if ($new_qty <= 0) {
            echo "
                <script>
                alert('Quantity must be greater than 0');
                window.location.href = 'viewcart.php'; 
                </script>
            ";
            exit;
        }

        $update_sql = "UPDATE tblcart SET quantity = ? WHERE idofuser = ? AND pname = ?";
        $update_stmt = $config->prepare($update_sql);
        $update_stmt->bind_param("iss", $new_qty, $user_id, $_POST['item']); // Changed parameter order
        
        if ($update_stmt->execute()) {
            echo "
                <script>
                alert('Cart updated successfully');
                window.location.href = 'viewcart.php';   
                </script>
            ";
        } else {
            echo "
                <script>
                alert('Error updating cart');
                window.location.href = 'viewcart.php'; 
                </script>
            ";
        }
        exit;
    }
} else {
    echo "
    <script>
    alert('Please login to add to cart');
    window.location.href = 'login.php'; 
    </script>
    ";
}
?>