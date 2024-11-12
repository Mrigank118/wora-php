<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Register</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 font-sans antialiased">
    <x-navbar />
    <div class="relative flex flex-col justify-center min-h-screen overflow-hidden px-4">
        <div class="w-full max-w-md p-6 bg-white rounded-xl shadow-lg ring-2 ring-gray-800/50 mx-auto">
            <h1 class="text-2xl font-semibold text-center text-gray-700 mb-6">Create Your Account</h1>

            <form action="{{ route('register.save') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label for="name" class="block text-base font-medium text-gray-500">Full Name</label>
                    <input name="name" type="text" id="name" placeholder="Enter your name"
                        class="w-full p-4 bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:outline-none text-gray-800 @error('name') border-red-500 @enderror" />
                    @error('name')
                    <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-base font-medium text-gray-500">Email Address</label>
                    <input name="email" type="email" id="email" placeholder="Enter your email"
                        class="w-full p-4 bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:outline-none text-gray-800 @error('email') border-red-500 @enderror" />
                    @error('email')
                    <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-base font-medium text-gray-500">Password</label>
                    <input name="password" type="password" id="password" placeholder="Enter your password"
                        class="w-full p-4 bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:outline-none text-gray-800 @error('password') border-red-500 @enderror" />
                    @error('password')
                    <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-base font-medium text-gray-500">Confirm Password</label>
                    <input name="password_confirmation" type="password" id="password_confirmation"
                        placeholder="Confirm your password"
                        class="w-full p-4 bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:outline-none text-gray-800 @error('password_confirmation') border-red-500 @enderror" />
                    @error('password_confirmation')
                    <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex justify-center">
                    <button type="submit"
                        class="w-full py-4 bg-black text-white font-semibold rounded-lg hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-black focus:ring-offset-2 transition duration-300">
                        Register Account
                    </button>
                </div>

                <div class="text-center text-sm text-gray-600">
                    <span>Already have an account? </span>
                    <a href="{{ route('login') }}" class="text-black hover:text-gray-800 hover:underline">Login</a>
                </div>

            </form>
        </div>
    </div>
    <x-footer />
</body>

</html>
