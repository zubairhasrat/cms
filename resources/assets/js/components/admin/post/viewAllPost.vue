<template>
  <div>
    <div class="row">
        <div class="col-sm-2">
            <SideBar></SideBar>
        </div>
         <div class="col-sm-10">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Image</th>
                        <th>Tags</th>
                        <th>Date</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="post in posts" :key="post.id">
                        <td>{{post.id}}</td>
                        <td>{{post.post_title}}</td>
                        <td>{{post.post_author}}</td>
                        <td>{{post.post_category}}</td>
                        <td>{{post.post_status}}</td>
                        <td>
                            <img :src="post.post_image" width="50px" height="50px">
                        </td>
                        <td>{{post.post_tag}}</td>
                        <td>{{post.created_at}}</td>
                        <td>
                            <router-link class="btn btn-primary" :to="{name: 'editPost',params: { post: post }}">Edit</router-link>
                        </td>
                        <td>
                            <a href="#" type="button" class="btn btn-danger" @click="deletePost(post)">Delete</a>
                        </td>
                    </tr>
                </tbody>
            </table>
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
            roles:[],
            permissions:[]
        }
    },
  computed: {
      posts(){
         return this.$store.getters.getAllPost
      },
       post(){
        return this.$store.getters.getPost
    },
     user(){
            return this.$store.getters.getAuthUser
        }
  },
  methods: {
      deletePost(post){
          this.$store.dispatch('deletePost',post)
      },
      role_has_per(arr, obj) {
            return (arr.indexOf(obj) != -1);
        },
        has_role(arr, obj) {
            return (arr.indexOf(obj) != -1);
        },
        is(role) {
            this.user.roles.forEach(element => {
                this.roles = element.name
            });
            return this.has_role(this.roles, role);
        },
        can(per){
             this.user.permissions.forEach(element => {
                this.permissions = element.name
            });
            return this.role_has_per(this.permissions, per);
        }

  },
  created(){
      this.$store.dispatch('getPost')
  }
}
</script>
