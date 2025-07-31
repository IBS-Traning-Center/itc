class ApplicationsFormBlock
{
    constructor(data = {
        feedbackFormBtnClass: '.btn-main',
        applicationsFormBlockId: 'applicationsFormBlock',
        selectDatesContentClass: '.select-dates-content',
        selectDateClass: '.select-date',
        dateInputClass: '.main-feedback-form-input.date',
        selectFreeDateClass: '.select-free-date',
        selectDatesBlockClass: '.select-dates-block',
        selectDatesBlockChildrenClass: '.select-dates',
        selectDateInputBlockClass: '.select-date-input',
        radioChangeCityName: '[name="form_radio_cert_location[]"]',
        certLevelClass: '.cert-level',
        jqSelectboxDropdownClass: '.jq-selectbox__dropdown ul li',
        scrollBtnSelector: '[data-scroll="applicationsFormBlock"]',
        defaultDateClass: '.date-default-block.question-block',
        takeDateBlockClass: '.take-date-block'
    }) {
        this.applicationsFormBlock = document.getElementById(data.applicationsFormBlockId);
        this.feedbackFormBtn = this.applicationsFormBlock.querySelectorAll(data.feedbackFormBtnClass);
        this.selectDatesContent = this.applicationsFormBlock.querySelectorAll(data.selectDatesContentClass);
        this.selectDateClass = data.selectDateClass;
        this.dateInput = this.applicationsFormBlock.querySelector(data.dateInputClass);
        this.selectFreeDate = this.applicationsFormBlock.querySelectorAll(data.selectFreeDateClass);
        this.selectDatesBlock = this.applicationsFormBlock.querySelectorAll(data.selectDatesBlockClass);
        this.selectDatesBlockChildrenClass = data.selectDatesBlockChildrenClass;
        this.selectDateInputBlockClass = data.selectDateInputBlockClass;
        this.radioChangeCity = this.applicationsFormBlock.querySelectorAll(data.radioChangeCityName);
        this.certLevel = this.applicationsFormBlock.querySelectorAll(data.certLevelClass);
        this.jqSelectboxDropdown = this.applicationsFormBlock.querySelectorAll(data.jqSelectboxDropdownClass);
        this.scrollBtn = document.querySelectorAll(data.scrollBtnSelector);
        this.defaultDate = document.querySelector(data.defaultDateClass);
        this.takeDateBlock = document.querySelector(data.takeDateBlockClass);
        this.selectedLevel = 'basic';
        this.selectedCity = 'onl';

        this.addApplicationsFormEventHandler();
        this.changeStateDate();

        const urlParams = new URLSearchParams(window.location.search);
        const scrollTo = urlParams.get('scrollTo');
        
        if (scrollTo === 'applicationsFormBlock') {
            const element = document.getElementById('applicationsFormBlock');
            if (element) {
                element.scrollIntoView({});
                
                const newUrl = new URL(window.location.href);
                newUrl.searchParams.delete('scrollTo');
                window.history.replaceState({}, document.title, newUrl.toString());
            }
        }
    }

    addApplicationsFormEventHandler()
    {
        if (this.feedbackFormBtn) {
            this.feedbackFormBtn.forEach(btn => {
                btn.addEventListener('click', () => {
                    this.applicationsFormBlock.querySelector('#'+btn.getAttribute("data-scroll")).scrollIntoView({ block: "start", behavior: "smooth" });
                });
            });
        }

        if (this.selectDatesContent) {
            let i = 0;

            this.selectDatesContent.forEach(block => {
                let selectDatesBlock = block.parentNode;

                block.addEventListener('click', () => {
                    if (selectDatesBlock.classList.contains('active')) {
                        selectDatesBlock.classList.remove('active');
                    } else {
                        selectDatesBlock.classList.add('active');
                    }
                });

                let selectDate = selectDatesBlock.querySelectorAll(this.selectDateClass);

                if (selectDate) {
                    let key = 0;

                    selectDate.forEach(select => {
                        if (key == 0 && i == 0) {
                            this.dateInput.value = select.querySelector('span').textContent;
                        }

                        select.addEventListener('click', () => {
                            let text = select.querySelector('span').textContent;
                            selectDatesBlock.querySelector('span').textContent = text;
                            this.dateInput.value = text;
                            selectDatesBlock.classList.remove('active');
                        });

                        key++;
                    });
                }

                i++;
            });
        }

        if (this.selectFreeDate) {
            this.selectFreeDate.forEach(input => {
                input.addEventListener('input', () => {
                    let [year, month, day] = input.value.split('-');
                    let formattedDate = `${day}.${month}.${year}`;

                    this.dateInput.value = formattedDate;
                });
            });
        }

        if (this.radioChangeCity) {
            this.radioChangeCity.forEach(input => {
                input.addEventListener('change', () => {
                    if (input.checked) {
                        this.selectedCity = input.dataset.value;
                        this.changeStateDate();
                    }
                });
            });
        }

        if (this.jqSelectboxDropdown && this.certLevel) {
            this.jqSelectboxDropdown.forEach(option => {
                option.addEventListener('click', () => {
                    this.certLevel.forEach(level => {
                        if (level.textContent.trim() == option.textContent.trim()) {
                            this.selectedLevel = level.dataset.value;
                            this.changeStateDate();
                        }
                    });

                    this.defaultDate.style.display = 'none';
                    this.takeDateBlock.style.display = 'block';
                });
            });
        }

        if (this.scrollBtn) {
            this.scrollBtn.forEach(btn => {
                btn.addEventListener('click', () => {
                    let dataCert = btn.dataset.cert;
                    
                    switch (dataCert) {
                        case 'base' :
                            this.selectedLevel = 'basic';
                            break;
                        case 'special' :
                            this.selectedLevel = 'spec';
                            break;
                        case 'pro' :
                            this.selectedLevel = 'prof';
                            break;
                    }

                    this.changeStateDate();

                    this.defaultDate.style.display = 'none';
                    this.takeDateBlock.style.display = 'block';
                });
            });
        }
    }

    changeStateDate()
    {
        if (this.selectDatesBlock) {
            this.selectDatesBlock.forEach(mainBlock => {
                let existMainNeedBlock = mainBlock.classList.contains(this.selectedLevel);
                mainBlock.style.display = 'none';

                if (existMainNeedBlock) {
                    mainBlock.style.display = 'block';

                    let dateSelectBlocks = mainBlock.querySelectorAll(this.selectDatesBlockChildrenClass);
                    let dateInputBlock = mainBlock.querySelector(this.selectDateInputBlockClass);
                    let countExistsBlocks = 0;

                    dateSelectBlocks.forEach(block => {
                        let existNeedBlock = block.classList.contains(this.selectedCity);
                        block.style.display = 'none';
                        dateInputBlock.style.display = 'none';

                        if (existNeedBlock) {
                            block.style.display = 'block';
                            countExistsBlocks++;
                        }
                    });

                    if (countExistsBlocks === 0) {
                        dateInputBlock.style.display = 'block';
                    }
                }
            });
        }
    }
}

document.addEventListener("DOMContentLoaded", () => {
    new ApplicationsFormBlock();
});

/* Yandex.Metrika counter */ (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)}; m[i].l=1*new Date(); for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }} k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)}) (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym"); /* /Yandex.Metrika counter */
ym(23056159, 'getClientID', function(clientID) {
    document.getElementById('clientID').value = clientID;
});