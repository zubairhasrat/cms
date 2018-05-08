<template>
  <div>
    <div class="container">
      <div class="row">
        <div class="col-sm-8" >
          <div v-for="post in allPost" :key="post.id">
          <h1 class="mt-4">{{post.post_title}}</h1>
          <p class="lead">
            by
          <a href="#">{{post.post_author}}</a>
          </p>
          <p>{{post.created_at}}</p>
          <img class="img-fluid rounded" width="100%;" height="300px;" :src="post.post_image" alt="">
          <p class="lead">{{post.post_content}}</p>
           <div class="media mb-4" v-for="comment in comments" :key="comment.id">
            <div class="media-body" v-if="post.id == comment.comment_post_id && comment.comment_status == 'approve'">
                <h4 class="mt-0">{{comment.comment_author}}</h4>
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
        <div class="col-sm-4">
           <!-- Search Widget -->
          <div class="card my-4" style="max-width: 100%;" >
            <h5 class="card-header">Search Post</h5>
            <div class="card-body">
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Search for..." v-model="search">
              </div>
            </div>
          </div>
             <!-- Categories Widget -->
          <div class="card  pading-top">
            <h5 class="card-header">Categories</h5>
            <div class="card-body">
              <div class="row">
                <div class="col-lg-6">
                  <ul v-for="category in categories" :key="category.id">
                   <a href="#" @click="selectedPost(category.cat_name)"><li>{{category.cat_name}}</li></a> 
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div v-if="totalPages() > 0" class="text-center custom">
					<span v-if="showPreviousLink()" class="pagination-btn" v-on:click="updatePage(currentPage - 1)"> <i class="fa fa-arrow-circle-left" aria-hidden="true"></i> </span>
					{{ currentPage + 1 }} of {{ totalPages() }}
					<span v-if="showNextLink()" class="pagination-btn" v-on:click="updatePage(currentPage + 1)"> <i class="fa fa-arrow-circle-right" aria-hidden="true"></i> </span>
			</div>
    </div>
  </div>
</template>
<script>
export default {
  data(){
    return{
      currentPage: 0,
			pageSize: 2,
      arrayLength : 0,
      search : '',
      category : '',
      filteredPost: []
    }
  },
  computed:{
    posts : {
      get: function(){
        this.filteredPost = this.$store.getters.getAllPost
        return this.filteredPost
      },
      set: function(post){
        this.filteredPost = post
      }
    },
    allPost(){
      var array = this.posts.filter((post) => {
        return post.post_title.match(this.search)
      })
      this.arrayLength = array.length;
			array = array.slice(this.currentPage * this.pageSize, (this.currentPage * this.pageSize) + this.pageSize);
        if (array.length == 0 && this.currentPage > 0) {
          this.updatePage(this.currentPage -1);
        }
     return array
    },
    categories(){
     return this.$store.getters.getCategory
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
    updatePage(pageNumber) {
			this.currentPage = pageNumber;
		},
		totalPages() {
			return Math.ceil(this.arrayLength / this.pageSize);
		},
		showPreviousLink() {
			return this.currentPage == 0 ? false : true;
		},
		showNextLink() {
			return this.currentPage == (this.totalPages() - 1) ? false : true;
    },
    selectedPost(category){
      var array = this.posts.filter(post => {
        return post.post_category.match(category)
      })
      this.posts = array
    }
  },
  created(){
    this.$store.dispatch('getPost')
    this.$store.dispatch('getComments')
    this.$store.dispatch('getCategories')
  }
}
</script>
<style>
  .pading-top{
    margin-top: 80px;
  }
  .card-header{
    font-size: 20px;
    font-weight: bold;
  }
  .pagination-btn {
		cursor: pointer;
	}
	.fa-arrow-circle-left, .fa-arrow-circle-right{
		color:rgb(109, 123, 243);
		font-size: 30px;
		padding: 10px;
	}
	.custom{
		padding: 10 5 5 px;
		color: rgb(109, 123, 243);;
		font-size: 20px;
		 text-shadow: 1px 1px #1a0b0b;
		font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif
	}
	.style{
		border-radius: 20px;
	}
</style>
