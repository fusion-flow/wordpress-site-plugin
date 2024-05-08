<?php
/*
Plugin Name: FusionFlow Chatbot 5
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
                    <span>Flow</span>
                    <span onclick="toggleChatbox()" style="cursor: pointer; font-size: 24px;">&times;</span>
                </div>
                <div class="chatbox-content">
                    <div id="chat-messages"></div>
                    <div class="chat-input-container">
                        <input type="text" id="chat-input" placeholder="Type your message...">
                        <button onclick="sendMessage()">Send</button>
                        <!-- Place these elements wherever you want the audio recorder to appear -->
                        <button id="togglebtn" onclick="toggleRecord()">Record</button>  
                        <!-- <img id="record" src="{{ url_for('static', filename='audio/mic128.png') }}" onclick="toggleRecording(this);">                  -->
                    </div>
                    <!-- <button onclick="playRecording()">Play</button> -->
                        <!-- <audio id="audioPlayer", display="none" controls></audio> -->
                        <video id="videoPlayer" controls autoplay></video>
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
            width: 400px;
            /* Set a maximum width for the chatbox */
        }

        /* .chatbox-header {
            background-color: #f1f1f1;
            padding: 10px;
            display: flex;
            justify-content: flex-end;
        } */

        .chatbox-header span {
            cursor: pointer;
        }

        .chatbox-header {
            background-color: #f1f1f1;
            padding: 10px;
            display: flex;
            justify-content: space-between; /* Add this line */
            align-items: center; /* Add this line */
        }

        .chatbox-header span:first-child {
            font-weight: bold; /* Add this line */
            font-size: 18px; /* Add this line */
        }
        .chatbox-content {
            display: flex;
            flex-direction: column;
        }

        #chat-messages {
            /* margin-bottom: 10px;
            padding: 10px;
            overflow-y: auto;
            max-height: 200px;
            Set a maximum height for the chat messages */
            /* display: flex;
            flex-direction: column;
            margin-bottom: 10px;
            overflow-y: auto;
            max-height: 200px;
            padding: 10px; */
            display: flex;
            flex-direction: column;
            margin-bottom: 10px;
            overflow-y: auto;
            max-height: 400px; /* Increase the value to make the chatbot height more */
            padding: 10px;
        }

        .chat-input-container {
            display: flex;
            padding: 10px;
        }
       
        #chat-input {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            width: 70%;
            box-sizing: border-box;
        }

        /* Style the Send and Record buttons */
        .chat-input-container button {
            background-color: #4CAF50;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-left: 8px;
        }

        /* Add hover effect to the buttons */
        .chat-input-container button:hover {
            background-color: #3e8e41;
        }

        /* #chat-input {
            flex: 1;
            margin-right: 10px;
        } */

        .chatbot-icon img {
            width: 70px;
            height: 70px;
        }

        #videoPlayer{
            display:none;
        }


        .user-message {
            align-self: flex-end;
            background-color: #b9f18e;
            border-radius: 10px;
            padding: 8px 12px;
            margin-bottom: 10px;
            max-width: 70%;
            /* margin-top: 10px; */
        }

        .chatbot-message {
            align-self: flex-start;
            background-color: #e5e5ea;
            border-radius: 10px;
            padding: 8px 12px;
            margin-bottom: 10px;
            max-width: 70%;
            /* margin-top: 10px; */
        }

        .chatbot-message button a {
        text-decoration: none;
        }

        .chatbot-message button {
            background-color: #87CEEB; /* Green background */
            border: none;
            color: white; /* White text */
            padding: 8px 16px; /* Some padding */
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 4px; /* Rounded corners */
            width: 100%;
        }

    </style>
    <script>

        // $(document).ready(function() {
            const socket = io('http://localhost:5000');

            // console.log(socket);
            // Event handler for connection
            socket.on('connect', function() {
                console.log('Connected to the server');
            });

            // Event handler for disconnection
            socket.on('disconnect', function() {
                console.log('Disconnected from the server');
            });

        // retrieve data in sessionStorage
        var existingData = JSON.parse(sessionStorage.getItem('chatHistory')) || [];

        function hideChatbotIcon() {
            loadMessages();
            var chatbotIcon = document.getElementById('chatbot-icon');
            chatbotIcon.style.display = 'none';

            var chatbox = document.getElementById('chatbox');
            chatbox.style.display = 'block';
        }

        function toggleChatbox() {
            loadMessages();
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

            chatbot_state = message.state
            response = message.response
            intent_url_mapping = message.intent_url_mapping

            console.log("chatbot_state", chatbot_state)
            console.log("response ", response)
            console.log("intent_url_mapping", intent_url_mapping)

            if (chatbot_state == "navigation_list"){
                startRecordingVideo().then(({ videostream, captureInterval }) => {
                // Set a timeout to stop the recording after 10 seconds (10000 milliseconds)
                    setTimeout(() => {
                        stopRecordingVideo(videostream, captureInterval);
                    }, 8000);
                });
            }

            if (chatbot_state != "navigation_list" && isRecordingVideo){
                stopRecordingVideo(globalStream, captureInterval);
            }

        
            // get the number of intents
            // let num_intents = Object.keys(intents).length;

            if(chatbot_state == "direct_navigation") {
                let intent = Object.keys(intent_url_mapping)[0];
                let url = intent_url_mapping[intent];

                //append the message to the session Storage
                existingData.push("Flow :", intent);
                // Save conversation history to session Storage
                sessionStorage.setItem('chatHistory', JSON.stringify(existingData));

                // Create a SpeechSynthesisUtterance
                const utterance = new SpeechSynthesisUtterance(intent);
                // Select a voice
                const voices = speechSynthesis.getVoices();
                utterance.voice = voices[0]; // Choose a specific voice

                // Set the rate to slow down the speech
                utterance.rate = 0.5; // Adjust this value to slow down further if needed

                // Speak the text
                speechSynthesis.speak(utterance);

                window.location.assign(url);

            } else if(chatbot_state == "navigation_list"){

                var chatMessages = document.getElementById('chat-messages');
                var chatbotMessageBubble = document.createElement('div');
                // console.log("chat", chatbot_response);
                // chatbotMessageBubble.textContent = chatbot_response;
                chatbotMessageBubble.classList.add('chatbot-message');
                chatMessages.appendChild(chatbotMessageBubble);
                

                // var chatInput = document.getElementById('chat-input');
                // var chatMessages = document.getElementById('chat-messages');
                // chatMessages.innerHTML += '<p>Alex: ' + response + '</p>';

                let chatbot_response = "Pages I found are </br>";
                let temp = "Pages I found are </br>"

                for(let intent in intent_url_mapping) {
                    if(intent_url_mapping.hasOwnProperty(intent)) {
                        let url = intent_url_mapping[intent];
                        const intentLink = '<button><a href="' + url + '">' + intent + '</a></button>';
                        chatbot_response += intentLink + "</br>";

                        // const intentLinkBubble = document.createElement('div');
                        // intentLinkBubble.innerHTML = '<p>' + intentLink + '</p>';
                        // intentLinkBubble.classList.add('chatbot-message');
                        // chatMessages.appendChild(intentLinkBubble);
                    }
                }

                chatbotMessageBubble.innerHTML = chatbot_response;

                existingData.push("Flow:" + chatbotMessageBubble.innerHTML);
                // Save conversation history to session Storage
                sessionStorage.setItem('chatHistory', JSON.stringify(existingData));

                // Create a SpeechSynthesisUtterance
                const utterance = new SpeechSynthesisUtterance(chatbot_response);
                // Select a voice
                const voices = speechSynthesis.getVoices();
                utterance.voice = voices[0]; // Choose a specific voice

                // Set the rate to slow down the speech
                utterance.rate = 0.5; // Adjust this value to slow down further if needed

                // Speak the text
                speechSynthesis.speak(utterance);
            } else {
                var chatMessages = document.getElementById('chat-messages');
                var chatbotMessageBubble = document.createElement('div');
                chatbotMessageBubble.textContent = response;
                chatbotMessageBubble.classList.add('chatbot-message');
                chatMessages.appendChild(chatbotMessageBubble);

                //append the message to the session Storage
                existingData.push("Flow:" + chatbotMessageBubble.textContent);
                // Save conversation history to session Storage
                sessionStorage.setItem('chatHistory', JSON.stringify(existingData));

                // Create a SpeechSynthesisUtterance
                 const utterance = new SpeechSynthesisUtterance(response);
                // Select a voice
                const voices = speechSynthesis.getVoices();
                utterance.voice = voices[0]; // Choose a specific voice

                // Set the rate to slow down the speech
                utterance.rate = 0.5; // Adjust this value to slow down further if needed

                // Speak the text
                speechSynthesis.speak(utterance);
            }
            
        });

        function loadMessages(){
            var chatMessages = document.getElementById('chat-messages');
            chatMessages.innerHTML = '';
            
            var conversation = JSON.parse(sessionStorage.getItem('chatHistory')) || [];
            conversation.forEach(function(message) {
                if (typeof message === 'string'){
                    console.log("message load", message);
                    var messageParts = message.split(':');
                    var sender = messageParts[0].trim();
                    var content = messageParts.slice(1).join(':').trim();

                    var messageBubble = document.createElement('div');
                    messageBubble.innerHTML=  content;

                    if (sender === 'Flow') {
                        messageBubble.classList.add('chatbot-message');
                    } else {
                        messageBubble.classList.add('user-message');
                    }

                    chatMessages.appendChild(messageBubble);
                }
            });
        }
        // function loadMessages(){
        //     var chatMessages = document.getElementById('chat-messages');
        //     var conversation = JSON.parse(sessionStorage.getItem('chatHistory')) || [];
        //     conversation.forEach(function(message){
        //         chatMessages.innerHTML += '<p>' + message + '</p>';
        //     });
        // }
        

        function sendMessage() {
            if (isRecording) {
                stopRecording();
                toggleRecord();
            } else {
                var chatInput = document.getElementById('chat-input');
                var chatMessages = document.getElementById('chat-messages');
                var userMessage = chatInput.value.trim();
                console.log("User message", userMessage);


                if (userMessage) {
                    console.log("inside");
                    var userMessageBubble = document.createElement('div');
                    userMessageBubble.textContent = userMessage;
                    userMessageBubble.classList.add('user-message');
                    chatMessages.appendChild(userMessageBubble);

                    // var conversation = JSON.parse(sessionStorage.getItem('chatbot_conversation')) || [];
                    // conversation.push({message: message, sender: 'user'});
                    // sessionStorage.setItem('chatbot_conversation', JSON.stringify(conversation));
                    
                    // chatMessages.innerHTML += '<a href="http://fusionflow2.local/resource-categories/communication-support/">Communication Supprot</a>'
                    // Using window.location.assign()
                    // window.location.assign("http://fusionflow2.local/resource-categories/communication-support/");
                    // Add logic here to process the user's message and get a response from the chatbot
                    // For now, let's simulate a simple response from the chatbot

                    // send message to backend through a websocket
                    socket.emit("message", userMessage);

                    //append the message to the session Storage
                    existingData.push("User :"+ userMessage);
                    // Save conversation history to session Storage
                    sessionStorage.setItem('chatHistory', JSON.stringify(existingData));

                    // Clear the input field
                    chatInput.value = '';
                }
            }
        }

        const toggleBtn = document.getElementById('togglebtn');
        let isRecording = false;
        let audioMediaRecorder, videoMediaRecorder;
        const chunkSize = 1024 * 1024;

        // function recordVideo() {}
        
        function toggleRecord(){
            if (isRecording) {
                isRecording = false;
                // stopRecording();
                toggleBtn.style.visibility = "visible";
                toggleBtn.innerText = "Record";
            } else {
                isRecording = true;
                startRecordingAudio();
                // startRecordingVideo();
                // toggleBtn.style.visibility = "hidden";
                toggleBtn.innerText = "Cancel";
            }
            console.log("record toggled, is recording", isRecording);
        }

        function startRecordingAudio() {
            console.log("Audio Recording Started")
            navigator.mediaDevices.getUserMedia({audio: true})
                .then(audiostream => {
                    let audioChunks = [];
                    audioMediaRecorder = new MediaRecorder(audiostream);
                    audioMediaRecorder.ondataavailable = event => {
                        if (event.data.size > 0) {
                            audioChunks.push(event.data);
                        }
                    };

                    audioMediaRecorder.onstop = () => {
                        // if (toggleBtn.innerText == "Record"){
                        //     console.log(toggleBtn.innerText)
                        //     isRecording = false;
                        //     console.log("audio sending cancelled")
                        //     return;
                        // }
                        // console.log(toggleBtn.innerText)
                        const audioBlob = new Blob(audioChunks, { type: 'audio/wav' });
                        var chatInput = document.getElementById('chat-input');
                        var message = chatInput.value;
                        var chatMessages = document.getElementById('chat-messages');
                        
                        // Create a chat bubble for the user's text message
                        var userMessageBubble = document.createElement('div');
                        userMessageBubble.classList.add('user-message');
                        userMessageBubble.textContent = message;
                        chatMessages.appendChild(userMessageBubble);
                        
                        chatInput.value = '';


                        //append the message to the session Storage
                        existingData.push("User :"+ message);
                        // Save conversation history to session Storage
                        sessionStorage.setItem('chatHistory', JSON.stringify(existingData));

                        // // Create a chat bubble for the audio recording
                        // var audioMessageBubble = document.createElement('div');
                        // audioMessageBubble.classList.add('user-message');
                        // var audioPlayer = document.createElement('audio');
                        // audioPlayer.src = URL.createObjectURL(audioBlob);
                        // audioPlayer.controls = true;
                        // audioMessageBubble.appendChild(audioPlayer);
                        // chatMessages.appendChild(audioMessageBubble);

                        // chatMessages.innerHTML += '<p>User: ' + message + '</p>';
                        // // socket.emit("message", message);
                        json_ = {"message": message, "audio": audioBlob}
                        console.log("Audio message sent")
                        socket.emit("audio_message", json_);
                        // const totalChunks = Math.ceil(audioBlob.size / chunkSize);
                        // console.log("Total chunks", totalChunks, "out of ", audioBlob.size, "chunks");

                        // for (let i = 0; i < totalChunks; i++) {
                        //     const start = i * chunkSize;
                        //     const end = Math.min(start + chunkSize, audioBlob.size);
                        //     const chunk = audioBlob.slice(start, end);
                        //     console.log("audio message")
                        //     
                        // }

                        // socket.on("audio_message", (audio_message)=>{
                        //     console.log(audio_message)
                        // });
                        isRecording = false;
                    };

                    audioMediaRecorder.start();
                    
                    console.log(" is recording", isRecording);
                })
                .catch(error => {
                    console.error('Error accessing microphone:', error);
            });
        }

        // function startRecordingVideo() {
        //     console.log("Video Recording Started")
        //     navigator.mediaDevices.getUserMedia({video: true})
        //         .then(videostream => {
        //             let videoChunks = [];
        //             videoMediaRecorder = new MediaRecorder(videostream);
        //             videoMediaRecorder.ondataavailable = event => {
        //                 if (event.data.size > 0) {
        //                     videoChunks.push(event.data);
        //                 }
        //             };

        //             videoMediaRecorder.onstop = () => {
        //                 const videoBlob = new Blob(videoChunks, { type: 'video/webm' });
        //                 const totalChunks = Math.ceil(videoBlob.size / chunkSize);
        //                 console.log("Total chunks", totalChunks, "out of ", videoBlob.size, "chunks");

        //                 for (let i = 0; i < totalChunks; i++) {
        //                     const start = i * chunkSize;
        //                     const end = Math.min(start + chunkSize, videoBlob.size);
        //                     const chunk = videoBlob.slice(start, end);
        //                     console.log("video message")
        //                     socket.emit("video_message", chunk);
        //                 }  

        //                 socket.on("video_message", (video_message)=>{
        //                     console.log(video_message)
        //                 });                

        //                 // const videoBlob = new Blob(videoChunks, { type: 'video/webm' });
        //                 // const videoUrl = URL.createObjectURL(videoBlob);
        //                 // videoPlayer.src = videoUrl;
        //                 isRecording = false;
        //             };

        //             videoMediaRecorder.start();
        //             isRecording = true;
        //             console.log(" is recording", isRecording);
        //         })
        //         .catch(error => {
        //             console.error('Error accessing microphone:', error);
        //     });

        // }

        var video = document.getElementById("videoPlayer");

        var captureInterval;
        var isRecordingVideo = false;
        var globalStream;

        function startRecordingVideo() {
            console.log("Video Recording Started")
            isRecordingVideo = true;
            return navigator.mediaDevices.getUserMedia({ video: true })
                .then(videostream => {
                    // Assign the video stream to a video element
                    const video = document.createElement('video');
                    video.srcObject = videostream;
                    globalStream = videostream;

                    captureInterval = setInterval(() => {
                        const cnv = document.createElement("canvas");
                        cnv.width = video.videoWidth;
                        cnv.height = video.videoHeight;
                        const ctx = cnv.getContext('2d');
                        ctx.drawImage(video, 0, 0, cnv.width, cnv.height);
                        cnv.toBlob((blob) => {
                            console.log("video message");
                            socket.emit("video_message", blob);
                        }, 'image/jpeg');
                    }, 3000);

                    return { videostream, captureInterval }; 
                })
                .catch(error => {
                    console.error('Error accessing web camera:', error);
                });         
        }
    
        function stopRecordingVideo(videostream, captureInterval) {
            if(!isRecordingVideo){
                console.log("Already stopped")
                return
            }
            // Clear the capture interval
            clearInterval(captureInterval);

            // Stop all tracks on the video stream
            const tracks = videostream.getTracks();
            if (tracks && tracks.length > 0) {
                console.log("tracks", tracks)
                tracks.forEach(track => track.stop());
                console.log("Video Recording Stopped");
            } else {
                console.warn("No tracks found in the video stream.");
            }

            isRecordingVideo = false;
        }

    function stopRecording() {
        console.log("Recording Stopped")
        // if (audioMediaRecorder && audioMediaRecorder.state === 'recording' && videoMediaRecorder && videoMediaRecorder.state === 'recording') {
        if (audioMediaRecorder && audioMediaRecorder.state === 'recording') {
            audioMediaRecorder.stop();
            clearInterval(captureInterval);
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