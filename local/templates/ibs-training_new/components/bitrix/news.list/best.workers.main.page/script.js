class StackRole
{
    constructor(data = {
        ourClientsBlockClass: '.stack_role-block'
    }) {

        this.ourClientsBlock = $('.stack_role-block');

        this.initSlider();
    }

    initSlider()
    {
        let sliderBlock = this.ourClientsBlock;
        const windowWidth = window.innerWidth;

        if (windowWidth < 1180) {
            if (sliderBlock) {
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
                                slidesToScroll: 1
                            }
                        }
                    ]
                });
            }
        }
    }
}

document.addEventListener("DOMContentLoaded", () => {
    new StackRole();
});