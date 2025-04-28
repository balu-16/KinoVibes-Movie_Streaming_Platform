<?php
session_start();
require_once 'config/database.php';

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $error = "All fields are required";
    } else {
        // Check user credentials
        $sql = "SELECT u.*, up.full_name, up.username 
                FROM users u 
                JOIN user_profiles up ON u.id = up.user_id 
                WHERE u.email = '$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                // Set session variables
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['full_name'] = $user['full_name'];

                // Redirect to index page
                header("Location: index.php");
                exit();
            } else {
                $error = "Invalid password";
            }
        } else {
            $error = "User not found";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - KinoVibes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="static/css/styles.css">
    <style>
        body {
            background-color: #000000 !important;
            color: #ffffff !important;
            min-height: 100vh;
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
    </style>
</head>

<body class="auth-page">
    <div class="container-fluid min-vh-100 d-flex justify-content-center align-items-center auth-container" style="background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('img/devara.jpg'); background-size: cover; background-position: center;">
        <div class="row justify-content-center w-100">
            <div class="col-md-5 col-lg-4">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Login</h3>
                    </div>
                    <div class="card-body">
                        <?php if ($error): ?>
                            <div class="alert alert-danger"><?php echo $error; ?></div>
                        <?php endif; ?>

                        <form method="POST" action="">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                        </form>
                        <div class="text-center mt-3">
                            <p>Don't have an account? <a href="register.php">Register here</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>