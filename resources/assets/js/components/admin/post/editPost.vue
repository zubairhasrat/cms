<template>
  <div>
    <div class="row">
          <div class="col-sm-2">
              <SideBar></SideBar>
          </div>
          <div class="col-sm-8 col-sm-offset-1">
                 <div class="form-group" :class="{'has-error': errors.has('post_title') }">
                <label for="title">Post Title</label>
                <input type="text" 
                v-model="post.post_title" 
                class="form-control" 
                v-validate="'required'" 
                data-vv-name="post_title" 
                required>
            </div>
            <p class="alert alert-danger" v-if="errors.has('post_title')">{{ errors.first('post_title') }}</p>
            <div class="form-group" :class="{'has-error': errors.has('post_author') }">
                <label for="categories">Post Category</label>
                <select  
                class="form-control" 
                v-model="post.post_category"
                v-validate="'required'" 
                data-vv-name="post_category" 
                required>
                    <option :value="post.post_category">{{post.post_category}}</option>
                </select>
            </div>
            <p class="alert alert-danger" v-if="errors.has('post_category')">{{ errors.first('post_category') }}</p>
            <div class="form-group" :class="{'has-error': errors.has('post_author') }">
                <label for="author">Post Author</label>
                <input type="text" 
                class="form-control" 
                name="author" 
                v-model="post.post_author"
                v-validate="'required'"
                data-vv-name="post_author"
                required>
            </div>
            <p class="alert alert-danger" v-if="errors.has('post_author')">{{ errors.first('post_author') }}</p>
            <div class="form-group" :class="{'has-error': errors.has('post_status') }">
                <label for="post_status">Post Status</label>
                <input type="text" 
                class="form-control" 
                name="post_status" 
                v-model="post.post_status"
                v-validate="'required'"
                data-vv-name="post_status"
                required>
            </div>
            <p class="alert alert-danger" v-if="errors.has('post_status')">{{ errors.first('post_status') }}</p>
            <div class="form-group">
                <img :src="post.post_image"  width="50px" height="50px">
                <form enctype="multipart/form-data" novalidate>
                    <input type="file" @change="onFileChange" accept="image/*" multiple data-vv-name="image" v-validate="'required|mimes:image/*'" required/>
                    <div class="input-group fileUploadError">
                        <div class="input-group__error alert alert-danger" v-show="errors.has('image')">
                        {{ errors.first('image') }}
                        </div>
                    </div>
                </form>
            </div>
            <div class="form-group" :class="{'has-error': errors.has('post_tag') }">
                <label for="post_tags">Post Tags</label>
                <input type="text" 
                class="form-control" 
                name="post_tags" 
                v-model="post.post_tag"
                v-validate="'required'"
                data-vv-name="post_tag"
                required>
            </div>
            <p class="alert alert-danger" v-if="errors.has('post_tag')">{{ errors.first('post_tag') }}</p>
            <div class="form-group" :class="{'has-error': errors.has('post_content') }">
                <label for="post_content">Post Content</label>
                <textarea name="post_content" 
                cols="30" rows="10" 
                class="form-control" 
                v-model="post.post_content"
                v-validate="'required'"
                data-vv-name="post_content"
                required></textarea>
            </div>
            <p class="alert alert-danger" v-if="errors.has('post_content')">{{ errors.first('post_content') }}</p>
            <div class="form-group">
                <input type="button"  class="btn btn-primary" name="create_post" value="Publish Post" @click="editPost(post)" />
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
        }
    },
   computed:{
    categories(){
       return this.$store.getters.getCategory
    },
    post(){
       
         return this.$store.getters.getPost
    }
   },
   methods: {
       onFileChange(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0]);
            },
        createImage(file) {
            let reader = new FileReader();
            let vm = this;
            reader.onload = (e) => {
                this.$store.dispatch('setPostImage',e.target.result)
            };
            reader.readAsDataURL(file);
        },
        editPost(post){
           this.$store.dispatch('editPost',post)
           this.$router.push('/viewPost') 
        }

   },
   created(){
       this.$store.dispatch('setEditPost',this.$route.params)
   }
}
</script>

