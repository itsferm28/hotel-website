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
    
    $sql = "SELECT b.id, r.name, r.price, b.check_in, b.check_out FROM bookings b 
            JOIN rooms r ON b.room_id = r.id 
            WHERE b.username = ? AND b.paid = 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $user_sql = "SELECT nombre, email FROM usuarios WHERE username = ?";
    $user_stmt = $conn->prepare($user_sql);
    $user_stmt->bind_param("s", $username);
    $user_stmt->execute();
    $user_result = $user_stmt->get_result();
    $user = $user_result->fetch_assoc();
    ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Invoice</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
        .invoice-container {
            width: 90%;
            max-width: 750px;
            background: #fff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            margin: 30px auto;
            font-family: Arial, sans-serif;
        }

        body {
            background: url('/img/ion17.jpg') no-repeat center center fixed;
            background-size: cover;
            }

        .invoice-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .invoice-header h2 {
            color: #007bff;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .invoice-info {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            border-bottom: 2px solid #ddd;
            padding-bottom: 10px;
            margin-bottom: 15px;
            font-size: 14px;
        }

        .invoice-info div {
            flex: 1;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        .table th, .table td {
            text-align: center;
            padding: 12px;
            border: 1px solid #ddd;
        }

        .table th {
            background-color: #e7dad2;
        }

        .total {
            font-size: 1.2rem;
            font-weight: bold;
            text-align: right;
            margin-top: 15px;
        }

        .text-end {
            text-align: right;
        }

        }
    </style>
    </head>
    <body>
        <div class="invoice-container">
            <div class="invoice-header">
                <h2>Invoice</h2>
                <p>Thank you for your payment! Below is the summary of your booking.</p>
            </div>
            <div class="invoice-info">
                <div>
                    <strong>Hotel Name:</strong> ION Adventure Hotel <br>
                    <strong>Address:</strong> 123 Luxury St, Reykjavik, Iceland <br>
                    <strong>Email:</strong> support@ioniceland.is
                </div>
                <div>
                    <strong>Customer Name:</strong> <?= htmlspecialchars($user['nombre']) ?> <br>
                    <strong>Email:</strong> <?= htmlspecialchars($user['email']) ?> <br>
                    <strong>Date:</strong> <?= date("F j, Y") ?>
                </div>
            </div>
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>Booking ID</th>
                        <th>Room Name</th>
                        <th>Check-in</th>
                        <th>Check-out</th>
                        <th>Price (per night)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $total = 0;
                        while ($row = $result->fetch_assoc()) {
                            $total += $row["price"];
                            echo "<tr>
                                    <td>{$row['id']}</td>
                                    <td>{$row['name']}</td>
                                    <td>{$row['check_in']}</td>
                                    <td>{$row['check_out']}</td>
                                    <td>\${$row['price']}</td>
                                  </tr>";
                        }
                        ?>
                </tbody>
            </table>
            <h4 class="text-end total">Total Amount: <strong>$<?= number_format($total, 2) ?></strong></h4>
            <div class="text-center mt-4">
                <button onclick="window.print()" class="btn btn-primary">Print Invoice</button>
                <a href="my_bookings.php" class="btn btn-secondary">Back to Bookings</a>
            </div>
        </div>
    </body>
</html>
<?php $conn->close(); ?>