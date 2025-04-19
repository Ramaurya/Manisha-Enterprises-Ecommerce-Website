<?php
session_start();
include 'config.php';

if(!isset($_SESSION["user"])){
    echo "
    <script>
        alert('Please login first');
        window.location.href = 'form.php/login.php';
    </script>
    ";
    exit();
}

if(isset($_POST["placeorder"])) {
    $user_id = $_SESSION["user"];
    $address = $_POST["address"];
    $city = $_POST["city"];
    $state = $_POST["state"];
    $pincode = $_POST["pincode"];
    $country = $_POST["country"];
    $paymentmode = $_POST["paymentmode"];
    
    // Store delivery details in session for online payment
    $_SESSION['delivery_address'] = $address;
    $_SESSION['delivery_city'] = $city;
    $_SESSION['delivery_state'] = $state;
    $_SESSION['delivery_pincode'] = $pincode;
    $_SESSION['delivery_country'] = $country;
    
    // Calculate cart total
    $total_query = "SELECT SUM(pprice * quantity) as total FROM tblcart WHERE idofuser = ?";
    $total_stmt = $config->prepare($total_query);
    $total_stmt->bind_param("s", $user_id);
    $total_stmt->execute();
    $total_result = $total_stmt->get_result();
    $total_row = $total_result->fetch_assoc();
    $_SESSION['cart_total'] = $total_row['total'];

    // If payment mode is online, redirect to payment page
    if($paymentmode === "online") {
        header("Location: payment.php");
        exit();
    }
    
    // For COD, proceed with order placement
    $cart_query = "SELECT * FROM tblcart WHERE idofuser = ?";
    $cart_stmt = $config->prepare($cart_query);
    $cart_stmt->bind_param("s", $user_id);
    $cart_stmt->execute();
    $cart_result = $cart_stmt->get_result();
    
    // Begin transaction
    $config->begin_transaction();
    
    try {
        // Insert each cart item as an order
        while($cart_item = $cart_result->fetch_assoc()) {
            $sql = "INSERT INTO tblorder (idofuser, pname, pprice, quantity, paymentmode, address, city, state, pincode, country) 
                   VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $config->prepare($sql);
            $stmt->bind_param("ssssssssss", 
                $user_id,
                $cart_item['pname'],
                $cart_item['pprice'],
                $cart_item['quantity'],
                $paymentmode,
                $address,
                $city,
                $state,
                $pincode,
                $country
            );
            $stmt->execute();
        }
        
        // Clear cart
        $clear_cart = "DELETE FROM tblcart WHERE idofuser = ?";
        $clear_stmt = $config->prepare($clear_cart);
        $clear_stmt->bind_param("s", $user_id);
        $clear_stmt->execute();
        
        // Commit transaction
        $config->commit();
        
        echo "
        <script>
            alert('Order placed successfully!');
            window.location.href = 'orders.php';
        </script>
        ";
        exit();
        
    } catch (Exception $e) {
        // Rollback transaction on error
        $config->rollback();
        echo "
        <script>
            alert('Error processing your order. Please try again.');
            window.location.href = 'checkout.php';
        </script>
        ";
        exit();
    }
} 