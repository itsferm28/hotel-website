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
    
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["booking_id"])) {
        $booking_id = $_POST["booking_id"];
    
        $stmt = $conn->prepare("SELECT room_id FROM bookings WHERE id = ?");
        $stmt->bind_param("i", $booking_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $booking = $result->fetch_assoc();
    
        if ($booking) {
            $room_id = $booking["room_id"];
    
            $deleteStmt = $conn->prepare("DELETE FROM bookings WHERE id = ?");
            $deleteStmt->bind_param("i", $booking_id);
    
            if ($deleteStmt->execute()) {
                $updateRoomStmt = $conn->prepare("UPDATE rooms SET available = 1 WHERE id = ?");
                $updateRoomStmt->bind_param("i", $room_id);
                $updateRoomStmt->execute();
    
                $_SESSION["success"] = "Booking canceled successfully.";
            } else {
                $_SESSION["error"] = "Error canceling booking.";
            }
        } else {
            $_SESSION["error"] = "Booking not found.";
        }
    }
    
    header("Location: my_bookings.php");
    exit();
    ?>