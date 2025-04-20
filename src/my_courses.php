<?php
require_once 'auth.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Check if user is logged in
if (!isLoggedIn()) {
    header("Location: login.php");
}


$user = getCurrentUser();
$user_id = $_SESSION['user_id'];

// Get user's registered courses
$conn = getDBConnection();
$stmt = $conn->prepare("SELECT * FROM courses WHERE user_id = ? ORDER BY created_at DESC");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$courses = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Courses - Skill India</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.4.1/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
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
                        <img src="<?php echo htmlspecialchars($user['profile_image']); ?>" alt="Profile" class="h-8 w-8 rounded-full">
                        <span class="ml-2 text-gray-700"><?php echo htmlspecialchars($user['name']); ?></span>
                    </div>
                    <a href="index.php" class="py-2 px-4 bg-red-500 text-white rounded hover:bg-red-600">home</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-6xl mx-auto mt-8 p-6">
        <h1 class="text-3xl font-bold mb-6">My Courses</h1>

        <?php
        if (isset($_SESSION['registration_success'])) {
            echo "<p class='text-green-500 text-lg'>" . $_SESSION['registration_success'] . "</p>";
            unset($_SESSION['registration_success']); 
        }
        ?>

        <?php if (empty($courses)): ?>
            <div class="bg-white p-6 rounded-lg shadow-lg text-center">
                <p class="text-gray-600">You haven't registered for any courses yet.</p>
                <a href="skillCourse.php" class="mt-4 inline-block bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600">
                    Browse Courses
                </a>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-2 gap-6">
                <?php foreach ($courses as $course): ?>
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                        <!-- Course Image -->
                        <img 
                            src="<?php echo htmlspecialchars($course['image']); ?>" 
                            alt="<?php echo htmlspecialchars($course['course_name']); ?>" 
                            class="w-full h-48 object-cover"
                        >
                        <div class="p-6">
                            <h2 class="text-xl font-semibold mb-2"><?php echo htmlspecialchars($course['course_name']); ?></h2>
                            <p class="text-gray-600 mb-2">Sector: <?php echo htmlspecialchars($course['sector']); ?></p>
                            <p class="text-gray-600 mb-2">Registration Date: <?php echo date('d M Y', strtotime($course['created_at'])); ?></p>
                            
                            <h2 class="text-gray-500 text-xl font font-semibold">Course will start soon...</h2>
                            <p class="text-black mb-2">You will be notified through email</p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>

</html>