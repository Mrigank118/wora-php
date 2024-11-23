<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WORA</title>
    <link rel="icon" type="image/x-icon" href="icons/favicon.ico?v=2">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/css/app.css')
</head>

<body class="bg-white min-h-screen flex flex-col">


    <header class="bg-blue-600 text-white">
        <x-navbar /> 
    </header>

    
    <main class="w-full mx-auto p-6 flex flex-wrap gap-6 min-h-screen flex-col md:flex-row">

       
        <x-chatbot />
    </main>

    <x-footer />

</body>

</html>