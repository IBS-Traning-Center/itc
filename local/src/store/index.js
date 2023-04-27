import Vue from 'vue'
import Vuex from 'vuex'
import order from './modules/order'
import analytics from './modules/analytics'
import courseDetail from './modules/courseDetail'
import createLogger from '@/plugins/logger'

Vue.use(Vuex)

const debug = process.env.NODE_ENV !== 'production'

export default new Vuex.Store({
    modules: {
        courseDetail,
        analytics,
        order,
    },
    strict: debug,
    plugins: debug ? [createLogger()] : []
})