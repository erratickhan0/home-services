<template>
    <div>
        <div class="wrapper">
            <main-header></main-header>
            <main-sidebar></main-sidebar>
            <div class="content-wrapper" style="min-height: 306px;">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>Jobs</h1>
                    <b-breadcrumb :items="items"></b-breadcrumb>
                </section>

                <!-- Main content -->
                <section class="content">

                    <!-- Default box -->
                    <div class="box">
                        <div class="box-header with-border list-business-box">

                            <div class="row">
                                <div class="col-sm-6 col-md-6 col-lg-5">
                                    <div class="box-tools">
                                        <b-input-group
                                            v-for="size in ['']"
                                            :key="size"
                                            :size="size"
                                            class=""
                                        >

                                            <input type="text" placeholder="Search" v-model="search"   class="form-control">
                                            <b-input-group-append>
                                                <b-button size="sm" text="Button" variant="success">
                                                    <i class="fa fa-search"></i>
                                                </b-button>
                                            </b-input-group-append>
                                        </b-input-group>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-md-6 col-lg-7 mobl-btn-block text-right">

                                </div>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <tbody>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Category</th>
                                        <th>Customer Name</th>
                                        <th>Labour Name</th>
                                        <th>Cust address</th>
                                        <th>Status</th>

                                    </tr>
                                    <tr  v-for="(list, index) in listing" v-if="listing.length && !loadingStart" >
                                        <td>{{list.id}}</td>
                                        <td class="list-business">
                                            <span v-if="list.cats">{{list.cats.category_name}}</span>
                                        </td>
                                        <td class="list-business">
                                            <span v-if="list.customer">{{list.customer.first_name}}  {{list.customer.last_name}}</span>
                                        </td>
                                        <td class="list-business">
                                            <span v-if="list.labour">{{list.labour.cnic}}</span>
                                        </td>
                                        <td class="list-business">
                                            <span v-if="list.cust_address">{{list.cust_address.area}}</span>
                                        </td>
                                        <div class="form-group">
                                            <select class="form-control" @change="statusUpdate(list.id)" v-model="job_status[list.id]">
                                                <option value="" disabled>Select Section</option>
                                                <option value="accepted">Accepted</option>
                                                <option value="rejected">Rejected</option>
                                                <option value="assigned">Assigned</option>
                                                <option value="in_progress">In progress</option>
                                                <option value="done">Done</option>
                                            </select>
                                        </div>


                                        <!--<td width="150">
                                            <div class="actions action-edit text-center">
                                                <a href="#" v-b-modal.addLabour  @click="updateLabour(list)"><i
                                                    class="fa fa-fw fa-edit"></i></a>
                                                <a href="#" v-b-modal.deleteRecord @click="deleteLabour(list)">
                                                    <i class="fa fa-fw fa-trash"></i></a>
                                            </div>
                                        </td>-->

                                    </tr>
                                    </tbody>
                                </table>
                                <no-record-found v-if="!listing.length && showNoRecordFound"></no-record-found>
                            </div>
                        </div>
                        <div class="box-footer clearfix">
                            <div class="total-record float-left" v-if="pagination">
                                <p><strong>Total records: <span>{{total}}</span></strong></p>
                            </div>
                            <div class="pagination-wrapper float-right" v-if="pagination">
                                <b-pagination size="md" :total-rows="total" v-model="currentPage" :per-page="10"></b-pagination>
                            </div>
                        </div>
                    </div>
                </section>

            </div>


        </div>
        <!--<sub-category-modal  @call-list="onCallList"></sub-category-modal>-->
        <!--<add-labour-modal  :list="list" @call-list="onCallList"></add-labour-modal>-->
        <!--<delete-record-modal  :requestUrl="submitUrl" @call-list="onCallList"></delete-record-modal>-->
        <b-modal  id="back-popup" ref="changeStatus"  size="md" :hide-footer=true>
            <div class="text-center">
                <p>Are you sure you want to delete?</p>
                <a  href="#"   @click='changeStatus(true)' class="btn mrg-raq">Yes</a>
                <a  href="#"   @click='changeStatus(false)' class="btn">No</a>

            </div>
        </b-modal>
    </div>
</template>

<script>
    export default {
        name:'job',
        data() {
            return {
                list_id:'',
                listing: [],
                list: {},
                pagination: false,
                total:0,
                showNoRecordFound: false,
                loadingStart: true,
                currentRecord : '',
                search: '',
                currentPage: 1,
                url: '/jobs-all',
                items: [
                    {
                        text: 'Home',
                        href: '#'
                    },
                    {
                        text: 'Labour',
                        href: '#'
                    },
                    {
                        text: 'List',
                        active: true
                    }
                ],
                formData:{
                    id:'',
                    status:'',

                },
                job_status:[]
            }
        },
        watch: {
            currentPage(pageNumber) {
                var data = {
                    search: this.search
                };
                this.getList(data, pageNumber);
            },
        },

        methods: {
            changeStatus(flag)
            {
                if(flag==false)
                {
                    this.$refs.changeStatus.hide();
                }
                else
                {
                    this.$refs.changeStatus.hide();
                    let url = '/job-status-change';
                    this.formData.status=this.job_status[this.formData.id];


                    var data = Object.assign({}, this.formData);
                    this.$http.post(url, data).then(response => {
                        response = response.data;

                    }).catch(error => {
                        self.errorMessage = error.response.data.error.message;
                        this.loading = false;
                    });

                }


            },
            statusUpdate(listid)
            {
                this.formData.id=listid;
                this.$refs.changeStatus.show();

            },
            getList(data, page, successCallback)
            {
                let self = this;
                self.showNoRecordFound = false;
                let url = self.url;
                if (typeof (page) == 'undefined' || !page) {
                    self.records = [];
                }
                if ((typeof (data) !== 'undefined' && data) || this.search) {
                    var query = '?pagination=true';
                    if (data.search != "" && data.search != "undefined") {
                        var query = query + '&keyword=' + data.search;
                    }
                    url = url + query;
                } else {
                    var query = '?pagination=true';
                    url = url + query;
                }

                if (typeof (page) !== 'undefined' && page) {
                    url += '&page=' + page;
                }

                self.$http.get(url).then(response => {


                    var response=response.data;

                    self.listing = response.data;
                    console.log(self.listing,'listing');
                    self.listing.forEach(function(value,key) {
                        if(value.status!=null)
                        {
                            if(value.status.accepted==true)
                            {
                                self.job_status[value.id]='accepted';
                            }
                            if(value.status.rejected==1)
                            {
                                self.job_status[value.id]='rejected';
                            }
                            if(value.status.in_progress==1)
                            {
                                self.job_status[value.id]='in_progress';
                            }
                            if(value.status.assigned==1)
                            {
                                self.job_status[value.id]='assigned';
                            }
                            if(value.status.done==1)
                            {
                                self.job_status[value.id]='done';
                            }

                        }


                    });
                    if (!self.listing.length) {
                        self.showNoRecordFound = true;
                    }

                    self.pagination = true;
                    self.total=response.total;
                    if (!self.listing.length) {
                        self.showNoRecordFound = true;
                    }
                    self.loading = false;
                    self.loadingStart = false;
                    successCallback(true);

                }).catch(error => {
                    if (error.status == 403) {
                        self.pagination = false;
                    }
                });
            },

        },
        mounted() {
            this.getList(false, false);

        },
        computed: {
            submitUrl(){
                if(this.currentRecord){
                    // return '/api/category/'+this.currentRecord.id;
                }
            }
        }


    }
</script>

<style scoped>

</style>
