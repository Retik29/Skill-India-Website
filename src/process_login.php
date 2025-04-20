<?php
session_start();
require_once 'config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8');
    $remember = isset($_POST['remember']) ? true : false;

    $conn = getDBConnection();

    // Prepare and execute the query
    $stmt = $conn->prepare("SELECT id, name, password, profile_image FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $user['password'])) {
            // Set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['profile_image'] = $user['profile_image'];

            // If remember me is checked, set cookie for 1 week
            if ($remember) {
                $cookie_name = "remember_token";
                $cookie_value = bin2hex(random_bytes(32)); // Generate a secure random token
                $expiry = time() + (7 * 24 * 60 * 60); // 1 week from now

                // Store the token in the database
                $token_stmt = $conn->prepare("UPDATE users SET remember_token = ? WHERE id = ?");
                $token_stmt->bind_param("si", $cookie_value, $user['id']);
                $token_stmt->execute();

                // Set the cookie
                setcookie($cookie_name, $cookie_value, $expiry, "/", "", true, true); // Secure and HttpOnly
            }

            // Redirect to dashboard or home page after email confirmation
            header("Location: ./phpmailer/indexMail.php");
            exit();
        } else {
            // Invalid password
            $_SESSION['login_error'] = "Invalid email or password. Please try again.";
            header("Location: login.php");
            exit();
        }
    } else {
        // User not found
        $_SESSION['login_error'] = "User not found, please check your email.";
        header("Location: login.php");
        exit();
    }

    $stmt->close();
    $conn->close();
} else {
    // If not a POST request, redirect to login page
    header("Location: login.php");
    exit();
}
