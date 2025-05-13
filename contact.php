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
                        <li class="nav-item"><a class="nav-link" href="about.php">About Us</a></li>
                        <li class="nav-item"><a class="nav-link" href="booking.php">Our Rooms</a></li>
                        <li class="nav-item"><a class="nav-link" href="gallery.php">Gallery</a></li>
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="contact.php">Contact</a></li>
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
            <div class="main-image" style="background-image: url('/img/ion4.jpg');">
                <h1>Contact</h1>
            </div>
            <div class="container marketing">
                <hr class="section-divider">
                <div class="container text-center mt-5">
                    <h3 class="fw-semibold mt-4">Inquiries? Shoot us an email or give a call!</h3>
                    <p class="text-muted">
                        Get in touch with us directly via phone or email for personalized assistance. 
                        We’re here to make sure your needs are met promptly and efficiently.
                    </p>
                    <div class="row justify-content-center mt-4">
                        <div class="col-md-5">
                            <h5 class="fw-bold text-uppercase">Email</h5>
                            <div class="contact-item">
                                <i class="bi bi-envelope-fill me-2"></i>
                                <a href="mailto:reservations@ioniceland.is" class="email-link">reservations@ioniceland.is</a>
                            </div>
                            <div class="contact-item">
                                <i class="bi bi-envelope-fill me-2"></i>
                                <a href="mailto:city@ioniceland.is" class="email-link">city@ioniceland.is</a>
                            </div>
                            <div class="contact-item">
                                <i class="bi bi-envelope-fill me-2"></i>
                                <a href="mailto:sales@ioniceland.is" class="email-link">sales@ioniceland.is</a>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <h5 class="fw-bold text-uppercase">Phone</h5>
                            <div class="contact-item">
                                <i class="bi bi-telephone-fill me-2"></i> +354 578 3720
                            </div>
                            <div class="contact-item">
                                <i class="bi bi-telephone-fill me-2"></i> +354 578 3730
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="section-divider">
                <div class="container mt-5">
                    <h2 class="text-center mb-4">Frequently Asked Questions</h2>
                    <div class="accordion" id="faqAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faqHeading1">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse1" aria-expanded="true" aria-controls="faqCollapse1">
                                What are check-in and check-out times?
                                </button>
                            </h2>
                            <div id="faqCollapse1" class="accordion-collapse collapse show" aria-labelledby="faqHeading1" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    At <strong>ION Adventure Hotel</strong>, check-in begins at <strong>16:00</strong>, and check-out is at <strong>12:00</strong>.<br>
                                    At <strong>ION City Hotel</strong>, check-in begins at <strong>15:00</strong>, and check-out is at <strong>11:00</strong>.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faqHeading2">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse2" aria-expanded="false" aria-controls="faqCollapse2">
                                When is the best time to see the Northern Lights?
                                </button>
                            </h2>
                            <div id="faqCollapse2" class="accordion-collapse collapse" aria-labelledby="faqHeading2" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Iceland is among the top destinations in the world to witness the <strong>Northern Lights</strong>, particularly during the <strong>winter months (September to April)</strong>. The aurora borealis is most vivid on clear, dark nights far from city lights, making ION Adventure Hotel an ideal spot to experience this breathtaking phenomenon.<br><br>
                                    While sightings can’t be guaranteed, your chances are excellent in Iceland’s remote areas, where natural light pollution is minimal.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faqHeading3">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse3" aria-expanded="false" aria-controls="faqCollapse3">
                                Do you have a gym?
                                </button>
                            </h2>
                            <div id="faqCollapse3" class="accordion-collapse collapse" aria-labelledby="faqHeading3" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Our hotels feature compact yet comfortable <strong>fitness rooms</strong>, thoughtfully designed to provide guests with a convenient and enjoyable workout experience during their stay.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faqHeading4">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse4" aria-expanded="false" aria-controls="faqCollapse4">
                                What will the weather be like during my stay?
                                </button>
                            </h2>
                            <div id="faqCollapse4" class="accordion-collapse collapse" aria-labelledby="faqHeading4" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Iceland’s weather can vary significantly by season and change rapidly, often without warning. It’s essential to check the weather forecast both before and during your travels, as strong winds and gusts can pose serious risks.<br><br>
                                    For the latest weather updates, visit <a href="https://www.vedur.is/" target="_blank">vedur.is</a>, where the Icelandic Meteorological Office provides detailed and reliable forecasts.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faqHeading5">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse5" aria-expanded="false" aria-controls="faqCollapse5">
                                Can I stay with my pet?
                                </button>
                            </h2>
                            <div id="faqCollapse5" class="accordion-collapse collapse" aria-labelledby="faqHeading5" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Yes! <strong>Our hotels are pet-friendly.</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="section-divider">
                <div class="row mt-5">
                    <div class="col">
                        <h3 class="text-center mb-4">Visit Us</h3>
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d445874.27151033137!2d-21.91189038023588!3d64.11697491903585!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48d67d516324131d%3A0x3a9ded13d7cffb74!2sION%20Adventure%20Hotel%2C%20Nesjavellir%2C%20a%20Member%20of%20Design%20Hotels!5e0!3m2!1sen!2shn"
                            width="100%" height="350" style="border: 2px solid black; border-radius: 15px;" allowfullscreen="" loading="lazy">
                        </iframe>
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