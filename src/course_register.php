<?php
require_once 'auth.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in
if (!isLoggedIn()) {
    echo "<script>
            if (confirm('Login first to register for any course. Do you want to go to the login page?')) {
                window.location.href = 'login.php';
            } else {
                window.location.href = 'skillCourse.php';
            }
          </script>";
    exit();
}

// Get course details from URL 
$course_name = isset($_GET['course']) ? htmlspecialchars($_GET['course'], ENT_QUOTES, 'UTF-8') : '';
$sector = isset($_GET['sector']) ? htmlspecialchars($_GET['sector'], ENT_QUOTES, 'UTF-8') : '';
$imagePath = isset($_GET['image']) ? htmlspecialchars($_GET['image'], ENT_QUOTES, 'UTF-8') : 'images/default.jpg';

if (empty($course_name) || empty($sector)) {
    header('Location: skillCourse.php');
    exit();
}

$user = getCurrentUser();

$registrationError = isset($_SESSION['registration_error']) ? $_SESSION['registration_error'] : '';
unset($_SESSION['registration_error']); // Clear the error after retrieving 


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register for <?php echo htmlspecialchars($course_name); ?> - Skill India</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.4.1/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
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

<body class="bg-gray-100">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex justify-between">
                <div class="flex space-x-7">
                    <div>
                        <a href="index.php" class="flex items-center py-4">
                            <span class="font-semibold text-gray-500 text-lg">Skill India</span>
                        </a>
                    </div>
                </div>
                <div class="flex items-center space-x-3">
                    <div class="flex items-center">
                        <img src="<?php echo htmlspecialchars($user['profile_image']) ; ?>" alt="Profile" class="h-8 w-8 rounded-full">
                        <span class="ml-2 text-gray-700"><?php echo htmlspecialchars($user['name']); ?></span>
                    </div>
                    <a href="skillCourse.php" class="py-2 px-4 bg-red-500 text-white rounded hover:bg-red-600">go back</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Alert Box -->
    <div id="alertBox" class=" p-4 mb-4 text-lg text-red-800 rounded-lg bg-red-200 hidden" role="alert">
        <span id="alertMessage" class="font-medium"></span>
    </div>

    <!-- Main Content -->
    <div class="max-w-4xl mx-auto mt-8 p-6 bg-white rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold mb-6">Course Registration</h1>

        <p class="mb-1">You are registering for the course: <strong><?php echo htmlspecialchars($course_name); ?></strong></p>
        <p class="mb-1">Sector: <strong><?php echo htmlspecialchars($sector); ?></strong></p>
        <p class="mb-4">Please fill out the form below to register for the course.</p>

        <form action="process_course_registration.php" method="POST">
            <input type="hidden" name="course_name" value="<?php echo htmlspecialchars($course_name); ?>">
            <input type="hidden" name="sector" value="<?php echo htmlspecialchars($sector); ?>">
            <input type="hidden" name="image" value="<?php echo htmlspecialchars($imagePath); ?>">


            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Full Name</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>"
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Email</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>"
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone" 
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="qualification">Highest Qualification</label>
                <select id="qualification" name="qualification"
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500" required>
                    <option value="">Select Qualification</option>
                    <option value="10th">10th Standard</option>
                    <option value="12th">12th Standard</option>
                    <option value="diploma">Diploma</option>
                    <option value="bachelor">Bachelor's Degree</option>
                    <option value="master">Master's Degree</option>
                    <option value="other">Other</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="experience">Work Experience (Years)</label>
                <input type="number" id="experience" name="experience" min="0"
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500" required>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="address">Address</label>
                <textarea id="address" name="address" rows="3"
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500" required></textarea>
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 focus:outline-none">
                    Register for Course
                </button>
                <a href="skillCourse.php" class="text-blue-500 hover:text-blue-700">Back to Courses</a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const alertBox = document.getElementById('alertBox');
            const alertMessage = document.getElementById('alertMessage');
            const registrationError = "<?php echo $registrationError; ?>";

            if (registrationError) {
                alertMessage.textContent = registrationError;
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
    </script>
</body>

</html>