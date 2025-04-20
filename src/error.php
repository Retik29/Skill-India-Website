<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error Page</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.4.1/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

    <div class="text-center bg-white p-10 rounded-lg shadow-lg max-w-lg">
        <!-- Error Graphic -->
        <div class="mb-6">
            <img src="https://via.placeholder.com/150" alt="Error Graphic" class="mx-auto w-32 h-32">
        </div>

        <!-- Error Message -->
        <h1 class="text-4xl font-bold text-red-600 mb-4">Oops! Something went wrong.</h1>
        <p class="text-gray-700 mb-6">We can't seem to find the page you're looking for. It might have been moved, deleted, or the URL might be incorrect.</p>

        <!-- Action Buttons -->
        <div class="flex justify-center space-x-4">
            <a href="index.php" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition duration-300">Go to Homepage</a>
            <a href="contact.php" class="bg-gray-600 text-white px-6 py-2 rounded hover:bg-gray-700 transition duration-300">Contact Support</a>
        </div>
    </div>

</body>
</html>
