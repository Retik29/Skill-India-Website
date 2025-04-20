<?php
require_once 'auth.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in
if (!isLoggedIn()) {
    header('login.php');
}

// Get form data
$user_id = $_SESSION['user_id'];
$course_name = filter_var($_POST['course_name'], FILTER_SANITIZE_STRING);
$sector = filter_var($_POST['sector'], FILTER_SANITIZE_STRING);
$imagePath = $_POST['image'];
$phone = filter_var($_POST['phone'], FILTER_SANITIZE_STRING);
$qualification = filter_var($_POST['qualification'], FILTER_SANITIZE_STRING);
$experience = filter_var($_POST['experience'], FILTER_SANITIZE_NUMBER_INT);
$address = filter_var($_POST['address'], FILTER_SANITIZE_STRING);

// Validate input
if (empty($course_name) || empty($sector) ||  empty($phone) || empty($qualification) || empty($address)) {
    // Set  error session
    $_SESSION['registration_error'] = 'All fields are required. Please fill out the form completely.';
    
    // Redirect back to the course registration page
    header('Location: course_register.php?course=' . urlencode($course_name) . '&sector=' . urlencode($sector));
    exit();
}

// Check if user is already registered for this course
$conn = getDBConnection();
$stmt = $conn->prepare("SELECT id FROM courses WHERE user_id = ? AND course_name = ?");
$stmt->bind_param("is", $user_id, $course_name);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Set an error session
    $_SESSION['registration_error'] = 'You are already registered for this course.';
    
    // Redirect back to the skill courses page
    header('Location: course_register.php?course=' . urlencode($course_name) . '&sector=' . urlencode($sector));
    exit();
}

// Insert registration into database
$stmt = $conn->prepare("INSERT INTO courses (user_id, course_name, sector, image, phone, qualification, experience, address) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("isssssis", $user_id, $course_name, $sector, $imagePath , $phone, $qualification, $experience, $address);

if ($stmt->execute()) {
    $_SESSION['registration_success'] = 'Successfully registered for the course!';
    // Redirect to the "My Courses" page
    header('Location: my_courses.php');
    exit();
} else {
    // Set an error session message
    $_SESSION['registration_error'] = 'Failed to register for the course, Please try again.';
    
    // Redirect back to the course registration page
    header('Location: course_register.php?course=' . urlencode($course_name) . '&sector=' . urlencode($sector));
    exit();
}

$stmt->close();
$conn->close();
