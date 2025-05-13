<?php
    session_start();
    
    if (!isset($_SESSION["username"])) {
        header("Location: auth/access.php");
        exit();
    }
    
    $host = "localhost";
    $dbname = "proyectofinal";
    $username = "root";
    $password = "admin";
    
    $conn = new mysqli($host, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $username = $_SESSION["username"];
    
    $update_sql = "UPDATE bookings SET paid = 1 WHERE username = ? AND paid = 0";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("s", $username);
    
    if ($update_stmt->execute()) {
        $_SESSION["success"] = "All bookings have been successfully paid!";
        $update_stmt->close();
        $conn->close();
        
        header("Location: invoice.php");
        exit();
    } else {
        $_SESSION["error"] = "Error processing payment.";
        $update_stmt->close();
        $conn->close();
        
        header("Location: my_bookings.php");
        exit();
    }
    ?>