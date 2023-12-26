// script.js
jQuery(document).ready(function ($) {
    // Open the modal
    $('#openModalBtn').on('click', function () {
        $('#customModal').show();
    });

    // Close the modal
    $('#closeModalBtn').on('click', function () {
        $('#customModal').hide();
    });

    // Get and display the typed text in the modal
    $('#customTextBox').on('input', function () {
        var typedText = $(this).val();
        $('#typedText').text(typedText);
    });
});
