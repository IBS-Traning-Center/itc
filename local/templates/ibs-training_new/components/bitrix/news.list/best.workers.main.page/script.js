document.addEventListener('DOMContentLoaded', function () {
    let swiperInstance = null;

    // Находим элементы внутри компонента
    const component = document.getElementById('ibs-services-component');
    if (!component) return;

    const desktopGrid = component.querySelector('.ibs-services-grid--desktop');
    const sliderWrapper = component.querySelector('.ibs-services-slider-wrapper');

    function initSwiper() {
        if (window.innerWidth < 1440) {
            if (desktopGrid) desktopGrid.style.display = 'none';
            if (sliderWrapper) sliderWrapper.style.display = 'block';

            const sliderElement = component.querySelector('.ibs-services-slider');
            if (!swiperInstance && sliderElement) {
                swiperInstance = new Swiper(sliderElement, {
                    slidesPerView: 1,
                    spaceBetween: 24,
                    centeredSlides: true,
                    loop: false,

                    pagination: {
                        el: component.querySelector('.ibs-services-slider__pagination'),
                        clickable: true,
                        bulletClass: 'ibs-services-slider__bullet',
                        bulletActiveClass: 'ibs-services-slider__bullet--active',
                    },

                    navigation: {
                        nextEl: component.querySelector('.ibs-services-slider__arrow--next'),
                        prevEl: component.querySelector('.ibs-services-slider__arrow--prev'),
                    },

                    breakpoints: {
                        768: {
                            slidesPerView: 2,
                            centeredSlides: false,
                        },
                        1024: {
                            slidesPerView: 3,
                            centeredSlides: false,
                        }
                    }
                });
            }
        } else {
            if (desktopGrid) desktopGrid.style.display = 'flex';
            if (sliderWrapper) sliderWrapper.style.display = 'none';

            if (swiperInstance) {
                swiperInstance.destroy(true, true);
                swiperInstance = null;
            }
        }
    }

    initSwiper();
    window.addEventListener('resize', initSwiper);
});