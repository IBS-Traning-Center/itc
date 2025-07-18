$(document).ready(function () {
    if($(window).width() >= 992) {
        const textBlock = $('#history-text');
    
        $('.history__list__item').mouseenter(function () {
            let currentText = $(this).find('.history__list__item__text').html();
            textBlock.html(' ').html(currentText);
        });
    
        $('.history__list__item').hover(function () {
                $('.history__list__item').removeClass('active');
                $(this).addClass('active');
                
            }, function () {
                $(this).removeClass('active');
            }
        );
    } else {
        $('.history__list__item').click(function () {
            $(this).siblings().find('.history__list__item__text').slideUp();
            $('.history__list__item').removeClass('active');

            $(this).addClass('active');
            $(this).find('.history__list__item__text').slideToggle();
        });
    }
});