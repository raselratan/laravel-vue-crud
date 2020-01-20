<template>
  <div class="container-fluid">
    <div class="d-flex justify-content-center h-100">
		  <div v-show="loginStatus" class="card mt-4">
        <div class="card-header">
          <h3>Sign In</h3>
        </div>
        <div class="card-body">
            <div class="input-group form-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
              </div>
              <input type="text" v-model=form.email class="form-control" placeholder="Email">
              
            </div>
            <div class="input-group form-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-key"></i></span>
              </div>
              <input type="password" v-model=form.password class="form-control" placeholder="password">
            </div>
            <div class="row align-items-center remember">
              <input v-model=form.rToken type="checkbox">Remember Me
            </div>
            <div class="form-group">
              <button @click="loginForm" class="btn float-right login_btn">Login</button>
            </div>
        </div>
        <div class="card-footer">
          <div class="d-flex justify-content-center links">
            Don't have an account?<a href="#" @click="signUp">Sign Up</a>
          </div>
          <div class="d-flex justify-content-center">
            <a href="#">Forgot your password?</a>
          </div>
        </div>
		  </div>

		  <div v-show="!loginStatus" class="card mt-4">
        <div class="card-header">
          <h3>Sign Up</h3>
        </div>
        <div class="card-body">
            <div class="input-group form-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
              </div>
              <input type="text" v-model=form.name class="form-control" placeholder="Name">
            </div>

            <div class="input-group form-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-at"></i></span>
              </div>
              <input type="text" v-model=form.email class="form-control" placeholder="Email">
            </div>

            <div class="input-group form-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-key"></i></span>
              </div>
              <input type="password" v-model=form.password class="form-control" placeholder="password">
            </div>
            
            <div class="form-group mt-5">
              <button @click="registrationForm" class="btn float-right login_btn">Submit</button>
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
            loginStatus:true,
            form:new Form({
                name:'',
                email: '',
                password:'',
                remember:'',
                
            })
        }
    },
    mounted() {
        console.log('Component mounted.')
    },

    methods:{
      loginForm(){
        this.form.post('/admin/login').then(({data})=>{
          if(data.logmsg == 'error'){
              toast.fire({
                  type: 'warning',
                  title: 'Check your Email and Password'
              });
          }
          else{
            window.location.href = '/admin';
            toast.fire({
                type: 'success',
                title: 'Successfully Logged in'
            });
          }
          
      })
      .catch(()=>{
          toast.fire({
              type: 'warning',
              title: 'Check your Email and Password'
          });
      });
      },

      signUp(){
        this.loginStatus=false;
         this.form.reset();
      },
      registrationForm(){
        this.form.post('/admin/registration').then(({data})=>{
          toast.fire({
            type: 'success',
            title: 'Sign up successfully'
          })
          this.loginStatus=true;  
      })
      .catch(()=>{
          toast.fire({
            type: 'warning',
            title: 'Invalid Information. Try Again'
          })
      });
      },
    },  

    created() {
      this.form.reset();
    }
    }

</script>






<style scoped>
  .container-fluid{
  min-height: 700px;  
  align-content: center;
  background-image: url('http://getwallpapers.com/wallpaper/full/a/5/d/544750.jpg');
  background-size: cover;
  background-repeat: no-repeat;
  height: 100%;
  font-family: 'Numans', sans-serif;
  }

  .card{
  height: 370px;
  margin-top: auto;
  margin-bottom: auto;
  width: 400px;
  background-color: rgba(0,0,0,0.5) !important;
  }

  .social_icon span{
  font-size: 60px;
  margin-left: 10px;
  color: #FFC312;
  }

  .social_icon span:hover{
  color: white;
  cursor: pointer;
  }

  .card-header h3{
  color: white;
  }

  .social_icon{
  position: absolute;
  right: 20px;
  top: -45px;
  }

  .input-group-prepend span{
  width: 50px;
  background-color: #fd984a;
  color: black;
  border:0 !important;
  }

  input:focus{
  outline: 0 0 0 0  !important;
  box-shadow: 0 0 0 0 !important;

  }

  .remember{
  color: white;
  }

  .remember input
  {
  width: 20px;
  height: 20px;
  margin-left: 15px;
  margin-right: 5px;
  }

  .login_btn{
  color: black;
  background-color: #fd984a;
  width: 100px;
  }

  .login_btn:hover{
  color: black;
  background-color: white;
  }

  .links{
  color: white;
  }

  .links a{
  margin-left: 4px;
  }
</style>
