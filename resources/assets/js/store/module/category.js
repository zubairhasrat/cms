import Vue from 'vue'
import Vuex from 'vuex'
import _ from 'lodash'
import index from 'vuex';

Vue.use(Vuex)
const state = {
    categories:[],
    category: {
      id : null,
      title : null,
    },
}
const getters = {
    getCategory(){
      return state.categories
    },
}
const mutations = {
    SET_CATEGORY : (state,payload) => {
      state.category = payload
    },
    SET_CATEGORIES : (state,payload) =>{
      state.categories = payload
    },
    ADD_CATEGORIES (state, payload) {
      state.categories.unshift(_.cloneDeep(payload))
    },
    DELETE_CATEGORY (state,payload) {
      const index = state.categories.indexOf(payload);
      state.categories.splice(index, 1)
    },
}
const actions = {
    addCategory(context,payload){
      axios.post('api/category',{
        cat_name: payload
      })
      .then(response => {
        context.commit('SET_CATEGORY',response.data)
        context.commit('ADD_CATEGORIES',response.data)
      })
      .catch(e => {
        this.errors.push(e)
      })
    },
    getCategories(context){
      axios.get('api/getCategories',{
      })
      .then(response => {
        context.commit('SET_CATEGORIES',response.data)
      })
    },
    deleteCategory(context,payload){
     
      axios.delete('api/deletecategory/'+payload.id,{
      })
      .then(response => {
        context.commit('DELETE_CATEGORY',payload)
      })
    },
}
export default {
    state,
    getters,
    actions,
    mutations
  }