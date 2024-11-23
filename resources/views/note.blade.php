<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Saved Notes</title>
    @vite('resources/css/app.css')
    <style>
       
        .note-card:nth-child(1) { background-color: #ffd966; }
        .note-card:nth-child(2) { background-color: #f28b82; }
        .note-card:nth-child(3) { background-color: #81c995; }
        .note-card:nth-child(4) { background-color: #d7aefb; }
        .note-card:nth-child(5) { background-color: #aecbfa; }

        /* Note Card Styling */
        .note-card {
            position: relative;
            height: 300px;
            width: 280px;
            color: #1a1a1a;
            padding: 16px;
            margin: 15px;
            border-radius: 12px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            cursor: pointer;
            overflow: hidden;
        }

        .note-card:hover {
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
            transform: translateY(-5px);
        }

       
        .note-content {
            color: #333333;
            font-size: 1.1rem; 
            line-height: 1.5;
            margin-bottom: 20px;
        }

        .note-date {
            font-size: 1rem; 
            color: #5f6368;
            position: absolute;
            bottom: 12px;
            left: 16px;
        }

       
        .blue-dot {
            height: 8px;
            width: 8px;
            background-color: #1a73e8;
            border-radius: 50%;
            display: inline-block;
            margin-right: 6px;
        }
    </style>
</head>

<body class="bg-gray-100 min-h-screen">

   
    <header class="bg-blue-600 text-white">
        <x-navbar /> 
    </header>

    
    <main class="w-full mx-auto p-6">
        <div class="max-w-screen-xl mx-auto">
            <h1 class="text-2xl font-semibold mb-6">Your Saved Notes</h1>

          
            <div id="notes-container" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-4 gap-6">
                <!-- Notes will be dynamically loaded here -->
            </div>
        </div>
    </main>

    <!-- JavaScript to Fetch and Display Notes -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            fetch('/api/notes')
                .then(response => response.json())
                .then(data => {
                    const notesContainer = document.getElementById('notes-container');
                    
                    if (data.notes && data.notes.length > 0) {
                        data.notes.forEach((note, index) => {
                            const noteElement = document.createElement('div');
                            noteElement.classList.add('note-card');

                            noteElement.innerHTML = `
                                <!-- Note Content -->
                                <div class="note-content" data-full-content="${note.content}">
                                    ${note.content.length > 150 ? note.content.substring(0, 200) + '...' : note.content}
                                </div>

                                <!-- Note Date -->
                                <div class="note-date">
                                    <small>${new Date(note.created_at).toLocaleDateString()}</small>
                                </div>
                            `;

                            notesContainer.appendChild(noteElement);
                        });
                    } else {
                        notesContainer.innerHTML = '<p class="text-gray-500">You have no saved notes.</p>';
                    }
                })
                .catch(error => {
                    console.error('Error fetching notes:', error);
                    notesContainer.innerHTML = '<p class="text-red-500">Failed to load notes.</p>';
                });
        });
    </script>

</body>

</html>
