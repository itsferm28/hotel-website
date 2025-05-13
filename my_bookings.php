<?php
    session_start();
    
    if (!isset($_SESSION['username'])) {
        header("Location: auth/access.php");
        exit();
    }
    
    if (isset($_SESSION["success"])) {
        echo "<div class='alert alert-success text-center'>" . $_SESSION["success"] . "</div>";
        unset($_SESSION["success"]);
    }
    if (isset($_SESSION["error"])) {
        echo "<div class='alert alert-danger text-center'>" . $_SESSION["error"] . "</div>";
        unset($_SESSION["error"]);
    }
    
    $host = "localhost";
    $dbname = "proyectofinal";
    $username = "root";
    $password = "admin";
    
    $conn = new mysqli($host, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $payment_check_sql = "SELECT payment_method FROM usuarios WHERE username = ?";
    $payment_stmt = $conn->prepare($payment_check_sql);
    $payment_stmt->bind_param("s", $_SESSION["username"]);
    $payment_stmt->execute();
    $payment_result = $payment_stmt->get_result();
    $payment = $payment_result->fetch_assoc();
    
    $has_payment_method = isset($payment["payment_method"]) && !empty($payment["payment_method"]);
    
    $booking_sql = "SELECT b.*, r.name, r.image FROM bookings b JOIN rooms r ON b.room_id = r.id WHERE b.username = ?";
    $stmt = $conn->prepare($booking_sql);
    $stmt->bind_param("s", $_SESSION["username"]);
    $stmt->execute();
    $result = $stmt->get_result();
    ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Luxury Hotel Experience">
        <meta name="author" content="ION Iceland">
        <title>My Bookings</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
        <link href="../carousel.css" rel="stylesheet">
    </head>
    <body>
        <header>
            <nav class="navbar navbar-expand-md navbar-light fixed-top bg-light">
                <a class="navbar-brand ms-3 d-flex align-items-center" href="../index.php">
                <img src="../img/ion.png" alt="Hotel Logo" style="height: 30px;">
                </a>
                <div class="collapse navbar-collapse justify-content-center">
                    <ul class="navbar-nav mx-auto gap-5">
                        <li class="nav-item"><a class="nav-link" href="../index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="../about.php">About Us</a></li>
                        <li class="nav-item"><a class="nav-link" href="../booking.php">Our Rooms</a></li>
                        <li class="nav-item"><a class="nav-link" href="../gallery.php">Gallery</a></li>
                        <li class="nav-item"><a class="nav-link" href="../contact.php">Contact</a></li>
                    </ul>
                </div>
                <?php if (!empty($_SESSION['username'])): ?>
                <div class="dropdown me-3">
                    <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    Account
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="auth/account.php">Edit Account</a></li>
                        <li><a class="dropdown-item" href="my_bookings.php">My Bookings</a></li>
                        <li><a class="dropdown-item" href="auth/logout.php">Log Out</a></li>
                    </ul>
                </div>
                <?php else: ?>
                <a class="btn btn-primary me-3" href="auth/access.php">Member Access</a>
                <?php endif; ?>
            </nav>
        </header>
        <div class="content-wrapper">
            <main class="booking-container">
                <div class="booking-card">
                    <h2 class="text-center">My Bookings</h2>
                    <hr>
                    <?php if ($result->num_rows > 0): ?>
                    <?php while ($booking = $result->fetch_assoc()): ?>
                    <div class="booking-item">
                        <img src="<?= htmlspecialchars($booking['image']) ?>" alt="Room Image">
                        <div>
                            <h5><?= htmlspecialchars($booking['name']) ?></h5>
                            <p><strong>Check-in:</strong> <?= $booking['check_in'] ?> | <strong>Check-out:</strong> <?= $booking['check_out'] ?></p>
                            <p><strong>Status:</strong> 
                                <?= $booking['paid'] ? '<span class="badge bg-success">Paid</span>' : '<span class="badge bg-warning">Unpaid</span>' ?>
                            </p>
                        </div>
                    </div>
                    <form action="cancel_booking.php" method="POST">
                        <input type="hidden" name="booking_id" value="<?= $booking['id'] ?>">
                        <button type="submit" class="btn btn-danger btn-sm">Cancel</button>
                    </form>
                    <?php endwhile; ?>
                    <?php 
                        $payment_check_sql = "SELECT payment_method FROM usuarios WHERE username = ?";
                        $payment_stmt = $conn->prepare($payment_check_sql);
                        $payment_stmt->bind_param("s", $_SESSION["username"]);
                        $payment_stmt->execute();
                        $payment_result = $payment_stmt->get_result();
                        $payment = $payment_result->fetch_assoc();
                        $has_payment_method = !empty($payment["payment_method"]);
                        ?>
                    <div class="text-center mt-4">
                        <?php if ($has_payment_method && !$expired): ?>
                        <form action="pay_all.php" method="POST">
                            <button type="submit" class="btn btn-success btn-lg">Pay All</button>
                        </form>
                        <?php elseif ($expired): ?>
                        <p class="text-danger">Your payment method has expired. Please update your payment details.</p>
                        <?php else: ?>
                        <h5 class="mb-3">Add a Payment Method</h5>
                        <form action="add_payment.php" method="POST">
                            <div class="mb-2">
                                <label for="card_number" class="form-label">Card Number</label>
                                <input type="text" id="card_number" name="card_number" class="form-control" placeholder="Enter your card number" required>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="expiration_date" class="form-label">Expiration Date</label>
                                    <input type="month" id="expiration_date" name="expiration_date" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="cvv" class="form-label">CVV</label>
                                    <input type="text" id="cvv" name="cvv" class="form-control" placeholder="3-digit code" required>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Save Payment Method</button>
                        </form>
                        <?php endif; ?>
                    </div>
                    <?php else: ?>
                    <p class="no-bookings text-center">No bookings found.</p>
                    <?php endif; ?>
                </div>
            </main>
        </div>
        <div class="container marketing">
        <hr class="section-divider">
        <footer class="container footer">
            <div class="row">
                <div class="col-md-4">
                    <h5>Explore</h5>
                    <ul class="footer-links">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="about.php">About Us</a></li>
                        <li><a href="booking.php">Our Rooms</a></li>
                        <li><a href="contact.php">Contact</a></li>
                        <li><a href="/auth/access.php">Member Access</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Inquiries</h5>
                    <ul class="footer-links">
                        <li><a href="mailto:reservations@ioniceland.is">reservations@ioniceland.is</a></li>
                        <li><a href="mailto:ioncity@ioniceland.is">ioncity@ioniceland.is</a></li>
                        <li><a href="mailto:sales@ioniceland.is">sales@ioniceland.is</a></li>
                    </ul>
                    <div class="social-icons">
                        <a href="https://www.instagram.com/ioniceland/" class="social-icon"><i class="bi bi-instagram"></i></a>
                        <a href="https://www.facebook.com/IONIceland/" class="social-icon"><i class="bi bi-facebook"></i></a>
                    </div>
                </div>
                <div class="col-md-4">
                    <h5>Stay Updated</h5>
                    <form>
                        <input type="email" class="form-control" placeholder="Enter your email">
                        <button type="submit" class="btn btn-primary mt-2">Subscribe</button>
                    </form>
                </div>
            </div>
            <hr class="section-divider">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p>&copy; ION Iceland 2024 - All rights reserved.</p>
                </div>
                <div class="col-md-6 text-end">
                    <a href="#" class="back-to-top"><i class="bi bi-arrow-up-circle"></i></a>
                </div>
            </div>
        </footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
<?php $conn->close(); ?>