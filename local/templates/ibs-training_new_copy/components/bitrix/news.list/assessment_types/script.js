$(document).ready(function () {
    $('.assessment_types').find('[data-type]').on('click', function (e) {
        let type = $(this).attr('data-type');
        let certName = '';
        let certText = '';

        switch (type) {
            case 'testing':
                certName = 'Тестирование';
                certText = 'Тестирование';
                break;

            case 'expert':
                certName = 'Экспертная оценка';
                certText = 'Экспертная оценка';
                break;

            case 'cert':
                certName = 'Сертификация';
                certText = 'Сертификация';
                break;
        
            default:
                break;
        }

        let formID = $(this).attr('data-scroll');        
        let select = $('#'+formID).find('select[name="form_dropdown_expert_testing"]');
        let option = select.find('option:contains("'+ certName +'")');
        option.prop('selected', true);
        select.next().find('.jq-selectbox__select-text').text(certText);
        let currentPseudoLi = select.parent().find('.jq-selectbox__dropdown').find('li:contains("'+ certName +'")');
        currentPseudoLi.siblings().removeClass('selected').removeClass('sel');
        currentPseudoLi.addClass('selected').addClass('sel');
        
    });
});