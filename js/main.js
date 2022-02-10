(function($) {

    $(".toggle-password").click(function() {

        $(this).toggleClass("zmdi-eye zmdi-eye-off");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });

})(jQuery);

var password = document.getElementById("password");
var re_password = document.getElementById("re_password");

function validatePassword() {
    if (password.value != re_password.value) {
        re_password.setCustomValidity("Passwords Don't Match");
    } else {
        re_password.setCustomValidity('');
    }
}

password.onchange = validatePassword;
re_password.onkeyup = validatePassword;