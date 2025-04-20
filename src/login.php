<?php
session_start();
require_once './config/database.php';
require_once 'auth.php';

if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

if (isset($_COOKIE['remember_token'])) {
    // Validate the remember token
    $conn = getDBConnection();
    $stmt = $conn->prepare("SELECT id, name, profile_image FROM users WHERE remember_token = ?");
    $stmt->bind_param("s", $_COOKIE['remember_token']);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Set session variables
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['profile_image'] = $user['profile_image'];

        header("Location: index.php");
        exit();
    }
    $stmt->close();
    $conn->close();
}

$loginError = isset($_SESSION['login_error']) ? $_SESSION['login_error'] : '';
unset($_SESSION['login_error']); // Clear the error after retrieving 



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skill India Login</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <!-- <script type="module" src="registration.js" defer></script> -->

    <style>
        #alertBox {
            position: fixed;
            top: -100px;
            left: 50%;
            transform: translateX(-50%);
            transition: top 0.5s ease-in-out;
            z-index: 1000;
        }

        #alertBox.show {
            top: 20px;
        }
    </style>
</head>

<body class="bg-gray-100 flex items-center justify-center h-screen">
    <!-- Alert Box -->
    <div id="alertBox" class=" p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-200 hidden" role="alert">
        <span id="alertMessage" class="font-medium"></span>
    </div>

    <div class="flex border rounded-lg shadow-lg overflow-hidden bg-white w-1/2">
        <div class="p-8 w-1/2">
            <h1 class="text-2xl font-bold mb-4">Login to Skill India</h1>

            <form action="process_login.php" method="POST">
                <div class="mb-4">
                    <label class="block text-gray-700" for="email">Email</label>
                    <input class="mt-1 p-2 border rounded w-full" type="email" id="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700" for="password">Password</label>
                    <div class="relative">
                        <input 
                            class="mt-1 p-2 border rounded w-full pr-10" 
                            type="password" 
                            id="password" 
                            name="password" 
                            placeholder="Enter your password" 
                            required
                        >
                        <button 
                            type="button" 
                            class="absolute inset-y-0 right-0 px-3 text-gray-600 hover:text-gray-800 focus:outline-none" 
                            onclick="togglePasswordVisibility('password', this)"
                        >
                            Show
                        </button>
                    </div>
                </div>
                <div class="mb-4 flex items-center">
                    <input type="checkbox" id="remember" name="remember" class="mr-2 ">
                    <label for="remember" class="text-gray-700">Remember me for 1 week</label>
                </div>
                <button class="bg-blue-600 text-white py-2 mt-2 rounded w-full hover:bg-blue-700 font-bold" type="submit">Log in</button>

            </form>

            <!-- Continue with Google Button -->
            <!-- <button 
                class="bg-yellow-300 text-black py-2 rounded w-full hover:opacity-90 mt-4 flex items-center justify-center"
                type="button"
                id="googleLoginButton">
                <span class="font-bold">Continue with Google</span>
                <img src="images/google-icon.png" alt="Google Icon" class="h-5 w-5 ml-2">
                
            </button> -->
            

            <p class="text-center text-sm mt-5">Don't have an account? <a class="text-blue-600" href="signup.php">Sign Up</a></p>
        </div>

        <div class="bg-purple-600 w-1/2 flex flex-col justify-center items-center text-white text-center p-5">
            <h2 class="font-bold text-lg">Your Path to Skill Mastery Begins Here</h2>
            <div class="mt-4">
                <img src="images/logos.png" alt="Illustration" class="h-48">
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const alertBox = document.getElementById('alertBox');
            const alertMessage = document.getElementById('alertMessage');
            const loginError = "<?php echo $loginError; ?>";

            if (loginError) {
                alertMessage.textContent = loginError;
                alertBox.classList.remove('hidden');
                alertBox.classList.add('show');

                // Hide the alert box after 5 seconds
                setTimeout(() => {
                    alertBox.classList.remove('show');
                    setTimeout(() => {
                        alertBox.classList.add('hidden');
                    }, 500); // Wait for the transition to complete
                }, 5000);
            }
        });

        function togglePasswordVisibility(passwordFieldId, button) {
            const passwordField = document.getElementById(passwordFieldId);
            if (passwordField.type === "password") {
                passwordField.type = "text";
                button.textContent = "Hide";
            } else {
                passwordField.type = "password";
                button.textContent = "Show";
            }
        }
    </script>
       
</body>

</html>