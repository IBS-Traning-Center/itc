class CourseSection
{
    constructor(data = {
        filterCourseBlockClass: '.filter-course-block',
        openFilterMobileBtnClass: '.open-filter-mobile-btn',
        mobileFilterModalClass: '.mobile-filter-modal',
        mobileFilterModalContentClass: '.mobile-filter-modal-content',
        backgroundModalFilterClass: '.background-modal-filter',
        setFilterBtnId: 'set_filter',
        delFilterBtnId: 'del_filter'
    }) {
        this.filterCourseBlock = document.querySelector(data.filterCourseBlockClass);
        this.openFilterMobileBtn = document.querySelector(data.openFilterMobileBtnClass);
        this.mobileFilterModal = document.querySelector(data.mobileFilterModalClass);
        this.mobileFilterModalContent = document.querySelector(data.mobileFilterModalContentClass);
        this.backgroundModalFilter = document.querySelector(data.backgroundModalFilterClass);
        
        this.setFilterBtn = document.getElementById(data.setFilterBtnId);
        this.delFilterBtn = document.getElementById(data.delFilterBtnId);

        if (window.innerWidth < 1181) {
            this.modalOpenFilterMobile();
            this.changeLocationMobileFilterBlock();
            this.backgroundModalFilterHandlerListener();
            this.addEventHandlerFilterButtons();
        }
    }

    addEventHandlerFilterButtons()
    {
        if (this.setFilterBtn) {
            this.setFilterBtn.addEventListener('click', () => {
                this.modalCloseFilterModal();
            });
        }

        if (this.delFilterBtn) {
            this.delFilterBtn.addEventListener('click', () => {
                this.modalCloseFilterModal();
            });
        }
    }

    changeLocationMobileFilterBlock()
    {
        if (
            this.filterCourseBlock &&
            this.mobileFilterModalContent
        ) {
            this.mobileFilterModalContent.appendChild(this.filterCourseBlock);
        }
    }

    modalOpenFilterMobile()
    {
        if (
            this.openFilterMobileBtn &&
            this.mobileFilterModal &&
            this.backgroundModalFilter
        ) {
            this.openFilterMobileBtn.addEventListener('click', () => {
                this.mobileFilterModal.style.display = 'block';
                this.backgroundModalFilter.style.display = 'block';
            });
        }
    }

    backgroundModalFilterHandlerListener()
    {
        if (
            this.backgroundModalFilter &&
            this.mobileFilterModal
        ) {
            this.backgroundModalFilter.addEventListener('click', () => {
                this.modalCloseFilterModal();
            });
        }
    }

    modalCloseFilterModal()
    {
        if (
            this.backgroundModalFilter &&
            this.mobileFilterModal
        ) {
            this.mobileFilterModal.style.display = 'none';
            this.backgroundModalFilter.style.display = 'none';
        }
    }
}

document.addEventListener("DOMContentLoaded", () => {
    new CourseSection();
});