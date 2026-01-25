class BecomeCoachForm
{
    constructor (data = {
        phoneSelector: '.sign-course-form-input.PHONE',
        fileInputSelector: '.sign-course-form-input.FILE[type="file"]',
        fileUploadWrapper: '.file-upload-wrapper',
        fileInfoSelector: '.file-info',
        fileNameSelector: '.file-name',
        clearFileBtnSelector: '.clear-file-btn',
        multiselectSelector: '.jq-select-multiple'
    }) {
        this.phoneSelector = data.phoneSelector;
        this.fileInputSelector = data.fileInputSelector;
        this.fileUploadWrapper = data.fileUploadWrapper;
        this.fileInfoSelector = data.fileInfoSelector;
        this.fileNameSelector = data.fileNameSelector;
        this.clearFileBtnSelector = data.clearFileBtnSelector;
        this.multiselectSelector = data.multiselectSelector;

        this.init();
    }

    init()
    {
        this.setPhonePlaceholder();
        this.initFileUploadEvents();
        this.initCustomMultiselect();
        this.initSubmitEvents();
    }

    setPhonePlaceholder()
    {
        $(this.phoneSelector).inputmask({
            mask: '+7 (999) 999-99-99',
            placeholder: '_',
            showMaskOnHover: true,
            showMaskOnFocus: true,
            clearIncomplete: true,
            showMaskOnHover: true
        });
    }

    initFileUploadEvents()
    {
        const fileInputs = document.querySelectorAll(this.fileInputSelector);
        
        if (fileInputs.length === 0) return;

        fileInputs.forEach(fileInput => {
            this.setupFileInput(fileInput);
        });
    }

    setupFileInput(fileInput)
    {
        const uploadWrapper = fileInput.closest(this.fileUploadWrapper) || 
                             fileInput.closest('.file-upload-wrapper') ||
                             fileInput.parentElement;
        
        if (!uploadWrapper) return;

        let fileInfo = uploadWrapper.querySelector(this.fileInfoSelector);
        let fileNameSpan = uploadWrapper.querySelector(this.fileNameSelector);
        let clearBtn = uploadWrapper.querySelector(this.clearFileBtnSelector);

        if (!fileInfo || !fileNameSpan || !clearBtn) {
            this.createFileInfoElements(uploadWrapper, fileInput);
            fileInfo = uploadWrapper.querySelector(this.fileInfoSelector);
            fileNameSpan = uploadWrapper.querySelector(this.fileNameSelector);
            clearBtn = uploadWrapper.querySelector(this.clearFileBtnSelector);
        }

        if (!fileInfo || !fileNameSpan || !clearBtn) return;

        const updateFileDisplay = (file) => {
            if (file) {
                let fileName = file.name;
                if (fileName.length > 40) {
                    const extension = fileName.split('.').pop();
                    const nameWithoutExt = fileName.substring(0, fileName.lastIndexOf('.'));
                    fileName = nameWithoutExt.substring(0, 30) + '...' + extension;
                }
                
                fileNameSpan.textContent = fileName;
                fileInfo.style.display = 'flex';
                uploadWrapper.classList.add('has-file');
            } else {
                fileInfo.style.display = 'none';
                uploadWrapper.classList.remove('has-file');
            }
        };

        fileInput.addEventListener('change', (e) => {
            const file = e.target.files[0];
            updateFileDisplay(file);
        });

        clearBtn.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();
            
            fileInput.value = '';
            
            updateFileDisplay(null);
        });

        fileInfo.addEventListener('click', (e) => {
            if (!e.target.classList.contains('clear-file-btn') && 
                !e.target.closest('.clear-file-btn')) {
                fileInput.click();
            }
        });

        if (fileInput.files.length > 0) {
            updateFileDisplay(fileInput.files[0]);
        }

        uploadWrapper.addEventListener('dragover', (e) => {
            e.preventDefault();
            uploadWrapper.classList.add('drag-over');
        });

        uploadWrapper.addEventListener('dragleave', () => {
            uploadWrapper.classList.remove('drag-over');
        });

        uploadWrapper.addEventListener('drop', (e) => {
            e.preventDefault();
            uploadWrapper.classList.remove('drag-over');
            
            if (e.dataTransfer.files.length) {
                fileInput.files = e.dataTransfer.files;
                fileInput.dispatchEvent(new Event('change', { bubbles: true }));
            }
        });
    }

    createFileInfoElements(uploadWrapper, fileInput)
    {
        if (uploadWrapper.querySelector('.file-info')) return;

        const fileInfo = document.createElement('div');
        fileInfo.className = 'file-info';
        fileInfo.style.display = 'none';

        const fileNameSpan = document.createElement('span');
        fileNameSpan.className = 'file-name';

        const clearBtn = document.createElement('button');
        clearBtn.type = 'button';
        clearBtn.className = 'clear-file-btn';
        clearBtn.title = 'Удалить файл';
        clearBtn.textContent = '×';

        fileInfo.appendChild(fileNameSpan);
        fileInfo.appendChild(clearBtn);

        fileInput.insertAdjacentElement('afterend', fileInfo);
    }

    initCustomMultiselect()
    {
        const multiselects = document.querySelectorAll(this.multiselectSelector);
        
        multiselects.forEach(multiselect => {
            this.createCustomMultiselect(multiselect);
        });
    }

    createCustomMultiselect(multiselectContainer)
    {
        try {
            const originalSelect = multiselectContainer.querySelector('select[multiple]');
            if (!originalSelect) {
                return;
            }

            if (multiselectContainer.querySelector('.custom-multiselect-wrapper')) {
                return;
            }
            
            multiselectContainer.style.cssText = 'display: none !important';
            
            const options = Array.from(originalSelect.options);
            
            const wrapperHtml = `
                <div class="custom-multiselect-wrapper">
                    <div class="custom-multiselect-box">
                        <span class="custom-multiselect-placeholder">Интересующие направления</span>
                        <div class="selected-tags"></div>
                        <div class="custom-multiselect-arrow"></div>
                    </div>
                    <div class="custom-multiselect-dropdown">
                        ${options.map(option => `
                            <div class="dropdown-option ${option.selected ? 'selected' : ''}" 
                                 data-value="${option.value}">
                                <span>${option.text}</span>
                                <span class="checkmark">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M9.70718 17.3805L21.2707 5.00004L22.0015 5.68262L10.438 18.0631L9.70718 17.3805Z" fill="black"/>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M2.70712 9.38043L10.8972 17.5705L10.1901 18.2776L2.00002 10.0875L2.70712 9.38043Z" fill="black"/>
                                    </svg>
                                </span>
                            </div>
                        `).join('')}
                    </div>
                    <div class="custom-multiselect-overlay"></div>
                </div>
            `;
            
            multiselectContainer.insertAdjacentHTML('afterend', wrapperHtml);
            
            const wrapper = multiselectContainer.nextElementSibling;
            const box = wrapper.querySelector('.custom-multiselect-box');
            const selectedTags = wrapper.querySelector('.selected-tags');
            const dropdown = wrapper.querySelector('.custom-multiselect-dropdown');
            const overlay = wrapper.querySelector('.custom-multiselect-overlay');
            
            const updateSelectedTags = () => {
                selectedTags.innerHTML = '';
                const selectedOptions = Array.from(originalSelect.selectedOptions);

                const hasSelected = selectedOptions.length > 0;
                box.classList.toggle('has-selected', hasSelected);

                selectedOptions.forEach(option => {
                    const tagHtml = `
                        <div class="selected-tag">
                            <span>${option.text}</span>
                            <span class="remove-tag" title="Удалить">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <line x1="19.1973" y1="5.35355" x2="4.34806" y2="20.2028" stroke="black"/>
                                    <line x1="19.2011" y1="20.2032" x2="4.35189" y2="5.35392" stroke="black"/>
                                </svg>
                            </span>
                        </div>
                    `;
                    selectedTags.insertAdjacentHTML('beforeend', tagHtml);

                    const lastTag = selectedTags.lastElementChild;
                    const removeBtn = lastTag.querySelector('.remove-tag');

                    removeBtn.addEventListener('click', (e) => {
                        e.stopPropagation();
                        option.selected = false;

                        const dropdownOption = wrapper.querySelector(
                            `.dropdown-option[data-value="${option.value}"]`
                        );
                        if (dropdownOption) {
                            dropdownOption.classList.remove('selected');
                        }

                        updateSelectedTags();

                        originalSelect.dispatchEvent(new Event('change', { bubbles: true }));
                        if (typeof $ !== 'undefined') {
                            $(originalSelect).trigger('change');
                        }
                    });
                });
            };
            
            updateSelectedTags();
            
            dropdown.querySelectorAll('.dropdown-option').forEach((dropdownOption, index) => {
                const option = originalSelect.options[index];
                
                dropdownOption.addEventListener('click', (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    
                    option.selected = !option.selected;
                    
                    dropdownOption.classList.toggle('selected');
                    
                    updateSelectedTags();
                    
                    const changeEvent = new Event('change', { bubbles: true });
                    originalSelect.dispatchEvent(changeEvent);
                    
                    if (typeof $ !== 'undefined') {
                        $(originalSelect).trigger('change');
                    }
                });
            });
            
            box.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                
                const isActive = dropdown.classList.contains('active');
                
                if (isActive) {
                    dropdown.classList.remove('active');
                    overlay.classList.remove('active');
                    box.classList.remove('active');
                } else {
                    dropdown.classList.add('active');
                    overlay.classList.add('active');
                    box.classList.add('active');
                }
            });
            
            overlay.addEventListener('click', (e) => {
                e.preventDefault();
                dropdown.classList.remove('active');
                overlay.classList.remove('active');
                box.classList.remove('active');
            });
            
            document.addEventListener('click', (e) => {
                if (!wrapper.contains(e.target)) {
                    dropdown.classList.remove('active');
                    overlay.classList.remove('active');
                    box.classList.remove('active');
                }
            });
            
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && dropdown.classList.contains('active')) {
                    dropdown.classList.remove('active');
                    overlay.classList.remove('active');
                    box.classList.remove('active');
                }
            });
            
        } catch (error) {
            console.error('Ошибка при создании кастомного мультиселекта:', error);
        }
    }

    initSubmitEvents() {
        const forms = document.querySelectorAll('form[name="become_coach_new"]');
        if (!forms.length) return;

        forms.forEach(form => {
            const submitBtn = form.querySelector('button[type="submit"], input[type="submit"]');
            if (!submitBtn) return;

            submitBtn.addEventListener('click', (e) => {
                let isValid = true;

                form.querySelectorAll('.error-message').forEach(msg => msg.remove());
                form.querySelectorAll('.error').forEach(el => el.classList.remove('error'));

                const fields = form.querySelectorAll('[name]');
                fields.forEach(field => {
                    const value = field.value?.trim?.() ?? '';

                    if (field.hasAttribute('required') && !value) {
                        isValid = false;
                        field.classList.add('error');
                        this.showError(field, 'Это поле обязательно для заполнения');
                    }

                    if (field.classList.contains('PHONE') && value) {
                        const phoneRegex = /^\+7 \(\d{3}\) \d{3}-\d{2}-\d{2}$/;
                        if (!phoneRegex.test(value)) {
                            isValid = false;
                            field.classList.add('error');
                            this.showError(field, 'Введите корректный номер телефона');
                        }
                    }

                    if (field.classList.contains('EMAIL') && value) {
                        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                        if (!emailRegex.test(value)) {
                            isValid = false;
                            field.classList.add('error');
                            this.showError(field, 'Введите корректный email');
                        }
                    }
                });

                // чекбоксы согласий
                const privacyPolicy = form.querySelector(
                    'input[name="form_checkbox_privacy_policy_coach[]"]'
                );
                if (privacyPolicy && !privacyPolicy.checked) {
                    isValid = false;
                    this.showError(
                        privacyPolicy.parentElement,
                        'Вы должны согласиться с обработкой персональных данных',
                        true
                    );
                }

                const personalData = form.querySelector(
                    'input[name="form_checkbox_agree_of_subject_coach[]"]'
                );
                if (personalData && !personalData.checked) {
                    isValid = false;
                    this.showError(
                        personalData.parentElement,
                        'Вы должны согласиться с условиями обработки персональных данных',
                        true
                    );
                }

                if (!isValid) {
                    e.preventDefault();
                    e.stopPropagation();
                }
            });
        });
    }

    showError(target, message, afterWrapperLevel = false) {
        const errorMsg = document.createElement('div');
        errorMsg.className = 'error-message';
        errorMsg.textContent = message;

        if (afterWrapperLevel) {
            target.parentElement.insertBefore(errorMsg, target.nextSibling);
        } else {
            target.insertAdjacentElement('afterend', errorMsg);
        }
    }
}

document.addEventListener('DOMContentLoaded', () => {
    new BecomeCoachForm();
});