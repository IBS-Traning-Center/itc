$(function () {
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
                minlength: 18
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

            $this.find('[name=phone]').inputmask({
                mask: "+7 (999) 999-99-99",
                showMaskOnHover: false
            });

            $this.find('[name=email]').inputmask({
                mask: "*{1,20}[.*{1,20}][.*{1,20}][.*{1,20}]@*{1,20}[.*{2,6}][.*{1,2}]",
                greedy: false,
                showMaskOnHover: false,
                onBeforePaste: function (pastedValue, opts) {
                    pastedValue = pastedValue.toLowerCase();
                    return pastedValue.replace("mailto:", "");
                },
                definitions: {
                    '*': {
                        validator: "[0-9A-Za-z!#$%&'*+/=?^_`{|}~\-]",
                        casing: "lower"
                    }
                }
            });

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
                        case 'lighting-calculation':
                            data.append('form-id', '1');
                            break;
                        default:
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
                                    switch (formName) {
                                        case 'send_price_list':
                                            $('.send-price-form-area').hide();
                                            setTimeout(function () {
                                                $('.mask').show();
                                            }, 250);
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
