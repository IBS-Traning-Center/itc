$(document).ready(function () {
    $('.our-services__image').css({
        height: $('.our-services__list').height() + 'px'
    });
    
    $('.our-services__item').mouseenter(function () { 
        let image = $(this).attr('data-img');

        $('.our-services__image img').attr('src', image);
    });

    $('.our-services__item').on('click', function(e) {
        let targetId = $(this).attr('href');
        
        if (targetId && targetId.startsWith('#')) {
            e.preventDefault();
            if ($(targetId).length) {
                $('html, body').animate({
                    scrollTop: $(targetId).offset().top - 360
                }, 800); 
                
                $('.mini-gallery [data-code]').hide();
                $('.mini-gallery [data-tab]').removeClass('active');

                $('.mini-gallery [data-code]').each(function() {
                    let codeWords = $(this).attr('data-code').split(/\s+/);
                    if(codeWords == targetId.slice(1)) {
                        $(this).show();
                    }
                });

                $('.mini-gallery [data-tab]').each(function() {
                    let codeWords = $(this).attr('data-tab').split(/\s+/);
                    if(codeWords == targetId.slice(1)) {
                        $(this).addClass('active');

                        let scrollContainer = $('.tabs--wrapper');
                        let elementPosition = $('#accreditations').position().left - 16;
                        scrollContainer.scrollLeft(elementPosition);
                    }
                });

            }
        }
    });
});