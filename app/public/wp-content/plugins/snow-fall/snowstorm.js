// snowstorm.js
var snowStorm = (function(window, document) {
    // Snowstorm configuration options
    // You can customize these options as needed
    var options = {
        flakeColor: '#ffffff',   // Snowflake color
        flakeCount: 100,         // Number of snowflakes
        followMouse: false       // Snowflakes follow the mouse
    };

    // Include the Snowstorm script
    var script = document.createElement('script');
    script.type = 'text/javascript';
    script.src = 'https://www.schillmania.com/projects/snowstorm/snowstorm.js';
    document.head.appendChild(script);

    // Initialize Snowstorm with custom options
    script.onload = function() {
        snowStorm.flakeColor = options.flakeColor;
        snowStorm.flakeCount = options.flakeCount;
        snowStorm.followMouse = options.followMouse;
        snowStorm.snowColor = options.flakeColor;
        snowStorm.snowCharacter = '&#x2022;';
        snowStorm.useMeltEffect = true;
        snowStorm.freezeOnBlur = false;
    };
})(window, document);
