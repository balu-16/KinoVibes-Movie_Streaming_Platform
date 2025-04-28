<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KinoVibes - Stream & Download Movies</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="icon" href="img/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="static/css/styles.css">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <img src="img/logo.png" alt="KinoVibes Logo" class="nav-logo">
            <div class="text-center">
                <a class="navbar-brand" href="#">KinoVibes</a>
                <span class="navbar-subtitle">Explore | Stream | Vibe</span>
            </div>
            <div class="d-flex align-items-center">
                <div class="user-welcome me-3 text-light">
                    <span>Welcome, </span>
                    <span id="currentUser" class="fw-bold"><?php echo htmlspecialchars($_SESSION['full_name']); ?></span>
                </div>
                <a href="logout.php" class="btn btn-outline-danger btn-sm me-2">
                    <i class="fas fa-sign-out-alt"></i> Sign Out
                </a>
                <img src="img/logo.png" alt="KinoVibes Logo" class="nav-logo">
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero-section">
        <div class="container">
            <h1 class="hero-title">Welcome to KinoVibes</h1>
            <p class="hero-subtitle">Your Ultimate Movie Streaming Destination</p>
        </div>
    </div>

    <!-- Search and Filter Section -->
    <div class="container my-4">
        <div class="input-group">
            <button class="btn dropdown-toggle" type="button" id="filterButton" data-bs-toggle="dropdown"
                aria-expanded="false">
                <i class="fas fa-filter"></i>
            </button>
            <ul class="dropdown-menu" id="categoryMenu">
                <li><a class="dropdown-item" href="#" data-category="all">All Movies</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="#" data-category="action">Action</a></li>
                <li><a class="dropdown-item" href="#" data-category="adventure">Adventure</a></li>
                <li><a class="dropdown-item" href="#" data-category="comedy">Comedy</a></li>
                <li><a class="dropdown-item" href="#" data-category="crime">Crime</a></li>
                <li><a class="dropdown-item" href="#" data-category="fantasy">Fantasy</a></li>
                <li><a class="dropdown-item" href="#" data-category="marvel">Marvel</a></li>
                <li><a class="dropdown-item" href="#" data-category="dc">DC</a></li>
            </ul>

            <input type="text" id="searchInput" class="form-control" placeholder="Search movies..." aria-label="Search">
            <button class="btn btn-danger" type="button" onclick="searchImages()">
                <i class="fas fa-search"></i> Search
            </button>
        </div>
    </div>

    <!-- Movie Gallery -->
    <div class="container">
        <h2 class="gallery-title">Featured Movies</h2>
        <div class="row" id="imageGallery">
            <!-- Movie cards will be loaded here -->
            <div class="col-md-3 col-sm-6 mb-4 image-card" data-name="Devara">
                <div class="movie-card">
                    <img src="img/devara.jpg" alt="Devara" class="img-fluid" onclick="streamMovie('Devara')">
                    <div class="movie-info-overlay">
                        <h3>Devara</h3>
                        <p>Action/Drama • 2024</p>
                        <div class="movie-buttons">
                            <button class="btn btn-sm btn-light" onclick="streamMovie('Devara')">
                                <i class="fas fa-play"></i> Watch Now
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 mb-4 image-card" data-name="John Wick 1">
                <div class="movie-card">
                    <img src="img/johnwick1.jpg" alt="John Wick 1" class="img-fluid" onclick="streamMovie('John Wick 1')">
                    <div class="movie-info-overlay">
                        <h3>John Wick</h3>
                        <p>Action/Thriller • 2014</p>
                        <div class="movie-buttons">
                            <button class="btn btn-sm btn-light" onclick="streamMovie('John Wick 1')">
                                <i class="fas fa-play"></i> Watch Now
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 mb-4 image-card" data-name="John Wick 2">
                <div class="movie-card">
                    <img src="img/johnwick2.jpg" alt="John Wick 2" class="img-fluid" onclick="streamMovie('John Wick 2')">
                    <div class="movie-info-overlay">
                        <h3>John Wick: Chapter 2</h3>
                        <p>Action/Thriller • 2017</p>
                        <div class="movie-buttons">
                            <button class="btn btn-sm btn-light" onclick="streamMovie('John Wick 2')">
                                <i class="fas fa-play"></i> Watch Now
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 mb-4 image-card" data-name="John Wick 3">
                <div class="movie-card">
                    <img src="img/johnwick3.jpg" alt="John Wick 3" class="img-fluid" onclick="streamMovie('John Wick 3')">
                    <div class="movie-info-overlay">
                        <h3>John Wick: Chapter 3</h3>
                        <p>Action/Thriller • 2019</p>
                        <div class="movie-buttons">
                            <button class="btn btn-sm btn-light" onclick="streamMovie('John Wick 3')">
                                <i class="fas fa-play"></i> Watch Now
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 mb-4 image-card" data-name="John Wick 4">
                <div class="movie-card">
                    <img src="img/johnwick4.jpg" alt="John Wick 4" class="img-fluid" onclick="streamMovie('John Wick 4')">
                    <div class="movie-info-overlay">
                        <h3>John Wick: Chapter 4</h3>
                        <p>Action/Thriller • 2023</p>
                        <div class="movie-buttons">
                            <button class="btn btn-sm btn-light" onclick="streamMovie('John Wick 4')">
                                <i class="fas fa-play"></i> Watch Now
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 mb-4 image-card" data-name="Iron Man 1">
                <div class="movie-card">
                    <img src="img/ironman1.jpg" alt="Iron Man" class="img-fluid" onclick="streamMovie('Iron Man 1')">
                    <div class="movie-info-overlay">
                        <h3>Iron Man</h3>
                        <p>Action/Sci-Fi • 2008</p>
                        <div class="movie-buttons">
                            <button class="btn btn-sm btn-light" onclick="streamMovie('Iron Man 1')">
                                <i class="fas fa-play"></i> Watch Now
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 mb-4 image-card" data-name="Iron Man 2">
                <div class="movie-card">
                    <img src="img/ironman2.jpg" alt="Iron Man 2" class="img-fluid" onclick="streamMovie('Iron Man 2')">
                    <div class="movie-info-overlay">
                        <h3>Iron Man 2</h3>
                        <p>Action/Sci-Fi • 2010</p>
                        <div class="movie-buttons">
                            <button class="btn btn-sm btn-light" onclick="streamMovie('Iron Man 2')">
                                <i class="fas fa-play"></i> Watch Now
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 mb-4 image-card" data-name="Iron Man 3">
                <div class="movie-card">
                    <img src="img/ironman3.jpg" alt="Iron Man 3" class="img-fluid" onclick="streamMovie('Iron Man 3')">
                    <div class="movie-info-overlay">
                        <h3>Iron Man 3</h3>
                        <p>Action/Sci-Fi • 2013</p>
                        <div class="movie-buttons">
                            <button class="btn btn-sm btn-light" onclick="streamMovie('Iron Man 3')">
                                <i class="fas fa-play"></i> Watch Now
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 mb-4 image-card" data-name="Avengers Endgame">
                <div class="movie-card">
                    <img src="img/avengersendgame.jpg" alt="Avengers: Endgame" class="img-fluid" onclick="streamMovie('Avengers Endgame')">
                    <div class="movie-info-overlay">
                        <h3>Avengers: Endgame</h3>
                        <p>Action/Sci-Fi • 2019</p>
                        <div class="movie-buttons">
                            <button class="btn btn-sm btn-light" onclick="streamMovie('Avengers Endgame')">
                                <i class="fas fa-play"></i> Watch Now
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 mb-4 image-card" data-name="The Dark Knight">
                <div class="movie-card">
                    <img src="img/thedarkknight.jpg" alt="The Dark Knight" class="img-fluid" onclick="streamMovie('The Dark Knight')">
                    <div class="movie-info-overlay">
                        <h3>The Dark Knight</h3>
                        <p>Action/Crime • 2008</p>
                        <div class="movie-buttons">
                            <button class="btn btn-sm btn-light" onclick="streamMovie('The Dark Knight')">
                                <i class="fas fa-play"></i> Watch Now
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 mb-4 image-card" data-name="Man of Steel">
                <div class="movie-card">
                    <img src="img/manofsteel.jpg" alt="Man of Steel" class="img-fluid" onclick="streamMovie('Man of Steel')">
                    <div class="movie-info-overlay">
                        <h3>Man of Steel</h3>
                        <p>Action/Sci-Fi • 2013</p>
                        <div class="movie-buttons">
                            <button class="btn btn-sm btn-light" onclick="streamMovie('Man of Steel')">
                                <i class="fas fa-play"></i> Watch Now
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 mb-4 image-card" data-name="Aquaman">
                <div class="movie-card">
                    <img src="img/aquaman.jpg" alt="Aquaman" class="img-fluid" onclick="streamMovie('Aquaman')">
                    <div class="movie-info-overlay">
                        <h3>Aquaman</h3>
                        <p>Action/Adventure • 2018</p>
                        <div class="movie-buttons">
                            <button class="btn btn-sm btn-light" onclick="streamMovie('Aquaman')">
                                <i class="fas fa-play"></i> Watch Now
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 mb-4 image-card" data-name="Black Adam">
                <div class="movie-card">
                    <img src="img/blackadam.jpg" alt="Black Adam" class="img-fluid" onclick="streamMovie('Black Adam')">
                    <div class="movie-info-overlay">
                        <h3>Black Adam</h3>
                        <p>Action/Fantasy • 2022</p>
                        <div class="movie-buttons">
                            <button class="btn btn-sm btn-light" onclick="streamMovie('Black Adam')">
                                <i class="fas fa-play"></i> Watch Now
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 mb-4 image-card" data-name="KGF Chapter 1">
                <div class="movie-card">
                    <img src="img/kgf1.jpg" alt="KGF Chapter 1" class="img-fluid" onclick="streamMovie('KGF Chapter 1')">
                    <div class="movie-info-overlay">
                        <h3>KGF Chapter 1</h3>
                        <p>Action/Drama • 2018</p>
                        <div class="movie-buttons">
                            <button class="btn btn-sm btn-light" onclick="streamMovie('KGF Chapter 1')">
                                <i class="fas fa-play"></i> Watch Now
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 mb-4 image-card" data-name="KGF Chapter 2">
                <div class="movie-card">
                    <img src="img/kgf2.jpg" alt="KGF Chapter 2" class="img-fluid" onclick="streamMovie('KGF Chapter 2')">
                    <div class="movie-info-overlay">
                        <h3>KGF Chapter 2</h3>
                        <p>Action/Drama • 2022</p>
                        <div class="movie-buttons">
                            <button class="btn btn-sm btn-light" onclick="streamMovie('KGF Chapter 2')">
                                <i class="fas fa-play"></i> Watch Now
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 mb-4 image-card" data-name="Pushpa">
                <div class="movie-card">
                    <img src="img/pushpa.jpg" alt="Pushpa" class="img-fluid" onclick="streamMovie('Pushpa')">
                    <div class="movie-info-overlay">
                        <h3>Pushpa: The Rise</h3>
                        <p>Action/Crime • 2021</p>
                        <div class="movie-buttons">
                            <button class="btn btn-sm btn-light" onclick="streamMovie('Pushpa')">
                                <i class="fas fa-play"></i> Watch Now
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 mb-4 image-card" data-name="Pushpa 2">
                <div class="movie-card">
                    <img src="img/pushpa2.jpg" alt="Pushpa 2" class="img-fluid" onclick="streamMovie('Pushpa 2')">
                    <div class="movie-info-overlay">
                        <h3>Pushpa 2: The Rule</h3>
                        <p>Action/Crime • 2024</p>
                        <div class="movie-buttons">
                            <button class="btn btn-sm btn-light" onclick="streamMovie('Pushpa 2')">
                                <i class="fas fa-play"></i> Watch Now
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 mb-4 image-card" data-name="Salaar">
                <div class="movie-card">
                    <img src="img/salaar.jpg" alt="Salaar" class="img-fluid" onclick="streamMovie('Salaar')">
                    <div class="movie-info-overlay">
                        <h3>Salaar</h3>
                        <p>Action/Thriller • 2023</p>
                        <div class="movie-buttons">
                            <button class="btn btn-sm btn-light" onclick="streamMovie('Salaar')">
                                <i class="fas fa-play"></i> Watch Now
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 mb-4 image-card" data-name="Guntur Kaaram">
                <div class="movie-card">
                    <img src="img/gunturkaaram.jpg" alt="Guntur Kaaram" class="img-fluid" onclick="streamMovie('Guntur Kaaram')">
                    <div class="movie-info-overlay">
                        <h3>Guntur Kaaram</h3>
                        <p>Action/Drama • 2024</p>
                        <div class="movie-buttons">
                            <button class="btn btn-sm btn-light" onclick="streamMovie('Guntur Kaaram')">
                                <i class="fas fa-play"></i> Watch Now
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 mb-4 image-card" data-name="Brahmastra">
                <div class="movie-card">
                    <img src="img/brahmastra.jpg" alt="Brahmastra" class="img-fluid" onclick="streamMovie('Brahmastra')">
                    <div class="movie-info-overlay">
                        <h3>Brahmastra</h3>
                        <p>Fantasy/Adventure • 2022</p>
                        <div class="movie-buttons">
                            <button class="btn btn-sm btn-light" onclick="streamMovie('Brahmastra')">
                                <i class="fas fa-play"></i> Watch Now
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 mb-4 image-card" data-name="Leo">
                <div class="movie-card">
                    <img src="img/leo.jpg" alt="Leo" class="img-fluid" onclick="streamMovie('Leo')">
                    <div class="movie-info-overlay">
                        <h3>Leo</h3>
                        <p>Action/Crime • 2023</p>
                        <div class="movie-buttons">
                            <button class="btn btn-sm btn-light" onclick="streamMovie('Leo')">
                                <i class="fas fa-play"></i> Watch Now
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 mb-4 image-card" data-name="Jailer">
                <div class="movie-card">
                    <img src="img/jailer.jpg" alt="Jailer" class="img-fluid" onclick="streamMovie('Jailer')">
                    <div class="movie-info-overlay">
                        <h3>Jailer</h3>
                        <p>Action/Drama • 2023</p>
                        <div class="movie-buttons">
                            <button class="btn btn-sm btn-light" onclick="streamMovie('Jailer')">
                                <i class="fas fa-play"></i> Watch Now
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 mb-4 image-card" data-name="Mad">
                <div class="movie-card">
                    <img src="img/mad.jpg" alt="Mad" class="img-fluid" onclick="streamMovie('Mad')">
                    <div class="movie-info-overlay">
                        <h3>Mad</h3>
                        <p>Comedy/Drama • 2023</p>
                        <div class="movie-buttons">
                            <button class="btn btn-sm btn-light" onclick="streamMovie('Mad')">
                                <i class="fas fa-play"></i> Watch Now
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 mb-4 image-card" data-name="Daaku Maharaj">
                <div class="movie-card">
                    <img src="img/daakumaharaj.jpg" alt="Daaku Maharaj" class="img-fluid" onclick="streamMovie('Daaku Maharaj')">
                    <div class="movie-info-overlay">
                        <h3>Daaku Maharaj</h3>
                        <p>Action/Drama • 2024</p>
                        <div class="movie-buttons">
                            <button class="btn btn-sm btn-light" onclick="streamMovie('Daaku Maharaj')">
                                <i class="fas fa-play"></i> Watch Now
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Options Modal -->
    <div class="modal fade" id="optionsModal" tabindex="-1" aria-labelledby="optionsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="optionsModalLabel">Choose Your Option</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <button id="watchButton" class="btn btn-primary">
                        <i class="fas fa-play"></i> Watch Now
                    </button>
                    <button id="downloadButton" class="btn btn-danger">
                        <i class="fas fa-download"></i> Download
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Us Section -->
    <section class="contact-section">
        <div class="container">
            <h2 class="text-center mb-4">Contact Us</h2>
            <div class="row">
                <div class="col-md-6">
                    <form id="contactForm">
                        <div class="form-group mb-3">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter your name">
                        </div>
                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter your email">
                        </div>
                        <div class="form-group mb-3">
                            <label for="movieSuggestions">Movie Suggestions</label>
                            <textarea class="form-control" id="movieSuggestions" rows="3" placeholder="Suggest movies you'd like to see on our platform"></textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label for="webpageSuggestions">Webpage Suggestions</label>
                            <textarea class="form-control" id="webpageSuggestions" rows="3" placeholder="Share your feedback about our website"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                <div class="col-md-6">
                    <div class="contact-info">
                        <h3>Get in Touch</h3>
                        <p>We value your feedback and suggestions. Feel free to reach out to us with any questions or comments.</p>
                        <div class="social-icons mt-4">
                            <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                            <a href="https://t.me/kinovibes_movies" class="social-icon"><i class="fab fa-telegram"></i></a>
                            <div class="kinovibes-logo">
                                <img src="img/4.png" alt="KinoVibes" height="80">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer mt-5 py-3">
        <div class="container text-center">
            <p>© 2024 KinoVibes. All rights reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- DataList JS -->
    <script src="https://cdn.jsdelivr.net/npm/datalist-css/dist/datalist-css.min.js"></script>
    <!-- Database JS -->
    <script src="static/js/db.js"></script>
    <!-- User Authentication JS -->
    <script src="static/js/user-auth.js"></script>
    <!-- Main JS -->
    <script src="static/js/main.js"></script>
</body>

</html>