// Global variable to store movies data
let moviesData = {};

// Load movies data when the page loads
document.addEventListener('DOMContentLoaded', function() {
    // Check if user is logged in via Auth module
    if (typeof Auth !== 'undefined' && !Auth.isLoggedIn()) {
        window.location.href = 'authentication.html';
    }
    
    // Load movies data
    fetch('static/js/movies_db.json')
        .then(response => response.json())
        .then(data => {
            moviesData = data;
            // Initialize the gallery with all movies
            filterByCategory('all');
        })
        .catch(error => {
            console.error('Error loading movies:', error);
            const gallery = document.getElementById('imageGallery');
            if (gallery) {
                gallery.innerHTML = '<div class="col-12 text-center"><h3>Error loading movies. Please try again later.</h3></div>';
            }
        });

    // Initialize search functionality
    const searchInput = document.getElementById("searchInput");
    if (searchInput) {
        searchInput.addEventListener("keypress", function(e) {
            if (e.key === 'Enter') {
                searchImages();
            }
        });
    }

    // Initialize search button
    const searchButton = document.querySelector('button[onclick="searchImages()"]');
    if (searchButton) {
        searchButton.addEventListener('click', function() {
            searchImages();
        });
    }

    // Initialize category filters - handle both onclick and data-category attributes
    const categoryButtons = document.querySelectorAll('.dropdown-item');
    
    categoryButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Get the category from data-category attribute or from the text content
            const category = this.getAttribute('data-category') || this.textContent.toLowerCase().trim();
            
            // Call the filter function
            filterByCategory(category);
        });
    });

    // Set up user info in navbar
    setupUserInfo();

    // Sign out functionality
    const signoutButton = document.getElementById('signoutButton');
    if (signoutButton) {
        signoutButton.addEventListener('click', function() {
            if (typeof signOutUser === 'function') {
                signOutUser();
            }
            window.location.href = 'logout.php';
        });
    }
});

// Function to filter by category
function filterByCategory(category) {
    const gallery = document.getElementById('imageGallery');
    if (!gallery) return;

    // Clear existing content
    gallery.innerHTML = '';
    
    // Check if moviesData is empty or undefined
    if (!moviesData || Object.keys(moviesData).length === 0) {
        gallery.innerHTML = '<div class="col-12 text-center"><h3>Error: Movies data not loaded. Please refresh the page.</h3></div>';
        return;
    }

    // Filter and display movies
    let moviesFound = false;

    Object.entries(moviesData).forEach(([key, movie]) => {
        if (category === 'all' || movie.category.toLowerCase() === category.toLowerCase()) {
            moviesFound = true;
            const movieCard = document.createElement('div');
            movieCard.className = 'col-md-3 col-sm-6 mb-4 image-card';
            movieCard.setAttribute('data-name', key);

            movieCard.innerHTML = `
                <div class="movie-card">
                    <img src="img/${key}.jpg" alt="${movie.title}" class="img-fluid" onclick="streamMovie('${key}')">
                    <div class="movie-info-overlay">
                        <h3>${movie.title}</h3>
                        <p>${movie.genres.join('/')} • ${movie.year}</p>
                        <div class="movie-rating">${movie.rating}</div>
                        <div class="movie-duration">${movie.duration}</div>
                        <div class="movie-buttons">
                            <button class="btn btn-sm btn-light" onclick="streamMovie('${key}')">
                                <i class="fas fa-play"></i> Watch Now
                            </button>
                        </div>
                    </div>
                </div>
            `;

            gallery.appendChild(movieCard);
        }
    });

    // Show message if no movies found
    if (!moviesFound) {
        gallery.innerHTML = '<div class="col-12 text-center"><h3>No movies found in this category.</h3></div>';
    }
}

// Function to search images
function searchImages() {
    const searchTerm = document.getElementById('searchInput').value.toLowerCase();
    
    const gallery = document.getElementById('imageGallery');
    if (!gallery) return;

    // Clear existing content
    gallery.innerHTML = '';
    
    // If search term is empty, show all movies
    if (!searchTerm.trim()) {
        filterByCategory('all');
        return;
    }
    
    // Check if moviesData is empty or undefined
    if (!moviesData || Object.keys(moviesData).length === 0) {
        gallery.innerHTML = '<div class="col-12 text-center"><h3>Error: Movies data not loaded. Please refresh the page.</h3></div>';
        return;
    }

    // Filter and display movies based on search
    let moviesFound = false;
    
    Object.entries(moviesData).forEach(([key, movie]) => {
        if (
            movie.title.toLowerCase().includes(searchTerm) ||
            movie.genres.join(' ').toLowerCase().includes(searchTerm) ||
            movie.year.toString().toLowerCase().includes(searchTerm) ||
            movie.category.toLowerCase().includes(searchTerm)
        ) {
            moviesFound = true;
    const movieCard = document.createElement('div');
    movieCard.className = 'col-md-3 col-sm-6 mb-4 image-card';
            movieCard.setAttribute('data-name', key);

    movieCard.innerHTML = `
        <div class="movie-card">
                    <img src="img/${key}.jpg" alt="${movie.title}" class="img-fluid" onclick="streamMovie('${key}')">
            <div class="movie-info-overlay">
                <h3>${movie.title}</h3>
                <p>${movie.genres.join('/')} • ${movie.year}</p>
                <div class="movie-rating">${movie.rating}</div>
                <div class="movie-duration">${movie.duration}</div>
                <div class="movie-buttons">
                            <button class="btn btn-sm btn-light" onclick="streamMovie('${key}')">
                        <i class="fas fa-play"></i> Watch Now
                    </button>
                </div>
            </div>
        </div>
    `;

            gallery.appendChild(movieCard);
        }
    });

    // If no results found, show a message
    if (!moviesFound) {
        gallery.innerHTML = '<div class="col-12 text-center"><h3>No movies found matching your search.</h3></div>';
    }
}

// Function to stream movie
function streamMovie(movieKey) {
    const movie = moviesData[movieKey.toLowerCase()];
    if (!movie) {
        console.error('Movie not found:', movieKey);
        return;
    }

    // If videoUrl exists, open directly in new tab
    if (movie.videoUrl) {
        window.open(movie.videoUrl, '_blank');
        return;
    } else {
        // If no video, show modal with info or fallback
    const optionsModal = new bootstrap.Modal(document.getElementById('optionsModal'));
    const modalTitle = document.getElementById('optionsModalLabel');
        const modalBody = document.getElementById('optionsModalBody');
    const watchButton = document.getElementById('watchButton');
    const downloadButton = document.getElementById('downloadButton');

        modalTitle.textContent = movie.title;
        modalBody.innerHTML = '<div class="alert alert-info">Video not available for this movie.</div>';
    watchButton.onclick = function() {
            alert('Video not available for this movie.');
    };
    downloadButton.onclick = function() {
        window.open('https://t.me/kinovibes_movies', '_blank');
    };
    optionsModal.show();
    }
}

// Function to set up user info in the navbar
function setupUserInfo() {
    const userDisplay = document.getElementById('currentUser');

    if (userDisplay && typeof getUserDisplayName === 'function') {
        userDisplay.textContent = getUserDisplayName();
    }
}

// Function to initialize carousels
function initializeCarousels() {
    const carousels = document.querySelectorAll('.movie-carousel');

    carousels.forEach(carousel => {
        const movieRow = carousel.querySelector('.movie-row');
        const prevBtn = carousel.querySelector('.prev');
        const nextBtn = carousel.querySelector('.next');
        const category = movieRow.dataset.category;

        // Filter and add movies for this category
        const categoryMovies = Object.entries(moviesData)
            .filter(([_, movie]) => movie.category === category);

        categoryMovies.forEach(([key, movie]) => {
            const movieCard = document.createElement('div');
            movieCard.className = 'movie-card';
            movieCard.innerHTML = `
                <img src="img/${key}.jpg" alt="${movie.title}" class="img-fluid" onclick="streamMovie('${key}')">
                <div class="movie-info-overlay">
                    <h3>${movie.title}</h3>
                    <p>${movie.genres.join('/')} • ${movie.year}</p>
                    <div class="movie-rating">${movie.rating}</div>
                    <div class="movie-duration">${movie.duration}</div>
                    <div class="movie-buttons">
                        <button class="btn btn-sm btn-light" onclick="streamMovie('${key}')">
                            <i class="fas fa-play"></i> Watch Now
                        </button>
                    </div>
                </div>
            `;
            movieRow.appendChild(movieCard);
        });

        // Scroll controls
        prevBtn.addEventListener('click', () => {
            movieRow.scrollBy({ left: -220, behavior: 'smooth' });
        });

        nextBtn.addEventListener('click', () => {
            movieRow.scrollBy({ left: 220, behavior: 'smooth' });
        });
    });
}
