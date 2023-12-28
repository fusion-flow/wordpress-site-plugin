<?php
/*
Plugin Name: FusionFlow Chatbot
Description: Chatbot to help people with Aphasia
Version: 1.0
Author: FusionFlow
*/

// Add chatbot icon HTML, CSS, and JavaScript
function add_chatbot_icon()
{
?>
    <div class="chatbot-container">
        <div class="chatbot-icon" id="chatbot-icon" onclick="hideChatbotIcon()">
            <img src="http://fusionflow2.local/wp-content/uploads/2023/12/chatbot.png" alt="Chatbot Icon">
        </div>
        <div class="chatbox" id="chatbox" style="display: none;">
            <div class="chatbox-header">
                <span onclick="toggleChatbox()">Close</span>
            </div>
            <div class="chatbox-content">
                <div id="chat-messages"></div>
                <div class="chat-input-container">
                    <input type="text" id="chat-input" placeholder="Type your message...">
                    <button onclick="sendMessage()">Send</button>
                </div>
            </div>
        </div>
    </div>
    <style>
        .chatbot-container {
            position: fixed;
            bottom: 20px;
            right: 20px;
            display: flex;
            flex-direction: column;
        }

        .chatbot-icon {
            cursor: pointer;
        }

        .chatbox {
            background-color: #fff;
            border: 1px solid #ccc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 10px;
            max-width: 300px;
            /* Set a maximum width for the chatbox */
        }

        .chatbox-header {
            background-color: #f1f1f1;
            padding: 10px;
            display: flex;
            justify-content: flex-end;
        }

        .chatbox-header span {
            cursor: pointer;
        }

        .chatbox-content {
            display: flex;
            flex-direction: column;
        }

        #chat-messages {
            margin-bottom: 10px;
            padding: 10px;
            overflow-y: auto;
            max-height: 200px;
            /* Set a maximum height for the chat messages */
        }

        .chat-input-container {
            display: flex;
            padding: 10px;
        }

        #chat-input {
            flex: 1;
            margin-right: 10px;
        }

        .chatbot-icon img {
            width: 70px;
            height: 70px;
        }
    </style>
    <script>
        function hideChatbotIcon() {
            var chatbotIcon = document.getElementById('chatbot-icon');
            chatbotIcon.style.display = 'none';

            var chatbox = document.getElementById('chatbox');
            chatbox.style.display = 'block';
        }

        function toggleChatbox() {
            var chatbox = document.getElementById('chatbox');
            var chatbotIcon = document.getElementById('chatbot-icon');

            if (chatbox.style.display === 'none' || chatbox.style.display === '') {
                chatbox.style.display = 'block';
                chatbotIcon.style.display = 'none';
            } else {
                chatbox.style.display = 'none';
                chatbotIcon.style.display = 'block';
            }
        }

        function sendMessage() {
            var chatInput = document.getElementById('chat-input');
            var message = chatInput.value;

            if (message.trim() !== '') {
                var chatMessages = document.getElementById('chat-messages');
                chatMessages.innerHTML += '<p>User: ' + message + '</p>';

                // Add logic here to process the user's message and get a response from the chatbot
                // For now, let's simulate a simple response from the chatbot

                // Clear the input field
                chatInput.value = '';
            }
        }
    </script>
<?php
}

// Hook the function to wp_footer to add the icon and chatbox to the footer of each page
add_action('wp_footer', 'add_chatbot_icon');
?>