<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Saved Notes</title>
    <!-- Vite CSS for Tailwind -->
    @vite('resources/css/app.css')

    <style>
        /* The expanded view on hover effect */
        .note-card {
            position: relative;
            transition: all 0.3s ease; /* Smooth transition */
            height: 200px; /* Default height */
            width: 250px; /* Fixed width */
        }

        /* On hover, the note card expands in height */
        .note-card:hover {
            height: auto; /* Expands the height on hover */
            background-color: rgba(255, 255, 255, 0.8); /* Slight transparent background */
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15); /* Add stronger shadow */
            z-index: 10; /* Bring the note on top */
        }

        /* Ensure the content can grow and be visible */
        .note-card .note-content {
            text-overflow: clip;
            overflow: visible;
            height: 100%;
        }

        .note-card .note-text {
            max-height: none; /* Ensure the text has no height restrictions */
        }
    </style>
</head>

<body class="bg-gray-100 min-h-screen">

    <!-- Navbar (This assumes you have a navbar component already) -->
    <header class="bg-blue-600 text-white">
        <x-navbar /> <!-- Loads the navbar component -->
    </header>

    <!-- Main Content Area -->
    <main class="w-full mx-auto p-6">

        <div class="max-w-screen-xl mx-auto">
            <h1 class="text-2xl font-semibold mb-6">Your Saved Notes</h1>

            <!-- Notes Grid Container (with fixed height and scrollable) -->
            <div id="notes-container" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6 overflow-y-auto" style="max-height: calc(100vh - 150px);">
                <!-- Notes will be dynamically loaded here -->
            </div>
        </div>

    </main>

    <script>
        // Function to fetch saved notes using AJAX
        document.addEventListener('DOMContentLoaded', function () {
            // Fetch notes from the backend API
            fetch('/api/notes')  // API endpoint to fetch notes
                .then(response => response.json())
                .then(data => {
                    const notesContainer = document.getElementById('notes-container');
                    
                    if (data.notes && data.notes.length > 0) {
                        // Loop through each note and create an HTML element for it
                        data.notes.forEach(note => {
                            const noteElement = document.createElement('div');
                            noteElement.classList.add(
                                'note-card',   // Note card with hover effect
                                'bg-white',
                                'p-6',         // Padding for better spacing
                                'rounded-lg',
                                'shadow-lg',    // Larger shadow for better separation
                                'hover:shadow-xl', // Add hover shadow effect
                                'transition-shadow', 
                                'flex',
                                'flex-col',
                                'justify-between',
                                'overflow-hidden', 
                                'space-y-2',
                                'cursor-pointer' // Add a pointer cursor for interactive elements
                            );

                            // Add the full content of the note inside
                            noteElement.innerHTML = `
                                <div class="note-text">
                                    <p class="text-gray-700 text-md h-full note-content">${note.content}</p>
                                    <div class="text-xs text-gray-500 mt-auto">
                                        <small>Saved on: ${new Date(note.created_at).toLocaleString()}</small>
                                    </div>
                                </div>
                            `;

                            notesContainer.appendChild(noteElement);
                        });
                    } else {
                        // If no notes found, display a message
                        notesContainer.innerHTML = '<p class="text-gray-500">You have no saved notes.</p>';
                    }
                })
                .catch(error => {
                    console.error('Error fetching notes:', error);
                    // Show error message if API request fails
                    document.getElementById('notes-container').innerHTML = '<p class="text-red-500">Failed to load notes.</p>';
                });
        });
    </script>

</body>

</html>
