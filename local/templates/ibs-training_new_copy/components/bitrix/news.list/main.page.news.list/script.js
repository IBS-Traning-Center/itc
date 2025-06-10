class MainPageNewsList
{
    constructor(data = {
        mainPageNewsListBlockClass: '.main-page-news-list-block'
    }) {

        this.companyReviewsTab = $(data.mainPageNewsListBlockClass);

        this.initMainPageSlider();
    }

    initMainPageSlider()
    {
        if (this.companyReviewsTab) {
            this.companyReviewsTab.slick({
                dots: true,
                prevArrow: '<button type="button" aria-label="Prev" role="button" class="slick-arrow slick-arrow--prev"><svg width="14" height="24" viewBox="0 0 14 24" fill="none" xmlns="http://www.w3.org/2000/svg">\n' +
                    '<path fill-rule="evenodd" clip-rule="evenodd" d="M1.35359 11.2929L0.646484 12L1.35359 12.7071L12.6465 24L13.3536 23.2929L2.0607 12L13.3536 0.707107L12.6465 0L1.35359 11.2929Z" fill="black"/>\n' +
                    '</svg></button>',
                nextArrow: '<button type="button" aria-label="Next" role="button" class="slick-arrow slick-arrow--next"><svg width="14" height="24" viewBox="0 0 14 24" fill="none" xmlns="http://www.w3.org/2000/svg">\n' +
                    '<path fill-rule="evenodd" clip-rule="evenodd" d="M12.6464 11.2929L13.3535 12L12.6464 12.7071L1.35352 24L0.646409 23.2929L11.9393 12L0.646409 0.707107L1.35352 0L12.6464 11.2929Z" fill="black"/>\n' +
                    '</svg></button>',
                slidesToShow: 1,
                slidesToScroll: 1,
                infinite: false,
                variableWidth: true,
                customPaging: function(slider, i) {
                    let current = i + 1;
                    let total = slider.slideCount;

                    return (
                        '<button type="button" role="button" tabindex="0" class="slick-dots-button">\
                            <span class="slick-dots-current">' + current + '</span>\
                            <span class="slick-dots-separator">из</span>\
                            <span class="slick-dots-total">' + total + '</span>\
                        </button>'
                    );
                },
                responsive: [
                    {
                        breakpoint: 1350,
                        settings: {
                            variableWidth: false
                        }
                    },
                ]
            });
        }
    }
}

document.addEventListener("DOMContentLoaded", () => {
    new MainPageNewsList();
});