<?php
    if (session_status() === PHP_SESSION_NONE && !isset($_SESSION['username'])) {
        session_start();
    }
    ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Contact ION Iceland - Get in touch with us for inquiries and reservations">
        <meta name="author" content="ION Iceland">
        <title>Contact Us - ION Iceland</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
        <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="carousel.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
        <header>
            <nav class="navbar navbar-expand-md navbar-light fixed-top bg-light">
                <a class="navbar-brand ms-3 d-flex align-items-center" href="index.php">
                <img src="/img/ion.png" alt="Hotel Logo" style="height: 30px;">
                </a>
                <div class="collapse navbar-collapse justify-content-center" id="navbarCollapse">
                    <ul class="navbar-nav mx-auto gap-5">
                        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="about.php">About Us</a></li>
                        <li class="nav-item"><a class="nav-link" href="booking.php">Our Rooms</a></li>
                        <li class="nav-item"><a class="nav-link" href="gallery.php">Gallery</a></li>
                        <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
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
            <div class="main-image" style="background-image: url('/img/ion5.jpg');">
                <h1>About Us</h1>
            </div>
            <div class="container marketing">
                <hr class="section-divider">
                <div class="video-container" style="text-align: center;">
                    <iframe width="560" height="315" 
                        src="https://www.youtube.com/embed/e8Yp8MTDzmY?si=li-IlmKBvArbyugm" 
                        title="YouTube video player" frameborder="0" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                        referrerpolicy="strict-origin-when-cross-origin" 
                        allowfullscreen>
                    </iframe>
                </div>
                <div class="container text-center mt-5 custom-container">
                    <h3 class="custom-heading">Inspired by Iceland</h3>
                    <p class="custom-text">
                        <span class="highlight">ION Hotels embodies the raw beauty of Iceland, blending striking modern design with the country's dramatic landscapes. Located just outside Reykjavik, ION Adventure Hotel, once a residence for geothermal plant workers, was transformed into a world-class retreat by architect  Sigurlaug Sverrisdóttir and California-based firm Minarc. 
                        <br><br>
                        With sweeping lake views, rugged surroundings, and an architectural style that harmonizes with its environment, ION Hotels offers an immersive experience where nature and innovation meet.
                    </p>
                </div>
                <hr class="section-divider">
                <h1 class="custom-heading">Reviews</h1>
                <div class="review-grid">
                    <div class="review-card">
                        <h2 class="fw-bold">A Stay Like No Other</h2>
                        <p>Experience the magic of the Northern Lights from the comfort of our luxurious suites.</p>
                        <blockquote class="blockquote mt-4 review-blockquote">
                            <p class="mb-2 fst-italic">"Absolutely breathtaking! The views, the service, and the ambiance were beyond words. Can't wait to return!"</p>
                            <br>
                            <footer class="blockquote-footer">Emma R., <cite title="Guest Review">Guest Review</cite></footer>
                        </blockquote>
                    </div>
                    <div class="review-card">
                        <h2 class="fw-bold">An Unforgettable Experience</h2>
                        <p>Luxury, nature, and comfort combined into one unforgettable retreat.</p>
                        <blockquote class="blockquote mt-4 review-blockquote">
                            <p class="mb-2 fst-italic">"The hospitality and attention to detail were phenomenal. A truly unique place to relax and recharge."</p>
                            <br>
                            <footer class="blockquote-footer">James P., <cite title="Guest Review">Guest Review</cite></footer>
                        </blockquote>
                    </div>
                    <div class="review-card">
                        <h2 class="fw-bold">A Perfect Getaway</h2>
                        <p>Disconnect from the world and immerse yourself in Iceland’s natural beauty.</p>
                        <blockquote class="blockquote mt-4 review-blockquote">
                            <p class="mb-2 fst-italic">"The perfect escape! Loved the spa, the food, and of course, the breathtaking views. Highly recommend!"</p>
                            <br>
                            <footer class="blockquote-footer">Sophie M., <cite title="Guest Review">Guest Review</cite></footer>
                        </blockquote>
                    </div>
                    <div class="review-card">
                        <h2 class="fw-bold">Absolutely Magical</h2>
                        <p>From the moment we arrived, everything felt like a dream come true.</p>
                        <blockquote class="blockquote mt-4 review-blockquote">
                            <p class="mb-2 fst-italic">"Waking up to the sunrise over the mountains was pure magic. The service was impeccable. Worth every penny!"</p>
                            <br>
                            <footer class="blockquote-footer">Liam D., <cite title="Guest Review">Guest Review</cite></footer>
                        </blockquote>
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
        <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>