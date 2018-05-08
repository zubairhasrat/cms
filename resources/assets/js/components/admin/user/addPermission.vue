<template>
  <div>
      <div class="row">
          <div class="col-sm-2">
              <SideBar></SideBar>
          </div>
          <div class="col-sm-10">
              <div class='col-md-4 col-md-offset-4'>
                <h1><i class='fa fa-key'></i> Create New Permission</h1>
                <br>
                <form v-on:submit="addPermission" action="#" method="post">
                    <div class="form-group" :class="{'has-error': errors.has('per_name') }">
                        <label for="email">Name</label>
                        <input type="text" 
                        class="form-control" 
                        name="name" 
                        v-model="permission.per_name"
                        v-validate="'required'" 
                        data-vv-name="per_name" 
                        required>
                    </div>
                    <p class="alert alert-danger" v-if="errors.has('per_name')">{{ errors.first('per_name') }}</p>
                    <div class="form-group">
                        <label for="user_role">Assign Permission to Roles</label>
                        <div class="checkbox">
                            <label v-for="role in roles" :key="role.id">
                                <input 
                                type="checkbox" 
                                v-model="role.selected"
                                @change="addThing(role.name)"
                                >{{role.name}}
                            </label>
                        </div>
                        <p class="alert alert-danger" v-if="error !== null">{{ error}}</p>
                        <div class="form-group">
                            <input type="submit"  class="btn btn-primary" name="add_permission" value="Save"  />
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
     permission(){
         return this.$store.getters.permission
     }
  },
  methods:{
      addPermission: function(event){
           event.preventDefault();
           if(this.selectedOption.length == 0){
             this.error = "role required.";
            }else{
           this.roles.forEach(element => {
               if(element.selected == true)
               this.data.push(element);
           });
           let requestObj = {
               permission : this.permission,
               role : this.data
           }
           this.$store.dispatch('addPermission',requestObj)
           this.$router.push('/viewPermission') 
        }
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
<style scoped>
    label {
        display: block;
        width: 100%;
        }
</style>
