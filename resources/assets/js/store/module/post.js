import Vue from 'vue'
import Vuex from 'vuex'
import _ from 'lodash'
import index from 'vuex';

Vue.use(Vuex)
const state = {
    posts:[],
    post: {
      post_title: null,
      post_category: null,
      post_author: null,
      post_status: null,
      post_image: null,
      post_tag: null,
      post_content: null,
    },
}
const getters = {
    getPost(){
        return state.post
    },
    getAllPost(){
        return state.posts
    },
}
const mutations = {
    SET_POST : (state,payload) => {
        state.post =payload;
      },
      SET_POSTS : (state,payload) => {
        state.posts=payload;
      },
      ADD_POST: (state,payload) => {
        state.posts.unshift(_.cloneDeep(payload))
      },
      DELETE_POST : (state,payload) => {
        const index = state.posts.indexOf(payload);
        state.posts.splice(index, 1)
      },
      EDIT_POST: (state,payload) => {
        const index = state.posts.indexOf(payload)
        delete payload.index
        state.posts[index] = payload
      },
      SET_POST_IMAGE_FILE : (state,payload) => {
        state.post.post_image = payload;
      },
}
const actions = {
    addPost(context,payload){
        axios.post('api/addposts',{
          post_title : payload.post_title,
          post_category : payload.post_category.cat_name,
          post_author : payload.post_author,
          post_status : payload.post_status,
          post_image : payload.post_image,
          post_tag : payload.post_tag,
          post_content : payload.post_content
        })
        .then(response => {
          context.commit('SET_POST',response.data)
          context.commit('ADD_POST',response.data)
        })
      },
      getPost(context){
        axios.get('api/posts',{
        })
        .then(response => {
          context.commit('SET_POSTS',response.data)
        })
      },
      setPostImage(context,payload){
        context.commit('SET_POST_IMAGE_FILE',payload)
      },
      setEditPost(context,payload){
        context.commit('SET_POST',payload.post)
      },
      editPost(context,payload){
        axios.put('api/editposts/'+payload.id,{
          post_title : payload.post_title,
          post_category : payload.post_category.cat_name,
          post_author : payload.post_author,
          post_status : payload.post_status,
          post_image : payload.post_image,
          post_tag : payload.post_tag,
          post_content : payload.post_content
        })
        .then(response => {
          context.commit('EDIT_POST',response.data)
        })
      },
      deletePost(context,payload){
        axios.delete('api/deletepost/'+payload.id,{
    
        })
        .then(response => {
        context.commit('DELETE_POST',payload)
        })
      },
      setPostBycategory(context,payload){
        context.commit('SET_POSTS',payload)
      },
      setDeatailPost(context,payload){
        context.commit('SET_POST',payload)
      }
}
export default {
    state,
    getters,
    actions,
    mutations
  }