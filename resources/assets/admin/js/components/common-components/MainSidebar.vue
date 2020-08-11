<template>
    <div>
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar user panel -->
                <!-- /.search form -->
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu" data-widget="tree">
                   <!-- <li :class="[currentPage.includes('admin/dashboard')? activeClass:'']" >

                        <router-link to="/admin/dashboard">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                        </router-link>
                    </li>

                    <li :class="[currentPage.includes('admin/business-type')? activeClass:'']">
                        <router-link to="/admin/business-type">
                            <i class="fa fa-briefcase"></i> <span>Business Type</span>
                        </router-link>
                    </li>

                    <li :class="[currentPage.includes('admin/project-speciality')? activeClass:'']">

                        <router-link to="/admin/project-speciality">
                            <i class="fa fa-star"></i> <span>Project Speciality</span>
                        </router-link>
                    </li>-->



                    <!--<li class="treeview menu-open">
                        <a href="#">

                            <i class="fa fa-dropbox"></i> <span>Product and Category</span>
                            <span class="pull-right-container">
                              <i class="fa fa-angle-left pull-right"></i>
                             </span>
                        </a>
                        <ul class="treeview-menu">

                            <li> <router-link to="/admin/category"> <i class="fa fa-circle-o"></i> Categories</router-link></li>
                            <li><router-link to="/admin/sub-category"><i class="fa fa-circle-o"></i>Sub Categories</router-link></li>
                            <li><router-link to="/admin/category-feature"><i class="fa fa-circle-o"></i>Feature Categories</router-link></li>
                            <li><router-link to="/admin/feature"><i class="fa fa-circle-o"></i>Features</router-link></li>
                            <li><router-link to="/admin/product"><i class="fa fa-circle-o"></i>Products</router-link></li>
                        </ul>
                    </li>-->
                   <!-- <li :class="[currentPage.includes('admin/lead')? activeClass:'']">
                        <router-link to="/admin/lead"><i class="fa fa-circle-o">
                        </i>Leads</router-link>
                    </li>
                    <li :class="[currentPage.includes('admin/final-question')? activeClass:'']">
                        <router-link to="/admin/final-question">
                         <i class="fa fa-question-circle"></i> <span>Final Question</span>
                        </router-link>
                    </li>
                    <li :class="[currentPage.includes('admin/members')? activeClass:'']">
                        <router-link to="/admin/members">
                            <i class="fa fa-users"></i> <span>Users</span>
                        </router-link>
                    </li>

                    <li :class="[currentPage.includes('admin/product')? activeClass:'']">

                        <router-link to="/admin/product">
                            <i class="fa fa-product-hunt"></i><span>Products</span>
                        </router-link>
                    </li>-->

                    <li :class="[currentPage.includes('admin/category-management')? activeClass:'']">

                        <router-link to="/admin/category-management">
                            <i class="fa fa-dropbox"></i><span>Category Management</span>
                        </router-link>
                    </li>
                    <li :class="[currentPage.includes('admin/labour-management')? activeClass:'']">

                        <router-link to="/admin/labour-management">
                            <i class="fa fa-dropbox"></i><span>Labour Management</span>
                        </router-link>
                    </li>
                </ul>


                <ul class="account">
                    <li><a href v-on:click="logout"><i class="fa fa-sign-out"></i> Logout</a></li>
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>

    </div>
</template>

<script>
    export default {

        computed:{
        currentPage:function()
        {

            return this.$route.path;
        }
        },
        data()
        {
            return {
                activeClass:'active'
            }
        },
        methods: {

            logout: function () {
                var this_ = this;
                if(this.$auth.isAuthenticated()){
                    this.$auth.logout().then(function (Vue) {
                        this_.$store.commit('setAuthAdminUser', '');
                        this_.$router.push({ name: 'home'})
                    })
                }else{
                    this_.$router.push({ name: 'home'})
                }
            }
        }
    }
</script>
