import Vue from 'vue'
import basketPage from './basketPage.vue'

document.addEventListener('DOMContentLoaded', function () {
    new Vue({
        render: (h) => h(basketPage)
    }).$mount('#basketPage')
})