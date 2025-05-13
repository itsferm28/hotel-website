<?php
    session_start();
    
    if (isset($_SESSION['message'])) {
        $displayMessage = $_SESSION['message'];
        unset($_SESSION['message']);
    }
    ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Luxury Hotel Experience">
        <meta name="author" content="ION Iceland">
        <title>ION Adventure Hotel</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
        <link href="carousel.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
        <?php if (!empty($displayMessage)): ?>
        <div class="alert alert-warning text-center"><?php echo $displayMessage; ?></div>
        <?php endif; ?>
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
        <main>
            <div id="myCarousel" class="carousel slide mb-6" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active" style="background-image: url(/img/ion1.jpg);">
                        <div class="container">
                            <div class="carousel-caption text-start">
                                <h1>A Stay Like No Other</h1>
                                <p>Experience the magic of the Northern Lights from the comfort of our luxurious suites.</p>
                                <p><a class="btn btn-lg btn-primary" href="gallery.php">Browse Gallery</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item" style="background-image: url(/img/ion2.jpg);">
                        <div class="container">
                            <div class="carousel-caption">
                                <h1>Dine with a View</h1>
                                <p>Enjoy world-class cuisine with breathtaking landscapes.</p>
                                <p><a class="btn btn-lg btn-primary" href="/auth/access.php">Book Now</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item" style="background-image: url(/img/ion3.jpg);">
                        <div class="container">
                            <div class="carousel-caption text-end">
                                <h1>Relax & Rejuvenate</h1>
                                <p>Soak in geothermal pools while enjoying nature’s tranquility.</p>
                                <p><a class="btn btn-lg btn-primary" href="/auth/register.php">Sign up</a></p>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
                </button>
            </div>
            <div class="container marketing">
                <hr class="section-divider">
                <div class="row featurette">
                    <div class="col-md-12 d-flex justify-content-center">
                        <div class="featurette-image position-relative">
                            <video class="w-100 d-block rounded" autoplay muted loop>
                                <source src="/vids/ion.mp4" type="video/mp4">
                            </video>
                            <div class="video-caption">
                                <h1 class="fw-bold">Experience ION Adventure</h1>
                                <p class="lead">Where everything meets nothing</p>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="section-divider">
                <div class="row featurette">
                    <div class="col-md-7">
                        <h2 class="featurette-heading">ION Adventure <span class="text-body-secondary">It’ll blow your mind.</span></h2>
                        <p class="lead">An unforgettable experience. Whether you are seeking a quiet, soulful soak beneath the Northern Lights, a challenging trek across an ancient glacier or a day of fly-fishing in plentiful icy rivers.</p>
                    </div>
                    <div class="col-md-5">
                        <video class="featurette-image img-fluid mx-auto" width="500" height="500" autoplay muted loop>
                            <source src="/vids/ion1.mp4" type="video/mp4">
                        </video>
                    </div>
                </div>
                <hr class="section-divider">
                <div class="row featurette">
                    <div class="col-md-7 order-md-2">
                        <h2 class="featurette-heading">ION City <span class="text-body-secondary">Designed for the Modern Explorer</span></h2>
                        <p class="lead">Boutique Design Hotel in the heart of Reykjavik City. The urban insight & communication of the 101 RVK area, sister ship to ION Adventure Hotel.</p>
                    </div>
                    <div class="col-md-5 order-md-1">
                        <video class="featurette-image img-fluid mx-auto" width="500" height="500" autoplay muted loop>
                            <source src="/vids/ion2.mp4" type="video/mp4">
                        </video>
                    </div>
                </div>
                <hr class="section-divider">
            </div>
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
    </body>
</html>