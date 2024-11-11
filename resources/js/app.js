import './bootstrap';

// Frontend JavaScript (handling response for all platforms)
fetch('/adapt-content', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
    },
    body: JSON.stringify({
        message: lastGeneratedResponse // Your message input
    })
})
.then(response => response.json())  // Get the response as JSON
.then(data => {
    if (data.error) {
        alert(data.error);  // Show error if response contains an error message
        return;
    }

    // Ensure content for all platforms is processed
    const platforms = ['instagram', 'twitter', 'linkedin', 'medium'];
    platforms.forEach(platform => {
        const platformBox = document.getElementById(`${platform}-box`);  // Match box ID with platform
        if (platformBox && data[platform]) {
            platformBox.textContent = data[platform];  // Update the content of the respective platform box
        } else {
            console.warn(`No content for platform: ${platform}-box`);  // Warn if no content is found
        }
    });
})
.catch(error => {
    console.error('Error:', error);
    alert("An error occurred while adapting the content.");
});
