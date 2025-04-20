<?php
// Start session only if it is not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'config/database.php';

function isLoggedIn()
{
    return isset($_SESSION['user_id']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'dashboard') {
    dashboard();
}

function dashboard() {
    if (!isset($_SESSION['user_id'])) {
        echo "<script>
                if (confirm('You are not logged in, Login first to access dashboard. Do you want to go to the login page?')) {
                    window.location.href = 'login.php';
                } else {
                    window.location.href = 'index.php';
                }
              </script>";
        exit();
    }
    else {
        echo "<script>
                if (confirm('You are being redirected to an external website. Do you want to proceed?')) {
                    window.location.href = 'https://app.powerbi.com/view?r=eyJrIjoiMmU0MDllMDctMDM1OS00MWY2LWI0NmItZDRhMTVmZGE2YzM0IiwidCI6IjcyNGI4ZWQxLTgxODMtNGNiOS1iNWIwLTFlZDY3YWZlYWNmMSIsImMiOjEwfQ%3D%3D';
                } else {
                    window.location.href = 'index.php';
                }
              </script>";
        exit();
    }
}


function getCurrentUser()
{
    if (!isLoggedIn()) {
        return null;
    }

    $conn = getDBConnection();
    $stmt = $conn->prepare("SELECT id, name, email, phone, profile_image FROM users WHERE id = ?");
    $stmt->bind_param("i", $_SESSION['user_id']);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        return $result->fetch_assoc();
    }

    return null;
}
