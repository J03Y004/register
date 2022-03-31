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
password.oninput = function() {
    // Validate capital letters
    let upperCaseLetters = /[A-Z]/g;
    if (!password.value.match(upperCaseLetters)) {
        password.setCustomValidity("Must contain a capital letter");
        password.reportValidity();
        return;
    }

    // Validate numbers
    let numbers = /[0-9]/g;
    if (!password.value.match(numbers)) {
        password.setCustomValidity("Must contain a number");
        password.reportValidity();
        return;
    }

    // Validate length
    if (password.value.length < 8) {
        password.setCustomValidity("Minimum 8 character");
        password.reportValidity();
        return;
    }

    password.setCustomValidity("");
    confirmPassword();
}

function confirmPassword() {
    if (password.value != re_password.value) {
        this.setCustomValidity("Passwords Don't Match");
        this.reportValidity();
        return;
    }

    this.setCustomValidity("");
}

re_password.oninput = confirmPassword;