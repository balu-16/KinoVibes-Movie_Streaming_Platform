<?php
session_start();
require_once 'config/database.php';

$error = '';
$success = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);

    // Validate input
    if (empty($full_name) || empty($username) || empty($email) || empty($password)) {
        $error = "All fields are required";
    } elseif ($password !== $confirm_password) {
        $error = "Passwords do not match";
    } elseif (strlen($password) < 6) {
        $error = "Password must be at least 6 characters long";
    } else {
        // Check if email already exists
        $check_email = "SELECT * FROM user_profiles WHERE email = '$email'";
        $result = $conn->query($check_email);

        if ($result->num_rows > 0) {
            $error = "Email already exists";
        } else {
            // Hash password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert into users table first
            $sql_users = "INSERT INTO users (email, password) VALUES ('$email', '$hashed_password')";
            if ($conn->query($sql_users)) {
                $user_id = $conn->insert_id;

                // Insert into user_profiles table
                $sql_profiles = "INSERT INTO user_profiles (user_id, full_name, username, email, password, phone_number) 
                               VALUES ('$user_id', '$full_name', '$username', '$email', '$hashed_password', '$phone_number')";

                if ($conn->query($sql_profiles)) {
                    $success = "Registration successful! You can now login.";
                } else {
                    $error = "Error: " . $conn->error;
                }
            } else {
                $error = "Error: " . $conn->error;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - KinoVibes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="static/css/styles.css">
    <style>
        body {
            background-color: #000000 !important;
            color: #ffffff !important;
        }

        .card {
            background-color: #000000 !important;
            border: 1px solid #333333 !important;
        }

        .card-header {
            background-color: #0a0a0a !important;
            border-bottom: 2px solid #e50914 !important;
        }

        .card-header h3 {
            color: #ffffff !important;
        }

        .form-label {
            color: #ffffff !important;
        }

        .form-control {
            background-color: #111111 !important;
            border: 1px solid #333333 !important;
            color: #ffffff !important;
        }

        .form-control:focus {
            background-color: #111111 !important;
            color: #ffffff !important;
            border-color: #e50914 !important;
            box-shadow: 0 0 0 2px rgba(229, 9, 20, 0.25) !important;
        }

        .btn-primary {
            background-color: #e50914 !important;
            border: none !important;
            color: #ffffff !important;
        }

        .btn-primary:hover {
            background-color: #f40612 !important;
        }

        .card-body {
            background-color: #000000 !important;
        }

        .text-center p {
            color: #ffffff !important;
        }

        .text-center a {
            color: #e50914 !important;
        }

        .alert-danger {
            background-color: rgba(229, 9, 20, 0.1) !important;
            color: #ff8c8c !important;
            border: 1px solid rgba(229, 9, 20, 0.2) !important;
        }

        .alert-success {
            background-color: rgba(39, 174, 96, 0.1) !important;
            color: #2ecc71 !important;
            border: 1px solid rgba(39, 174, 96, 0.2) !important;
        }
    </style>
</head>

<body class="auth-page">
    <div class="container mt-5 auth-container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Create Account</h3>
                    </div>
                    <div class="card-body">
                        <?php if ($error): ?>
                            <div class="alert alert-danger"><?php echo $error; ?></div>
                        <?php endif; ?>
                        <?php if ($success): ?>
                            <div class="alert alert-success"><?php echo $success; ?></div>
                        <?php endif; ?>

                        <form method="POST" action="">
                            <div class="mb-3">
                                <label for="full_name" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="full_name" name="full_name" required>
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="phone_number" class="form-label">Phone Number</label>
                                <input type="tel" class="form-control" id="phone_number" name="phone_number">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="mb-3">
                                <label for="confirm_password" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Register</button>
                            </div>
                        </form>
                        <div class="text-center mt-3">
                            <p>Already have an account? <a href="login.php">Login here</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>