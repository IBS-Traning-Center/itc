$(document).ready(function () {
    $('[data-cert]').on('click', function (e) {
        let cert = $(this).attr('data-cert');
        let certName = '';
        let certText = '';

        switch (cert) {
            case 'base':
                certName = 'Базовый';
                certText = 'Уровень «Базовый»';
                break;

            case 'special':
                certName = 'Специалист';
                certText = 'Уровень «Специалист»';
                break;
 
            case 'pro':
                certName = 'Профессионал';
                certText = 'Уровень «Профессионал»';
                break;
        
            default:
                break;
        }

        let formID = $(this).attr('data-scroll');        
        let select = $('#'+formID).find('select[name="form_dropdown_cert_level"]');
        let option = select.find('option:contains("'+ certName +'")');
        option.prop('selected', true);
        select.next().find('.jq-selectbox__select-text').text(certText);
        let currentPseudoLi = select.parent().find('.jq-selectbox__dropdown').find('li:contains("'+ certName +'")');
        currentPseudoLi.siblings().removeClass('selected').removeClass('sel');
        currentPseudoLi.addClass('selected').addClass('sel');
        
    });

    if($(window).width() >= 1280) {
        const levelsRowHeight = $('.levels__row').height();
    
        $('.levels__row').css({
            height: levelsRowHeight
        });
    
        $('.levels__item__content > div:first').each(function (index, el) { 
            $(el).css({
                minWidth: $(el).width(),
                width: $(el).width(),
                flexShrink: '0'
            });
        });
    
        
        $('.levels__item__showmore').on('click', function (e) {
            let item = $(this).parent();
    
            item.siblings().removeClass('opened');
            item.toggleClass('opened');
            item.removeClass('justify-content-end');
    
            item.siblings().find('.levels__item__desc').hide();
    
            if (item.find('.levels__item__desc').is(":hidden")) {
                item.find('.levels__item__desc').fadeIn(); // Плавное появление
                item.siblings().last().addClass('justify-content-end');
            } else {
                item.find('.levels__item__desc').hide(); // Мгновенное скрытие
                item.siblings().last().removeClass('justify-content-end');
            }

            if($(this).find('p').text() == 'Показать подробнее') {
                item.siblings().find('.levels__item__showmore p').removeClass('active');
                $(this).find('p').addClass('active');
                $(this).find('p').text('Скрыть информацию');
            } else {
                $(this).find('p').removeClass('active');
                $(this).find('p').text('Показать подробнее');
            }
        });


    } else if($(window).width() < 1280) {
        $('.levels__item__showmore--mobile').on('click', function (e) {
            let item = $(this).parent();
            let textBlock = item.find('.levels__item__desc--mobile__text');
            textBlock.slideToggle();
            console.log(textBlock);

            if($(this).find('p').text() == 'Показать подробнее') {
                item.siblings().find('.levels__item__showmore--mobile p').removeClass('active');
                $(this).find('p').addClass('active');
                $(this).find('p').text('Скрыть информацию');
            } else {
                $(this).find('p').removeClass('active');
                $(this).find('p').text('Показать подробнее');
            }
        });
    }

    $('.open_level_modal_form').on('click', function (e) {
        e.preventDefault();

        $(this).parent().next().addClass('show');

        // console.log();
    });

    $('.levels__item__modal--bg').on('click', function (e) {
        $(this).parent().removeClass('show');
    });

    $('.levels__item__modal--window__close').on('click', function (e) {
        $(this).parent().parent().removeClass('show');
    });

    $('.scroll-to-levels').on('click', function (e) {
        e.preventDefault();
        $('html, body').animate({
            scrollTop: $('#levels').offset().top + 40
        }, 1000);
    });
});