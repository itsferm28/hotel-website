<?php
    session_start();
    
    if (!isset($_SESSION['username'])) {
        $_SESSION['message'] = "You must be logged in to access your account.";
        header("Location: ../auth/access.php");
        exit;
    }
    
    $host = "localhost";
    $dbname = "proyectofinal";
    $username = "root";
    $password = "admin";
    
    $conn = new mysqli($host, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $loggedInUser = $_SESSION["username"];
    
    $sql = "SELECT * FROM usuarios WHERE Username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $loggedInUser);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    
    $paymentSQL = "SELECT payment_method, expiration_date, cvv FROM usuarios WHERE Username = ?";
    $paymentStmt = $conn->prepare($paymentSQL);
    $paymentStmt->bind_param("s", $loggedInUser);
    $paymentStmt->execute();
    $paymentResult = $paymentStmt->get_result();
    $paymentInfo = $paymentResult->fetch_assoc();
    
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["updateProfile"])) {
        $nombre = $_POST["fname"];
        $newUsername = $_POST["username"];
        $email = $_POST["email"];
        $telefono = $_POST["movil"];
        $edad = $_POST["birthdate"];
    
        if ($newUsername !== $loggedInUser) {
            $checkUsernameSQL = "SELECT COUNT(*) FROM usuarios WHERE Username = ?";
            $checkStmt = $conn->prepare($checkUsernameSQL);
            $checkStmt->bind_param("s", $newUsername);
            $checkStmt->execute();
            $checkStmt->bind_result($count);
            $checkStmt->fetch();
            $checkStmt->close();
    
            if ($count > 0) {
                $_SESSION["error"] = "Username already exists. Please choose another.";
                header("Location: account.php");
                exit();
            }
        }
    
        if (!empty($_POST["password"])) {
            $clave = $_POST["password"];
            $updateSQL = "UPDATE usuarios SET Username = ?, nombre = ?, email = ?, clave = ?, telefono = ?, edad = ? WHERE Username = ?";
            $updateStmt = $conn->prepare($updateSQL);
            $updateStmt->bind_param("sssssss", $newUsername, $nombre, $email, $clave, $telefono, $edad, $loggedInUser);
        } else {
            $updateSQL = "UPDATE usuarios SET Username = ?, nombre = ?, email = ?, telefono = ?, edad = ? WHERE Username = ?";
            $updateStmt = $conn->prepare($updateSQL);
            $updateStmt->bind_param("ssssss", $newUsername, $nombre, $email, $telefono, $edad, $loggedInUser);
        }
    
        if ($updateStmt->execute()) {
            $_SESSION["username"] = $newUsername;
            $_SESSION["success"] = "Profile updated successfully.";
            header("Location: account.php");
            exit();
        } else {
            $_SESSION["error"] = "Error updating profile.";
        }
    }
    
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["updatePayment"])) {
        $cardNumber = $_POST["card_number"] ?? null;
        $expirationDate = $_POST["expiration_date"] ?? null;
        $cvv = $_POST["cvv"] ?? null;
    
        if ($cardNumber && $expirationDate && $cvv) {
            $updatePaymentSQL = "UPDATE usuarios SET payment_method = ?, expiration_date = ?, cvv = ? WHERE Username = ?";
            $updateStmt = $conn->prepare($updatePaymentSQL);
            $updateStmt->bind_param("ssss", $cardNumber, $expirationDate, $cvv, $loggedInUser);
            $updateStmt->execute();
            $updateStmt->close();
    
            $_SESSION["success"] = "Payment information updated.";
            header("Location: account.php");
            exit();
        } else {
            $_SESSION["error"] = "Please fill in all payment fields.";
        }
    }
    
    ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Account - ION Adventure Hotel</title>
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
                <div class="dropdown me-3">
                    <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    Account
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="account.php">Edit Account</a></li>
                        <li><a class="dropdown-item" href="../my_bookings.php">My Bookings</a></li>
                        <li><a class="dropdown-item" href="../auth/logout.php">Log Out</a></li>
                    </ul>
                </div>
            </nav>
        </header>
        <main class="signup-container">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="card signup-card">
                            <div class="card-header bg-light text-center">
                                <h3>Edit Profile</h3>
                            </div>
                            <div class="card-body">
                                <?php if (isset($_SESSION["success"])) { echo "<div class='alert alert-success'>" . $_SESSION["success"] . "</div>"; unset($_SESSION["success"]); } ?>
                                <?php if (isset($_SESSION["error"])) { echo "<div class='alert alert-danger'>" . $_SESSION["error"] . "</div>"; unset($_SESSION["error"]); } ?>
                                <form action="account.php" method="post">
                                    <input type="hidden" name="updateProfile" value="1">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="username" name="username" value="<?= htmlspecialchars($user["Username"] ?? "") ?>" required>
                                        <label for="username">Username</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="fname" name="fname" value="<?= htmlspecialchars($user["nombre"] ?? "") ?>" required>
                                        <label for="fname">Name</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($user["email"] ?? "") ?>" required>
                                        <label for="email">Email</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="password" class="form-control" id="password" name="password">
                                        <label for="password">New Password (leave blank to keep current)</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="movil" name="movil" value="<?= htmlspecialchars($user["telefono"] ?? "") ?>">
                                        <label for="movil">Phone</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="birthdate" name="birthdate" value="<?= htmlspecialchars($user["edad"] ?? "") ?>">
                                        <label for="birthdate">Age</label>
                                    </div>
                                    <div class="mt-4 mb-0">
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-primary btn-block">Update Profile</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card signup-card">
                            <div class="card-header bg-light text-center">
                                <h5>Payment Information</h5>
                            </div>
                            <div class="card-body">
                                <form action="account.php" method="post">
                                    <input type="hidden" name="updatePayment" value="1">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="card_number" name="card_number" 
                                            placeholder="XXXX XXXX XXXX XXXX" value="<?= htmlspecialchars($paymentInfo['payment_method'] ?? '') ?>">
                                        <label for="card_number">Credit Card Number</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="date" class="form-control" id="expiration_date" name="expiration_date" 
                                            value="<?= htmlspecialchars($paymentInfo['expiration_date'] ?? '') ?>" required>
                                        <label for="expiration_date">Expiration Date</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="cvv" name="cvv" placeholder="XXX" value="<?= htmlspecialchars($cardInfo['cvv'] ?? '') ?>">
                                        <label for="cvv">CVV</label>
                                    </div>
                                    <div class="mt-4 mb-0">
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-primary btn-block">Update Payment</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
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