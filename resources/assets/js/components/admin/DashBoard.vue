<template>
  <div>
      <div class="row">
          <div class="col-sm-2">
              <Sidebar></Sidebar>
          </div>
          <div class="col-sm-10">
              <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">
                                Welcome to Admin Page <small>{{user.name}}</small>
                            </h1>
                        </div>
                    </div>
                    <div class="row" >
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-file-text fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div>Posts</div>
                                        </div>
                                    </div>
                                </div>
                                <router-link to="/viewPost">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </router-link>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-comments fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div>Comments</div>
                                        </div>
                                    </div>
                                </div>
                                <router-link to="/viewComments">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </router-link>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-user fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div> Users</div>
                                        </div>
                                    </div>
                                </div>
                                <router-link to="/viewUser">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </router-link>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-list fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div>Categories</div>
                                    </div>
                                </div>
                            </div>
                                <router-link to="/category">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </router-link>
                        </div>
                    </div>
                </div>
            </div>       
            </div>
          </div>
      </div>
</div> 
</template>
<script>
import Sidebar from './sideBar.vue'
export default {
    components:{
        Sidebar
    },
     data(){
        return{
            roles:[],
            permissions:[]
        }
      },
    computed:{
        user(){
            return this.$store.getters.getAuthUser
        }
    },
    methods:{
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
        this.$store.dispatch('getAuthUser');
    }
}
</script>
