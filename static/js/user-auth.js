// This file is now a wrapper for the PHP backend authentication
// Most functionality is handled by the PHP backend

/**
 * Check if user is logged in by checking for session cookie
 * @returns {boolean} True if user is logged in
 */
function isLoggedIn() {
    // This will be handled by PHP session
    return document.cookie.includes('PHPSESSID');
}

/**
 * Get current user display name from the page
 * @returns {string} User's display name
 */
function getUserDisplayName() {
    const userElement = document.getElementById('currentUser');
    return userElement ? userElement.textContent : 'User';
}

/**
 * Update the user display in the navbar
 */
function updateUserDisplay() {
    const userElement = document.getElementById('currentUser');
    if (userElement) {
        // The PHP backend already sets this value
        console.log('User display updated by PHP');
    }
}

/**
 * Handle authentication redirects
 */
function handleAuthRedirects() {
    const currentPage = getCurrentPage();
    
    // If on login/register page and already logged in, redirect to index
    if ((currentPage === 'login' || currentPage === 'register') && isLoggedIn()) {
        window.location.href = 'index.php';
    }
    
    // If on protected page and not logged in, redirect to login
    if (currentPage !== 'login' && currentPage !== 'register' && !isLoggedIn()) {
        window.location.href = 'login.php';
    }
}

/**
 * Get the current page name
 * @returns {string} Current page name
 */
function getCurrentPage() {
    const path = window.location.pathname;
    const page = path.split('/').pop().split('.')[0];
    return page || 'index';
}

// Initialize when the page loads
document.addEventListener('DOMContentLoaded', function() {
    handleAuthRedirects();
    updateUserDisplay();
}); 