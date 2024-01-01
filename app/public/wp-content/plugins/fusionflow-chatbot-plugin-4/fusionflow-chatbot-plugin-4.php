<?php
/*
Plugin Name: FusionFlow Chatbot 4
Description: Chatbot to help people with Aphasia
Version: 1.0
Author: FusionFlow
*/

if (!session_id()) {
    session_start();
}

// Add chatbot icon HTML, CSS, and JavaScript
function add_chatbot_icon()
{

    // Check if the chatbox is hidden in the session storage
    $chatboxHidden = isset($_SESSION['chatbox_hidden']) ? $_SESSION['chatbox_hidden'] : 'false';
?>
    <div class="chatbot-container">
        <div class="chatbot-icon" id="chatbot-icon" <?php echo $chatboxHidden === 'true' ? 'style="display:none;"' : ''; ?>  onclick="hideChatbotIcon()">
            <img src="http://fusionflow2.local/wp-content/uploads/2023/12/chatbot.png" alt="Chatbot Icon">
        </div>
        <div class="chatbox" id="chatbox" <?php echo $chatboxHidden === 'true' ? '' : 'style="display:none;"'; ?>>
            <div class="chatbox-header">
                <h3>Message Us</h3>
                <p onclick="toggleChatbox()">x</p>
            </div>
            <div class="chatbox-body">
                <div id="chat-messages">
                    <div class="chatbox-body-send">
                        <p>This is my message.</p>
                        <span>12:00</span>
                    </div>
                    <div class="chatbox-body-receive">
                        <p>This is my message.</p>
                        <span>12:00</span>
                    </div>
                </div>
                <div class="chat-input-container chatbox-footer">
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
            /* margin-top: 10px; */
            /* max-width: 300px; */
            height: 90%;
            width: 400px;
            /* position: absolute; */
            margin: 0 auto;
            overflow: hidden;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex; 
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
            z-index: 15;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.005);
            right: 0;
            bottom: 0;
            margin: 15px;
            background: #fff;
            border-radius: 15px;
            /* visibility: hidden; */
            &-header {
                height: 8%;
                border-top-left-radius: 15px;
                border-top-right-radius: 15px;
                display: flex;
                font-size: 14px;
                padding: 0.5em 0;
                box-shadow: 0 0 3px rgba(0, 0, 0, 0.2);
                box-shadow: 0 0 3px rgba(0, 0, 0, 0.2),
                    0 -1px 10px rgba(172, 54, 195, 0.3);
                box-shadow: 0 1px 10px rgba(0, 0, 0, 0.025);
                & h3 {
                    font-family: ubuntu;
                    font-weight: 400;
                    float: left;
                    position: absolute;
                    left: 25px; 
                }
                & p {
                    float: right;
                    position: absolute;
                    right: 16px;
                    cursor: pointer;
                    height: 50px;
                    width: 50px;
                    text-align: center;
                    line-height: 3.25;
                    margin: 0;
                }
            }
            &-body {
                height: 75%;
                background: #f8f8f8;
                overflow-y: scroll;
                padding: 12px;
                &-send {
                    width: 250px;
                    float: right;
                    background: white;
                    padding: 10px 20px;
                    border-radius: 5px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.015);
                    margin-bottom: 14px;
                    & p {
                        margin: 0;
                        color: #444;
                        font-size: 14px;
                        margin-bottom: 0.25rem;
                    }
                    & span {
                        float: right;
                        color: #777;
                        font-size: 10px;
                    }
                }
                &-receive {
                    width: 250px;
                    float: left;
                    background: white;
                    padding: 10px 20px;
                    border-radius: 5px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.015);
                    margin-bottom: 14px;
                    & p {
                        margin: 0;
                        color: #444;
                        font-size: 14px;
                        margin-bottom: 0.25rem;
                    }
                    & span {
                        float: right;
                        color: #777;
                        font-size: 10px;
                    }
                }
                &::-webkit-scrollbar {
                    width: 5px;
                    opacity: 0;
                }
            }
            &-footer {
                position: relative;
                display: flex;
                & button {
                    border: none;
                    padding: 16px;
                    font-size: 14px;
                    background: white;
                    cursor: pointer;
                    &:focus {
                        outline: none;
                    }
                }
                & input {
                    padding: 10px;
                    border: none;
                    -webkit-appearance: none;
                    border-radius: 50px;
                    background: whitesmoke;
                    margin: 10px;
                    font-family: ubuntu;
                    font-weight: 600;
                    color: #444;
                    width: 280px;
                    &:focus {
                        outline: none;
                    }
                }
                & .send {
                    vertical-align: middle;
                    align-items: center;
                    justify-content: center;
                    transform: translate(0px, 20px);
                    cursor: pointer;
                }
            } 
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

        .chatbox-body {
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

        .chat-button {
            padding: 25px 16px;
            background: #2C50EF;
            width: 120px;
            position: absolute;
            bottom: 0;
            right: 0;
            margin: 15px;
            border-top-left-radius: 25px;
            border-top-right-radius: 25px;
            border-bottom-left-radius: 25px;
            box-shadow: 0 2px 15px rgba(#2C50EF, 0.21);
            cursor: pointer;
            & span {
                &::before {
                    content: "";
                    height: 15px;
                    width: 15px;
                    background: #47cf73;
                    position: absolute;
                    transform: translate(0, -7px);
                    border-radius: 15px;
                }
                &::after {
                    content: "Message Us";
                    font-size: 14px;
                    color: white;
                    position: absolute;
                    left: 50px;
                    top: 18px;
                }
            }
        }
        .modal {
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            opacity: 0;
            visibility: hidden;
            transform: scale(1.1);
            transition: visibility 0s linear 0.25s, opacity 0.25s 0s, transform 0.25s;
        }
        .modal-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 1rem 1.5rem;
            width: 24rem;
            border-radius: 0.5rem;
        }
        .modal-close-button {
            float: right;
            width: 1.5rem;
            line-height: 1.5rem;
            text-align: center;
            cursor: pointer;
            border-radius: 0.25rem;
            background-color: lightgray;
        }
        .close-button:hover {
            background-color: darkgray;
        }
        .show-modal {
            opacity: 1;
            visibility: visible;
            transform: scale(1);
            transition: visibility 0s linear 0s, opacity 0.25s 0s, transform 0.25s;
            z-index: 30;
        }
        @media only screen and(max-width: 450px) {
            .chatbox {
                min-width: 100% !important;
            }
        }
    </style>
    <script>
        // Update session storage when the chatbox is hidden or shown
        function updateChatboxState(hidden) {
            <?php $_SESSION['chatbox_hidden'] = "' + hidden + '"; ?>;
        }

        function hideChatbotIcon() {
            var chatbotIcon = document.getElementById('chatbot-icon');
            chatbotIcon.style.display = 'none';

            var chatbox = document.getElementById('chatbox');
            chatbox.style.display = 'block';

            // Update session storage
            updateChatboxState(true);
        }

        function toggleChatbox() {
            var chatbox = document.getElementById('chatbox');
            var chatbotIcon = document.getElementById('chatbot-icon');

            if (chatbox.style.display === 'none' || chatbox.style.display === '') {
                chatbox.style.display = 'block';
                chatbotIcon.style.display = 'none';

                // Update session storage
                updateChatboxState(true);
            } else {
                chatbox.style.display = 'none';
                chatbotIcon.style.display = 'block';

                // Update session storage
                updateChatboxState(false);
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