import Vue from 'vue'
import ElementUI from 'element-ui'
import '@/element-io/theme/index.css'
import locale from 'element-ui/lib/locale/lang/en'
import Vuelidate from 'vuelidate'
import VueMask from 'v-mask'
import courseModal from './template.vue'
import detailModalMenu from './templateMenu.vue'

function fixedMenu () {
    let scrollTop = $(window).scrollTop() + $('.header').height();
    let scrollMenu = parseInt($('.course-detail__menu-and-offer').offset().top)
    if (scrollTop > scrollMenu) {
        $('.course-menu-and-offer').addClass('fixed');
        $('.course-detail__menu-and-offer')
            .height($('.course-menu-and-offer').height())
            .addClass('fixed');
    } else {
        $('.course-menu-and-offer').removeClass('fixed');
        $('.course-detail__menu-and-offer')
            .css('height', 'auto')
            .removeClass('fixed');
    }
}

document.addEventListener('DOMContentLoaded', function () {
    Vue.use(VueMask);
    Vue.use(Vuelidate)
    Vue.use(ElementUI,{ locale });

    new Vue({
        render: (h) => h(courseModal)
    }).$mount('#courseModal')

    new Vue({
        render: (h) => h(detailModalMenu)
    }).$mount('#detailModalMenu')

    if ($('.course-menu-and-offer').length>0) {
        let header = document.querySelector('.header'),
            menu = document.querySelector('.course-menu-and-offer'),
            offer = document.querySelector('.course-detail__offer'),
            offerMarginTop = 0

        fixedMenu();

        window.addEventListener('scroll', function () {
            let scrollTop = window.scrollY
            let headerPosition = scrollTop + header.getBoundingClientRect().bottom,
                offerPosition = scrollTop + offer.getBoundingClientRect().top

            offerMarginTop = Math.round((headerPosition - offerPosition  > 0) ? headerPosition - offerPosition : 0)
            console.log('headerPosition:'+headerPosition, 'offerPosition:'+offerPosition, 'offerMarginTop:'+offerMarginTop);
            offer.style.paddingTop = offerMarginTop+'px'

            fixedMenu();
        });
    }

    document
        .querySelectorAll('.course-schedules__view-control')
        .forEach(function (item) {
            item.addEventListener('change', function (event) {
                document
                    .querySelectorAll('[data-schedules-type]')
                    .forEach(function (item) {
                        item.style.display = 'none'
                    })
                let schedulesTypeElement = document.querySelector('[data-schedules-type="'+event.target.value+'"]')

                schedulesTypeElement.style.display = 'block'
            })
        })

    document
        .querySelectorAll('.course-accordion .course-accordion-item__header')
        .forEach(function (item) {
            item.addEventListener('click', function (event) {
                var self = this

                if(self.classList.contains('active')) {
                    self.classList.remove('active')
                } else {
                    self.classList.add('active')
                }
            })
        })

    document
        .querySelectorAll('.js-course-detail-reviews')
        .forEach(function (item) {
            item.addEventListener('click', function (event) {
                var self = this
                BX.ajax.runComponentAction('luxoft:courses.detail', 'getReviews', {})
            })
        })

    document
        .querySelectorAll('.course-trainers-item__more')
        .forEach(function (item) {
            item.addEventListener('click', function (event) {
                var self = this
                if(self.parentElement.querySelector('.course-trainers-item__description')) {
                    let parentElement = self.parentElement
                    if(parentElement.classList.contains('open')) {
                        parentElement.classList.remove('open')
                    } else {
                        parentElement.classList.add('open')
                    }
                }
            })
        })

    document
        .querySelectorAll('.js-course-roadmap-show')
        .forEach(function (item) {
            item.addEventListener('click', function (event) {
                var self = this,
                    parentElement = self.parentElement,
                    alternativeText = self.getAttribute('data-alternative-text');

                if(self.classList.contains('open')) {
                    if(parentElement) {
                        parentElement.querySelectorAll('.course-accordion-item__header').forEach(function (headerItem) {
                            headerItem.classList.remove('active')
                        })
                    }

                    self.setAttribute('data-alternative-text', self.innerText)
                    self.classList.remove('open')
                    self.innerText = alternativeText;
                } else {
                    if(parentElement) {
                        parentElement.querySelectorAll('.course-accordion-item__header').forEach(function (headerItem) {
                            headerItem.classList.add('active')
                        })
                    }

                    self.setAttribute('data-alternative-text', self.innerText)
                    self.classList.add('open')
                    self.innerText = alternativeText;
                }
            })
        })

    document
        .querySelectorAll('.js-menu-scroll')
        .forEach(function (item) {

        })

    document.querySelectorAll('a[href^="#"]').forEach(link => {

        link.addEventListener('click', function(e) {
            e.preventDefault();

            let href = this.getAttribute('href').substring(1);

            const scrollTarget = document.getElementById(href);

            const topOffset = document.querySelector('.course-menu-and-offer').offsetHeight + document.querySelector('.header').offsetHeight;
            // const topOffset = 0; // если не нужен отступ сверху
            const elementPosition = scrollTarget.getBoundingClientRect().top;
            const offsetPosition = elementPosition - topOffset;

            window.scrollBy({
                top: offsetPosition,
                behavior: 'smooth'
            });
        });
    });

    document
        .querySelectorAll('.course-menu__mobile-dropdown-select')
        .forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                this.parentElement.classList.add('open')
            })
        })

    if(document.querySelector('.js_show-all-reviews') !== null) {
        document
            .querySelector('.js_show-all-reviews')
            .addEventListener('click', function(event) {
                event.preventDefault();
                event.stopPropagation();

                const self = this,
                    reviewsContainer = self.previousElementSibling,
                    alternativeText  = self.getAttribute('data-alternative-text')

                self.setAttribute('data-alternative-text', self.innerText)
                self.innerText = alternativeText;

                if(reviewsContainer.classList.contains('show-all')) {
                    reviewsContainer.classList.remove('show-all')
                } else {
                    reviewsContainer.classList.add('show-all')
                }
            })
    }

    document
        .querySelectorAll('.course-menu__mobile-dropdown-wrap')
        .forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                this.parentElement.classList.remove('open')
            })
        })

    document
        .querySelectorAll('.course-menu__mobile-dropdown .course-menu__link')
        .forEach(item => {
            item.addEventListener('click', function(e) {
                document.querySelector('.course-menu__mobile-dropdown-select').innerText = this.innerText
                document.querySelector('.course-menu__mobile-dropdown').classList.remove('open')
            })
        })
})