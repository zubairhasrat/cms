import Vue from 'vue'
import Vuex from 'vuex'
import _ from 'lodash'
import index from 'vuex';

Vue.use(Vuex)
const state = {
    comments:[],
  comment:{
    comment_author: null,
    comment_author_email:null,
    comment_content:null,
    comment_status:null,
    comment_post_id:null
  },
}
const getters = {
    getComment(){
        return state.comment
      },
      getAllComments(){
        return state.comments
      },
}
const mutations = {
    SET_COMMENT : (state,payload) => {
        state.comment =payload;
      },
      SET_COMMENTS : (state,payload) => {
        state.comments=payload;
      },
      ADD_COMMENT: (state,payload) => {
        state.comments.unshift(_.cloneDeep(payload))
      },
      DELETE_COMMENT : (state,payload) => {
        const index = state.comments.indexOf(payload);
        state.comments.splice(index, 1)
      },
      EDIT_COMMENT: (state,payload) => {
        const index = state.comments.indexOf(payload)
        delete payload.index
        state.comments[index] = payload
      },
      SET_NULL_COMMENT:(state) => {
        state.comment = {
          comment_author: null,
          comment_author_email:null,
          comment_content:null,
          comment_status:null,
          comment_post_id:null
        };
      },
}
const actions = {
    addComment(context,payload){
        axios.post('api/addcomment',{
          comment_author: payload.comments.comment_author,
          comment_author_email: payload.comments.comment_author_email,
          comment_content: payload.comments.comment_content,
          comment_status: 'unapprove',
          comment_post_id: payload.posts.id
        })
        .then(response => {
          context.commit('ADD_COMMENT',response.data)
          context.commit('SET_COMMENT',response.data)
        })
      },
      setNullComment(context){
        context.commit('SET_NULL_COMMENT','')
      },
      getComments(context){
        axios.get('api/getcomments',{
        })
        .then(response => {
          context.commit('SET_COMMENTS',response.data)
        })
      },
      approveComment(context,payload){
        axios.put('api/aprovecomment/'+payload,{
    
        })
        .then(response => {
          context.commit('EDIT_COMMENT',response.data)
        })
      },
      deleteComment(context,payload){
        axios.delete('api/deletecomment/'+payload,{
    
        })
        .then(response => {
          context.commit('DELETE_COMMENT',response.data)
        })
      },
}
export default {
    state,
    getters,
    actions,
    mutations
  }