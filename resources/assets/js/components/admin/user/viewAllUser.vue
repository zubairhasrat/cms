<template>
  <div>
      <div class="row">
          <div class="col-sm-2">
              <SideBar></SideBar>
          </div>
          <div class="col-sm-10">
              <div class="col-lg-10 col-lg-offset-1">
                <h1><i class="fa fa-users"></i> User Management 
                <router-link class="btn btn-default pull-right" to="/role">Roles</router-link>
                <router-link class="btn btn-default pull-right" to="/viewPermission">Permissions</router-link>
                <router-link class="btn btn-success" to="/addUsers">Add Users</router-link>
                </h1>
                <hr>
                <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Date/Time Added</th>
                        <th>User Roles</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="user in users" :key="user.id">
                        <td>{{user.name}}</td>
                        <td>{{user.email}}</td>
                        <td>{{user.created_at}}</td>
                        <td>
                            <span v-for="role in user.roles" :key="role.id">{{role.name}},</span>
                        </td>
                        <td>
                        <router-link class="btn btn-primary" :to="{name:'editUser',params:{ user:user}}" >Edit</router-link>
                            <a href="#" type="button" class="btn btn-danger" @click="deleteUser(user)" >Delete</a>
                        </td>
                    </tr>
                </tbody>
            </table>
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
  computed:{
      users(){
         return this.$store.getters.getUser
      }
  },
  created(){
      this.$store.dispatch('getUsers')
  },
  methods:{
      deleteUser(user){
          this.$store.dispatch('deleteUser',user)
      }
  }
}
</script>
