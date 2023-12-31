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
                    <!-- Place these elements wherever you want the audio recorder to appear -->
                    <button id="togglebtn" onclick="toggleRecord()">Start</button>                   
                </div>
                <button onclick="playRecording()">Play</button>
                    <audio id="audioPlayer" controls></audio>
                    <video id="videoPlayer" controls></video>
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

        let mediaRecorder;
        let audioChunks = [];
        let videoChunks = [];
        let isRecording = false;
        const toggleBtn = document.getElementById('togglebtn');
        
        function toggleRecord(){
            console.log("record toggled, is recording", isRecording);
            if (isRecording) {
                stopRecording();
                toggleBtn.innerText = "Start";
            } else {
                startRecording();
                toggleBtn.innerText = "Stop";
            }
        }

        function startRecording() {
            console.log("Recording Started")
        navigator.mediaDevices.getUserMedia({ audio: true, video: true })
            .then(stream => {
                mediaRecorder = new MediaRecorder(stream);
                mediaRecorder.ondataavailable = event => {
                    if (event.data.size > 0) {
                        audioChunks.push(event.data);
                        videoChunks.push(event.data);
                    }
                };

                mediaRecorder.onstop = () => {
                    const audioBlob = new Blob(audioChunks, { type: 'audio/wav' });
                    const audioUrl = URL.createObjectURL(audioBlob);
                    audioPlayer.src = audioUrl;
                    const videoBlob = new Blob(videoChunks, { type: 'video/webm' });
                    const videoUrl = URL.createObjectURL(videoBlob);
                    videoPlayer.src = videoUrl;
                    isRecording = false;
                };

                mediaRecorder.start();
                isRecording = true;
                console.log(" is recording", isRecording);
            })
            .catch(error => {
                console.error('Error accessing microphone:', error);
            });
    }
    function stopRecording() {
        console.log("Recording Stopped")
        if (mediaRecorder && mediaRecorder.state === 'recording') {
            mediaRecorder.stop();
        }
    }

    function playRecording() {
        if (audioPlayer.src) {
            audioPlayer.play();
        }
        if (videoPlayer.src) {
            videoPlayer.play();
        }
    }
    </script>
<?php
}

function audio_recorder_enqueue_scripts() {
    wp_enqueue_script('audio-recorder-script', plugin_dir_url(__FILE__) . 'js/audio-recorder.js', array('jquery'), '1.0', true);
}

// Hook the function to wp_footer to add the icon and chatbox to the footer of each page
add_action('wp_footer', 'add_chatbot_icon');
add_action('wp_enqueue_scripts', 'audio_recorder_enqueue_scripts');
?>