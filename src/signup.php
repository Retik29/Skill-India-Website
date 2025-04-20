<?php
session_start();
$signupError = isset($_SESSION['signup_error']) ? $_SESSION['signup_error'] : '';
unset($_SESSION['signup_error']); // Clear the error after retrieving it
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skill India Signup</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.4.1/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <script type="module" src="registration.js" defer></script>

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
    <div id="alertBox" class="p-4 mb-4 text-lg text-red-800 rounded-lg bg-red-200 dark:bg-red-800 dark:red-blue-400 hidden" role="alert">
        <span id="alertMessage" class="font-medium"></span>
    </div>

    <div class="flex border rounded-lg shadow-lg overflow-hidden bg-white w-1/2">
        <div class="p-8 w-1/2">
            <h1 class="text-2xl font-bold mb-4">Sign Up to Skill India</h1>
            <form action="process_signup.php" method="POST" enctype="multipart/form-data">
                <div class="mb-4">
                    <label class="block text-gray-700" for="name">Name</label>
                    <input class="mt-1 p-2 border rounded w-full" type="text" id="name" name="name" placeholder="Enter the name" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700" for="email">Email</label>
                    <input class="mt-1 p-2 border rounded w-full" type="email" id="email" name="email" placeholder="Enter the email" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700" for="password">Password</label>
                    <div class="relative">
                        <input 
                            class="mt-1 p-2 border rounded w-full pr-10" 
                            type="password" 
                            id="password" 
                            name="password" 
                            placeholder="Enter the Password" 
                            required 
                            oninput="checkPasswordStrength()"
                        >
                        <button 
                            type="button" 
                            class="absolute inset-y-0 right-0 px-3 text-gray-600 hover:text-gray-800 focus:outline-none" 
                            onclick="togglePasswordVisibility('password', this)"
                        >
                            Show
                        </button>
                    </div>
                    <p id="passwordStrength" class="text-sm mt-1 hidden"></p>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700" for="confirm-password">Confirm Password</label>
                    <input 
                        class="mt-1 p-2 border rounded w-full" 
                        type="password" 
                        id="confirm-password" 
                        name="confirm-password" 
                        placeholder="Enter the Password" 
                        required 
                        oninput="checkPasswordMatch()"
                    >
                    <p id="passwordMatch" class="text-sm mt-1 hidden"></p>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700" for="profile_image">Profile Image</label>
                    <div class="mt-1 flex items-center">
                        <input type="file" id="profile_image" name="profile_image" accept="image/*" class="hidden" onchange="previewImage(this)">
                        <label for="profile_image" class="cursor-pointer bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded border border-gray-300">
                            Choose Image
                        </label>
                        <img id="imagePreview" class="ml-4 h-10 w-10 rounded-full object-cover hidden" src="#" alt="Preview">
                    </div>
                </div>
                <button class="bg-blue-600 text-white py-2 rounded w-full hover:bg-blue-700 font-bold" type="submit">Sign Up</button>
            </form>

            <!-- Continue with Google Button -->
            <!-- <button 
            class="
             bg-yellow-300 text-black py-2 px-4 rounded w-full hover:opacity-90 mt-4 flex items-center justify-center"
            type="button"
            onclick="window.location.href='';"
            >
            <span class="font-bold">Continue with Google</span>
            <img src="images/google-icon.png" alt="Google Icon" class="h-5 w-5 ml-2">
            </button> -->



            <p class="text-center text-sm mt-5">have an account? do <a class="text-blue-600" href="login.php">Login</a></p>
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
            const signupError = "<?php echo $signupError; ?>";

            if (signupError) {
                alertMessage.textContent = signupError;
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

        function previewImage(input) {
            const preview = document.getElementById('imagePreview');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }


        function checkPasswordStrength() {
            const password = document.getElementById('password').value;
            const strengthText = document.getElementById('passwordStrength');
            let strength = '';

            if (password.length < 6) {
                strength = 'Weak';
                strengthText.className = 'text-sm mt-1 text-red-500';
            } else if (password.length >= 6 && /[A-Za-z]/.test(password) && /[0-9]/.test(password) && /[!@#$%^&*]/.test(password)) {
                strength = 'Strong';
                strengthText.className = 'text-sm mt-1 text-green-500';
            } else if (password.length >= 6 && /[A-Za-z]/.test(password) && /[0-9]/.test(password)) {
                strength = 'Medium';
                strengthText.className = 'text-sm mt-1 text-yellow-500';
            } else {
                strength = 'Weak';
                strengthText.className = 'text-sm mt-1 text-red-500';
            }

            strengthText.textContent = `Password Strength: ${strength}`;
            strengthText.classList.remove('hidden');
        }

        function checkPasswordMatch() {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm-password').value;
            const matchText = document.getElementById('passwordMatch');

            if (confirmPassword === '') {
                matchText.classList.add('hidden');
            } else if (password === confirmPassword) {
                matchText.textContent = 'Passwords match';
                matchText.className = 'text-sm mt-1 text-green-500';
                matchText.classList.remove('hidden');
            } else {
                matchText.textContent = 'Passwords do not match';
                matchText.className = 'text-sm mt-1 text-red-500';
                matchText.classList.remove('hidden');
            }
        }

        function togglePasswordVisibility(fieldId, button) {
            const field = document.getElementById(fieldId);
            if (field.type === 'password') {
                field.type = 'text';
                button.textContent = 'Hide';
            } else {
                field.type = 'password';
                button.textContent = 'Show';
            }
        }
    </script>

</body>

</html>