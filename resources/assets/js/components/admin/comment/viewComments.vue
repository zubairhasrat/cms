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
                        <th>user</th>
                        <th>Comment</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>In Response to</th>
                        <th>Date</th>
                        <th>Approve</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="comment in comments" :key="comment.id">
                        <th>{{comment.id}}</th>
                        <th>{{comment.comment_author}}</th>
                        <th>{{comment.comment_content}}</th>
                        <th>{{comment.comment_author_email}}</th>
                        <th>{{comment.comment_status}}</th>
                        <th>{{comment.comment_post_id}}</th>
                        <th>{{comment.created_at}}</th>
                        <th><a href="#" class="btn btn-primary" @click="approveComment(comment)">Approve</a></th>
                        <th><a href="#" class="btn btn-danger" @click="deleteComments(comment)">Delete</a></th>
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
  computed:{
      comments(){
       return this.$store.getters.getAllComments
      }
  },
  methods:{
      approveComment(comment){
        this.$store.dispatch('approveComment',comment.id)
        this.$store.dispatch('getComments');
      },
      deleteComments(comment){
        this.$store.dispatch('deleteComment',comment.id)
        this.$store.dispatch('getComments');
      }
  },
  created(){
      this.$store.dispatch('getComments');
  }
}
</script>
