(function($) {

    $(".toggle-password").click(function() {

        $(this).toggleClass("zmdi-eye zmdi-eye-off");
        let input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });

})(jQuery);

let password = document.getElementById("password");
let re_password = document.getElementById("re_password");

// When the user starts to type something inside the password field
password.onkeyup = function() {
    // Validate capital letters
    let upperCaseLetters = /[A-Z]/g;
    if (myInput.value.match(upperCaseLetters)) {
        password.setCustomValidity('');
    } else {
        password.setCustomValidity("Must contain a capital letter");
    }

    // Validate numbers
    let numbers = /[0-9]/g;
    if (myInput.value.match(numbers)) {
        re_password.setCustomValidity('');
    } else {
        re_password.setCustomValidity("Must contain a number");
    }

    // Validate length
    if (myInput.value.length >= 8) {
        re_password.setCustomValidity('');
    } else {
        re_password.setCustomValidity("Minimum 8 character");
    }
}

function confirmPassword() {
    if (password.value == re_password.value) {
        re_password.setCustomValidity('');
    } else {
        re_password.setCustomValidity("Passwords Don't Match");
    }
}

password.onchange = confirmPassword;
re_password.onkeyup = confirmPassword;

$("submit").click(function() {
    let name = $("name").val();
    let surname = $("surname").val();
    let email = $("email").val();
    let password = $("password").val();

    password = CryptoJS.SHA512(password);
});