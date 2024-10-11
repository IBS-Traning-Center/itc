class OurClients
{
    constructor(data = {
        ourClientsBlockClass: '.our-clients-block'
    }) {

        this.ourClientsBlock = $('.our-clients-block');

        this.initSlider();
    }

    initSlider()
    {
        let sliderBlock = this.ourClientsBlock;

        if (sliderBlock) {
            sliderBlock.slick({
                slidesToShow: 6,
                slidesToScroll: 1,
                infinite: true,
                autoplay: true,
                autoplaySpeed: 2000,
                arrows: false,
                dots: false,
                variableWidth: true,
                swipeToSlide: true,
                responsive: [
                    {
                        breakpoint: 1601,
                        settings: {
                            slidesToShow: 5,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 1260,
                        settings: {
                            slidesToShow: 4,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 1180,
                        settings: {
                            slidesToShow: 6,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 840,
                        settings: {
                            slidesToShow: 5,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 660,
                        settings: {
                            slidesToShow: 4,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 490,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 340,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                    }
                ]
            });
        }
    }
}

document.addEventListener("DOMContentLoaded", () => {
    new OurClients();
});