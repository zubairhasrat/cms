<template>
  <div>
    <div class="row">
      <div class="col-sm-2">
        <side-bar></side-bar>
      </div>
      <div class="col-sm-8">
        <div class="row">
          <div class="col-lg-4">
              <div class="form-group" :class="{'has-error': errors.has('cat_name') }">
                  <input type="text" 
                  class="form-control" 
                  v-model="cat_name"
                  v-validate="'required'" 
                  data-vv-name="cat_name" 
                  required>
              </div>
              <p class="alert alert-danger" v-if="errors.has('cat_name')">{{ errors.first('cat_name') }}</p>
              <div class="form-group">
              <input class = "btn btn-primary" type="submit" name="update_category" @click="addCategory" value="Add Category"/>
            
            </div>
          </div>
          <div class="col-lg-6 col-lg-offset-2">
            <table class="table table-bordered table-striped">
              <thead>
                <th>ID</th>
                <th>Title</th>
                <th>Delete</th>
                <th>Edit</th>
              </thead>
              <tbody>
              <tr v-for="category in categories" :key="category.id">
                <td>{{category.id}}</td>
                <td>{{category.cat_name}}</td>
                <td><a href="#" type="button" class="btn btn-danger" @click="removeCategory(category)">Delete</a></td>
                <td><a href="#" type="button"  class="btn btn-primary">Edit</a></td>
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
 import axios from 'axios';
 import {mapGetters} from 'vuex'
 import SideBar from '../sideBar'
 export default {
   components:{
     SideBar
   },
   data(){
     return{
       cat_name : '',
       edit_data : ''
     }
   },
   computed:{
    categories(){
     return this.$store.getters.getCategory
    }
   },
   methods:{
     addCategory(){
      this.$store.dispatch('addCategory',this.cat_name)
      this.cat_name = null;
     },
     removeCategory(id){
       this.$store.dispatch('deleteCategory',id)
     },
     
   },
   created(){
     this.$store.dispatch('getCategories')
   }
 }
 </script>
 