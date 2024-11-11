<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <!-- Vite CSS for Tailwind -->
    @vite('resources/css/app.css')
</head>

<body class="bg-white min-h-screen flex flex-col">

    <!-- Navbar (Top Division) -->
    <header class="bg-blue-600 text-white">
        <x-navbar /> <!-- This loads the navbar component -->
    </header>

    <!-- Main Content Area (Expands to fill the screen) -->
    <main class="w-full mx-auto p-6 flex flex-wrap gap-6 min-h-screen flex-col md:flex-row">

        <!-- Left Section (expanded) -->
        <x-chatbot />

    </main>

</body>

</html>