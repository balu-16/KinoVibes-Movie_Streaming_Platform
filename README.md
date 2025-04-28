# KinoVibes - Movie Streaming Platform

A modern web application for streaming and discovering movies with client-side user authentication.

## Features

- Client-side authentication using localStorage
- User registration and login
- Movie browsing and filtering
- Responsive design for all devices

## Setup Instructions

### Prerequisites

- Node.js (v12 or higher)
- npm (Node Package Manager)

### Installation

1. **Install Dependencies**

   ```bash
   npm install express cors body-parser
   ```

2. **Start the Server**

   ```bash
   node server.js
   ```

3. **Access the Application**

   Open your browser and navigate to:

   ```
   http://localhost:3000
   ```

## Default Login Credentials

You can register a new account or use these pre-configured accounts:

### Admin User

- Username: `admin`
- Password: `admin123`

### Test User

- Username: `test`
- Password: `test123`

## Project Structure

- `server.js` - Simple Express server for static file serving
- `static/js/auth.js` - Client-side authentication utilities
- `static/js/login.js` - Login page functionality
- `static/js/signup.js` - Signup page functionality
- `static/css/` - CSS stylesheets
- `index.html` - Main application page
- `login.html` - User login page
- `signup.html` - User registration page

## Client-side Authentication

The application uses localStorage for authentication, which means:

- User data is stored in the browser
- No database connection is required
- Simple and lightweight implementation
- Perfect for demonstration and learning purposes

## License

This project is licensed under the MIT License.

---

Developed for educational purposes. All movie data and images are used for demonstration only.
