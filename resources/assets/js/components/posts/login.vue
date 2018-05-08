<template>
  <div>
      <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Login</div>
                    <div class="panel-body">
                        <form class="form-horizontal" @submit.prevent="loginUser">
                            <div class="form-group">
                                <label for="email" class="col-md-4 control-label">E-Mail Address</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" v-model="login.email" class="form-control" name="email"  required autofocus>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password" class="col-md-4 control-label">Password</label>    
                                <div class="col-md-6">
                                    <input id="password"  v-model="login.password" type="password" class="form-control" name="password" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <div class="checkbox">
                                        <label>
                                            <!-- <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me -->
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Login
                                    </button>
                                    <a class="btn btn-link" href="#">
                                        Forgot Your Password?
                                    </a>
                                </div>
                            </div>
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
          login:{
              email:'',
              password: ''
          }
      }
  },
  methods:{
      loginUser(){
          axios.post('login',this.login)
          .then(response => {
            this.$store.dispatch('setUserStatus',true)
            this.$router.push('/dashboard') 
                // let token= response.data.token;
                // if(token){
                //     localStorage.setItem('token',token)
                // }
          })
          .catch(error => {
              console.log(error.response)
          })
      }
  }
}
</script>
<style>

</style>
