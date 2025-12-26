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

            let needSlider = false;

            if (windowWidth >= 1180) {
                needSlider = itemsCount > 3;
            }
            else if (windowWidth >= 768) {
                needSlider = itemsCount > 2;
            }
            else {
                needSlider = itemsCount > 1;
            }

            if (needSlider) {
                console.log(`Включаем слайдер для ${itemsCount} элементов`);

                let slidesToShow = 3;
                let arrows = true;
                let infinite = false;

                if (windowWidth >= 1180) {
                    slidesToShow = Math.min(3, itemsCount);
                    arrows = true;
                }
                else if (windowWidth >= 768) {
                    slidesToShow = Math.min(2, itemsCount);
                    arrows = true;
                }
                else {
                    slidesToShow = 1;
                    arrows = false;
                }

                this.timetableBlock.slick({
                    slidesToShow: slidesToShow,
                    slidesToScroll: 1,
                    infinite: infinite,
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
                                slidesToScroll: 1,
                                arrows: false,
                                infinite: false
                            }
                        },
                        {
                            breakpoint: 1024,
                            settings: {
                                slidesToShow: Math.min(2, itemsCount),
                                slidesToScroll: 1,
                                arrows: true,
                                infinite: false
                            }
                        },
                        {
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1,
                                arrows: false,
                                dots: true,
                                infinite: false
                            }
                        }
                    ]
                });
                setTimeout(() => {
                    this.adjustDotsPosition();
                }, 100);

            } else {
                console.log('Выключаем слайдер, все помещается');
                this.timetableBlock.addClass('no-slider');
            }
        }

        adjustDotsPosition() {
            const dotsContainer = this.timetableBlock.find('.slick-dots');
            if (dotsContainer.length) {
                dotsContainer.css('margin-top', '60px'); // Увеличиваем отступ сверху для дотов
            }
        }
    }

    document.addEventListener("DOMContentLoaded", () => {
        new TimetableSlider();
    });
}