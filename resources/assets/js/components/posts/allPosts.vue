<template>
    <section id="blog-section" >
     <div class="container">
         <div class=" col-lg-8">
            <div class="card my-4" style="max-width: 100%;" >
            <h5 class="card-header">Search Post</h5>
            <div class="card-body">
              <div class="form-group style">
                <input type="text" class="form-control style" placeholder="Search post..." v-model="search">
              </div>
            </div>
          </div>
         </div>
       <div class="row">
         <div class="col-lg-8">
           <div class="row">
            <div class="col-lg-6 col-md-6" v-for="posts in allPost" :key="posts.id">
                <div v-for="post in posts" :key="post.id">
                    <aside>
                    <img :src="post.post_image" height="200px;" width="100%">
                    <div class="content-title">
                        <router-link  :to="{name: 'detailpost',params: { post: post }}">
                            <div class="text-center">
                            <h3><a href="#">{{post.post_title}}</a></h3>
                            </div>
                        </router-link>
                    </div>
                    <div class="content-footer">
                    <!-- <img class="user-small-img" src="https://lh3.googleusercontent.com/-uwagl9sPHag/WM7WQa00ynI/AAAAAAAADtA/hio87ZnTpakcchDXNrKc_wlkHEcpH6vMwCJoC/w140-h148-p-rw/profile-pic.jpg"> -->
                    <span style="font-size: 16px;color: #fff;">Posted By:  {{post.post_author}}</span>
                    <span class="pull-right" style="font-size: 14px;color: #fff;">
                       On:  {{post.created_at}}
                    </span>
                        
                    </div>
                </aside>
                </div>
            </div>
           </div>
            <div v-if="totalPages() > 0" class="text-center custom">
                <span v-if="showPreviousLink()" class="pagination-btn" v-on:click="updatePage(currentPage - 1)"> <i class="fa fa-arrow-circle-left" aria-hidden="true"></i> </span>
                {{ currentPage + 1 }} of {{ totalPages() }}
                <span v-if="showNextLink()" class="pagination-btn" v-on:click="updatePage(currentPage + 1)"> <i class="fa fa-arrow-circle-right" aria-hidden="true"></i> </span>
            </div>
          </div>
        
     <!--// RECENT POST===========-->
         <div class="col-lg-4">           
               <div class="widget-sidebar">
                 <h2 class="title-widget-sidebar">// RECENT POST</h2>
                   <div class="content-widget-sidebar">
                    <ul>
                     <li class="recent-post" v-for="post in recentPost" :key="post.id">
                        <div class="post-img">
                         <img :src="post.post_image" class="img-responsive">
                         </div>
                         <a href="#"><h5>{{post.post_title}}</h5></a>
                         <p><small><i class="fa fa-calendar" data-original-title="" title=""></i> {{post.created_at}}</small></p>
                        </li>
                        <hr>
                    </ul>
                   </div>
                 </div>
        <!--=====================
               CATEGORIES
          ======================-->
             <div class="widget-sidebar">
              <h2 class="title-widget-sidebar">// CATEGORIES</h2>
                <div v-for="category in categories" :key="category.id">
                     <button class="categories-btn" >{{category.cat_name}}</button>
                </div>
             </div>    
             </div>
           </div>
         </div>
    </section>
</template>
<script>
export default {
  data(){
    return{
      currentPage: 0,
	  pageSize: 6,
      arrayLength : 0,
      search : '',
      category : '',
    }
  },
   created(){
    this.$store.dispatch('getPost')
    this.$store.dispatch('getComments')
    this.$store.dispatch('getCategories')
  },
  computed:{
    posts () {
        return this.$store.getters.getAllPost
    },
    recentPost(){
        var array = this.posts.slice(0,2)
        return array
    },
     categories(){
     return this.$store.getters.getCategory
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
        return _.chunk(array,2)
    },
    categories(){
     return this.$store.getters.getCategory
    }
  },
  methods:{
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
  },
 
}
</script>
<style scoped>

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
        margin-top: 50px;
		padding: 10 5 5 px;
		color: rgb(109, 123, 243);;
		font-size: 20px;
		 text-shadow: 1px 1px #1a0b0b;
		font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif
	}
    
	.style{
		border-radius: 20px;
		padding: 0%;
	}
	.style:hover{
		background-color: #ecf3f9;
		-webkit-box-shadow: 0px 0px 15px 5px rgba(0, 185, 233, .75);
		box-shadow: 0px 0px 15px 5px rgba(0, 185, 233, .75);
		-webkit-transition: all 0.7s ease;
		transition: all 0.7s ease;
	}

    body{background-color:#ECF0F1;}

    .navbar-inverse {
        background-color: #34495E;
        border-color: #34495E;
    }

    .navbar {
    position: relative;
    min-height: 50px;
    margin-bottom: 20px;
    border: 0px solid transparent;
    border-radius:0px;
    
    }
    .navbar-brand {
   
    float: left;
    height:auto;
    padding: 10px 10px;
    font-size: 18px;
    line-height: 20px;
    }
    .navbar-brand>img{ width:80%;}

    .navbar-inverse .navbar-nav > li > a {
        color: #F39C12;
    }
    .navbar-inverse .navbar-nav > li > a:hover {
    background-color: #009688;
    }

.btn-default {
    color: #333;
    background-color: #009688;
    border-color: #009688;
    border-radius:0px;
    color:#fff;
}

#blog-section{margin-top:40px;margin-bottom:80px;}
.content-title{padding:5px;background-color:#fff;}
.content-title h3 a{color:#34495E;text-decoration:none; transition: 0.5s;}
.content-title h3 a:hover{color:#F39C12; }
.content-footer{background-color:#16A085;padding:10px;position: relative;}
.content-footer span a {
    color: #fff;
    display: inline-block;
    padding: 6px 5px;
    text-decoration: none;
    transition: 0.5s;
}
.content-footer span a:hover{     
    color:#F39C12;   
}
aside{
    margin-top: 30px;
    -webkit-box-shadow: 1px 4px 16px 3px rgba(199,197,199,1);
-moz-box-shadow: 1px 4px 16px 3px rgba(199,197,199,1);
box-shadow: 1px 4px 16px 3px rgba(199,197,199,1);}
aside .content-footer>img {
    width: 33px;
    height: 33px;
    border-radius: 100%;
    margin-right: 10px;
    border: 2px solid #fff;
}

.user-ditels {
    width: 300px;
    top: -100px;
    height: 100px;
    padding-bottom: 99px;
    position: absolute;
    border: solid 2px #fff;
    background-color: #34495E;
    right: 25px;
    display: none;
    z-index: 1;
}

@media (max-width:768px){
    .user-ditels {   
    right: 5px;   
}
    
}
.user-small-img{cursor: pointer;}

.content-footer:hover .user-ditels  {
    display: block;
}


.content-footer .user-ditels .user-img{width: 100px;height:100px;float: left;}
.user-full-ditels h3 {
    color: #fff;
    display: block;
    margin: 0px;
    padding-top: 10px;
    padding-right: 28px;
    text-align: right;
}
.user-full-ditels p{    
    color: #fff;
    display: block;
    margin: 0px;
     padding-right: 20px;
    padding-top: 5px;
   text-align: right;}
.social-icon {
    background-color: #fff;
    margin-top: 10px;
    padding-right: 20px;
    text-align: right;
}
.social-icon>a{font-size:20px;text-decoration:none;padding: 5px;}
.social-icon a:nth-of-type(1){color:#4E71A8;}
.social-icon a:nth-of-type(2){color:#3FA1DA;}
.social-icon a:nth-of-type(3){color:#E3411F;}
.social-icon a:nth-of-type(4){color:#CA3737;}
.social-icon a:nth-of-type(5){color:#3A3A3A;}


/*recent-post-col////////////////////*/
.widget-sidebar {
    background-color: #fff;
    padding: 20px;
    margin-top: 30px;
}

.title-widget-sidebar {
    font-size: 14pt;
    border-bottom: 2px solid #e5ebef;
    margin-bottom: 15px;
    padding-bottom: 10px;    
    margin-top: 0px;
}

.title-widget-sidebar:after {
    border-bottom: 2px solid #f1c40f;
    width: 150px;
    display: block;
    position: absolute;
    content: '';
    padding-bottom: 10px;
}

.recent-post{width: 100%;height: 80px;list-style-type: none;}
.post-img img {
    width: 100px;
    height: 70px;
    float: left;
    margin-right: 15px;
    border: 5px solid #16A085;
    transition: 0.5s;
}

.recent-post a {text-decoration: none;color:#34495E;transition: 0.5s;}
.post-img, .recent-post a:hover{color:#F39C12;}
.post-img img:hover{border: 5px solid #F39C12;}

/*===============ARCHIVES////////////////////////////*/



button.accordion {
    background-color: #16A085;
    color: #fff;
    cursor: pointer;
    padding: 18px;
    width: 100%;
    border: none;
    text-align: left;
    outline: none;
    font-size: 15px;
    transition: 0.4s;
}

button.accordion.active, button.accordion:hover {
    background-color: #F39C12;color: #fff;
}

button.accordion:after {
    content: '\002B';
    color: #fff;
    font-weight: bold;
    float: right;
    margin-left: 5px;
}

button.accordion.active:after {
    content: "\2212";
}

.panel {
    padding: 0 18px;
    background-color: white;
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.2s ease-out;
}


/*categories//////////////////////*/

.categories-btn{
    background-color: #F39C12;
    margin-top:30px;
    color: #fff;
    cursor: pointer;
    padding: 18px;
    width: 100%;
    border: none;
    text-align: left;
    outline: none;
    font-size: 15px;
    transition: 0.4s;
    
}
.categories-btn:after {
    content: '\25BA';
    color: #fff;
    font-weight: bold;
    float: right;
    margin-left: 5px;
}
.categories-btn:hover {
    background-color: #16A085;color: #fff;
}

.form-control{border-radius: 0px;}

.btn-warning {
    border-radius: 0px;
    background-color: #F39C12;
    margin-top: 15px;
}
.input-group-addon{border-radius: 0px;}
</style>
