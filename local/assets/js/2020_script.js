'use strict';
$(function () {
    $('.main-slider__list').slick({
        arrows: false,
        slidesToShow: 1,
        slidesToScroll: 1
    })

    function formFailInit() {
        function fileAdd(e) {
            var self = this;
            [].forEach.call(this.files, function (el) {
                if ((el.size / 1024 / 1024) > self.dataset.maxSize) return;
                var newInp = document.createElement("input");
                newInp.type = "file";
                newInp.name = self.name;
                newInp.dataset.maxsize = self.dataset.maxsize;
                newInp.setAttribute('data-name', self.getAttribute('data-name'))
                newInp.onchange = fileAdd;
                self.parentElement.appendChild(newInp);
                self.name = self.getAttribute('data-name');
                self.setAttribute('data-name', el.name)
                self.classList.add('h-content')
                var html = "<li><i class=\"fa fa-times fa-1\" aria-hidden=\"true\"></i><span class='element-file'>" + el
                        .name +
                    "</span></li>";
                var elHtml = htmlToElements(html)[0];
                elHtml.querySelector(".fa").onclick = fileDelete;
                self.parentElement.nextElementSibling.appendChild(elHtml);
                self.parentElement.nextElementSibling.appendChild(self);
            })
        }

        function fileDelete(e) {
            var name = this.parentElement.innerText.trim();
            this.parentElement.parentElement.querySelector("input[data-name=\"" + name + "\"]").remove();
            this.parentElement.remove();
        }

        function htmlToElements(html) {
            var template = document.createElement('template');
            template.innerHTML = html;
            return template.content.childNodes;
        }

        function formReset(form) {
            form.reset();
            form.querySelector(".file-list").innerHTML = "";
        }

        document.querySelectorAll("form input[name=visualFile]").forEach(function (item) {
            item.onchange = fileAdd;
        });
    }

    formFailInit();


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
                $('body').css('overflow', 'visible')
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
            if($('#header-sticky-wrapper').hasClass('is-sticky')) {
                $('.header__box._search').slideToggle(300);
            }
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

    $(document)
        .on('click','#js_add_user_info', function () {
            var $userField = [
                    {name: 'ФИО', code: 'full-name'},
                    {name: 'Дата рождения', code: 'date-birth'},
                    {name: 'СНИЛС <br>(только граждане РФ)', code: 'SNILS'},
                    {name: 'Телефон', code: 'phone'},
                    {name: 'Адрес Обучающегося', code: 'address'},
                ],
                $newRow = '';

            function renderUserRow(field) {
                return `              
                    <div>
                        <div class="bx_block r1x3 pt8">${field.name}<span class="bx_sof_req">*</span></div>
                        <div class="bx_block r3x1">
                            <input type="text" name="${field.code}" maxlength="250" size="0" value="">
                        </div>
                        <div style="clear: both;"></div>
                    </div>`
            }
            $userField.forEach(function (element) {
                $newRow += renderUserRow(element);
            })
            $(this).before(
                '<br><hr><br>' +
                '<div class="clientInfo">'+$newRow+'</div>'
            )
        })
        .on('change','.clientInfo input', function () {
            function allData () {
                var $all = [],
                    $str = '';

            $('.clientInfo').each(function () {
                    var currentUser = {};
                    $(this).find('input').each(function ($indexField, $field) {
                        currentUser[$(this).attr('name')] = $(this).val();
                        $str += $(this).val() + ';'
                    })
                    $str += '\r\n';
                    $all.push(currentUser);
                })
                return $str;
            }
            $('#clientInfoAllResult').text(allData());
        })
        .on('change','#isShowUserInfo', function () {
            if(!$(this).prop('checked')) {
                $('.clientsInfo').css('display','none');
            } else {
                $('.clientsInfo').css('display', 'block');
            }
        })
});
