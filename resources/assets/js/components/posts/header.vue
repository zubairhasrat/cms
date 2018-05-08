<template>
  <div>
    <nav class="navbar navbar-inverse" data-spy="affix"  data-offset-top="197">
    <div class="container">
        <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>                        
        </button>
        <router-link to="/">
        <a class="navbar-brand" href="#"><img src="https://lh3.googleusercontent.com/-N4NB2F966TU/WM7V1KYusRI/AAAAAAAADtA/fPvGVNzOkCo7ZMqLI6pPITE9ZF7NONmawCJoC/w185-h40-p-rw/logo.png"></a>
        </router-link>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
            <li><router-link to="/">Home</router-link></li>
            <li><a href="#">About Us</a></li>
            <li><a href="#">Contact Us</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right" >
            <li v-if="userStatus == false"><router-link class="glyphicon glyphicon-user" to="/registration"> Sign Up</router-link> </li>
            <li v-if="userStatus == false"><router-link to="/login" class="glyphicon glyphicon-log-in"> Login</router-link></li>
            
            <li class="dropdown" v-else>
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                    {{user.name }}
                        <span class="caret"></span>
                </a>
                
                <ul class="dropdown-menu">
                    <li>
                        <a href="#" @click="logout()">
                            Logout
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
        </div>
    </div>
</nav>
   
</div>
</template>
<script>
export default {
    computed:{
        user(){
            return this.$store.getters.getAuthUser
        },
        userStatus(){
            console.log(this.$store.getters.getLoginStatus)
            return this.$store.getters.getLoginStatus
        }
    },
    methods:{
         logout(){
             axios.post('logout').then(
                 response => {
                     this.$store.dispatch('logoutUser')
                     this.$router.push('/') 
                 }
             )
         }
    },
    created(){
    }
}
</script>
 <style scoped>
        body{background-color:#ECF0F1;}
        .affix {
                top: 0px;
                width: 100%;
                z-index: 9999 !important;
            }
        .navbar-inverse {
            background-color: #34495E;
            border-color: #34495E;
            margin-bottom: 30px;
        }
        .navbar {
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
    </style>
