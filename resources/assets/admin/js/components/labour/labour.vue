<template>
    <div>
        <div class="wrapper">
            <main-header></main-header>
            <main-sidebar></main-sidebar>
            <div class="content-wrapper" style="min-height: 306px;">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>Labours</h1>
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

                                            <input type="text" placeholder="Search" v-model="search"  v-on:keyup="onApply" class="form-control">
                                            <b-input-group-append>
                                                <b-button size="sm" text="Button" variant="success">
                                                    <i class="fa fa-search"></i>
                                                </b-button>
                                            </b-input-group-append>
                                        </b-input-group>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-md-6 col-lg-7 mobl-btn-block text-right">
                                    <!-- Button trigger modal -->
                                    <b-button v-b-modal.addLabour variant="success" size="lg">Add Labour</b-button>

                                    <!-- Modal -->
                                </div>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <tbody>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>CNIC</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>City</th>
                                    </tr>
                                    <tr  v-for="(list, index) in listing" v-if="listing.length && !loadingStart" >
                                        <td>{{list.id}}</td>
                                        <td class="list-business">
                                            <span>{{list.cnic}}</span>
                                        </td>
                                        <td class="list-business">
                                            <span>{{list.phone}}</span>
                                        </td>
                                        <td class="list-business">
                                            <span>{{list.address}}</span>
                                        </td>
                                        <td class="list-business">
                                            <span>{{list.cities.name}}</span>
                                        </td>

                                        <td width="150">
                                            <div class="actions action-edit text-center">
                                                <a href="#" v-b-modal.addLabour  @click="updateLabour(list)"><i
                                                    class="fa fa-fw fa-edit"></i></a>
                                                <a href="#" v-b-modal.deleteRecord @click="deleteLabour(list)">
                                                    <i class="fa fa-fw fa-trash"></i></a>
                                            </div>
                                        </td>

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
        <add-labour-modal  :list="list" @call-list="onCallList"></add-labour-modal>
        <!--<delete-record-modal  :requestUrl="submitUrl" @call-list="onCallList"></delete-record-modal>-->
    </div>
</template>

<script>
    export default {
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
                url: '/labours-all',
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
                ]
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
            updateLabour(list) {
                this.list = list;
            },
            deleteLabour(list) {
                this.list = list;
                this.currentRecord = list;

            },
            onCallList() {
                this.onApply();
            },
            onApply() {
                this.loadingStart = true;
                this.loading = true;
                var data = {
                    search: this.search
                };
                this.getList(data, false);
            }

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


