$(document).ready(function() {
    // Function to compare passwords
    function comparePasswords() {
        var password = $('#passwordInput').val();
        var passwordAgain = $('#passwordAgainInput').val();

        if (password !== passwordAgain) {
            $('#passwordError').show();
            $('#passwordInput, #passwordAgainInput').addClass('is-invalid');
            
        } else {
            $('#passwordError').hide();
            $('#passwordInput, #passwordAgainInput').removeClass('is-invalid');
        }
    }

    // Trigger the comparison when either password field changes
    $('#passwordInput, #passwordAgainInput').on('keyup',"", comparePasswords);
});