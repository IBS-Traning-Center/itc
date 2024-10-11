class CoursesWithDiscount
{
    constructor() {
        this.initCoursesWithDiscountSlider();
    }

    initCoursesWithDiscountSlider()
    {
        let coursesDiscountContent = $('#coursesDiscountSlider.more-elem');

        if (coursesDiscountContent) {
            coursesDiscountContent.slick({
                slidesToShow: 2,
                slidesToScroll: 1,
                infinite: false,
                autoplay: false,
                arrows: true,
                dots: false,
                variableWidth: false,
                responsive: [
                    {
                        breakpoint: 1251,
                        settings: 'unslick'
                    }
                ]
            });
        }
    }
}

document.addEventListener("DOMContentLoaded", () => {
    new CoursesWithDiscount();
});