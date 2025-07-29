class SignCourseMagnet
{
    constructor(data = {
        closeCourseMagnetModalClass: '.close-course-magnet-modal',
        backgroundModalClass: '.background-modal',
        signCourseMagnetBlockCLass: '.sign-course-magnet-block'
    }) {
        this.closeCourseMagnetModal = document.querySelector(data.closeCourseMagnetModalClass);
        this.backgroundModal = document.querySelector(data.backgroundModalClass);
        this.signCourseMagnetBlock = document.querySelector(data.signCourseMagnetBlockCLass);

        this.addSignCourseEventHandler();
        this.changeFormInput();
    }

    addSignCourseEventHandler()
    {
        if (this.closeCourseMagnetModal && this.backgroundModal && this.signCourseMagnetBlock) {
            this.closeCourseMagnetModal.addEventListener('click', () => {
                this.backgroundModal.style.display = 'none';
                this.signCourseMagnetBlock.style.display = 'none';
            });
        }
    }

    changeFormInput()
    {
        $(document).on('change keyup input click', 'input.phone', function() {
            if (this.value.match(/[^0-9]/g)) {
                this.value = this.value.replace(/[^0-9]/g, '');
            }
        });
    }
}

document.addEventListener("DOMContentLoaded", () => {
    new SignCourseMagnet();
});