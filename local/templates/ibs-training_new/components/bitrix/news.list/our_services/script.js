$(document).ready(function () {
    $('.our-services__image').css({
        height: $('.our-services__list').height() + 'px'
    });
    
    $('.our-services__item').mouseenter(function () { 
        let image = $(this).attr('data-img');

        $('.our-services__image img').attr('src', image);
    });
});