class CatalogSectionComplex {
    constructor(data = {
        linkedCourseItemClass: '.linked-course-item',
        showDiplomBtnClass: '.show-diplom-btn',
        diplomaModalClass: '.diploma-modal',
        diplomaModalCloseBtnClass: '.diploma-modal-close-btn',
        showAwardBtnClass: '.show-award-btn',
        awardModalClass: '.award-modal',
        awardModalCloseBtnClass: '.award-modal-close-btn',
        showFormatBtnClass: '.show-format-btn',
        formatModalClass: '.format-modal',
        formatModalCloseBtnClass: '.format-modal-close-btn',
        backgroundModalClass: '.background-modal',
        signCourseComplexBlockCLass: '.sign-course-complex-block',
        openSignModalClass: '.open-sign-modal',
        signTariffBtnClass: '.sign-tariff-btn',
        selectTariffClass: '.select-tariff',
        signCourseComplexBlockDemoCLass: '.sign-course-complex-block.demo',
        openDemoModalClass: '.open-demo-modal',
        signCourseMagnetBlockCLass: '.sign-course-magnet-block',
        openSignMagnetModalClass: '.open-sign-magnet-modal',
    }) {
        this.linkedCourseItem = document.querySelectorAll(data.linkedCourseItemClass);
        this.showDiplomBtn = document.querySelector(data.showDiplomBtnClass);
        this.diplomaModal = document.querySelector(data.diplomaModalClass);
        this.diplomaModalCloseBtn = document.querySelector(data.diplomaModalCloseBtnClass);
        this.showAwardBtn = document.querySelector(data.showAwardBtnClass);
        this.awardModal = document.querySelector(data.awardModalClass);
        this.awardModalCloseBtn = document.querySelector(data.awardModalCloseBtnClass);
        this.showFormatBtn = document.querySelector(data.showFormatBtnClass);
        this.formatModal = document.querySelector(data.formatModalClass);
        this.formatModalCloseBtn = document.querySelector(data.formatModalCloseBtnClass);
        this.backgroundModal = document.querySelector(data.backgroundModalClass);
        this.signCourseComplexBlock = document.querySelector(data.signCourseComplexBlockCLass);
        this.openSignModal = document.querySelectorAll(data.openSignModalClass);
        this.signTariffBtn = document.querySelectorAll(data.signTariffBtnClass);
        this.selectTariff = document.querySelectorAll(data.selectTariffClass);
        this.signCourseComplexBlockDemo = document.querySelector(data.signCourseComplexBlockDemoCLass);
        this.openDemoModal = document.querySelectorAll(data.openDemoModalClass);
        this.signCourseMagnetBlock = document.querySelector(data.signCourseMagnetBlockCLass);
        this.openSignMagnetModal = document.querySelectorAll(data.openSignMagnetModalClass);

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

        if (this.showAwardBtn) {
            this.showAwardBtn.addEventListener('click', () => {
                this.openAwardModal();
            });
        }

        if (this.awardModalCloseBtn) {
            this.awardModalCloseBtn.addEventListener('click', () => {
                this.closeAwardModal();
            });
        }

        if (this.showFormatBtn) {
            this.showFormatBtn.addEventListener('click', () => {
                this.openFormatModal();
            });
        }

        if (this.formatModalCloseBtn) {
            this.formatModalCloseBtn.addEventListener('click', () => {
                this.closeFormatModal();
            });
        }

        if (this.backgroundModal) {
            this.backgroundModal.addEventListener('click', () => {
                this.closeDiplomModal();
                this.closeAwardModal();
                this.closeFormatModal();

                if (this.signCourseComplexBlock) {
                    this.signCourseComplexBlock.style.display = 'none';
                }
                if (this.signCourseComplexBlockDemo) {
                    this.signCourseComplexBlockDemo.style.display = 'none';
                }
                if (this.signCourseMagnetBlock) {
                    this.signCourseMagnetBlock.style.display = 'none';
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

        if (this.openDemoModal) {
            this.openDemoModal.forEach(elem => {
               elem.addEventListener('click', () => {
                this.openSignComplexModalDemo();
               });
            });
        }

        if (this.openSignMagnetModal) {
            this.openSignMagnetModal.forEach(block => {
                block.addEventListener('click', () => {
                    this.openMagnetModal();
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

    openAwardModal()
    {
        if (
            this.backgroundModal &&
            this.awardModal &&
            this.awardModalCloseBtn
        ) {
            this.awardModal.style.display = 'flex';
            this.awardModalCloseBtn.style.display = 'flex';
            this.backgroundModal.style.display = 'flex';
        }
    }

    closeAwardModal()
    {
        if (
            this.backgroundModal &&
            this.awardModal &&
            this.awardModalCloseBtn
        ) {
            this.awardModal.style.display = 'none';
            this.awardModalCloseBtn.style.display = 'none';
            this.backgroundModal.style.display = 'none';
        }
    }

    openFormatModal()
    {
        if (
            this.backgroundModal &&
            this.formatModal &&
            this.formatModalCloseBtn
        ) {
            this.formatModal.style.display = 'flex';
            this.formatModalCloseBtn.style.display = 'flex';
            this.backgroundModal.style.display = 'flex';
        }
    }

    closeFormatModal()
    {
        if (
            this.backgroundModal &&
            this.formatModal &&
            this.formatModalCloseBtn
        ) {
            this.formatModal.style.display = 'none';
            this.formatModalCloseBtn.style.display = 'none';
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

    openSignComplexModalDemo()
    {
        if (this.signCourseComplexBlockDemo && this.backgroundModal) {
            this.signCourseComplexBlockDemo.style.display = 'block';
            this.backgroundModal.style.display = 'flex';
        }
    }

    openMagnetModal()
    {
        if (this.signCourseMagnetBlock && this.backgroundModal) {
            this.signCourseMagnetBlock.style.display = 'block';
            this.backgroundModal.style.display = 'flex';
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