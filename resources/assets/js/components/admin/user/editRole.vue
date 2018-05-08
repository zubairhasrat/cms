<template>
  <div>
      <div class="row">
          <div class="col-sm-2">
              <SideBar></SideBar>
          </div>
          <div class="col-sm-10">
              <div class='col-lg-4 col-lg-offset-4'>
                <h1><i class='fa fa-key'></i> Create Role</h1>
                <hr>
                <div class="form-group" :class="{'has-error': errors.has('name') }">
                    <label for="email">Name</label>
                    <input type="text" 
                    class="form-control" 
                    v-model="roles.name"
                    v-validate="'required'" 
                    data-vv-name="name" 
                    required>
                </div>
                <p class="alert alert-danger" v-if="errors.has('name')">{{ errors.first('name') }}</p>
                <div class="form-group">
                    <label for="user_role">Assign Permissions</label>
                    <div class="checkbox">
                        <label v-for="permission in permissions" :key="permission.id">
                            <input type="checkbox" 
                            v-model="permission.selected"
                            @change="addThing(permission.name)"
                            >{{permission.name}}
                        </label>
                    </div>
                    <p class="alert alert-danger" v-if="error !== null">{{ error}}</p>
                    <div class="form-group">
                        <input type="button"  class="btn btn-primary" name="add_roles" value="Save" @click="editRole" />
                    </div>
                </div>
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
            roles:null,
            selectedPermission: null,
            array: null,
            data:[],
            selectedOption:[],
            error: null
        }
    },
    computed:{
     permissions(){
         return this.$store.getters.permission
         this.array.forEach(element => {
             element.selected == true
         });
     }
  },
  methods:{
     editRole(){
         this.$validator.validateAll().then(res => {
            if(this.selectedOption.length == 0){
                this.error = "role required.";
            }else{
                this.permissions.forEach(element => {
                    if(element.selected == true)
                    this.data.push(element.id);
                });
                let requestObj = {
                    role : this.roles,
                    permission : this.data
                }
                    this.$store.dispatch('editRole',requestObj)
                    this.$router.push('role')
            }
        }) 
     },
      addThing(op){
        this.selectedOption = op;
        this.error = null;
     }
  },
  created(){
    this.$store.dispatch('getPermission')
    this.roles = this.$route.params.role
    this.selectedPermission =this.$route.params.role.permissions
  }
}
</script>
<style scoped>
    label {
        display: block;
        width: 100%;
        }
</style>
