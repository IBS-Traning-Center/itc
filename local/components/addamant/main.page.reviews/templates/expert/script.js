class TrainerTalentPage
{
    constructor(data = {
        trainerContentId: 'trainerContent',
        tnainerBtnClasstrainerItemsTextClass: '.trainer-text-block > span',
    }) {
        this.trainerContent = document.getElementById(data.trainerContentId);
        this.trainerItemsText = document.querySelectorAll(data.trainerItemsTextClass);

        this.hideOverflowText();
        this.initTrainerSlider();
        this.scrollToForm();
    }

    hideOverflowText()
    {
        if (this.trainerItemsText) {
            let MAX_COUNT_SYMBOLS;

            if (window.innerWidth > 1180) {
                MAX_COUNT_SYMBOLS = 265;
            } else {
                MAX_COUNT_SYMBOLS = 205;
            }

            this.trainerItemsText.forEach(elem => {
                let sliced = elem.textContent.slice(0, MAX_COUNT_SYMBOLS);

                if (sliced.length < elem.textContent.length) {
                    if(elem.classList.contains('student-text')){
                        sliced += '...';
                        elem.innerHTML = sliced;
                    }
                }
            });
        }
    }

    scrollToForm(){
        const buttons = document.querySelectorAll('.trainer-modal');
        buttons.forEach(button => {
            button.addEventListener('click', function() {
                const targetElement = document.querySelector('.sign-course-form-block');
                
                if (targetElement) {
                    const elementPosition = targetElement.getBoundingClientRect().top;
                    const offsetPosition = elementPosition + window.pageYOffset;
                    const scrollToPosition = offsetPosition - 100;
                    window.scrollTo({
                      top: scrollToPosition,
                      behavior: 'smooth'
                    });
                }
            });
        });
    }

    initTrainerSlider()
    {
        if (this.trainerContent) {
            let trainerContentId = $('#trainerContent');

            trainerContentId.slick({
                slidesToShow: 3,
                slidesToScroll: 1,
                infinite: false,
                autoplay: false,
                arrows: false,
                dots: true,
                variableWidth: false,
                responsive: [
                    {
                        breakpoint: 1320,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            dots: true,
                            arrows: true,
                        }
                    }
                ]
            });
        }
    }

}

document.addEventListener("DOMContentLoaded", () => {
    new TrainerTalentPage();
});