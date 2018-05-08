<template>
  <div>
      <div class="row">
          <div class="col-sm-2">
              <SideBar></SideBar>
          </div>
          <div class="col-sm-10">
               <div class="col-lg-10 ">
                    <h1><i class="fa fa-key"></i> Roles Management
                    <router-link class="btn btn-default pull-right" to="/viewUser">Users</router-link>
                    <router-link class="btn btn-default pull-right" to="/viewPermission">Permissions</router-link>
                    <router-link class="btn btn-success" to="/addRole">Add Role</router-link>
                    </h1>
                    <hr>
                </div>
                <div class="col-lg-10 ">
                    <table class="table table-bordered table-striped table-responsive">
                        <thead>
                            <tr>
                                <th>Role</th>
                                <th>Permissions</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr v-for="role in roles" :key="role.id">
                            <td>{{role.name}}</td>
                            <td >
                                <span v-for="per in role.permissions" :key="per.id">{{per.name}},</span>
                            </td>
                            <td>
                                    <router-link class="btn btn-primary" :to="{name: 'editrole',params: { role: role }}" >Edit</router-link>
                                    <a href="#" type="button" class="btn btn-danger" @click="deleteRole(role)">Delete</a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
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
            allRolles:[],
            data:[]
        }
    },
  computed:{
     roles(){
        //   this.data = this.$store.getters.role
        //  this.data.forEach(element => {
        //      this.allRolles=element.permission
        //  });
        //  console.log(this.allRolles)
         return this.$store.getters.role

     }
  },
  methods:{
      deleteRole(role){
          this.$store.dispatch('deleteRole',role);
      },
      editRole(role){

      }
  },
  created(){
      this.$store.dispatch('getRole')
  }
}
</script>