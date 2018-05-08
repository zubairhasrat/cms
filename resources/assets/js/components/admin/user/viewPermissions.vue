<template>
  <div>
      <div class="row">
          <div class="col-sm-2">
              <SideBar></SideBar>
          </div>
          <div class="col-sm-10">
               <div class="col-md-10 col-md-offset-1">
                <h1><i class="fa fa-key"></i>Permissions Management
                <router-link class="btn btn-default pull-right" to="/viewUser">Users</router-link>
                <router-link class="btn btn-default pull-right" to="/role">Roles</router-link>
                <router-link class="btn btn-success" to="/addPermission">Add Permission</router-link>
                </h1>
                <hr>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Permissions</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="permission in permissions" :key="permission.id">
                                <th>{{permission.name}}</th>
                                <th> 
                                    <router-link class="btn btn-primary" :to="{name: 'editpermission',params:{permission:permission}}">Edit</router-link>
                                    <a href="#" type="button" class="btn btn-danger" @click="deletePermission(permission)">Delete</a>
                                </th>
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
     permissions(){
         return this.$store.getters.permission
     }
  },
  methods:{
      deletePermission(permission){
          this.$store.dispatch('deletePermission',permission)
      }
  },
  created(){
      this.$store.dispatch('getPermission')
  }
}
</script>
