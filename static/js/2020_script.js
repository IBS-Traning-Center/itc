'use strict';
$(function () {
    $('.main-slider__list').slick({
        arrows: false,
        slidesToShow: 1,
        slidesToScroll: 1
    })

    $(document)
        .on('click', '.js-modal-show', function (e) {
            e.preventDefault(); e.stopPropagation();
            var $this = $(this),
                modalSelector = $this.attr('data-selector'),
                $modal = $(modalSelector);
                $modal = ($modal.length) ? $modal : $('.modal').eq(0)
            if($modal.length) {
                $modal.fadeIn();
                $('.modals').fadeIn(250);
            }
        })
        .on('click', '.modal__close, .modals__wrapper', function (e) {
            e.preventDefault(); e.stopPropagation();
            $('.modals').fadeOut(250, function () {
                $('.modal').fadeOut()
            });
        })
        .on('click', '.js-form-show', function (e) {
            e.preventDefault(); e.stopPropagation();

            $(this).removeClass('js-form-show');
            $(this).removeClass('_b-white');
            $(this).addClass('_submit');

            $(this).parent().find('.fields').removeClass('_hidden');
            $(this).parent().find('.fields').slideDown(300);
        })
        .on('click','.header__control._search', function () {
            $('.header__box._search').slideToggle(300);
        })
        .on('click','.header__control._nav', function (e) {
            e.preventDefault(); e.stopPropagation();
            $(".hidden-menu").show();
        })
        .on('click','.hidden-menu-header .close-menu',function () {
            $(".hidden-menu").hide();
        })
        .on('click', '.lang-switcher__select', function () {
            var $this = $(this),
                $langSwitcher = $this.parent();
            $langSwitcher.toggleClass('_open');
        })
        .on('click', function (e) {
            var $target = $(e.target);
            if(
                !$target.closest('.lang-switcher').length &&
                $('.lang-switcher').hasClass('_open')
            ) {
                $('.lang-switcher').removeClass('_open');
            }
        })


    $("#header").sticky({topSpacing:0});
    setTimeout(function () {
        if(!$('#header-sticky-wrapper').hasClass('is-sticky')) {
            $('.header__box._search').slideDown(300);
        }
    }, 100);

    $('#header').on('sticky-start', function() {
        $('.header__box._search').slideUp(300);
    });

    $('#header').on('sticky-end', function() {
        $('.header__box._search').slideDown(300);
    });

    $(window).scroll(function () {
        if($('#header-sticky-wrapper').hasClass('is-sticky')) {
            $('.header__box._search').slideUp(300);
        }
    })
});