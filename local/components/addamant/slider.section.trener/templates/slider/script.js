class SliderTrenerPage
{
    constructor(data = {
        sliderTrenersContentId: 'sliderTrenerContent',
    }) {

        this.sliderTrenersContent = document.getElementById(data.sliderTrenersContentId);

        this.initReviewsSlider();
    }

    initReviewsSlider()
    {
        if (this.sliderTrenersContent) {
            let sliderTrenersContent = $('#sliderTrenerContent');

            sliderTrenersContent.slick({
                slidesToShow: 4,
                slidesToScroll: 1,
                infinite: false,
                autoplay: false,
                arrows: false,
                dots: true,
                variableWidth: false,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1,
                            arrows: true,
                        }
                    },
                    {
                        breakpoint: 500,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1,
                            arrows: true,
                        }
                    }
                ]
            });
        }
    }
}
1
document.addEventListener("DOMContentLoaded", () => {
    new SliderTrenerPage();
});