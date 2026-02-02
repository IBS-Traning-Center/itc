$(document).ready(function () {
    $('.differences__item__label').on('click', function (e) {
        console.log( $(this).parent().siblings('.differences__item__desc') );
        $(this).parent().siblings('.differences__item__desc').addClass('show');
    });

    $('.differences__item__desc').on('click', function (e) {
        if($(e.target).hasClass('differences__item__desc') || $(e.target).hasClass('modal--close')) {
            $(this).removeClass('show');
        }
    });
});