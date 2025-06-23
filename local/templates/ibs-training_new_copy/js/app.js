$(document).ready(function () {
    if($('.tabs').length > 0) {
        $('.tabs__item').on('click', function (e) {
            let tab = $(this).attr('data-tab');
            $(this).parent().siblings('*[data-code]').hide();
            $(this).parent().siblings('*[data-code="'+tab+'"]').show();
            
            $('.tabs__item').removeClass('active');
            $(this).addClass('active');
        });
    }
    
    const reviews__slider = new Swiper('.reviews__slider', {
        slidesPerView: 1,
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
                slidesPerView: 2,
            },
            768: {
                slidesPerView: 3,
            },
            1280: {
                slidesPerView: 4,
            },
          },
    });
});