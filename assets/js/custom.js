window.onload = function () {
    $('.mnlist').on("click", function () {
        $('.subtog').hide();
    });

    $('.dropdown-submenu a.test').on("click", function (e) {
        $('.subtog').hide();
        $(this).next('ul').show();
        e.stopPropagation();
        e.preventDefault();
    });
};