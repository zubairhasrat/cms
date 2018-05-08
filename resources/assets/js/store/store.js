import Vue from 'vue'
import Vuex from 'vuex'
import _ from 'lodash'
import category from './module/category'
import post from './module/post'
import comment from './module/comment'
import user from './module/user'
Vue.use(Vuex)

const store = new Vuex.Store({
  modules: {
    category,
    post,
    comment,
    user
  },
})
export default store