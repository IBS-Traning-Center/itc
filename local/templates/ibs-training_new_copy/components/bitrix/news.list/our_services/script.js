$(document).ready(function () {
    $('.our-services__item').mouseenter(function () { 
        let image = $(this).attr('data-img');

        $('.our-services__image img').attr('src', image);
    });
});