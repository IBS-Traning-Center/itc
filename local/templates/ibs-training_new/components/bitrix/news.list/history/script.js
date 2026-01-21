$(document).ready(function () {
    if($(window).width() >= 992) {
        const textBlock = $('#history-text');
    
        $('.history__list__item').mouseenter(function () {
            let currentText = $(this).find('.history__list__item__text').html();
            textBlock.fadeOut(300, function() {
                $(this).html(currentText).fadeIn(300);
            });
        });
    
        $('.history__list__item').hover(function () {
                $(this).siblings().removeClass('active');
                $(this).addClass('active');
                
            }, function () {
                $(this).removeClass('active');
            }
        );
    } else {
        $('.history__list__item').click(function () {
            $(this).siblings().find('.history__list__item__text').slideUp();
            $('.history__list__item').removeClass('active');

            $(this).toggleClass('active');
            $(this).find('.history__list__item__text').slideToggle();
        });
    }
});