// Оборачиваем объявление в условие

    class BestWorker {
        constructor(data = {
            ourClientsBlockClass: '.best_worker-block'
        }) {
            this.ourClientsBlock = $('.best_worker-block');
            this.initSlider();
        }

        initSlider() {
            let sliderBlock = this.ourClientsBlock;
            const windowWidth = window.innerWidth;
           
            
            if (windowWidth < 1180) {
                if (sliderBlock.length && !sliderBlock.hasClass('slick-initialized')) {
                    sliderBlock.slick({
                        slidesToShow: 3,
                        slidesToScroll: 1,
                        infinite: false,
                        autoplay: false,
                        dots: true,
                        variableWidth: false,
                        swipeToSlide: true,
                        responsive: [
                            {
                                breakpoint: 1024,
                                settings: {
                                    slidesToShow: 2,
                                    slidesToScroll: 1
                                }
                            },
                            {
                                breakpoint: 600,
                                settings: {
                                    slidesToShow: 1,
                                    slidesToScroll: 1,
                                    gap: 24
                                }
                            }
                        ]
                    });
                }
            }
        }
    }

// Инициализация
document.addEventListener("DOMContentLoaded", () => {
        new BestWorker();
});