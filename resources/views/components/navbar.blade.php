<nav class="bg-black text-white p-4">
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
        <div class="text-xl flex flex-row space-x-2 font-bold">
            <a href="{{ route('welcome') }}" class="flex items-center space-x-2"> <!-- Link to the welcome page -->
                <img src="{{ asset('icons/wora.png') }}" alt="Wora Logo" class="h-8 w-8"> <!-- Adjust size as needed -->
                <p>Write Once Run Anywhere</p>
            </a>
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

            <!-- Mail Icon - Only shown when the user is logged in -->
            @auth
            <button class="relative" onclick="sendThankYouMail()">
                <img src="{{ asset('icons/mail.png') }}" alt="Mail" class="h-6 w-6">
            </button>
            @endauth

            <!-- Authentication Links -->
            @guest
            <a href="{{ route('login') }}" class="text-sm font-semibold bg-white hover:bg-gray-400 text-black py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50">
                Login
            </a>
            @else
            <!-- Logout Button for Authenticated Users -->
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button class="flex items-center rounded-md bg-gray-600 py-2 px-4 text-center text-sm transition-all shadow-sm hover:shadow-lg text-white hover:text-white hover:bg-gray-700 hover:border-slate-800 focus:text-white focus:bg-slate-800 focus:border-slate-800 active:text-white active:bg-slate-800 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                    type="submit"> <!-- Change type to "submit" -->
                    Logout
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 ml-1.5">
                        <path fill-rule="evenodd" d="M16.28 11.47a.75.75 0 0 1 0 1.06l-7.5 7.5a.75.75 0 0 1-1.06-1.06L14.69 12 7.72 5.03a.75.75 0 0 1 1.06-1.06l7.5 7.5Z" clip-rule="evenodd" />
                    </svg>
                </button>
            </form>
            @endguest
        </div>
    </div>
</nav>

<script>
    // JavaScript function to send the thank you email
    function sendThankYouMail() {
        fetch('/send-thank-you-mail', { // Direct URL instead of dynamic route
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({})
            })
            .then(response => response.json())
            .then(data => {
                if (data.message) {
                    alert('Thank you email sent successfully!');
                } else {
                    alert('Error sending email.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to send email.');
            });
    }
</script>