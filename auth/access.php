<?php
    session_start();
    
    if (isset($_SESSION['username'])) {
        $_SESSION['message'] = "You are already logged in!";
        header("Location: ../index.php");
        exit;
    }
    
    session_regenerate_id(true);
    require '../vistas/funciones.php';
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['inputUsername'];
        $clave = $_POST['inputPassword'];
    
        $loginResult = IniciarSesion($username, $clave);
        if ($loginResult === 'success') {
            $_SESSION['username'] = $username;
            header('Location: ../index.php');
            exit;
        } else {
            $_SESSION['message'] = $loginResult;
            header("Location: ../index.php");
            exit;
        }
    }
    ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Luxury Hotel Experience">
        <meta name="author" content="ION Iceland">
        <title>Login - ION Adventure Hotel</title>
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
                <a class="btn btn-primary me-3" href="register.php">Sign Up</a>
            </nav>
        </header>
        <main class="signup-container">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="card signup-card">
                            <div class="card-header bg-light">
                                <h3 class="text-center font-weight-light my-4">Member Login</h3>
                            </div>
                            <div class="card-body">
                                <form id="loginForm" class="was-validated" method="POST">
                                    <?php if (!empty($ErrorMensage)): ?>
                                    <div class="<?php echo $tipo_banner ?>" role="alert">
                                        <?php echo $ErrorMensage; ?>
                                    </div>
                                    <?php endif; ?>
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="inputUsername" name="inputUsername" type="text" placeholder="Enter your username" required/>
                                        <label for="inputUsername">Username</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="inputPassword" name="inputPassword" type="password" placeholder="Enter your password" required/>
                                        <label for="inputPassword">Password</label>
                                    </div>
                                    <div class="mt-4 mb-0">
                                        <div class="d-grid">
                                            <input type="submit" class="btn btn-primary btn-block" value="Log In">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer text-center py-3">
                                <div class="small">Don't have an account? <a href="register.php">Sign up!</a></div>
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
                            <li><a href="../index.php">Home</a></li>
                            <li><a href="../about.php">About Us</a></li>
                            <li><a href="../booking.php">Our Rooms</a></li>
                            <li><a href="../contact.php">Contact</a></li>
                            <li><a href="register.php">Sign Up</a></li>
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
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>