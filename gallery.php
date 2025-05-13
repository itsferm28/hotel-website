<?php
    if (session_status() === PHP_SESSION_NONE && !isset($_SESSION['username'])) {
        session_start();
    }
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
                            <a class="nav-link" href="booking.php">Our Rooms</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="gallery.php">Gallery</a>
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
        <main>
            <div class="main-image">
                <video autoplay muted loop playsinline class="background-video">
                    <source src="/vids/ion3.mp4" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
                <h1>Gallery</h1>
            </div>
            <div class="container marketing">
            <hr class="featurette-divider">
            <div class="container">
                <p class="text-center mt-3 fs-3">
                    Explore the beauty and elegance of our hotel through our carefully curated gallery.
                    From breathtaking landscapes to luxurious interiors, every moment is designed to impress.
                </p>
                <br><br>
                <div class="row g-3">
                    <div class="col-md-4"><img src="/img/ion6.jpg" class="img-fluid rounded gallery-img" data-bs-toggle="modal" data-bs-target="#galleryModal"></div>
                    <div class="col-md-4"><img src="/img/ion7.jpg" class="img-fluid rounded gallery-img" data-bs-toggle="modal" data-bs-target="#galleryModal"></div>
                    <div class="col-md-4"><img src="/img/ion8.jpg" class="img-fluid rounded gallery-img" data-bs-toggle="modal" data-bs-target="#galleryModal"></div>
                    <div class="col-md-4"><img src="/img/ion9.jpg" class="img-fluid rounded gallery-img" data-bs-toggle="modal" data-bs-target="#galleryModal"></div>
                    <div class="col-md-4"><img src="/img/ion10.jpg" class="img-fluid rounded gallery-img" data-bs-toggle="modal" data-bs-target="#galleryModal"></div>
                    <div class="col-md-4"><img src="/img/ion11.jpg" class="img-fluid rounded gallery-img" data-bs-toggle="modal" data-bs-target="#galleryModal"></div>
                    <div class="col-md-4"><img src="/img/ion12.jpg" class="img-fluid rounded gallery-img" data-bs-toggle="modal" data-bs-target="#galleryModal"></div>
                    <div class="col-md-4"><img src="/img/ion13.jpg" class="img-fluid rounded gallery-img" data-bs-toggle="modal" data-bs-target="#galleryModal"></div>
                    <div class="col-md-4"><img src="/img/ion14.jpg" class="img-fluid rounded gallery-img" data-bs-toggle="modal" data-bs-target="#galleryModal"></div>
                    <div class="col-md-6"><img src="/img/ion15.jpg" class="img-fluid rounded gallery-img" data-bs-toggle="modal" data-bs-target="#galleryModal"></div>
                    <div class="col-md-6"><img src="/img/ion16.jpg" class="img-fluid rounded gallery-img" data-bs-toggle="modal" data-bs-target="#galleryModal"></div>
                </div>
            </div>
            <div class="modal fade" id="galleryModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body text-center">
                            <img id="lightboxImage" class="img-fluid">
                        </div>
                    </div>
                </div>
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
            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    const galleryImages = document.querySelectorAll(".gallery-img");
                    const lightboxImage = document.getElementById("lightboxImage");
                
                    galleryImages.forEach(img => {
                        img.addEventListener("click", function () {
                            lightboxImage.src = this.src;
                        });
                    });
                });
            </script>
        </main>
        <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>