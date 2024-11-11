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
        <div class="flex-1 md:w-2/3 bg-white p-6 rounded-lg shadow-lg h-[780px] flex flex-col">
            <!-- Flex container for header and button -->
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">What's on your mind?</h2>
                <div>
                    <button id="adapt-btn" class="p-2 px-5 bg-green-400 text-white rounded-lg hover:bg-green-600">
                        Adapt
                    </button>
                    <!-- Show the 'Save Notes' button only if the user is logged in -->
                    @auth
                    <button id="save-notes-btn" class="p-2 px-5 bg-yellow-400 text-white rounded-lg hover:bg-yellow-500">
                        Save Notes
                    </button>
                    @endauth
                </div>
            </div>

            <!-- Chatbox Container -->
            <div id="chat-container" class="flex-1 overflow-hidden p-4 bg-gray-100 rounded-lg w shadow-lg mb-4 flex flex-col">
                <!-- Message Container (scrollable when content overflows) -->
                <div id="messages" class="flex-1 overflow-y-auto space-y-8 flex flex-col h-[700px]">
                    <!-- Messages will be displayed here -->
                </div>
            </div>

            <!-- User Input Field -->
            <div class="flex mt-4">
                <input id="user-input" type="text" class="flex-1 p-3 border rounded-lg mr-2 bg-white" placeholder="Type a message...">
                <button id="send-btn" class="p-3 bg-blue-500 text-white rounded-lg">Send</button>
            </div>
        </div>

        <!-- Content Component Section -->
        <div class="md:w-1/3 p-6 rounded-lg shadow-lg bg-white flex flex-col space-y-4" id="content-component">
            <div id="adapted-content" class="mt-6 space-y-4">
                <!-- Instagram Box -->
                <div class="p-4 bg-gray-100 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold mb-2">Instagram</h3>
                    <p id="instagram-box" class="text-gray-700">Check out this amazing view from the top of the mountains! The sunrise was breathtaking, and I couldn't resist capturing the moment. #MountainViews #Sunrise #Adventure</p>
                </div>

                <!-- Twitter Box -->
                <div class="p-4 bg-gray-100 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold mb-2">Twitter</h3>
                    <p id="twitter-box" class="text-gray-700">Just finished an incredible book on productivity! Highly recommend "Atomic Habits" to anyone looking to improve their daily routines. #Books #Productivity #SelfImprovement</p>
                </div>

                <!-- LinkedIn Box -->
                <div class="p-4 bg-gray-100 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold mb-2">LinkedIn</h3>
                    <p id="linkedin-box" class="text-gray-700">Excited to announce that I’ve completed my certification in Web Development! Looking forward to new opportunities and challenges in the tech world. #WebDevelopment #Certifications #CareerGrowth</p>
                </div>

                <!-- Medium Box -->
                <div class="p-4 bg-gray-100 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold mb-2">Medium Blog</h3>
                    <p id="medium-box" class="text-gray-700">In today’s blog post, I dive deep into the concept of "Digital Minimalism" and how it has transformed the way I approach technology in my personal and professional life. #DigitalMinimalism #Productivity #TechLifestyle</p>
                </div>
            </div>
        </div>
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

        // Function to add message to the chat
        function addMessage(sender, text) {
            const messageContainer = document.getElementById('messages');
            const messageElement = document.createElement('div');
            messageElement.classList.add('p-2', 'rounded-lg', 'mb-2', 'max-w-2xl'); // Changed max-w-xs to max-w-lg

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