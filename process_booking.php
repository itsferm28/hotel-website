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
    
    $user_query = $conn->prepare("SELECT id FROM usuarios WHERE Username = ?");
    $user_query->bind_param("s", $_SESSION["username"]);
    $user_query->execute();
    $user_result = $user_query->get_result();
    $user = $user_result->fetch_assoc();
    $user_id = $user["id"];
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $room_id = $_POST["room_id"];
        $check_in = $_POST["check_in"];
        $check_out = $_POST["check_out"];
    
        $booking_sql = "INSERT INTO bookings (user_id, room_id, check_in, check_out) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($booking_sql);
        $stmt->bind_param("iiss", $user_id, $room_id, $check_in, $check_out);
    
        if ($stmt->execute()) {
            $update_sql = "UPDATE rooms SET available = FALSE WHERE id = ?";
            $update_stmt = $conn->prepare($update_sql);
            $update_stmt->bind_param("i", $room_id);
            $update_stmt->execute();
    
            $_SESSION["success"] = "Room booked successfully!";
            header("Location: booking.php");
        } else {
            $_SESSION["error"] = "Error processing booking.";
            header("Location: booking.php");
        }
    }
    $conn->close();
    ?>