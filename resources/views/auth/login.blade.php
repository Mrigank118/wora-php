<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Login</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 font-sans antialiased">

    <x-navbar />
    <div class="relative flex flex-col justify-center min-h-screen overflow-hidden px-4">
        <div class="w-full max-w-md p-6 bg-white rounded-xl shadow-lg ring-2 ring-gray-800/50 mx-auto">
            <h1 class="text-2xl font-semibold text-center text-gray-700 mb-6">Login to Your Account</h1>

            <form action="{{ route('login.action') }}" method="POST" class="space-y-6">
                @csrf
                @if ($errors->any())
                <div role="alert" class="alert alert-warning bg-yellow-100 border-l-4 border-yellow-500 p-4 mb-4 text-gray-800">
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6 inline-block mr-2" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div>
                    <label for="email" class="block text-base font-medium text-gray-500">Email Address</label>
                    <input name="email" type="email" id="email" placeholder="Enter your email"
                        class="w-full p-4 bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:outline-none text-gray-800 @error('email') border-red-500 @enderror" />
                </div>

                <div>
                    <label for="password" class="block text-base font-medium text-gray-500">Password</label>
                    <input name="password" type="password" id="password" placeholder="Enter your password"
                        class="w-full p-4 bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:outline-none text-gray-800 @error('password') border-red-500 @enderror" />
                </div>

                <div>
                    <button type="submit"
                        class="w-full py-4 bg-black text-white font-semibold rounded-lg hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-black focus:ring-offset-2 transition duration-300">
                        Login
                    </button>
                </div>

                <div class="text-center text-sm text-gray-600">
                    <span>Don't have an account? </span>
                    <a href="{{ route('register') }}" class="text-black hover:text-gray-800 hover:underline">Register</a>
                </div>
            </form>
        </div>
    </div>

    <x-footer />
</body>

</html>
