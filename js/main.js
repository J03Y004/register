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

function validatePassword() {
    if (password.value != re_password.value) {
        re_password.setCustomValidity("Passwords Don't Match");
    } else {
        re_password.setCustomValidity('');
    }
}

password.onchange = validatePassword;
re_password.onkeyup = validatePassword;

$("submit").click(function(){
    let name = $("name").val();
    let surname = $("surname").val();
    let email = $("email").val();
    let password = $("password").val();

    password = CryptoJS.SHA512(password);
});