class TestingRoles
{
    constructor(data = {
        ourClientsBlockClass: '.pictures-block'
    }) {

        this.ourClientsBlock = $('.pictures-block');

        this.initRolesSlider();
    }

    initRolesSlider()
    {
        let sliderBlock = this.ourClientsBlock;

        if (sliderBlock) {
            sliderBlock.slick({
                slidesToShow: 10,
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
                            slidesToShow: 7,
                            slidesToScroll: 1
                        }
                    }
                ]
            });
        }
    }
}

document.addEventListener("DOMContentLoaded", () => {
    new TestingRoles();
});