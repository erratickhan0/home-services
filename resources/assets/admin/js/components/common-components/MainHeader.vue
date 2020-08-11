<template>
    <div>
          <header class="main-header">
            <!-- Logo -->
            <a href="#" class="logo">

              <!-- logo for regular state and mobile devices -->
              <span class="logo-lg">Home Services</span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
              <!-- Sidebar toggle button-->
              <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </a>

              <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                  <li class="dropdown user user-menu">
                    <a href="#" class="profile">

                       <img src="/assets/admin/images/admin.jpg"class="user-image" alt="User Image">
                      <span class="hidden-xs"> </span>
                    </a>
                  </li>

                </ul>
              </div>
            </nav>
          </header>
    </div>
</template>

<script>
    export default {
        computed: {
            getUser() {
             //   return  JSON.parse(this.$store.getters.getAuthAdminUser);
            },
        }
    }
</script>
