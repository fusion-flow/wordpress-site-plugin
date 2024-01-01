<?php
/*
Plugin Name: FusionFlow Chatbot 3
Description: Chatbot to help people with Aphasia
Version: 1.0
Author: FusionFlow
*/

// Add chatbot icon HTML, CSS, and JavaScript
function add_chatbot_icon()
{
?>
  <div id="chatbot-root"></div>
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
  <!-- <script src="https://unpkg.com/react@17/umd/react.production.min.js"></script>
  <script src="https://unpkg.com/react-dom@17/umd/react-dom.production.min.js"></script> -->
  <script src="https://unpkg.com/react@17/umd/react.development.js"></script>
  <script src="https://unpkg.com/react-dom@17/umd/react-dom.development.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/js-cookie/3.0.1/js.cookie.min.js"></script>
  <script type="module">
    window.onload = function () {
  // Using CommonJS-style require
    require(['/path/to/your/Chatbot.js'], function (module) {
        const Chatbot = module.default; // Assuming your module has a default export

        const App = () => (
        <div>
            {/* Other existing content */}
            <Chatbot />
        </div>
        );

        ReactDOM.render(<App />, document.getElementById('chatbot-root'));
    });
    };

  </script>
<?php
}

// Hook the function to wp_footer to add the icon and chatbox to the footer of each page
add_action('wp_footer', 'add_chatbot_icon');
?>
