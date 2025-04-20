<?php
require_once 'auth.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Get current user if logged in
$user = null;
if (isLoggedIn()) {
    $user = getCurrentUser();
} else {
    echo "<script>
            if (confirm('You are not logged in. Do you want to login to access this page?')) {
                window.location.href = 'login.php';
            } else {
                window.location.href = 'index.php';
            }
          </script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Exchange</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.4.1/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
</head>

<body class="bg-gray-100">

    <!-- Navigation Bar -->
    <nav class="flex w-full justify-between items-center p-4 bg-blue-600 text-white h-fit">
        <div class="flex items-center flex-1">
            <h1 class="text-2xl font-bold mr-8">Skill India</h1>
            <ul class="flex space-x-6 justify-center flex-1">
                <li><a href="index.php" class="hover:text-blue-200">Home</a></li>
                <li><a href="skillCourse.php" class="hover:text-blue-200">Skill Courses</a></li>
                <li><a href="job_exchange.php" class="hover:text-blue-200">Job Exchange</a></li>
                <li><a href="https://www.skillindiadigital.gov.in/skill-india-map" class="hover:text-blue-200">Skill India Map</a></li>
            </ul>
        </div>
        <div class="flex space-x-4">
            <?php if (isLoggedIn()): ?>
                <div class="relative">
                    <img 
                        src="<?php echo htmlspecialchars($user['profile_image']); ?>" 
                        alt="Profile" 
                        class="w-10 h-10 rounded-full cursor-pointer border-2 border-white" 
                        onclick="toggleDropdown()"
                    >
                    <div 
                        id="profileDropdown" 
                        class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 hidden"
                    >
                        <p class="block px-4 py-2 text-sm text-gray-700">Welcome, <?php echo htmlspecialchars($user['name']); ?></p>
                        <a href="my_courses.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-500 hover:text-white">My Courses</a>
                        <a href="logout.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-500 hover:text-white">Logout</a>
                    </div>
                </div>
            <?php else: ?>
                <button onclick="window.location.href='login.php'" class="bg-white text-blue-600 px-4 py-2 rounded hover:bg-blue-100">Login</button>
                <button onclick="window.location.href='signup.php'" class="bg-white text-blue-600 px-4 py-2 rounded hover:bg-blue-100">Sign Up</button>
            <?php endif; ?>
        </div>
    </nav>

    <h1 class=" text-2xl font-bold mb-6 text-center mt-5">Please select your Jobs</h1>

    <!-- Hero Section -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mt-8 mb-8 max-w-8xl m-10">
        <!-- Job Card 1 -->
        <div class="bg-white shadow-lg rounded-lg p-5 transition duration-300 border-2 border-transparent hover:border-blue-500">
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-bold">Assembly line operator / ...</h3>
                <span class="bg-blue-500 text-white rounded-full px-3 py-1 text-sm">Job</span>
            </div>
            <p class="mt-2">Orion Corporate Alliance Pvt Ltd</p>
            <p class="text-gray-500 text-sm">via: NSDC JobX</p>
            <p class="mt-4"><i>📅 27 Mar 2025</i></p>
            <p class="mt-1 text-gray-600">🌍 Haryana</p>
            <p class="my-2 text-gray-800">Banking, Financial Services & Insurance...</p>
            <p class="font-semibold">₹ 12,500 - 17,500/month</p>
            <a href="error.php" class="text-blue-600 hover:underline">View Details →</a>
        </div>

        <!-- Job Card 2 -->
        <div class="bg-white shadow-lg rounded-lg p-5 transition duration-300 border-2 border-transparent hover:border-blue-500">
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-bold">Requirement officer</h3>
                <span class="bg-blue-500 text-white rounded-full px-3 py-1 text-sm">Job</span>
            </div>
            <p class="mt-2">Growfast organic diamond pvt ltd</p>
            <p class="text-gray-500 text-sm">via: NSDC JobX</p>
            <p class="mt-4"><i>📅 27 Mar 2025</i></p>
            <p class="mt-1 text-gray-600">🌍 Madhya Pradesh</p>
            <p class="my-2 text-gray-800">Agriculture | Full Time | Immediate Join...</p>
            <p class="font-semibold">₹ 15,000 - 38,333/month</p>
            <a href="error.php" class="text-blue-600 hover:underline">View Details →</a>
        </div>

        <!-- Job Card 3 -->
        <div class="bg-white shadow-lg rounded-lg p-5 transition duration-300 border-2 border-transparent hover:border-blue-500">
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-bold">Beauty Professional</h3>
                <span class="bg-blue-500 text-white rounded-full px-3 py-1 text-sm">Job</span>
            </div>
            <p class="mt-2">Beauty & Wellness Sector Skill Council
            </p>
            <p class="text-gray-500 text-sm">via: NSDC JobX</p>
            <p class="mt-4"><i>📅 27 Mar 2025</i></p>
            <p class="mt-1 text-gray-600">🌍 Rajasthan</p>
            <p class="my-2 text-gray-800">Agriculture | Full Time | Immediate Join...</p>
            <p class="font-semibold">₹ 15,000 - 38,333/month</p>
            <a href="error.php" class="text-blue-600 hover:underline">View Details →</a>
        </div>

        <!-- Job Card 4 -->
        <div class="bg-white shadow-lg rounded-lg p-5 transition duration-300 border-2 border-transparent hover:border-blue-500">
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-bold">Software Developer</h3>
                <span class="bg-blue-500 text-white rounded-full px-3 py-1 text-sm">Job</span>
            </div>
            <p class="mt-2">Inductotherm (India) Pvt Ltd.</p>
            <p class="text-gray-500 text-sm">via: NSDC JobX</p>
            <p class="mt-4"><i>📅 26 Mar 2025</i></p>
            <p class="mt-1 text-gray-600">🌍 Gujarat</p>
            <p class="my-2 text-gray-800">Capital Goods | Full Time | Immediate Join...</p>
            <p class="font-semibold">₹ 29,166 - 33,333/month</p>
            <a href="error.php" class="text-blue-600 hover:underline">View Details →</a>
        </div>

        <!-- Job Card 5 -->
        <div class="bg-white shadow-lg rounded-lg p-8 transition duration-300 border-2 border-transparent hover:border-blue-500">
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-bold">Security Guard</h3>
                <span class="bg-blue-500 text-white rounded-full px-3 py-1 text-sm">Job</span>
            </div>
            <p class="mt-2">SIS LTD.</p>
            <p class="text-gray-500 text-sm">via: NSDC JobX</p>
            <p class="mt-4"><i>📅 26 Mar 2025</i></p>
            <p class="mt-1 text-gray-600">🌍 Maharashtra</p>
            <p class="my-2 text-gray-800">Mining | Full Time | Immediate Join...</p>
            <p class="font-semibold">₹ 10,000 - 25,000/month</p>
            <a href="error.php" class="text-blue-600 hover:underline">View Details →</a>
        </div>

        <!-- Job Card 6 -->
        <div class="bg-white shadow-lg rounded-lg p-5 transition duration-300 border-2 border-transparent hover:border-blue-500">
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-bold">DATA ENTRY OPERATOR</h3>
                <span class="bg-blue-500 text-white rounded-full px-3 py-1 text-sm">Job</span>
            </div>
            <p class="mt-2">AVI POLYMERS LIMITED
            </p>
            <p class="text-gray-500 text-sm">via: NCS</p>
            <p class="mt-4"><i>📅 26 Mar 2025</i></p>
            <p class="mt-1 text-gray-600">🌍 Maharashtra</p>
            <p class="my-2 text-gray-800">Mining | Full Time | Immediate Join...</p>
            <p class="font-semibold">₹ 10,000 - 25,000/month</p>
            <a href="error.php" class="text-blue-600 hover:underline">View Details →</a>
        </div>

        <!-- Job Card 7 -->
        <div class="bg-white shadow-lg rounded-lg p-5 transition duration-300 border-2 border-transparent hover:border-blue-500">
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-bold">Machine Operator</h3>
                <span class="bg-blue-500 text-white rounded-full px-3 py-1 text-sm">Job</span>
            </div>
            <p class="mt-2">Vemosa Skills Private Limited</p>
            <p class="text-gray-500 text-sm">via: NSDC JobX</p>
            <p class="mt-4"><i>📅 27 Mar 2025</i></p>
            <p class="mt-1 text-gray-600">🌍 Madhya Pradesh</p>
            <p class="my-2 text-gray-800">Agriculture | Full Time | Immediate Join...</p>
            <p class="font-semibold">₹ 15,000 - 38,333/month</p>
            <a href="error.php" class="text-blue-600 hover:underline">View Details →</a>
        </div>

        <!-- Job Card 8 -->
        <div class="bg-white shadow-lg rounded-lg p-5 transition duration-300 border-2 border-transparent hover:border-blue-500">
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-bold">Line Operator</h3>
                <span class="bg-blue-500 text-white rounded-full px-3 py-1 text-sm">Job</span>
            </div>
            <p class="mt-2">ORBEDGE SOLUTION PVT LTD</p>
            <p class="text-gray-500 text-sm">via: NSDC JobX</p>
            <p class="mt-4"><i>📅 26 Mar 2025</i></p>
            <p class="mt-1 text-gray-600">🌍 Maharashtra</p>
            <p class="my-2 text-gray-800">Mining | Full Time | Immediate Join...</p>
            <p class="font-semibold">₹ 10,000 - 25,000/month</p>
            <a href="error.php" class="text-blue-600 hover:underline">View Details →</a>
        </div>

        <!-- Job Card 9 -->
        <div class="bg-white shadow-lg rounded-lg p-5 transition duration-300 border-2 border-transparent hover:border-blue-500">
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-bold">PAINTER</h3>
                <span class="bg-blue-500 text-white rounded-full px-3 py-1 text-sm">Job</span>
            </div>
            <p class="mt-2">Signum Fire Protection India Pvt Ltd</p>
            <p class="text-gray-500 text-sm">via: NSDC JobX</p>
            <p class="mt-4"><i>📅 26 Mar 2025</i></p>
            <p class="mt-1 text-gray-600">🌍 Maharashtra</p>
            <p class="my-2 text-gray-800">Mining | Full Time | Immediate Join...</p>
            <p class="font-semibold">₹ 10,000 - 25,000/month</p>
            <a href="error.php" class="text-blue-600 hover:underline">View Details →</a>
        </div>
    </div>

    <!-- Footer Section -->
    <footer class="bg-white dark:bg-gray-900 mt-5">
        <div class="mx-auto w-full max-w-screen-xl p-4 py-6 lg:py-8">
            <div class="md:flex md:justify-between">
                <div class="mb-6 md:mb-0">
                    <a href="https://flowbite.com/" class="flex items-center">
                        <img src="images/unnamed.png" class="h-12 me-3" alt="FlowBite Logo" />
                        <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-blue-600">Skill India</span>
                    </a>
                </div>
                <div class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-3">
                    <div>
                        <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Resources</h2>
                        <ul class="text-gray-500 dark:text-gray-400 font-medium">
                            <li class="mb-4">
                                <a href="https://flowbite.com/" class="hover:underline">Skill Courses</a>
                            </li>
                            <li>
                                <a href="https://tailwindcss.com/" class="hover:underline">Job Exchange</a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Follow us</h2>
                        <ul class="text-gray-500 dark:text-gray-400 font-medium">
                            <li class="mb-4">
                                <a href="https://github.com/themesberg/flowbite" class="hover:underline ">Official Site</a>
                            </li>
                            <li>
                                <a href="https://discord.gg/4eeurUVvTy" class="hover:underline">Skill India Mission</a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Legal</h2>
                        <ul class="text-gray-500 dark:text-gray-400 font-medium">
                            <li class="mb-4">
                                <a href="#" class="hover:underline">Privacy Policy</a>
                            </li>
                            <li>
                                <a href="#" class="hover:underline">Terms &amp; Conditions</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
            <div class="sm:flex sm:items-center sm:justify-between">
                <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2025 <a href="https://flowbite.com/" class="hover:underline">Skill India™</a>. All Rights Reserved.
                </span>
                <div class="flex mt-4 sm:justify-center sm:mt-0">
                    <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 8 19">
                            <path fill-rule="evenodd" d="M6.135 3H8V0H6.135a4.147 4.147 0 0 0-4.142 4.142V6H0v3h2v9.938h3V9h2.021l.592-3H5V3.591A.6.6 0 0 1 5.592 3h.543Z" clip-rule="evenodd" />
                        </svg>
                        <span class="sr-only">Facebook page</span>
                    </a>
                    <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white ms-5">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 21 16">
                            <path d="M16.942 1.556a16.3 16.3 0 0 0-4.126-1.3 12.04 12.04 0 0 0-.529 1.1 15.175 15.175 0 0 0-4.573 0 11.585 11.585 0 0 0-.535-1.1 16.274 16.274 0 0 0-4.129 1.3A17.392 17.392 0 0 0 .182 13.218a15.785 15.785 0 0 0 4.963 2.521c.41-.564.773-1.16 1.084-1.785a10.63 10.63 0 0 1-1.706-.83c.143-.106.283-.217.418-.33a11.664 11.664 0 0 0 10.118 0c.137.113.277.224.418.33-.544.328-1.116.606-1.71.832a12.52 12.52 0 0 0 1.084 1.785 16.46 16.46 0 0 0 5.064-2.595 17.286 17.286 0 0 0-2.973-11.59ZM6.678 10.813a1.941 1.941 0 0 1-1.8-2.045 1.93 1.93 0 0 1 1.8-2.047 1.919 1.919 0 0 1 1.8 2.047 1.93 1.93 0 0 1-1.8 2.045Zm6.644 0a1.94 1.94 0 0 1-1.8-2.045 1.93 1.93 0 0 1 1.8-2.047 1.918 1.918 0 0 1 1.8 2.047 1.93 1.93 0 0 1-1.8 2.045Z" />
                        </svg>
                        <span class="sr-only">Discord community</span>
                    </a>
                    <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white ms-5">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 17">
                            <path d="M20 1.892a8.178 8.178 0 0 1-2.355.635 4.074 4.074 0 0 0 1.8-2.235 8.344 8.344 0 0 1-2.605.98A4.13 4.13 0 0 0 13.85 0a4.068 4.068 0 0 0-4.1 4.038 4 4 0 0 0 .105.919A11.705 11.705 0 0 1 1.4.734a4.006 4.006 0 0 0 1.268 5.392 4.165 4.165 0 0 1-1.859-.5v.05A4.057 4.057 0 0 0 4.1 9.635a4.19 4.19 0 0 1-1.856.07 4.108 4.108 0 0 0 3.831 2.807A8.36 8.36 0 0 1 0 14.184 11.732 11.732 0 0 0 6.291 16 11.502 11.502 0 0 0 17.964 4.5c0-.177 0-.35-.012-.523A8.143 8.143 0 0 0 20 1.892Z" clip-rule="evenodd" />
                        </svg>
                        <span class="sr-only">Twitter page</span>
                    </a>
                    <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white ms-5">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 .333A9.911 9.911 0 0 0 6.866 19.65c.5.092.678-.215.678-.477 0-.237-.01-1.017-.014-1.845-2.757.6-3.338-1.169-3.338-1.169a2.627 2.627 0 0 0-1.1-1.451c-.9-.615.07-.6.07-.6a2.084 2.084 0 0 1 1.518 1.021 2.11 2.11 0 0 0 2.884.823c.044-.503.268-.973.63-1.325-2.2-.25-4.516-1.1-4.516-4.9A3.832 3.832 0 0 1 4.7 7.068a3.56 3.56 0 0 1 .095-2.623s.832-.266 2.726 1.016a9.409 9.409 0 0 1 4.962 0c1.89-1.282 2.717-1.016 2.717-1.016.366.83.402 1.768.1 2.623a3.827 3.827 0 0 1 1.02 2.659c0 3.807-2.319 4.644-4.525 4.889a2.366 2.366 0 0 1 .673 1.834c0 1.326-.012 2.394-.012 2.72 0 .263.18.572.681.475A9.911 9.911 0 0 0 10 .333Z" clip-rule="evenodd" />
                        </svg>
                        <span class="sr-only">GitHub account</span>
                    </a>
                    <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white ms-5">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 0a10 10 0 1 0 10 10A10.009 10.009 0 0 0 10 0Zm6.613 4.614a8.523 8.523 0 0 1 1.93 5.32 20.094 20.094 0 0 0-5.949-.274c-.059-.149-.122-.292-.184-.441a23.879 23.879 0 0 0-.566-1.239 11.41 11.41 0 0 0 4.769-3.366ZM8 1.707a8.821 8.821 0 0 1 2-.238 8.5 8.5 0 0 1 5.664 2.152 9.608 9.608 0 0 1-4.476 3.087A45.758 45.758 0 0 0 8 1.707ZM1.642 8.262a8.57 8.57 0 0 1 4.73-5.981A53.998 53.998 0 0 1 9.54 7.222a32.078 32.078 0 0 1-7.9 1.04h.002Zm2.01 7.46a8.51 8.51 0 0 1-2.2-5.707v-.262a31.64 31.64 0 0 0 8.777-1.219c.243.477.477.964.692 1.449-.114.032-.227.067-.336.1a13.569 13.569 0 0 0-6.942 5.636l.009.003ZM10 18.556a8.508 8.508 0 0 1-5.243-1.8 11.717 11.717 0 0 1 6.7-5.332.509.509 0 0 1 .055-.02 35.65 35.65 0 0 1 1.819 6.476 8.476 8.476 0 0 1-3.331.676Zm4.772-1.462A37.232 37.232 0 0 0 13.113 11a12.513 12.513 0 0 1 5.321.364 8.56 8.56 0 0 1-3.66 5.73h-.002Z" clip-rule="evenodd" />
                        </svg>
                        <span class="sr-only">Dribbble account</span>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        function toggleDropdown() {
            const dropdown = document.getElementById('profileDropdown');
            dropdown.classList.toggle('hidden');
        }

        // Close the dropdown if clicked outside
        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('profileDropdown');
            const profileImage = event.target.closest('img');
            if (!dropdown.contains(event.target) && !profileImage) {
                dropdown.classList.add('hidden');
            }
        });
    </script>

</body>

</html>