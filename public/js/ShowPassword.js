$("#show-password").on("click", function () {
    const showHide = $("#show-password");
    showHide.text(showHide.text() === "Show password" ? "Hide password" : "Show password");
    
    document.querySelectorAll("[password]").forEach(element => {
        if (element.getAttribute("type") === "password") {
            element.setAttribute("type", "text");
        } else {
            element.setAttribute("type", "password");
        }
    });
});