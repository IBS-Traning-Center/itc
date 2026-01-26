$(document).ready(function () {
    $('*[data-scroll]').on('click', function (e) {
        e.preventDefault();
        let target = $(this).attr('data-scroll');
        // console.log(target);
        if (target.length) {
            $('html, body').animate({
                scrollTop: $('#' + target).offset().top
            }, 1000);
        }
    });

    if($('.tabs').length > 0) {
        $('.tabs__item').on('click', function(e) {
            let tab = $(this).attr('data-tab');
            let parentContainer = $(this).parent().parent();
            
            // Скрываем все блоки с data-code
            parentContainer.siblings('[data-code]').hide();
            
            // Показываем только те блоки, у которых в data-code есть искомое слово
            parentContainer.siblings('[data-code]').each(function() {
                let codeWords = $(this).attr('data-code').split(/\s+/);
                if(codeWords.includes(tab)) {
                    $(this).show();

                    // Показываем subcode внутри этого блока
                    $(this).find('[data-subcode="'+ tab +'"]').siblings('[data-subcode]').hide();
                    $(this).find('[data-subcode="'+ tab +'"]').show();
                }
            });
            
            // Управление классами активного таба
            $(this).siblings().removeClass('active');
            $(this).addClass('active');
        });
    }

    // if($('.tabs').length > 0) {
    //     $('.tabs__item').on('click', function (e) {
    //         let tab = $(this).attr('data-tab');

    //         $(this).parent().parent().siblings('*[data-code]').hide();
    //         $(this).parent().parent().siblings('*[data-code="'+tab+'"]').show();
            
    //         $(this).siblings().removeClass('active');
    //         $(this).addClass('active');
    //     });
    // }

    if($('.start').length > 0 && $(window).width() >= 1280) {
        const imageWidth = $('.start__image').width();
        const rightPadding = parseFloat($('.start > .container').css('padding-right'));
        const rightMargin = parseFloat($('.start > .container').css('margin-right'));

        if($(window).width() >= 1920) {
            $('.start__image').css({
                'right': rightMargin + rightPadding
            });

            $('.start > .container').css({
                'padding-right': rightPadding + imageWidth + rightPadding
            });
        } else {
            $('.start > .container').css({
                'padding-right': imageWidth + rightPadding - rightMargin
            });
        }
    }
    
    const reviews__slider = new Swiper('.reviews__slider', {
        slidesPerView: 1.5,
        spaceBetween: 31,
        freeMode: true,
        autoHeight: false,
        grabCursor: true,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        breakpoints: {
            576: {
                slidesPerView: 1.5,
            },
            768: {
                slidesPerView: 2.5,
            },
            1280: {
                slidesPerView: 4.5,
            },
            1480: {
                slidesPerView: 5,
            },
          },
    });

    const miniGallerySlider = new Swiper('.mini-gallery__slider', {
        freeMode: true,
        slidesPerView: 'auto',
        grabCursor: true,
        allowTouchMove: true,
        pagination: {
            el: ".mini-gallery__slider .swiper-pagination",
            clickable: true,
        },
        breakpoints: {
            0: {
                enabled: false
            },
            576: {
                enabled: true,
                spaceBetween: 64
            }
        }
    });
});