class BecomeCoach
{
    constructor(data = {
        closeCourseModalClass: '.close-course-modal',
        backgroundModalClass: '.background-modal',
        signCourseComplexBlockCLass: '.sign-course-complex-block',
        trainerModalClass: '.trainer-modal',
        fileBlockClass: '.file-block'
    }) {
        this.closeCourseModal = document.querySelector(data.closeCourseModalClass);
        this.backgroundModal = document.querySelector(data.backgroundModalClass);
        this.signCourseComplexBlock = document.querySelector(data.signCourseComplexBlockCLass);
        this.trainerModal = document.querySelectorAll(data.trainerModalClass);
        this.fileBlock = document.querySelectorAll(data.fileBlockClass);

        this.addSignCourseEventHandler();
        this.changeFormInput();
        this.changeFileEvents();
    }

    addSignCourseEventHandler()
    {

        if (this.closeCourseModal && this.backgroundModal && this.signCourseComplexBlock) {
            this.closeCourseModal.addEventListener('click', () => {
                this.backgroundModal.style.display = 'none';
                this.signCourseComplexBlock.style.display = 'none';
            });
        }

        if (this.trainerModal) {
            this.trainerModal.forEach(button => {
                button.addEventListener('click', () => {
                    this.openModal();
                });
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

        document.querySelector('input.city').addEventListener('input', function(event) {
            this.value = this.value.replace(/[^a-zA-Zа-яА-ЯёЁ\s]/g, '');
        });
    }

    openModal()
    {
        if (this.backgroundModal && this.signCourseComplexBlock) {
            this.backgroundModal.style.display = 'block';
            this.signCourseComplexBlock.style.display = 'block';
        }
    }

    changeFileEvents()
    {
        if (this.fileBlock) {
            this.fileBlock.forEach(block => {
                let input = block.querySelector('input');

                if (input) {
                    input.addEventListener('change', function () {
                        block.classList.add('added');

                        let fileName = this.files[0].name;
                        let fileSize = this.files[0].size;

                        let fileSizeI = block.querySelector('i');

                        if (fileSize && fileSizeI) {
                            let convertFileSize = fileSize / (1024 * 1024);
                            fileSizeI.textContent = convertFileSize.toFixed(3) + ' mb';
                        }

                        let span = block.querySelector('span');

                        if (fileName && span) {
                            span.textContent = fileName;
                        }
                    });

                    let removeInputBtn = block.querySelector('.remove-file');

                    if (removeInputBtn && input) {
                        removeInputBtn.addEventListener('click', function () {
                            block.classList.remove('added');
                            input.value = '';

                            let span = block.querySelector('span');

                            if (span) {
                                span.textContent = 'Прикрепить резюме';
                            }
                        });
                    }
                }
            });
        }
    }
}

document.addEventListener("DOMContentLoaded", () => {
    new BecomeCoach();
});