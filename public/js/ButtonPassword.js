function disableButtonPassword(disable, button, textNotMatch, inputPassword) {
    const classes = 'border border-danger';
    const style   = 'box-shadow: 0 0 0 0.25rem rgb(220 53 69)';

    if (disable) {
        inputPassword.addClass(classes);
        inputPassword.attr("style", style);
        textNotMatch.removeClass('d-none');
        button.attr("disabled", "disabled");
    } else {
        inputPassword.removeClass(classes);
        inputPassword.removeAttr("style", style); 
        textNotMatch.addClass('d-none');
        button.removeAttr("disabled", "disabled");
    }
}