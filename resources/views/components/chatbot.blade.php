<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <!-- Correct Link to Tailwind CDN (Ensure proper MIME type) -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.0.0/dist/tailwind.min.css" rel="stylesheet">

    <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- CSRF token for security -->
</head>

<body class="bg-gray-100">

    <div class="flex flex-col md:flex-row space-y-6 md:space-y-0 md:space-x-6 p-6">
        
        <!-- Chatbox Section -->
        <div class="flex-1 md:w-2/3 bg-white p-6 rounded-lg shadow-lg h-[750px] flex flex-col">
            <!-- Flex container for header and button -->
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl text-gray-600 font-bold">What's on your mind?</h2>
                <div>
                    <button id="adapt-btn" class="rounded-md bg-black py-2 px-4 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-gray-800 focus:shadow-none active:bg-gray-800 hover:bg-gray-800 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none ml-2" type="button">
                        Adapt Response
                    </button>

                    <!-- Show the 'Save Notes' button only if the user is logged in -->
                    @auth
                    <button id="save-notes-btn" class="p-2 px-5 bg-black text-white rounded-lg hover:bg-gray-800">
                        Save Notes
                    </button>

                    @endauth
                </div>
            </div>

            <!-- Chatbox Container -->
            <div id="chat-container" class="flex-1 overflow-hidden p-4 bg-white-100 rounded-lg shadow-lg mb-4 flex flex-col">
                <!-- Message Container (scrollable when content overflows) -->
                <div id="messages" class="flex-1 overflow-y-auto space-y-8 flex flex-col h-[700px]">

                    <!-- Centered Loading GIF Container -->
                    <div id="loading-container" class="flex items-center justify-center h-full">
                        <div class="flex items-center space-x-4 p-4">
                            <!-- GIF on the Left -->
                            <img src="{{ asset('Hello.gif') }}" alt="Hello GIF" class="w-200 object-cover">

                            <!-- Text on the Right -->
                            <div class="p-20 text-lg font-semibold text-gray-600">
                                Wora is an innovative, AI-powered platform designed to empower content creators by offering a wide range of advanced tools for generating, editing, and adapting content. With Wora, creators can easily craft high-quality material tailored for multiple platforms, ensuring that their content is optimized for different audiences and formats. Whether you're creating articles, social media posts, or other digital content, Wora’s intuitive interface and smart features provide the flexibility and efficiency needed to streamline the content creation process. </div>
                        </div>

                    </div>

                    <!-- Chat messages will be appended here -->
                </div>
            </div>



            <!-- User Input Field -->
            <div class="flex mt-4">
                <input id="user-input" type="text" class="flex-1 p-3 text-gray-500 border rounded-lg mr-2 bg-white" placeholder="Type a message...">
                <button id="send-btn" class="p-3 bg-black text-white rounded-lg">Send</button>
            </div>
        </div>

        <!-- Content Component Section -->
        <div class="md:w-1/3 p-6 rounded-lg shadow-lg bg-black flex flex-col h-[750px] space-y-4 text-white" id="content-component">
    <h2 class="text-xl font-bold">Your Adaptations Come Here!</h2>

    <div id="adapted-content" class="mt-6 space-y-4">
        <!-- Instagram Box -->
        <div class="p-4 bg-gray-900 rounded-lg shadow-md max-h-[150px] overflow-y-auto relative">
            <div class="flex items-center justify-between mb-2">
                <h3 class="text-xl font-semibold text-white">Instagram</h3>
                <span class="pin"></span>
            </div>
            <p id="instagram-box" class="text-gray-300">
                Laravel and Tailwind CSS bring structure and style to Wora! With Laravel powering the backend and Tailwind making the UI clean and responsive, we focus on both functionality and aesthetics.
            </p>
        </div>

        <!-- Twitter Box -->
        <div class="p-4 bg-gray-900 rounded-lg shadow-md max-h-[150px] overflow-y-auto relative">
            <div class="flex items-center justify-between mb-2">
                <h3 class="text-xl font-semibold text-white">Twitter</h3>
                <span class="pin"></span>
            </div>
            <p id="twitter-box" class="text-gray-300">
                Wora uses Google Cloud's Vertex AI for dynamic content generation! This integration enables content creators to edit and adapt across platforms.
            </p>
        </div>

        <!-- LinkedIn Box -->
        <div class="p-4 bg-gray-900 rounded-lg shadow-md max-h-[100px] overflow-y-auto relative">
            <div class="flex items-center justify-between mb-2">
                <h3 class="text-xl font-semibold text-white">LinkedIn</h3>
                <span class="pin"></span>
            </div>
            <p id="linkedin-box" class="text-gray-300">
                Excited to share that Wora is built on MariaDB for data management! Using MariaDB ensures robust, scalable performance for all your content needs.
            </p>
        </div>

        <!-- Medium Box -->
        <div class="p-4 bg-gray-900 rounded-lg shadow-md max-h-[250px] overflow-y-auto relative">
            <div class="flex items-center justify-between mb-2">
                <h3 class="text-xl font-semibold text-white">Medium Blog</h3>
                <span class="pin"></span>
            </div>
            <p id="medium-box" class="text-gray-300">
                Wora combines Laravel, Tailwind, MariaDB, and Vertex AI to simplify cross-platform content generation! Check out our journey building a tool that empowers creators everywhere. Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ullam fuga minus delectus. Dolorem explicabo necessitatibus iusto, quibusdam blanditiis autem ducimus ea, assumenda dolor adipisci harum culpa ipsa, maxime quas repudiandae.
            </p>
        </div>

    </div>

</div>

<style>
      .pin {
        height: 12px;
        width: 12px;
        background-color: #ff6b35; /* Orange color */
        border-radius: 50%;
        display: inline-flex;
        justify-content: center;
        align-items: center;
        position: relative;
    }

    /* Inner black circle */
    .pin::after {
        content: '';
        height: 6px;
        width: 6px;
        background-color: #000000; /* Black color */
        border-radius: 50%;
        display: inline-block;
    }
</style>



    </div>



    <script>
        // Variable to store the last generated response from the chatbot
        let lastGeneratedResponse = '';

        // Scroll the chat container to the bottom after each new message
        function scrollToBottom() {
            const messageContainer = document.getElementById('messages');
            messageContainer.scrollTop = messageContainer.scrollHeight; // Scroll to the latest message
        }

        document.getElementById('send-btn').addEventListener('click', function() {
            let userInput = document.getElementById('user-input').value;
            if (userInput.trim() !== "") {
                // Add user message to the chat
                addMessage('You', userInput);

                // Clear the input field
                document.getElementById('user-input').value = '';

                // Send the message to the backend for AI response
                sendMessageToAI(userInput);
            }
        });

        // Function to hide the loading GIF container
        function hideLoadingGif() {
            const loadingContainer = document.getElementById('loading-container');
            if (loadingContainer) {
                loadingContainer.style.display = 'none';
            }
        }

        // Function to add message to the chat
        function addMessage(sender, text) {
            hideLoadingGif(); // Hide the loading GIF when the first message is added

            const messageContainer = document.getElementById('messages');
            const messageElement = document.createElement('div');
            messageElement.classList.add('p-2', 'rounded-lg', 'mb-2', 'max-w-2xl');

            if (sender === 'You') {
                messageElement.classList.add('bg-blue-200', 'text-blue-800', 'self-end');
            } else {
                messageElement.classList.add('bg-gray-300', 'text-gray-800', 'self-start');
            }

            messageElement.textContent = text;
            messageContainer.appendChild(messageElement);
            scrollToBottom(); // Ensure we scroll to the bottom after adding the message
        }


        // Function to send user input to the backend for AI response
        function sendMessageToAI(userMessage) {
            // Show typing indicator first
            addMessage('AI', 'Typing...');

            // Simulate sending a message to an AI service via AJAX
            fetch('/chatbot', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                    body: JSON.stringify({
                        message: userMessage
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.message) {
                        // Save the last response and display it
                        lastGeneratedResponse = data.message;
                        simulateTyping(data.message); // Simulate typing of the AI's message
                    } else {
                        addMessage('AI', "Sorry, I couldn't understand that.");
                    }
                })
                .catch(error => {
                    addMessage('AI', "An error occurred. Please try again.");
                });
        }

        // Simulate typing animation for AI's response
        function simulateTyping(message) {
            const messageContainer = document.getElementById('messages');
            const typingMessage = messageContainer.lastChild;

            // Clear "Typing..." message and start typing the actual response
            typingMessage.textContent = '';
            let index = 0;

            // Simulate typing with a delay between each character
            const interval = setInterval(() => {
                typingMessage.textContent += message[index];
                index++;

                // Stop when all characters are typed
                if (index === message.length) {
                    clearInterval(interval);
                }
            }, 30); // Adjust this interval to control typing speed
        }

        document.getElementById('adapt-btn').addEventListener('click', function() {
            if (lastGeneratedResponse.trim() === "") {
                alert("No content to adapt. Please generate content first.");
                return;
            }

            // Create the different adaptation requests for each platform
            const adaptationRequests = {
                instagram: `${lastGeneratedResponse} Make it informal and engaging for Instagram.`,
                twitter: `${lastGeneratedResponse} Make it short and punchy for Twitter.`,
                linkedin: `${lastGeneratedResponse} Make it formal for LinkedIn.`,
                medium: `${lastGeneratedResponse} Make it detailed and insightful for Medium.`,
            };

            // Send the requests for each platform to the backend
            fetch('/adapt-content', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                    body: JSON.stringify({
                        instagramMessage: adaptationRequests.instagram,
                        twitterMessage: adaptationRequests.twitter,
                        linkedinMessage: adaptationRequests.linkedin,
                        mediumMessage: adaptationRequests.medium,
                    })
                })
                .then(response => response.json())
                .then(data => {
                    // Log the server response to check what's returned
                    console.log('Adapt Content Response:', data);

                    if (data.error) {
                        // Display the error message returned from the server
                        alert(data.error);
                        return;
                    }

                    // Update content for each platform
                    updatePlatformContent('instagram-box', data.instagram);
                    updatePlatformContent('twitter-box', data.twitter);
                    updatePlatformContent('linkedin-box', data.linkedin);
                    updatePlatformContent('medium-box', data.medium);
                })
                .catch(error => {
                    console.error('Error occurred during adaptation:', error);
                    alert("An error occurred while adapting the content. Check the console for more details.");
                });
        });

        // Helper function to update platform content
        function updatePlatformContent(platformId, content) {
            const platformSection = document.getElementById(platformId);
            if (platformSection) {
                platformSection.textContent = content; // Update the content
            } else {
                console.error(`No content area found for platform: ${platformId}`);
            }
        }

        document.getElementById('save-notes-btn').addEventListener('click', function() {
            if (lastGeneratedResponse.trim() === "") {
                alert("No content to save. Please generate content first.");
                return;
            }

            // Send the last generated response to save as a note
            fetch('/save-notes', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                    body: JSON.stringify({
                        message: lastGeneratedResponse
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert("Note saved successfully!");
                    } else {
                        alert("An error occurred while saving the note.");
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert("An error occurred while saving the note.");
                });
        });
    </script>
</body>

</html>