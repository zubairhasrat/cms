<template>
  <div>
      <div class="row">
          <div class="col-sm-2">
              <SideBar></SideBar>
          </div>
          <div class="col-sm-10">
              <div class='col-lg-4 col-lg-offset-4'>
                <h1> Create User</h1>
                    <hr>
                <div class="form-group" :class="{'has-error': errors.has('user_name')}">
                    <label for="user_firstname">Name</label>
                    <input type="text" 
                    v-model="user.user_name" 
                    class="form-control"
                    v-validate="'required'" 
                    data-vv-name="user_name" 
                    required>
                </div>
                <p class="alert alert-danger" v-if="errors.has('user_name')">{{ errors.first('user_name') }}</p>
                <div class="form-group" :class="{'has-error': errors.has('user_email')}">
                    <label for="email">Email</label>
                    <input type="email" 
                    v-model="user.user_email" 
                    class="form-control" 
                    v-validate="'required'" 
                    data-vv-name="user_email" 
                    required>
                </div>
                <p class="alert alert-danger" v-if="errors.has('user_email')">{{ errors.first('user_email') }}</p>
                <div class="form-group">
                    <label for="user_role">user role</label>
                    <div class="checkbox">
                        <label v-for="role in roles" :key="role.id">
                            <input type="checkbox" 
                            v-model="role.selected"
                            @change="addThing(role.name)"
                            >
                            {{role.name}}
                        </label>
                    </div>
                    <p class="alert alert-danger" v-if="error !== null">{{error}}</p>
                </div>
                
                <div class="form-group" :class="{'has-error': errors.has('user_password')}">
                    <label for="user_password">Password</label>
                    <input type="password" 
                    v-model="user.user_password" 
                    class="form-control"
                    v-validate="'required'" 
                    data-vv-name="user_password" 
                    required>
                </div>
                <p class="alert alert-danger" v-if="errors.has('user_password')">{{ errors.first('user_password') }}</p>
                <div class="form-group">
                    <input type="submit"  class="btn btn-primary" name="add_user" value="Register" @click="addUser" />
                </div>
            </div>
          </div>
      </div>
  </div>
</template>
<script>
import SideBar from '../sideBar'
import {mapGetters} from 'vuex'
export default {
    components:{
        SideBar
    },
    data(){
        return{
            selectedRoles:[],
            selectedOption:[],
            error: null
        }
    },
   computed:{
    user(){
      return this.$store.getters.user
    },
    roles(){
        return this.$store.getters.role
    }
   },
   methods:{
       addUser(){
           this.$validator.validateAll().then(res =>{
                if(this.selectedOption.length == 0){
                    this.error = "role required.";
                }else{
                this.roles.forEach(element => {
                if(element.selected == true){
                    this.selectedRoles.push(element.id) 
                }
            });
                let reqObj = {
                    users : this.user,
                    roles : this.selectedRoles
                }
                this.$store.dispatch('addUser',reqObj)
                this.$router.push('/viewUser')
            }
           })
        
       },
    addThing(op){
        this.selectedOption = op;
        this.error = null;
    }
   },
    created(){
      this.$store.dispatch('getRole')
  }
}
</script>
<style>
    label {
        display: block;
        width: 100%;
        }
</style>
