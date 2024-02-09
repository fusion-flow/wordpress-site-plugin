<?php
/*
Plugin Name: FusionFlow Chatbot 6
Description: Chatbot to help people with Aphasia
Version: 1.0
Author: FusionFlow
*/




// Add chatbot icon HTML, CSS, and JavaScript
function add_chatbot_icon()
{
    
?>  
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"> -->
        <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.7.4/socket.io.js"></script>
        <!-- <script src="/socket.io/socket.io.js"></script> -->
    </head>
    <body>
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
                        <img id="record" src="{{ url_for('static', filename='audio/mic128.png') }}" onclick="toggleRecording(this);">                 
                    </div>
                    <button onclick="playRecording()">Play</button>
                        <audio id="audioPlayer" controls></audio>
                        <video id="videoPlayer" controls></video>
                </div>
            </div>
        </div>
    </body>
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

        // $(document).ready(function() {
            const socket = io('http://localhost:5000');

            console.log(socket);
            // Event handler for connection
            socket.on('connect', function() {
                console.log('Connected to the server');
            });

            // Event handler for disconnection
            socket.on('disconnect', function() {
                console.log('Disconnected from the server');
            });
                
        //     // sending a connect request to the server.
        //     var socket = io.connect('http://localhost:5000');
        
        //     // An event handler for a change of value 
        //     $('input.sync').on('input', function(event) {
        //         socket.emit('Slider value changed', {
        //             who: $(this).attr('id'),
        //             data: $(this).val()
        //         });
        //         return false;
        //     });
        
        //     socket.on('after connect', function(msg) {
        //         console.log('After connect', msg);
        //     });
        
        //     socket.on('update value', function(msg) {
        //         console.log('Slider value updated');
        //         $('#' + msg.who).val(msg.data);
        //     });
        // });

        // const socket = io('http://localhost:5000');

        // // Event handler for connection
        // socket.on('connect', function() {
        //     console.log('Connected to the server');
        // });

        // // Event handler for disconnection
        // socket.on('disconnect', function() {
        //     console.log('Disconnected from the server');
        // });

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

        socket.on("response", (message)=>{
            console.log(message);
            

            // get the number of intents
            let num_intents = Object.keys(message).length;

            if(num_intents == 1) {
                let intent = Object.keys(message)[0];
                let url = message[intent];

                 // Create a SpeechSynthesisUtterance
                const utterance = new SpeechSynthesisUtterance(intent);
                // Select a voice
                const voices = speechSynthesis.getVoices();
                utterance.voice = voices[0]; // Choose a specific voice

                // Speak the text
                speechSynthesis.speak(utterance);

                window.location.assign(url);
            } else if(num_intents == 0) {
                var chatInput = document.getElementById('chat-input');
                var chatMessages = document.getElementById('chat-messages');
                chatMessages.innerHTML += '<p>Alex: Couldn\'t found the page</p>';

                // Create a SpeechSynthesisUtterance
                 const utterance = new SpeechSynthesisUtterance("Couldn't found the page");
                // Select a voice
                const voices = speechSynthesis.getVoices();
                utterance.voice = voices[0]; // Choose a specific voice

                // Speak the text
                speechSynthesis.speak(utterance);
            } else {
                var chatInput = document.getElementById('chat-input');
                var chatMessages = document.getElementById('chat-messages');
                chatMessages.innerHTML += '<p>Alex: Following are the pages found</p>';
                let chatbot_response = "Pages I found are ";

                for(let intent in message) {
                    if(message.hasOwnProperty(intent)) {
                        let url = message[intent];
                        chatMessages.innerHTML += '<p><a href="' + url + '">' + intent + '</a></p>';
                        chatbot_response += intent;
                    }
                }

                // Create a SpeechSynthesisUtterance
                const utterance = new SpeechSynthesisUtterance(chatbot_response);
                // Select a voice
                const voices = speechSynthesis.getVoices();
                utterance.voice = voices[0]; // Choose a specific voice

                // Speak the text
                speechSynthesis.speak(utterance);
            }
            
        });

        function sendMessage() {
            var chatInput = document.getElementById('chat-input');
            var message = chatInput.value;

            if (message.trim() !== '') {
                var chatMessages = document.getElementById('chat-messages');
                chatMessages.innerHTML += '<p>User: ' + message + '</p>';
                // chatMessages.innerHTML += '<a href="http://fusionflow2.local/resource-categories/communication-support/">Communication Supprot</a>'
                // Using window.location.assign()
                // window.location.assign("http://fusionflow2.local/resource-categories/communication-support/");
                // Add logic here to process the user's message and get a response from the chatbot
                // For now, let's simulate a simple response from the chatbot

                // send message to backend through a websocket
                socket.emit("message", message);

                
                // Save conversation history to localStorage
                localStorage.setItem('chatHistory', JSON.stringify(message));

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
                    console.log(audioBlob);
                    console.log(audioUrl);
                    socket.emit("audio_message", audioBlob);

                    socket.on("audio_message", (audio_message)=>{
                        console.log(audio_message)
                    });

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