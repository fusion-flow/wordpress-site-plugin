// Chatbot.js
import React, { useState, useEffect } from 'react';
import Cookies from 'js-cookie';

const Chatbot = () => {
  const [chatMessages, setChatMessages] = useState([]);
  const [inputMessage, setInputMessage] = useState('');

  useEffect(() => {
    // Check if there are stored messages and display them
    const storedMessages = Cookies.get('chatMessages');
    if (storedMessages) {
      setChatMessages(JSON.parse(storedMessages));
    }
  }, []);

  const hideChatbotIcon = () => {
    // Implement hide logic here if needed
  };

  const toggleChatbox = () => {
    // Implement toggle logic here if needed
  };

  const sendMessage = () => {
    if (inputMessage.trim() !== '') {
      setChatMessages([...chatMessages, { user: 'User', message: inputMessage }]);
      Cookies.set('chatMessages', JSON.stringify([...chatMessages, { user: 'User', message: inputMessage }]), { expires: 365 });
      setInputMessage('');
    }
  };

  return (
    <div className="chatbot-container">
      {/* Your existing chatbot icon HTML here */}
      <div className="chatbox" style={{ display: 'none' }}>
        {/* Your existing chatbox HTML here */}
        <div id="chat-messages">
          {chatMessages.map((msg, index) => (
            <p key={index}>{`${msg.user}: ${msg.message}`}</p>
          ))}
        </div>
        <div className="chat-input-container">
          <input
            type="text"
            id="chat-input"
            placeholder="Type your message..."
            value={inputMessage}
            onChange={(e) => setInputMessage(e.target.value)}
          />
          <button onClick={sendMessage}>Send</button>
        </div>
      </div>
    </div>
  );
};

export default Chatbot;
