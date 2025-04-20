<?php
session_start();
require_once './config/database.php';
require_once './auth.php';

if (isset($_SESSION['user_id']) && $_SESSION['user_id'] != null) {
    $user = getCurrentUser();
} else {
    $user = null;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>Skill India</title>
    <link href="./output.css" rel="stylesheet">
    <link rel="stylesheet" href="input.css">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />

</head>
<body class="">
    <!-- Navbar Section -->

    <nav class="flex w-full justify-between items-center p-4 bg-blue-600 text-white h-fit">
        <div class="flex items-center flex-1">
            <h1 class="text-2xl font-bold mr-8"><a href="index.php">Skill India</a></h1>
            <ul class="flex space-x-6 justify-center flex-1">
                <li><a href="index.php" class="hover:text-blue-200">Home</a></li>
                <li><a href="skillCourse.php" target="_blank" class="hover:text-blue-200">Skill Courses</a></li>
                <li><a href="job_exchange.php" target="_blank" class="hover:text-blue-200">Job Exchange</a></li>
                <li><a href="https://www.skillindiadigital.gov.in/skill-india-map" class="hover:text-blue-200" target="_blank">Skill India Map</a></li>
            </ul>
        </div>
        <div class="flex space-x-4 items-center">
            <form action="auth.php" method="POST" style="display: inline;">
                <input type="hidden" name="action" value="dashboard">
                <button type="submit" class="bg-white text-blue-600 px-4 py-2 rounded hover:bg-blue-100">Dashboard</button>
            </form>
            <?php if (isLoggedIn()): ?>
                <div class="relative group">
                    <img 
                        src="<?php echo htmlspecialchars($user['profile_image']); ?>" 
                        alt="Profile" 
                        class="w-10 h-10 rounded-full cursor-pointer border-2 border-white" 
                        onclick="toggleDropdown()"
                    >
                    <div 
                        id="profileDropdown" 
                        class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 hidden z-50"
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

    <!-- Hero Carousel Section -->
    <div id="default-carousel" class="relative w-full" data-carousel="slide">
        <!-- Carousel wrapper -->
        <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
            <!-- Item 1 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="./images/skill1.jpg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="Skill India Image 1">
            </div>
            <!-- Item 2 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="./images/skill2.jpg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="Skill India Image 2">
            </div>
            <!-- Item 3 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="./images/skill3.jpg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="Skill India Image 3">
            </div>
            <!-- Item 4 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="./images/skill4.jpg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="Skill India Image 4">
            </div>
            <!-- Item 5 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="./images/skill5.jpg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="Skill India Image 5">
            </div>
            <!-- Item 6 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="./images/skill6.jpg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="Skill India Image 6">
            </div>
        </div>
        <!-- Slider indicators -->
        <div class="absolute z-30 flex -translate-x-1/2 space-x-3 rtl:space-x-reverse bottom-5 left-1/2">
            <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 4" data-carousel-slide-to="3"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 5" data-carousel-slide-to="4"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 6" data-carousel-slide-to="5"></button>
        </div>
        <!-- Slider controls -->
        <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4" />
                </svg>
                <span class="sr-only">Previous</span>
            </span>
        </button>
        <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                </svg>
                <span class="sr-only">Next</span>
            </span>
        </button>
    </div>

    <!-- Partners Section -->
    <div class="container pt-3 pb-5 px-4 mx-auto bg-gray-100 w-[100%]">
        <h2 class="text-3xl font-bold mb-8 text-center">Our Partners</h2>

        <div class="flex animate-scroll overflow-hidden whitespace-nowrap w-full">
            <div class="flex space-x-8 animate-scroll-content">
                <!-- First set of images -->
                <img src="./images/p-logo1.png" alt="Partner 1" class="h-20 object-contain">
                <img src="./images/p-logo2.png" alt="Partner 2" class="h-20 object-contain">
                <img src="./images/p-logo3.png" alt="Partner 3" class="h-20 object-contain">
                <img src="./images/p-logo4.png" alt="Partner 4" class="h-20 object-contain">
                <img src="./images/p-logo5.png" alt="Partner 5" class="h-20 object-contain">
                <img src="./images/p-logo6.png" alt="Partner 6" class="h-20 object-contain">
                <img src="./images/p-logo7.png" alt="Partner 7" class="h-20 object-contain">
                <img src="./images/p-logo8.png" alt="Partner 8" class="h-20 object-contain">
                <img src="./images/p-logo9.png" alt="Partner 9" class="h-20 object-contain">
                <img src="./images/p-logo10.png" alt="Partner 10" class="h-20 object-contain">
            </div>
        </div>

        <div class="flex animate-scroll overflow-hidden whitespace-nowrap mt-6">
            <div class="flex space-x-8 animate-scroll-content">
                <img src="./images/brand1.png" alt="Success Story 1" class="h-20 object-contain">
                <img src="./images/brand2.png" alt="Success Story 2" class="h-20 object-contain">
                <img src="./images/brand3.png" alt="Success Story 3" class="h-20 object-contain">
                <img src="./images/brand4.png" alt="Success Story 4" class="h-20 object-contain">
                <img src="./images/brand5.png" alt="Success Story 5" class="h-20 object-contain">
                <img src="./images/brand6.png" alt="Success Story 6" class="h-20 object-contain">
                <img src="./images/brand7.png" alt="Success Story 7" class="h-20 object-contain">
                <img src="./images/brand8.png" alt="Success Story 8" class="h-20 object-contain">
                <img src="./images/brand9.png" alt="Success Story 9" class="h-20 object-contain">
                <img src="./images/brand10.png" alt="Success Story 10" class="h-20 object-contain">
                <img src="./images/brand11.png" alt="Success Story 11" class="h-20 object-contain">
            </div>
        </div>
    </div>

    <!-- Section 5  -->
    <div class="bg-gray-100 p-8">
        <div class="max-w-6xl mx-auto">
            <div class="flex flex-col md:flex-col gap-8">
                <!-- Card 1 -->
                <div class="bg-white rounded-lg shadow-lg p-6 flex items-center gap-6 w-1/2">
                    <img src="images/sidh-pm-modi.png" alt="Shri Narendra Modi" class="w-24 h-24 rounded-full border border-gray-300 mr-4">
                    <div>
                        <h2 class="text-xl font-semibold">Shri Narendra Modi</h2>
                        <p class="text-sm text-gray-500">HON'BLE PRIME MINISTER</p>
                        <p class="mt-2 text-gray-700">Skill development of the new generation is a national need and is the foundation of Aatmnirbhar Bharat.</p>
                    </div>
                </div>
                <!-- Card 2 -->
                <div class="bg-white rounded-lg shadow-lg p-6 flex items-center gap-6 w-1/2 ml-auto">
                    <img src="images/aatmnirbhar-bharat-card-jayant.png" alt="Shri Jayant Chaudhary" class="w-24 h-24 rounded-full border border-gray-300 mr-4">
                    <div>
                        <h2 class="text-xl font-semibold">Shri Jayant Chaudhary</h2>
                        <p class="text-sm text-gray-500">HON'BLE MINISTER OF STATE (I/C)</p>
                        <p class="mt-2 text-gray-700">New skills such as AI, machine learning, and automation are transforming industries and highlighting the critical need for continuous learning.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cards Section  -->

    <div class="max-w-7xl mx-auto py-12">
        <h1 class="text-3xl font-bold text-center mb-8">Building a Skilled India</h1>
        <div class="flex justify-center space-x-8">
            <div class="max-w-xs p-6 bg-white rounded-lg shadow-md text-center">
                <div class="flex justify-center mb-4">
                    <!-- Add your image/icon here -->
                    <img src="images/sample1.png" alt="Citizen Centric" class="h-13 w-13">
                </div>
                <h2 class="text-xl font-semibold">Citizen Centric</h2>
                <p class="text-gray-600 mt-2">Designed to meet the skilling needs of India's diverse and aspirational population</p>
            </div>
            <div class="max-w-xs p-6 bg-white rounded-lg shadow-md text-center">
                <div class="flex justify-center mb-4">
                    <!-- Add your image/icon here -->
                    <img src="images/sample2.png" alt="Career Focused" class="h-13 w-13">
                </div>
                <h2 class="text-xl font-semibold">Career Focused</h2>
                <p class="text-gray-600 mt-2">Relevant skill courses, certification, jobs, and apprenticeships</p>
            </div>
            <div class="max-w-xs p-6 bg-white rounded-lg shadow-md text-center">
                <div class="flex justify-center mb-4">
                    <!-- Add your image/icon here -->
                    <img src="images/sample3.png" alt="Multilingual" class="h-13 w-13">
                </div>
                <h2 class="text-xl font-semibold">Multilingual</h2>
                <p class="text-gray-600 mt-2">Explore Skill India Digital Hub in Multiple Indian languages</p>
            </div>
        </div>
        <div class="text-center mt-8">
            <button onclick="redirect2()" class="px-6 py-2 bg-orange-500 text-white rounded-lg font-semibold">REGISTER</button>
        </div>
    </div>

    <!-- Success Stories Section  -->

    <div class="bg-gray-100 w-full h-fit py-12 m-auto flex justify-evenly">
        <img src="images/testimonial1-img.png" alt="sample-img" class="h-50 w-80">
        <div class="w-1/2 h-hit p-5">
            <h3 class="font-bold text-3xl">Success Stories</h3>
            <video width="500" height="350" autoplay muted controls class="rounded-lg mt-5">
                <source src="images/construction_sector.mp4" type="video/mp4">
            </video>
        </div>
    </div>

    <!-- Carousel 2 Section  -->

    <div id="default-carousel" class="relative w-full mt-5" data-carousel="slide">
        <!-- Carousel wrapper -->
        <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
            <!-- Item 1 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="images/carousel1.png" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            </div>
            <!-- Item 2 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="images/carousel2.png" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            </div>
            <!-- Item 3 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="images/carousel3.png" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            </div>
        </div>

    </div>

    <!-- Download section  -->

    <div class="bg-gray-100 flex justify-center items-center h-fit">
        <div class="flex flex-col md:flex-row items-center p-6">
            <div class="md:w-1/2 text-left">
                <h1 class="text-3xl font-bold text-blue-600 mb-2">Download the Skill India Digital Hub<br> App!</h1>
                <p class="text-gray-700 mb-4">Use your mobile phone to meet your skilling needs.</p>
                <ul class="flex space-x-4 mb-4 justify-evenly max-w-sm">
                    <li>
                        <a href="https://apps.apple.com/in/app/skill-india-digital-hub/id1631506973" class="text-white rounded-lg px-2 py-1" target="_blank">
                            <img src="images/Apple.png" alt="App Store" class="h-8 mr-1">
                        </a>
                    </li>
                    <li>
                        <a href="https://play.google.com/store/apps/details?id=com.nsdcindia.skillindiaplatform&hl=en_IN" target="_blank" class="text-white rounded-lg px-2 py-1">
                            <img src="images/Google.png" alt="Google Play" class="h-8 mr-1">
                        </a>
                    </li>
                    <li class="flex flex-row">
                        <img src="images/download.png" alt="QR Code" class="h-20 w-20 mx-2 my-1">
                        <p class="text-gray-700">Scan and Download App</p>
                    </li>
                </ul>
            </div>
            <div class="md:w-1/2 flex justify-center mt-6 md:mt-0">
                <img src="images/download-app-mobile.png" alt="App Screenshot" class="h-96">
            </div>
        </div>
    </div>

    <!-- footer section -->
    <footer class="bg-white dark:bg-gray-900">
        <div class="mx-auto w-full max-w-screen-xl p-4 py-6 lg:py-8">
            <div class="md:flex md:justify-between">
                <div class="mb-6 md:mb-0">
                    <a href="index.html" class="flex items-center">
                        <img src="images/unnamed.png" class="h-12 me-3" alt="Skill India Logo" />
                        <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Skill India</span>
                    </a>
                </div>
                <div class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-3">
                    <div>
                        <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Resources</h2>
                        <ul class="text-gray-500 dark:text-gray-400 font-medium">
                            <li class="mb-4">
                                <a href="skillCourse.html" target="_blank" class="hover:underline">Skill Courses</a>
                            </li>
                            <li>
                                <a href="job_exchange.html" target="_blank" class="hover:underline">Job Exchange</a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Follow us</h2>
                        <ul class="text-gray-500 dark:text-gray-400 font-medium">
                            <li class="mb-4">
                                <a href="https://www.skillindiadigital.gov.in/" target="_blank" class="hover:underline ">Official Site</a>
                            </li>
                            <li>
                                <a href="https://skillindiamission.in/" target="_blank" class="hover:underline">Skill India Mission</a>
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
                    <a onclick="message()" target="_blank" href="https://www.facebook.com/NSDCIndiaOfficial" class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 8 19">
                            <path fill-rule="evenodd" d="M6.135 3H8V0H6.135a4.147 4.147 0 0 0-4.142 4.142V6H0v3h2v9.938h3V9h2.021l.592-3H5V3.591A.6.6 0 0 1 5.592 3h.543Z" clip-rule="evenodd" />
                        </svg>
                        <span class="sr-only">Facebook page</span>
                    </a>
                    <a onclick="message()" target="_blank" href="https://x.com/NSDCINDIA" class="text-gray-500 hover:text-gray-900 dark:hover:text-white ms-5">
                        <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z" />
                        </svg>
                        <span class="sr-only">Twitter Page</span>
                    </a>
                    <a onclick="message()" target="_blank" href="https://www.linkedin.com/company/national-skill-development-corporation/" class="text-gray-500 hover:text-gray-900 dark:hover:text-white ms-5">
                        <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                            <path d="M416 32H31.9C14.3 32 0 46.5 0 64.3v383.4C0 465.5 14.3 480 31.9 480H416c17.6 0 32-14.5 32-32.3V64.3c0-17.8-14.4-32.3-32-32.3zM135.4 416H69V202.2h66.5V416zm-33.2-243c-21.3 0-38.5-17.3-38.5-38.5S80.9 96 102.2 96c21.2 0 38.5 17.3 38.5 38.5 0 21.3-17.2 38.5-38.5 38.5zm282.1 243h-66.4V312c0-24.8-.5-56.7-34.5-56.7-34.6 0-39.9 27-39.9 54.9V416h-66.4V202.2h63.7v29.2h.9c8.9-16.8 30.6-34.5 62.9-34.5 67.2 0 79.7 44.3 79.7 101.9V416z" />
                        </svg>
                        <span class="sr-only">Linkedin page</span>
                    </a>
                    <a onclick="message()" target="_blank" href="https://www.youtube.com/user/NSDCIndiaOfficial" class="text-gray-500 hover:text-gray-900 dark:hover:text-white ms-5">
                        <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                            <path d="M549.7 124.1c-6.3-23.7-24.8-42.3-48.3-48.6C458.8 64 288 64 288 64S117.2 64 74.6 75.5c-23.5 6.3-42 24.9-48.3 48.6-11.4 42.9-11.4 132.3-11.4 132.3s0 89.4 11.4 132.3c6.3 23.7 24.8 41.5 48.3 47.8C117.2 448 288 448 288 448s170.8 0 213.4-11.5c23.5-6.3 42-24.2 48.3-47.8 11.4-42.9 11.4-132.3 11.4-132.3zm-317.5 213.5V175.2l142.7 81.2-142.7 81.2z" />
                        </svg>
                        <span class="sr-only">Youtube</span>
                    </a>

                </div>
            </div>
        </div>
    </footer>

    <script>
        (function() {
            if (!window.chatbase || window.chatbase("getState") !== "initialized") {
                window.chatbase = (...arguments) => {
                    if (!window.chatbase.q) {
                        window.chatbase.q = []
                    }
                    window.chatbase.q.push(arguments)
                };
                window.chatbase = new Proxy(window.chatbase, {
                    get(target, prop) {
                        if (prop === "q") {
                            return target.q
                        }
                        return (...args) => target(prop, ...args)
                    }
                })
            }
            const onLoad = function() {
                const script = document.createElement("script");
                script.src = "https://www.chatbase.co/embed.min.js";
                script.id = "UjWEUF0f_xWaBt5Rq7zLa";
                script.domain = "www.chatbase.co";
                document.body.appendChild(script)
            };
            if (document.readyState === "complete") {
                onLoad()
            } else {
                window.addEventListener("load", onLoad)
            }
        })();

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

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>

</html>