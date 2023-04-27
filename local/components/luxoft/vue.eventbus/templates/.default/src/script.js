import Vue from 'vue';
import store from '@/store';
window.vueEventBus = new Vue({
    created() {
        this.$on('courseDetailModal', function (show) {
            return store.dispatch('courseDetail/setShowModal', show);
        })
    }
})
