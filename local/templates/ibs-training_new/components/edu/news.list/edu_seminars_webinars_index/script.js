if (typeof TimetableSlider === 'undefined') {
    class TimetableSlider {
        constructor() {
            this.timetableBlock = $('.timetable-list');
            if (this.timetableBlock.length) {
                this.initSlider();
                let resizeTimer;
                $(window).on('resize', () => {
                    clearTimeout(resizeTimer);
                    resizeTimer = setTimeout(() => this.initSlider(), 250);
                });
            }
        }

        initSlider() {
            const windowWidth = window.innerWidth;
            const itemsCount = this.timetableBlock.find('.timetable-item').length;

            console.log(`Ширина: ${windowWidth}px, Элементов: ${itemsCount}`);

            if (this.timetableBlock.hasClass('slick-initialized')) {
                this.timetableBlock.slick('unslick');
                this.timetableBlock.removeClass('no-slider');
            }
            const needSlider = (windowWidth >= 1180 && itemsCount >= 4) ||
                (windowWidth < 1180 && itemsCount > 1);

            if (needSlider) {
                console.log(`Включаем слайдер для ${itemsCount} элементов`);

                let slidesToShow = 4;
                let arrows = true;

                if (windowWidth < 1180) {
                    slidesToShow = Math.min(3, itemsCount);
                }
                if (windowWidth < 1024) {
                    slidesToShow = Math.min(2, itemsCount);
                }
                if (windowWidth < 768) {
                    slidesToShow = 1;
                    arrows = false;
                }

                this.timetableBlock.slick({
                    slidesToShow: slidesToShow,
                    slidesToScroll: 1,
                    infinite: false,
                    dots: true,
                    arrows: arrows,
                    prevArrow: '<button type="button" class="slick-prev" aria-label="Previous"></button>',
                    nextArrow: '<button type="button" class="slick-next" aria-label="Next"></button>',
                    appendArrows: this.timetableBlock,
                    appendDots: this.timetableBlock,
                    responsive: [
                        {
                            breakpoint: 1180,
                            settings: {
                                slidesToShow: Math.min(3, itemsCount),
                                arrows: true
                            }
                        },
                        {
                            breakpoint: 1024,
                            settings: {
                                slidesToShow: Math.min(2, itemsCount),
                                arrows: true
                            }
                        },
                        {
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 1,
                                arrows: false,
                                dots: true
                            }
                        }
                    ]
                });
            } else {
                console.log('Выключаем слайдер, все помещается');
                this.timetableBlock.addClass('no-slider');
            }
        }
    }

    document.addEventListener("DOMContentLoaded", () => {
        new TimetableSlider();
    });
}