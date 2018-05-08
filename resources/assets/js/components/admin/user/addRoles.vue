<template>
  <div>
      <div class="row">
          <div class="col-sm-2">
              <SideBar></SideBar>
          </div>
           <div class="col-sm-10">
               <div class='col-lg-4 col-lg-offset-4'>
                <form action="post" v-on:submit='addRole'>
                    <h1><i class='fa fa-key'></i> Create Role</h1>
                    <hr>
                    <div class="form-group" :class="{'has-error': errors.has('role_name') }">
                        <label for="email">Name</label>
                        <input type="text" 
                        class="form-control"
                        v-model="roles.role_name"
                        v-validate="'required'" 
                        data-vv-name="role_name" 
                        required>
                    </div>
                    <p class="alert alert-danger" v-if="errors.has('role_name')">{{ errors.first('role_name') }}</p>
                    <div class="form-group">
                        <label for="user_role">Assign Permissions</label>
                        <div class="checkbox" >
                            <label v-for="permission in permissions" :key="permission.id">
                                <input type="checkbox" 
                                v-model="permission.selected"
                                @change="addThing(permission.name)"
                            >
                                {{permission.name}}
                            </label>
                        </div>
                        <p class="alert alert-danger" v-if="error !== null">{{ error}}</p>
                        <div class="form-group">
                            <input type="submit"  class="btn btn-primary" name="add_roles" value="Save" />
                        </div>
                    </div>
                </form>
            </div>
           </div>
      </div>
  </div>
</template>
<script>
import SideBar from '../sideBar'
export default {
    components:{
        SideBar
    },
    data(){
        return{
            data:[],
            selectedOption:[],
            error: null
        }
    },
    computed:{
     roles(){
        return this.$store.getters.role
     },
     permissions(){
         return this.$store.getters.permission
     }
  },
  methods:{
     addRole: function (event){
         event.preventDefault();
         if(this.selectedOption.length == 0){
             this.error = "permission required.";
         }else{
            
         this.permissions.forEach(element => {
               if(element.selected == true)
               this.data.push(element.id);
           });
           let requestObj = {
               role : this.roles,
               permission : this.data
           }
           this.$store.dispatch('addRole',requestObj)
           this.$router.push('role') 
        }   
     },
     addThing(op){
        this.selectedOption = op;
        this.error = null;
     }
  },
  created(){
      this.$store.dispatch('getPermission')
  }

}
</script>
<style scoped>
    label {
        display: block;
        width: 100%;
        }
</style>
