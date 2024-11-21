class SignCourse
{
    constructor(data = {
        selectDatesContentClass: '.select-dates-content',
        selectDatesBlockClass: '.select-dates-block',
        selectDateClass: '.select-date',
        dateInputClass: '.sign-course-form-input.date',
        faceInputClass: '.sign-course-form-input.face',
        signCourseTabPhysClass: '.sign-course-tab.phys',
        signCourseTabUrClass: '.sign-course-tab.ur',
        signBtnClass: '.btn-main',
    }) {
        this.selectDatesContent = document.querySelector(data.selectDatesContentClass);
        this.selectDatesBlock = document.querySelector(data.selectDatesBlockClass);
        this.selectDate = document.querySelectorAll(data.selectDateClass);
        this.dateInput = document.querySelector(data.dateInputClass);
        this.faceInput = document.querySelector(data.faceInputClass);
        this.signCourseTabPhys = document.querySelector(data.signCourseTabPhysClass);
        this.signCourseTabUr = document.querySelector(data.signCourseTabUrClass);
        this.signBtn = document.querySelectorAll(data.signBtnClass);

        this.addSignCourseEventHandler();
    }
    addSignCourseEventHandler()
    {
        if (this.signBtn) {
            this.signBtn.forEach(btn => {
                btn.addEventListener('click', () => {
                    const topPosition = document.querySelector('#'+btn.getAttribute("data-scroll")).getBoundingClientRect().top + window.pageYOffset - 50;

                    window.scrollTo({
                        top: topPosition,
                        behavior: 'smooth'
                    });
                });
            });
        }

        if (this.selectDatesContent && this.selectDatesBlock) {
            this.selectDatesContent.addEventListener('click', () => {
                if (this.selectDatesBlock.classList.contains('active')) {
                    this.selectDatesBlock.classList.remove('active');
                } else {
                    this.selectDatesBlock.classList.add('active');
                }
            });
        }

        if (this.selectDate && this.selectDatesContent && this.selectDatesBlock && this.dateInput) {
            this.selectDate.forEach(block => {
                block.addEventListener('click', () => {
                    let text = block.querySelector('span').textContent;
                    this.selectDatesContent.querySelector('span').textContent = text;
                    this.dateInput.value = text;
                    this.selectDatesBlock.classList.remove('active');
                });
            });
        }

        if (this.signCourseTabPhys && this.signCourseTabUr) {
            this.signCourseTabPhys.addEventListener('click', () => {
                this.signCourseTabPhys.classList.add('active');
                this.signCourseTabUr.classList.remove('active');

                this.editFaceInfo(this.signCourseTabPhys.querySelector('span').textContent);
            });

            this.signCourseTabUr.addEventListener('click', () => {
                this.signCourseTabUr.classList.add('active');
                this.signCourseTabPhys.classList.remove('active');

                this.editFaceInfo(this.signCourseTabUr.querySelector('span').textContent);
            });
        }
    }

    editFaceInfo(info)
    {
        if (this.faceInput && info) {
            this.faceInput.value = info;
        }
    }
}

document.addEventListener("DOMContentLoaded", () => {
    new SignCourse();
});