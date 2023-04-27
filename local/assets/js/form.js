$(function () {
    var phoneInputs = document.querySelectorAll('input[type="tel"], input[name="phone"], .js-mask-phone');
    var getInputNumbersValue = function (input) {
        // Return stripped input value — just numbers
        return input.value.replace(/\D/g, '');
    }
    var onPhonePaste = function (e) {
        var input = e.target,
            inputNumbersValue = getInputNumbersValue(input);
        var pasted = e.clipboardData || window.clipboardData;
        if (pasted) {
            var pastedText = pasted.getData('Text');
            if (/\D/g.test(pastedText)) {
                // Attempt to paste non-numeric symbol — remove all non-numeric symbols,
                // formatting will be in onPhoneInput handler
                input.value = inputNumbersValue;
                return;
            }
        }
    }
    var onPhoneInput = function (e) {
        var input = e.target,
            inputNumbersValue = getInputNumbersValue(input),
            selectionStart = input.selectionStart,
            formattedInputValue = "";

        if (!inputNumbersValue) {
            return input.value = "";
        }

        if (input.value.length != selectionStart) {
            // Editing in the middle of input, not last symbol
            if (e.data && /\D/g.test(e.data)) {
                // Attempt to input non-numeric symbol
                input.value = inputNumbersValue;
            }
            return;
        }

        if (["7", "8", "9"].indexOf(inputNumbersValue[0]) > -1) {
            if (inputNumbersValue[0] == "9") inputNumbersValue = "7" + inputNumbersValue;
            var firstSymbols = (inputNumbersValue[0] == "8") ? "8" : "+7";
            formattedInputValue = input.value = firstSymbols + " ";
            if (inputNumbersValue.length > 1) {
                formattedInputValue += '(' + inputNumbersValue.substring(1, 4);
            }
            if (inputNumbersValue.length >= 5) {
                formattedInputValue += ') ' + inputNumbersValue.substring(4, 7);
            }
            if (inputNumbersValue.length >= 8) {
                formattedInputValue += '-' + inputNumbersValue.substring(7, 9);
            }
            if (inputNumbersValue.length >= 10) {
                formattedInputValue += '-' + inputNumbersValue.substring(9, 11);
            }
        } else {
            formattedInputValue = '+' + inputNumbersValue.substring(0, 16);
        }
        input.value = formattedInputValue;
    }
    var onPhoneKeyDown = function (e) {
        // Clear input after remove last symbol
        var inputValue = e.target.value.replace(/\D/g, '');
        if (e.keyCode == 8 && inputValue.length == 1) {
            e.target.value = "";
        }
    }
    for (var phoneInput of phoneInputs) {
        phoneInput.addEventListener('keydown', onPhoneKeyDown);
        phoneInput.addEventListener('input', onPhoneInput, false);
        phoneInput.addEventListener('paste', onPhonePaste, false);
    }

    $.validator.methods.email = function (value, element) {
        return this.optional(element) || /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/.test(value);
    };
    $.validator.addMethod(
        "regex",
        function (value, element, regexp) {
            if (regexp.constructor != RegExp)
                regexp = new RegExp(regexp);
            else if (regexp.global)
                regexp.lastIndex = 0;
            return this.optional(element) || regexp.test(value);
        },
        "Please check your input."
    );
    $.validator.addMethod(
        "checkElement",
        function (value, element, params) {
            var result = false;
            if(typeof params.element && $(params.element).length) {
                var rules = {},
                    fieldName = $(params.element).attr('name'),
                    $form = $(params.element).closest('form');

                rules[fieldName] = params.rules

                var validator = $form.validate({rules: rules})
                result = validator.element(params.element)
            }
            return this.optional(element) || result;
        },
        "Please check your input."
    );
    $.extend($.validator.messages, {
        required: "Это поле необходимо заполнить.",
        remote: "Пожалуйста, введите правильное значение.",
        email: "введите корректный email адрес",
        url: "Пожалуйста, введите корректный URL.",
        date: "Пожалуйста, введите корректную дату.",
        dateISO: "Пожалуйста, введите корректную дату в формате ISO.",
        number: "Пожалуйста, введите число.",
        digits: "Пожалуйста, вводите только цифры.",
        creditcard: "Пожалуйста, введите правильный номер кредитной карты.",
        equalTo: "Пожалуйста, введите такое же значение ещё раз.",
        extension: "Пожалуйста, выберите файл с правильным расширением.",
        maxlength: $.validator.format("Пожалуйста, введите не больше {0} символов."),
        minlength: $.validator.format("Пожалуйста, введите не меньше {0} символов."),
        rangelength: $.validator.format("Пожалуйста, введите значение длиной от {0} до {1} символов."),
        range: $.validator.format("Пожалуйста, введите число от {0} до {1}."),
        max: $.validator.format("Пожалуйста, введите число, меньшее или равное {0}."),
        min: $.validator.format("Пожалуйста, введите число, большее или равное {0}.")
    });
    var formRules = {
        'frdo-template': {
            'FIO': {
                required: true,
                minlength: 2
            },
            'COMPANY': {
                minlength: 2,
                required: true,
            },
            'BIRTHDAY': {
                minlength: 10,
                required: true,
            },
            'SNILS': {
                minlength: 14,
                required: true,
            },
            'EMAIL': {
                required: true,
                email: true
            },
            'POSITION': {
                required: true,
            },
            'POSITION_CUSTOM': {
                required: true,
            },
            'ADDRESS': {
                required: true,
            },
            'agree': {
                required: true,
            }
        },
        'frdo': {
            'COURSE-NAME': {
                required: true,
            },
            'COURSE': {
                required: true,
            },
            'FIO': {
                required: true,
                minlength: 2
            },
            'BIRTHDAY': {
                minlength: 10,
                required: true,
            },
            'SNILS': {
                minlength: 14,
                required: true,
            },
            'EMAIL': {
                required: true,
                email: true
            },
            'POSITION': {
                required: true,
            },
            'POSITION_CUSTOM': {
                required: true,
            },
            'ADDRESS': {
                required: true,
            },
            'agree': {
                required: true,
            }
        },
        'summer-school': {
            'PROPERTY_FULLNAME': {
                required: true,
                minlength: 2
            },
            'PROPERTY_EMAIL': {
                required: true,
                email: true
            },
            'PROPERTY_PHONE': {
                required: true,
                minlength: 17
            },
            'PROPERTY_COMPANY': {
                required: true,
                minlength: 2
            },
            'PROPERTY_CITY': {
                required: true,
                minlength: 2
            },
            "agree": {
                required: true
            },
            "agree-2": {
                required: true
            }
        },
        'send_price_list': {
            name: {
                required: true,
                minlength: 2
            },
            email: {
                required: true,
                email: true
            },
            phone: {
                required: true,
                minlength: 17
            },
            "agree": {
                required: true
            },
            "agree-2": {
                required: true
            }
        },
        'subscribe': {
            email: {
                required: true,
                email: true
            },
        },
        'callback-contacts': {
            name: {
                required: true,
                minlength: 2
            },
            company: {
                required: true,
                minlength: 2
            },
            phone: {
                required: true,
                minlength: 7
            },
            email: {
                required: true,
                email: true
            },
            agree: {
                required: true
            }
        },
        'callback-mini': {
            name: {
                required: true,
                minlength: 2
            },
            phone: {
                required: true,
            },
            email: {
                required: true,
                email: true
            },
            "agree": {
                required: true
            },
            "agree-2": {
                required: true
            }
        },
        'callback-modal': {
            name: {
                required: true,
                minlength: 2
            },
            phone: {
                required: true,
            },
            email: {
                required: true,
                email: true
            },
            "agree": {
                required: true
            },
            "agree-2": {
                required: true
            }
        },
    };
    function formInit() {
        $('[data-form-type=webform]').each(function () {
            var $this = $(this);
            var formName = $this.attr('name'),
                formID = parseInt($this.attr('data-form-id'));

            $this.validate({
                ignore: ".ignore",
                focusInvalid: true,
                errorPlacement: function (error, element) {
                    return true;
                },
                rules: formRules[formName],
                submitHandler: function (form) {
                    setTimeout(function() {
                        $('input, select').trigger('refresh');
                    }, 1);

                    $(form).css('pointer-events', 'none');
                    var data = new FormData(form);
                    data.append('url', location.href);
                    data.append('action', 'feedback');

                    var url ='/local/ajax/form.php';

                    switch (formName) {
                        case 'frdo-template':
                        case 'frdo':
                            var url ='/local/ajax/frdo.php';
                            break;
                        case 'summer-school':
                            var url ='/local/ajax/userOrder.php';
                            break;
                        case 'lighting-calculation':
                            data.append('form-id', '1');
                            break;
                        default:
                            data.append('form-name', formName);
                            data.append('form-id', formID);
                        break;
                    }
                    $.ajax({
                            url: url,
                            cache: false,
                            contentType: false,
                            processData: false,
                            type: 'POST',
                            data: data,
                            dataType: 'json',
                            success: function (data) {
                                if(data.type === 'ok') {
                                    if(formID == '27') {window.targetEvents.askQuestionContacts();}
                                    if(formID == '28') {window.targetEvents.webFormSpecificSolution();}
                                    if(formID == '37') {window.targetEvents.summerActionQuestion();}
                                    switch (formName) {
                                        case 'summer-school':
                                            window.targetEvents.summerActionRegistration();
                                            $this.closest('.overlay').find('.close').click()
                                            $('#success').bPopup({
                                                modalColor: '#14202b',
                                                closeClass: 'close'
                                            });
                                            break
                                        case 'send_price_list':
                                            $('.send-price-form-area').hide();
                                            setTimeout(function () {
                                                $('.mask').show();
                                            }, 250);
                                            break;
                                        case 'talent-search':
                                            $this.find('.form__success').addClass('_show');
                                            $this.find('.form__content').remove();
                                            break;
                                        default:
                                            $this.find('.form__success').addClass('_show');
                                            break;
                                    }
                                    form.reset();
                                }
                                $(form).css('pointer-events', 'all');
                                $('input, select').trigger('refresh');
                            },
                            error: function (data) {
                                $(form).css('pointer-events', 'all');
                                $('input, select').trigger('refresh');
                            }
                    });
                },
                invalidHandler: function (form,validator) {
                    setTimeout(function() {
                        $('input, select').trigger('refresh');
                    }, 1);
                }
            });
        });
    }
    formInit();
});
