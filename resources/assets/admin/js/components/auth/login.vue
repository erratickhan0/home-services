<template>
	<div>
	   <div class="login-box">
		  <div class="login-logo">
		    <a target="_blank" href="javascript;;">

		      <h1><br> Home Services</h1>
		    </a>
		  </div>
		  <!-- /.login-logo -->
		  <div class="login-box-body">
              <alert v-if="errorMessage || successMessage" :errorMessage="errorMessage"
                     :successMessage="successMessage"></alert>
              <form @submit.prevent="login" novalidate="">
		      <div class="form-group has-feedback">
                  <input id="login_email" type="email" v-model="login_info.email" v-validate="'required|email'"
                         name="email" class="form-control" data-vv-name="email"
                         placeholder="Enter your email address"
                         :class="[errorBag.first('email') ? 'is-invalid' : '']">
                  <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
		      </div>
		      <div class="form-group has-feedback">
		          <input id="login_password" type="password" :maxlength="25" v-model="login_info.password"
                         v-validate="'required'" data-vv-as="password" name="password" class="form-control"
                         data-vv-name="password" placeholder="Enter your account password"
                         :class="[errorBag.first('password') ? 'is-invalid' : '']">

		        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
		      </div>
		      <div class="row">
                  <div class="col-sm-8"></div>
		        <!-- /.col -->
		        <div class="col-sm-4">
                    <button :class="[loading  ? 'show-spinner' : '' , 'btn' , 'btn-success btn-block']">
                        <span>Sign In</span>

                    </button>
		        </div>
		        <!-- /.col -->
		      </div>
		    </form>
		    <!-- /.social-auth-links -->

<!--		    <a href="forgot.php">I forgot my password</a><br>-->
<!--		    <a href="register.php" class="text-center">Register an account</a>-->

		  </div>
		  <!-- /.login-box-body -->
		</div>
	</div>
</template>

<script>
    export default {
        data() {
            return {
                //titleproperties: 'dashboard-title',
                titleproperties: 'bodyclass',
                errorMessage: window.errorMessage,
                successMessage: window.successMessage,
                login_info: {
                    'email': '',
                    'password': '',
                    'remember_me': false
                },
                loading: false,

                //remember_me: false
            }
        },
        mounted() {
            this.$auth.options.loginUrl = '/login';
            self = this;
            this.$nextTick(function () {
                setTimeout(function () {
                    self.errorMessage = '';
                }, 5000);
            });

            this.fillByMemory();
        },
        watch: {
            message(value) {
                this.successMessage = value
            }
        },
        methods: {
            login: function () {
                var this_ = this;
                this.loading = true;
                window.successMessage = "";
                if (!this.$auth.isAuthenticated())
                {

                    this.$auth.login(this.login_info).then(function (response) {
                        this_.rememberMe();
                        self.loading = false;
                        console.log('zee');
                        console.log(response.data);
                       // this_.$store.commit('setAuthAdminUser', response.data);
                        this_.$router.push({name: 'category-management'})

                    }).catch(error => {
                        console.log(error.response,'svas');
                        this.loading = false;
                      //  console.log(error.email[0]);
                        //this_.errorMessage = error.email[0]+' '+error.password[0];
                        console.log("here1");

                        setTimeout(function () {
                            this_.errorMessage = '';
                            this.loading = false
                        }, 5000);
                    })
                } else {
                    console.log("here2");
                    setTimeout(function () {
                        this.loading = false;
                        location.reload();
                    }, 5000);
                }
            },
            validateBeforeSubmit() {
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        this.login();
                        this.errorMessage = '';
                        return;
                    }
                    this.errorMessage = this.errorBag.all()[0];
                });
            },

            rememberMe: function () {
                if (this.login_info.remember_me) {
                    localStorage.email = this.login_info.email;
                    localStorage.password = this.login_info.password;
                    localStorage.chkbox = this.login_info.remember_me;

                } else {
                    localStorage.email    = '';
                    localStorage.password = '';
                    localStorage.chkbox   = '';
                }
            },
            fillByMemory() {
                if (localStorage.chkbox && localStorage.chkbox != '') {
                    this.login_info.remember_me = localStorage.chkbox;
                    this.login_info.email = localStorage.email;
                    this.login_info.password = localStorage.password;
                } else {
                    this.login_info.remember_me         = '';
                    this.login_info.email    = '';
                    this.login_info.password = '';
                }
            }
        },

    }
</script>
