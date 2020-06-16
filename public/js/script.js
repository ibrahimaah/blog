/*******************************************************************************/
/** Adjust the height of header background image */
$(function() {
    var img_header = $(".img-header");
    var navbar = $(".navbar");

    img_header.height($(window).height() - navbar.height());

    $(window).on("resize", function() {
        img_header.height($(window).height() - navbar.height());
    });
});

/*******************************************************************************/
