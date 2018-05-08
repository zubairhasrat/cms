<template>
   <div class="container">
      <div class="row">
        <div  class="col-sm-2"></div>
        <div class="col-sm-8" >
          <div>
          <h1 class="mt-4">{{post.post_title}}</h1>
          <p class="lead">
            by
          <a href="#">{{post.post_author}}</a>
          </p>
          <p>{{post.created_at}}</p>
          <img class="img-fluid rounded" width="100%;" height="300px;" :src="post.post_image" alt="">
          <hr>
          <p class="lead">{{post.post_content}}</p>
           <div class="media mb-4" v-for="comment in comments" :key="comment.id">
            <div class="media-body" v-if="post.id == comment.comment_post_id && comment.comment_status == 'approve'">
                <h4 class="mt-0">comment by {{comment.comment_author}}</h4>
                <p>
                  {{comment.comment_content}}
                </p>
            </div>
          </div>
          <div class="card my-4">
            <h3 class="card-header">Leave a Comment:</h3>
            <div class="card-body">
              <form>
                <div class="form-group" :class="{'has-error': errors.has('comment_author')}">
                  <input type="text" 
                  class="form-control" 
                  v-model="comment.comment_author" 
                  placeholder="Enter name" 
                  v-validate="'required'"
                  data-vv-name="comment_author"
                  required>
                </div>
                <p class="alert alert-danger" v-if="errors.has('comment_author')">{{ errors.first('comment_author') }}</p>
                <div class="form-group" :class="{'has-error': errors.has('comment_author_email')}">
                  <input type="text" 
                  class="form-control" 
                  v-model="comment.comment_author_email" 
                  placeholder="Enter email"
                  v-validate="'required'"
                  data-vv-name="comment_author_email"
                  required>
                </div>
                <p class="alert alert-danger" v-if="errors.has('comment_author_email')">{{ errors.first('comment_author_email') }}</p>
                <div class="form-group" :class="{'has-error': errors.has('comment_content')}">
                  <textarea class="form-control" 
                  v-model="comment.comment_content" 
                  rows="5"
                  v-validate="'required'"
                  data-vv-name="comment_content"
                  required></textarea>
                </div>
                <p class="alert alert-danger" v-if="errors.has('comment_content')">{{ errors.first('comment_content') }}</p>
                <button type="button" class="btn btn-primary" @click="addComments(post,comment)">Submit</button>
              </form>
            </div>
          </div>
          </div>
        </div>
      </div>
    </div>
</template>
<script>
export default {
  data(){
    return{
    }
  },
  computed:{
    post(){
        return this.$store.getters.getPost
    },
   comment(){
     return this.$store.getters.getComment
   },
   comments(){
     return this.$store.getters.getAllComments
   }
  },
  methods:{
    addComments(post,comment){
      this.$validator.validateAll().then(res => {
        let reqObj = {
        posts: post,
        comments: comment
        }
        this.$store.dispatch('addComment',reqObj)
        this.$store.dispatch('setNullComment')
      })
    },
  },
  created(){
    this.$store.dispatch('setDeatailPost',this.$route.params.post)
    this.$store.dispatch('getComments')
  }
}
</script>
<style>

</style>
