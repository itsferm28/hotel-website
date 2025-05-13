<?php
    if (session_status() === PHP_SESSION_NONE && !isset($_SESSION['username'])) {
        session_start();
    }
    
    $host = "localhost";
    $dbname = "proyectofinal";
    $username = "root";
    $password = "admin";
    
    $conn = new mysqli($host, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["confirm_booking"])) {
        if (!empty($_SESSION["username"]) && isset($_POST["room_id"], $_POST["check_in"], $_POST["check_out"])) {
            $user = $_SESSION["username"];
            $room_id = $_POST["room_id"];
            $check_in = $_POST["check_in"];
            $check_out = $_POST["check_out"];
    
            $stmt = $conn->prepare("INSERT INTO bookings (username, room_id, check_in, check_out) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("siss", $_SESSION["username"], $room_id, $check_in, $check_out);
            if ($stmt->execute()) {
                $updateRoom = $conn->prepare("UPDATE rooms SET available = 0 WHERE id = ?");
                $updateRoom->bind_param("i", $room_id);
                $updateRoom->execute();
                
                $_SESSION["success"] = "Booking confirmed!";
                header("Location: booking.php");
                exit();
            } else {
                $_SESSION["error"] = "Error processing your booking.";
            }
            $stmt->close();
        } else {
            $_SESSION["error"] = "Missing booking details.";
        }
    }
    
    $sql = "SELECT * FROM rooms";
    $result = $conn->query($sql);
    ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <script src="../assets/js/color-modes.js"></script>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
        <meta name="generator" content="Hugo 0.122.0">
        <title>Carousel Template · Bootstrap v5.3</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="carousel.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    </head>
    <body>
        <header>
            <nav class="navbar navbar-expand-md navbar-light fixed-top bg-light">
                <a class="navbar-brand ms-3 d-flex align-items-center" href="index.php">
                <img src="/img/ion.png" alt="Hotel Logo" style="height: 30px;">
                </a>
                <div class="collapse navbar-collapse justify-content-center" id="navbarCollapse">
                    <ul class="navbar-nav mx-auto gap-5">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about.php">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="booking.php">Our Rooms</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="gallery.php">Gallery</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact.php">Contact</a>
                        </li>
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
        <div class="main-image" style="background-image: url('/img/ion18.jpg');">
            <h1>Our Rooms</h1>
        </div>
        <main class="container mt-5">
            <hr class="section-divider">
            <h2 class="text-center mb-4">Our Rooms & Availability</h2>
            <p class="text-center mt-3 fs-3">
                Explore the beauty and elegance of our hotel through our carefully curated gallery.
                From breathtaking landscapes to luxurious interiors, every moment is designed to impress.
            </p>
            <br>
            <div class="row row-cols-1 row-cols-md-2 g-4">
                <?php while ($room = $result->fetch_assoc()): ?>
                <div class="col">
                    <div class="card room-card h-100 d-flex flex-column">
                        <img src="<?= htmlspecialchars($room["image"]) ?>" class="card-img-top" alt="<?= htmlspecialchars($room["name"]) ?>">
                        <div class="card-body d-flex flex-column">
                            <h4 class="card-title"><?= htmlspecialchars($room["name"]) ?></h4>
                            <p class="flex-grow-1"><?= htmlspecialchars($room["description"]) ?></p>
                            <p><strong>Price: </strong>$<?= number_format($room["price"], 2) ?> per night</p>
                            <p><strong>Status:</strong>
                                <?= $room["available"] ? '<span class="badge bg-success">Available</span>' : '<span class="badge bg-danger">Booked</span>' ?>
                            </p>
                            <?php if (!empty($_SESSION['username'])): ?>
                            <?php if ($room["available"]): ?>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#bookingModal<?= $room['id'] ?>">Book Now</button>
                            <div class="modal fade" id="bookingModal<?= $room['id'] ?>" tabindex="-1" aria-labelledby="bookingModalLabel<?= $room['id'] ?>" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Book <?= htmlspecialchars($room["name"]) ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <form action="booking.php" method="POST">
                                            <div class="modal-body">
                                                <input type="hidden" name="room_id" value="<?= $room['id'] ?>">
                                                <label for="check_in">Check-in Date:</label>
                                                <input type="date" name="check_in" class="form-control" required>
                                                <label for="check_out" class="mt-2">Check-out Date:</label>
                                                <input type="date" name="check_out" class="form-control" required>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-success" name="confirm_booking">Confirm Booking</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <?php else: ?>
                            <button class="btn btn-secondary" disabled>Unavailable</button>
                            <?php endif; ?>
                            <?php else: ?>
                            <a href="auth/access.php" class="btn btn-primary">Sign in to Book Now</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
            <hr class="featurette-divider">
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
        </main>
        <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>