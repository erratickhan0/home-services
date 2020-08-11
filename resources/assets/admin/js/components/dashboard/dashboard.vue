<template>
	<div>
       <div class="wrapper">
            <main-header></main-header>
            <main-sidebar></main-sidebar>
            <div class="content-wrapper" style="min-height: 306px;">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>Dashboard </h1>
                    <!-- <b-breadcrumb ></b-breadcrumb> -->
                </section>

                <!-- Main content -->
                <section class="content">

                    <div class="row">
                        <div class="col-md-12">
                            <!-- Default box -->
                            <div class="box">
                                <div class="box-header with-border list-business-box ">
                                    <h3>Recent Project Requests </h3>
                                </div>
                                <div class="box-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover project-detail">
                                            <thead>
                                                <tr>
                                                    <th width="60px">S:No</th>
                                                    <th>Full Name</th>
                                                    <th>Email</th>
                                                    <th>City</th>
                                                    <th>Country</th>
                                                    <th width="60px"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <tr v-for="list in listing">
                                                <td>{{list.id}}</td>
                                                <td class="list-dashboard">
                                                    <span>{{list.first_name + list.last_name}}</span>
                                                </td>
                                                <td class="list-dashboard">
                                                    <span>{{list.email}}</span>
                                                </td>
                                                <td class="list-dashboard">
                                                    <span>{{list.city}}</span>
                                                </td>
                                                <td class="list-dashboard">
                                                    <span>{{list.country}}</span>
                                                </td>
                                                <td>
                                                    <div class="actions action-edit text-center">
                                                        <a href="#" v-b-modal.detailProjectRequest  @click="viewList(list)" ><i
                                                            class="fa fa-fw fa-eye" v-b-tooltip.hover title="View Detail"></i></a>
                                                    </div>
                                                </td>
                                            </tr>

                                            </tbody>
                                        </table>
                                        <no-record-found v-if="!listing.length && showNoRecordFound"></no-record-found>
                                    </div>
                                </div>

                            </div>
                        </div>
                         <!--<div class="col-md-12">
                            <div class="box">
                                 <div class="box-body">
                                    <graph></graph>
                                 </div>
                            </div>
                        </div>-->
                    </div>

                </section>

            </div>
       </div>
       <DetailProjectRequestModal  :list="list"></DetailProjectRequestModal>
	</div>

   </template>

<script>

    export default {
        data(){
            return{
                listing : [],
                list: {},
                url : '/api/lead',
                pagination: true,
                showNoRecordFound:false,
                currentPage: 1,

            }
        },


        methods:{

            getList(){
                let self = this;
                let url = this.url;
                self.showNoRecordFound = false;

                var query = '?pagination=true';
                var page = '?page=5';
                url = url + query + page;


                self.$http.get(url).then(response => {
                    response = response.data;
                    self.listing = response.data;
                    if(!self.listing.length)
                        self.showNoRecordFound = true;
                }).catch((error)=>{
                    if(error.status==403)
                        self.pagination = false;

                });
            },
            viewList(view_list){
                this.list = view_list;
                console.log(view_list);
            },

        },
        mounted() {

            this.getList();


        }
    }
</script>
