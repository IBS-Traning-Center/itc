document.addEventListener('click', function (e) {
    const icon = e.target.closest('.eye-icon, .field__icon');

    if (icon) {
        const input = icon.previousElementSibling;

        if (input && (input.tagName === 'INPUT')) {

            input.type = input.type === 'password' ? 'text' : 'password';

            icon.innerHTML = input.type === 'text'
                ? '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">\n            <path d="M11.9984 9.00462C14.2075 9.00462 15.9984 10.7955 15.9984 13.0046C15.9984 15.2138 14.2075 17.0046 11.9984 17.0046C9.78927 17.0046 7.99841 15.2138 7.99841 13.0046C7.99841 10.7955 9.78927 9.00462 11.9984 9.00462ZM11.9984 10.5046C10.6177 10.5046 9.49841 11.6239 9.49841 13.0046C9.49841 14.3853 10.6177 15.5046 11.9984 15.5046C13.3791 15.5046 14.4984 14.3853 14.4984 13.0046C14.4984 11.6239 13.3791 10.5046 11.9984 10.5046ZM11.9984 5.5C16.6119 5.5 20.5945 8.65001 21.6995 13.0644C21.8001 13.4662 21.5559 13.8735 21.1541 13.9741C20.7523 14.0746 20.345 13.8305 20.2444 13.4286C19.3055 9.67796 15.9198 7 11.9984 7C8.07534 7 4.68851 9.68026 3.75127 13.4332C3.6509 13.835 3.24376 14.0794 2.84189 13.9791C2.44002 13.8787 2.1956 13.4716 2.29596 13.0697C3.39905 8.65272 7.38289 5.5 11.9984 5.5Z" fill="#212121"/>\n            <line x1="20.9761" y1="17.277" x2="2.68129" y2="6.77318" stroke="black" stroke-width="1.5" stroke-linecap="round"/>\n          </svg>'
                : '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">\n            <path d="M11.9984 9.00462C14.2075 9.00462 15.9984 10.7955 15.9984 13.0046C15.9984 15.2138 14.2075 17.0046 11.9984 17.0046C9.78927 17.0046 7.99841 15.2138 7.99841 13.0046C7.99841 10.7955 9.78927 9.00462 11.9984 9.00462ZM11.9984 10.5046C10.6177 10.5046 9.49841 11.6239 9.49841 13.0046C9.49841 14.3853 10.6177 15.5046 11.9984 15.5046C13.3791 15.5046 14.4984 14.3853 14.4984 13.0046C14.4984 11.6239 13.3791 10.5046 11.9984 10.5046ZM11.9984 5.5C16.6119 5.5 20.5945 8.65001 21.6995 13.0644C21.8001 13.4662 21.5559 13.8735 21.1541 13.9741C20.7523 14.0746 20.345 13.8305 20.2444 13.4286C19.3055 9.67796 15.9198 7 11.9984 7C8.07534 7 4.68851 9.68026 3.75127 13.4332C3.6509 13.835 3.24376 14.0794 2.84189 13.9791C2.44002 13.8787 2.1956 13.4716 2.29596 13.0697C3.39905 8.65272 7.38289 5.5 11.9984 5.5Z" fill="#212121"/>\n          </svg>';
        } else {
            const parent = icon.closest('.input-group, .form-group, .password-wrapper');
            if (parent) {
                const inputInParent = parent.querySelector('input[type="password"], input[type="text"]');
                if (inputInParent) {
                    inputInParent.type = inputInParent.type === 'password' ? 'text' : 'password';
                }
            }
            const forAttr = icon.getAttribute('for');
            if (forAttr) {
                const inputById = document.getElementById(forAttr);
                if (inputById && inputById.tagName === 'INPUT') {
                    inputById.type = inputById.type === 'password' ? 'text' : 'password';
                }
            }
        }
    }
});
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
        slidesPerView: 'auto',
        grabCursor: true,
        allowTouchMove: true,
        freeMode: true,
        spaceBetween: 64,
        pagination: {
            el: ".mini-gallery__slider .swiper-pagination",
            clickable: true,
        },
        breakpoints: {
            0: {
                freeMode: false,
            },
            576: {
                enabled: true,
                spaceBetween: 64,
            }
        }
    });
});
