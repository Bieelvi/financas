function showMessage(type, message) {
    const flashMessage = $("#flash-message");
    const typeMessage = $("#type-message");

    flashMessage.removeClass('d-none');

    typeMessage.addClass(`alert alert-${type}`);
    typeMessage.html(message);
}

function hideMessage() {
    const flashMessage = $("#flash-message");

    flashMessage.addClass('d-none');
}

$.post("/session").done(function (data) {
    const objectSuccess = JSON.parse(data);

    showMessage(
        objectSuccess.data.type,
        objectSuccess.data.message
    );
}).fail(function (status, data) {
    if (status.status !== 404) {
        const objectError = JSON.parse(data.responseText);
    
        showMessage(
            objectError.data.type,
            objectError.data.message
        );
    }
}).always(function () {
    setTimeout(() => {
        $.post("/session/unset", {
            unset: 'flash_message'
        }).done(function () {
            hideMessage();
        });
    }, 5000);
});