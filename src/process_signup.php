<?php
session_start();
require_once 'config/database.php';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Handle profile image upload
    $profile_image = 'images/default-profile.png'; // Default image
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
        $target_dir = "uploads/profile_images/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $file_extension = strtolower(pathinfo($_FILES["profile_image"]["name"], PATHINFO_EXTENSION));
        $new_filename = uniqid() . '.' . $file_extension;
        $target_file = $target_dir . $new_filename;

        // Check if image file is an actual image
        $check = getimagesize($_FILES["profile_image"]["tmp_name"]);
        if ($check !== false) {
            if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file)) {
                $profile_image = $target_file;
            }
        }
    }

    $conn = getDBConnection();

    // Check if email already exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Email already exists, set session error and redirect to signup page
        $_SESSION['signup_error'] = "Email already exists. Please use a different email or do login.";
        header("Location: signup.php");
        exit();
    }

    $stmt->close();

    // Insert user into database
    $stmt = $conn->prepare("INSERT INTO users (name, email, password, profile_image) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $password, $profile_image);

    if ($stmt->execute()) {
        // Set session variables
        $_SESSION['user_id'] = $stmt->insert_id;
        $_SESSION['name'] = $name;
        $_SESSION['profile_image'] = $profile_image;

        // Show alert and redirect to login page
        echo "<script>
                alert('Account successfully created!');
                window.location.href = './phpmailer/indexMail.php';
              </script>";
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
