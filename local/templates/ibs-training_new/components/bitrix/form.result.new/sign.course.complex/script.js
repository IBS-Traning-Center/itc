class SignCourseComplex
{
    constructor(data = {
        selectDatesContentClass: '.select-dates-content',
        selectDatesBlockClass: '.select-dates-block',
        selectDateClass: '.select-date',
        dateInputClass: '.sign-course-form-input.date',

        selectTariffsContentClass: '.select-tariffs-content',
        selectTariffsBlockClass: '.select-tariffs-block',
        selectTariffClass: '.select-tariff',
        tariffInputClass: '.sign-course-form-input.tariff',

        closeCourseModalClass: '.close-course-modal',
        backgroundModalClass: '.background-modal',
        signCourseComplexBlockCLass: '.sign-course-complex-block'
    }) {
        this.selectDatesContent = document.querySelector(data.selectDatesContentClass);
        this.selectDatesBlock = document.querySelector(data.selectDatesBlockClass);
        this.selectDate = document.querySelectorAll(data.selectDateClass);
        this.dateInput = document.querySelector(data.dateInputClass);

        this.selectTariffsContent = document.querySelector(data.selectTariffsContentClass);
        this.selectTariffsBlock = document.querySelector(data.selectTariffsBlockClass);
        this.selectTariff = document.querySelectorAll(data.selectTariffClass);
        this.tariffInput = document.querySelector(data.tariffInputClass);

        this.closeCourseModal = document.querySelector(data.closeCourseModalClass);
        this.backgroundModal = document.querySelector(data.backgroundModalClass);
        this.signCourseComplexBlock = document.querySelector(data.signCourseComplexBlockCLass);

        this.addSignCourseEventHandler();
        this.changeFormInput();
    }

    addSignCourseEventHandler()
    {
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

        if (this.selectTariffsContent && this.selectTariffsBlock) {
            this.selectTariffsContent.addEventListener('click', () => {
                if (this.selectTariffsBlock.classList.contains('active')) {
                    this.selectTariffsBlock.classList.remove('active');
                } else {
                    this.selectTariffsBlock.classList.add('active');
                }
            });
        }

        if (this.selectTariff && this.selectTariffsContent && this.selectTariffsBlock && this.tariffInput) {
            this.selectTariff.forEach(block => {
                block.addEventListener('click', () => {
                    let text = block.querySelector('span').textContent;
                    this.selectTariffsContent.querySelector('span').textContent = text;
                    this.tariffInput.value = text;
                    this.selectTariffsBlock.classList.remove('active');
                });
            });
        }

        if (this.closeCourseModal && this.backgroundModal && this.signCourseComplexBlock) {
            this.closeCourseModal.addEventListener('click', () => {
                this.backgroundModal.style.display = 'none';
                this.signCourseComplexBlock.style.display = 'none';
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
}

document.addEventListener("DOMContentLoaded", () => {
    new SignCourseComplex();
});