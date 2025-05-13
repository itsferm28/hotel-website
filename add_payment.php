<?php
    session_start();
    
    if (!isset($_SESSION['username'])) {
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
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $card_number = $_POST["card_number"];
        $expiration_date = $_POST["expiration_date"] . "-01";
        $cvv = $_POST["cvv"];
        $username = $_SESSION["username"];
    
        $stmt = $conn->prepare("UPDATE usuarios SET payment_method = ?, expiration_date = ?, cvv = ? WHERE username = ?");
        $stmt->bind_param("ssss", $card_number, $expiration_date, $cvv, $username);
    
        if ($stmt->execute()) {
            $_SESSION["success"] = "Payment method saved successfully!";
        } else {
            $_SESSION["error"] = "Failed to save payment method.";
        }
    
        $stmt->close();
        header("Location: my_bookings.php");
        exit();
    }
    
    
    $conn->close();
    ?>