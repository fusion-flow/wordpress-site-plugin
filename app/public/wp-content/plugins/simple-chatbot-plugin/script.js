// script.js
jQuery(document).ready(function ($) {
    const $chatbotMessages = $('#chatbot-messages');
    const $userInput = $('#user-input');
    const $sendBtn = $('#send-btn');

    $sendBtn.on('click', function () {
        const userMessage = $userInput.val();
        if (userMessage.trim() !== '') {
            appendMessage('user', userMessage);
            // Send the user message to your backend for processing
            // You can use AJAX or any other method to communicate with the server
            // Example: $.post('your-backend-endpoint', { message: userMessage }, handleResponse);
            $userInput.val(''); // Clear user input
        }
    });

    // Function to append a message to the chatbot interface
    function appendMessage(sender, message) {
        const messageClass = sender === 'user' ? 'user-message' : 'chatbot-message';
        const formattedMessage = `<div class="${messageClass}">${message}</div>`;
        $chatbotMessages.append(formattedMessage);
        $chatbotMessages.scrollTop($chatbotMessages[0].scrollHeight); // Auto-scroll to the bottom
    }
});
