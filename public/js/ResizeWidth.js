function resizeWidth(element) {
    if ($(window).width() < 768) {
        element.removeClass("w-50");
        element.removeClass("w-25");
        element.addClass("w-75");
    }

    if ($(window).width() >= 768) {
        element.removeClass("w-75");
        element.removeClass("w-25");
        element.addClass("w-50");
    }

    if ($(window).width() >= 1200) {
        element.removeClass("w-75");
        element.removeClass("w-50");
        element.addClass("w-25");
    }
}