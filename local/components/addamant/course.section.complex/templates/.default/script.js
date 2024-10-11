class CatalogSectionComplex {
    constructor(data = {
        linkedCourseItemClass: '.linked-course-item',
        showDiplomBtnClass: '.show-diplom-btn',
        diplomaModalClass: '.diploma-modal',
        diplomaModalCloseBtnClass: '.diploma-modal-close-btn',
        backgroundModalClass: '.background-modal',
        signCourseComplexBlockCLass: '.sign-course-complex-block',
        openSignModalClass: '.open-sign-modal',
        signTariffBtnClass: '.sign-tariff-btn',
        selectTariffClass: '.select-tariff'
    }) {
        this.linkedCourseItem = document.querySelectorAll(data.linkedCourseItemClass);
        this.showDiplomBtn = document.querySelector(data.showDiplomBtnClass);
        this.diplomaModal = document.querySelector(data.diplomaModalClass);
        this.diplomaModalCloseBtn = document.querySelector(data.diplomaModalCloseBtnClass);
        this.backgroundModal = document.querySelector(data.backgroundModalClass);
        this.signCourseComplexBlock = document.querySelector(data.signCourseComplexBlockCLass);
        this.openSignModal = document.querySelectorAll(data.openSignModalClass);
        this.signTariffBtn = document.querySelectorAll(data.signTariffBtnClass);
        this.selectTariff = document.querySelectorAll(data.selectTariffClass);

        this.addEventHandlerSectionComplex();
        this.initLinkedCourses();
    }

    addEventHandlerSectionComplex() {
        if (this.linkedCourseItem) {
            this.linkedCourseItem.forEach(elem => {
                elem.addEventListener('click', () => {
                    if (elem.classList.contains('active')) {
                        elem.classList.remove('active');
                    } else {
                        elem.classList.add('active');
                    }
                });
            });
        }

        if (this.showDiplomBtn) {
            this.showDiplomBtn.addEventListener('click', () => {
                this.openDiplomModal();
            });
        }

        if (this.diplomaModalCloseBtn) {
            this.diplomaModalCloseBtn.addEventListener('click', () => {
                this.closeDiplomModal();
            });
        }

        if (this.backgroundModal) {
            this.backgroundModal.addEventListener('click', () => {
                this.closeDiplomModal();

                if (this.signCourseComplexBlock) {
                    this.signCourseComplexBlock.style.display = 'none';
                }
            });
        }

        if (this.openSignModal) {
            this.openSignModal.forEach(elem => {
               elem.addEventListener('click', () => {
                  this.openSignComplexModal();
               });
            });
        }

        if (this.signTariffBtn) {
            this.signTariffBtn.forEach(elem => {
                elem.addEventListener('click', () => {
                    if (this.selectTariff) {
                        let type = elem.dataset.type;

                        this.selectTariff.forEach(tariff => {
                            let text = tariff.querySelector('span').textContent;

                            if (text === type) {
                                tariff.click();
                            }
                        });

                        this.openSignComplexModal();
                    }
                });
            });
        }
    }

    openDiplomModal()
    {
        if (
            this.diplomaModal &&
            this.diplomaModalCloseBtn &&
            this.backgroundModal
        ) {
            this.diplomaModal.style.display = 'flex';
            this.diplomaModalCloseBtn.style.display = 'flex';
            this.backgroundModal.style.display = 'flex';
        }
    }

    closeDiplomModal()
    {
        if (
            this.diplomaModal &&
            this.diplomaModalCloseBtn &&
            this.backgroundModal
        ) {
            this.diplomaModal.style.display = 'none';
            this.diplomaModalCloseBtn.style.display = 'none';
            this.backgroundModal.style.display = 'none';
        }
    }

    openSignComplexModal()
    {
        if (this.signCourseComplexBlock && this.backgroundModal) {
            this.signCourseComplexBlock.style.display = 'block';
            this.backgroundModal.style.display = 'flex';

            let dynamicBlock = document.querySelector('.page._content > div > .sign-course-complex-block');
            dynamicBlock.style.display = 'block';
        }
    }

    initLinkedCourses()
    {
        let sliderBlock = $('.linked-courses-content');

        if (sliderBlock) {
            sliderBlock.slick({
                slidesToShow: 4,
                slidesToScroll: 1,
                infinite: false,
                autoplay: false,
                arrows: false,
                dots: true,
                variableWidth: false,
                responsive: [
                    {
                        breakpoint: 1400,
                        settings: {
                            slidesToShow: 3
                        }
                    },
                    {
                        breakpoint: 870,
                        settings: {
                            slidesToShow: 2
                        }
                    },
                    {
                        breakpoint: 550,
                        settings: {
                            slidesToShow: 1
                        }
                    }
                ]
            });
        }
    }
}

document.addEventListener("DOMContentLoaded", () => {
    new CatalogSectionComplex();
});