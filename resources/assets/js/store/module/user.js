import Vue from 'vue'
import Vuex from 'vuex'
import _ from 'lodash'
import index from 'vuex';

Vue.use(Vuex)
const state = {
    
  users:[],
  user: {
    user_name:null,
    user_email:null,
    user_password:null
  },
  roles:[],
  role: {
    role_name: null
  },
  permissions:[],
  permission: {
    per_name:null
  },
  authUser: {
    user_name:null,
    user_email:null,
    user_password:null
  },
  isLogedIn: false,
  authUserRoles:[]
}
const getters = {
    user(){
        return state.user
      },
      getUser(){
        return state.users
      },
      role(){
        return state.roles
      },
      permission(){
        return state.permissions
      },
      getAuthUser(){
        return state.authUser
      },
      getLoginStatus(){
        return state.isLogedIn
      }
}
const mutations = {
    SET_PERMISSION : (state,payload) => {
        state.permission =payload;
      },
      SET_PERMISSIONS : (state,payload) => {
        state.permissions=payload;
      },
      ADD_PERMISSION: (state,payload) => {
        state.permissions.unshift(_.cloneDeep(payload))
      },
      DELETE_PERMISSION : (state,payload) => {
        const index = state.permissions.indexOf(payload);
        state.permissions.splice(index, 1)
      },
      SET_ROLE : (state,payload) => {
        state.role =payload;
      },
      SET_ROLES : (state,payload) => {
        state.roles=payload;
      },
      ADD_ROLE: (state,payload) => {
        state.roles.unshift(_.cloneDeep(payload))
      },
      DELETE_ROLE : (state,payload) => {
        const index = state.roles.indexOf(payload);
        state.roles.splice(index, 1)
      },
      SET_USER : (state,payload) => {
        state.user =payload;
      },
      SET_USERS : (state,payload) => {
        state.users=payload;
      },
      ADD_USER: (state,payload) => {
        state.users.unshift(_.cloneDeep(payload))
      },
      DELETE_USER : (state,payload) => {
        const index = state.users.indexOf(payload);
        state.users.splice(index, 1)
      },
      SET_AUTH_USER: (state,payload) => {
        state.authUser = payload
      },
      SET_LOGIN_STATUS: (state,payload) =>{
        state.isLogedIn = payload
      }
}
const actions = {
    getRole(context,payload){
        axios.get('api/roles',{
        })
        .then(response => {
          context.commit('SET_ROLES',response.data)
        })
      },
      addRole(context,payload){
        axios.post('api/addRoles',{
          name: payload.role.role_name,
          permissions :payload.permission
        })
        .then(response => {
        })
      },
      deleteRole(context,payload){
        axios.delete('api/deleterole/'+payload.id,{
    
        })
        .then(response => {
          context.commit('DELETE_ROLE',payload)
        })
      },
      editRole(context,payload){
        axios.put('api/editrole/'+payload.role.id,{
          name: payload.role.name,
          permissions :payload.permission
        })
        .then(response => {
        })
      },
      getPermission(context,payload){
        axios.get('api/permissions',{
        })
        .then(response => {
          context.commit('SET_PERMISSIONS',response.data)
        })
      },
      addPermission(context,payload){
        axios.post('api/Addpermissions',{
          name: payload.permission.per_name,
          roles : payload.role
        })
        .then(response => {
          context.commit('SET_PERMISSION',response.data)
          context.commit('ADD_PERMISSION',response.data)
        })
        .catch(e => {
          this.errors.push(e)
        })
      },
      editPermission(context,payload){
        axios.put('api/editpermission/'+payload.permission.id,{
          name: payload.permission.name,
          roles: payload.role
        })
        .then(response => {
        })
      },
      deletePermission(context,payload){
        axios.delete('api/deletepermission/'+payload.id,{
    
        })
        .then(response => {
          context.commit('DELETE_PERMISSION',payload)
        })
      },
      addUser(context,payload){
        axios.post('api/addusers',{
          name: payload.users.user_name,
          email: payload.users.user_email,
          password: payload.users.user_password,
          roles : payload.roles
        })
        .then(response => {
          context.commit('SET_USER',response.data)
          context.commit('ADD_USER',response.data)
        })
        .catch(e => {
          this.errors.push(e)
        })
      },
      getUsers(context){
        axios.get('api/users',{
    
        })
        .then(response => {
          context.commit('SET_USERS',response.data)
        })
      },
      deleteUser(context,payload){
        axios.delete('api/deleteuser/'+payload.id,{
    
        })
        .then(response => {
          context.commit('DELETE_USER',payload)
        })
      },
      editUser(context,payload){
       axios.put('api/edituser/'+payload.users.id,{
        name: payload.users.name,
        email:payload.users.email,
        password:payload.users.password,
        roles : payload.roles
       })
       .then(response => {
        context.commit('SET_USER',response.data)
       })
      },
      getSelectedUser(context,payload){
        axios.get('api/getsingleuser/'+payload,{
    
        })
        .then(response => {
          context.commit('SET_USER',response.data)
        })
      },
      getAuthUser(context){
        axios.get('api/authuser',{
        })
        .then(response => {
          context.commit('SET_AUTH_USER',response.data)
          context.commit('SET_LOGIN_STATUS',true)
        })
      },
      setUserStatus(context,payload){
        context.commit('SET_LOGIN_STATUS',payload)
      },
      logoutUser(context){
        context.commit('SET_LOGIN_STATUS',false)
      },
      loginUser(context,payload){
        axios.post('login',payload)
        .then(response => {
          context.commit('SET_LOGIN_STATUS',true)
        })
        .catch(error => {
            console.log(error.response)
        })
      }
}
export default {
    state,
    getters,
    actions,
    mutations
  }
  