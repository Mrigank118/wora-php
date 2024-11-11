<!-- resources/views/components/navbar.blade.php -->

<nav class="bg-blue-500 text-white p-4">
    <div class="max-w-screen-xl mx-auto flex items-center justify-between">

        <!-- Left: Username Display -->
        <div class="text-lg font-semibold">
            @auth
            <span> Hello, {{ Auth::user()->name }}</span> <!-- Show authenticated user's name -->
            @else
            <span>Hello, Guest</span> <!-- Show 'Guest' if not authenticated -->
            @endauth
        </div>

        <!-- Middle: App Name -->
        <div class="text-xl font-bold">
            Write Once Run Anywhere
        </div>

        <!-- Right: Notification + Auth Links -->
        <div class="flex items-center space-x-8">
            <!-- Notes Icon - Link to View Notes Page -->
            @auth
            <a href="{{ route('notes') }}" class="relative">
                <!-- Notes Icon -->
                <img src="{{ asset('icons/notes.png') }}" alt="Notes" class="h-6 w-6">
            </a>
            @endauth

            <!-- Mail Icon -->
            <button class="relative">
                <img src="{{ asset('icons/mail.png') }}" alt="Mail" class="h-6 w-6">
            </button>

            <!-- Authentication Links -->
            @guest
            <a href="{{ route('login') }}" class="text-sm font-semibold bg-blue-400 hover:bg-green-500 text-white py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">
                Login
            </a>
            @else
            <!-- Logout Button for Authenticated Users -->
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="text-sm font-semibold bg-blue-400 hover:bg-red-600 text-white py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50">
                    Logout
                </button>
            </form>
            @endauth
        </div>
    </div>
</nav>
