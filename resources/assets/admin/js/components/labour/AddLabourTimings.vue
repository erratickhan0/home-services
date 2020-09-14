<template>
    <div>
        <b-modal id="addLabourTimings" ref="myModalRef" :hide-footer=true>
            <template slot="modal-title">
                Add Labour Timings
            </template>
            <alert v-if="errorMessage || successMessage" :errorMessage="errorMessage" :successMessage="successMessage"></alert>
            <form @submit.prevent="onSubmit">

                <div class="form-group">
                    <label>CNIC</label>
                    <select class="form-control" v-model="labour_id" onchange="getSlots">
                        <option value="" >Select Labour</option>
                        <option v-for="lab in getLabours"
                                :value="lab.id">
                            <span>CNIC : {{lab.cnic}}</span>
                        </option>
                    </select>
                </div>
                <div class="form-group">
                    <label>CNIC</label>
                    <select class="form-control" v-model="time_slot_id">
                        <option value="" >Select Timings</option>
                        <option v-for="slots in getTimings"
                                :value="slots.id">
                            <span>Time slots :{{slots.start_time}} to {{slots.end_time}} Shift:{{slots.shift}}</span>
                        </option>
                    </select>
                </div>
                <div slot="modal-footer" class="custom-modal-footer">
                    <div class="row m-0">
                        <div class="col-sm-12 text-right">
                            <button type="button" class="btn btn-secondary" v-on:click="hideModal">
                                Close
                            </button>
                            <button type="submit" class="btn btn-success">
                                Submit
                            </button>
                        </div>
                    </div>
                </div>

            </form>

        </b-modal>
    </div>
</template>

<script>

    export default {
        props: ['list'],
        data() {
            return {
                selected: null,
                errorMessage: '',
                successMessage: '',
                loading: false,
                getLabours:[],
                getTimings:[],
                labour_id:'',
                time_slot_id:'',

            }
        },
        mounted() {

            this.getAllLabours();
            this.getAllTimings();
           // this.getAllProjectSpeciality();
        },
        methods: {
            getSlots()
            {
                let self = this;
                let url = '/get-labour-slots';
                self.$http.get(url).then(response => {
                    /*response = response.data;
                    self.getLabourSlots=response;
                    console.log(self.getLabourSlots,'slots');*/


                }).catch(error => {
                });

            },
            getAllTimings()
            {
                let self = this;
                let url = '/time-slots';
                self.$http.get(url).then(response => {
                    response = response.data;
                    self.getTimings=response;
                    console.log(self.getTimings,'timings');


                }).catch(error => {
                });
            },
            getAllLabours() {
                let self = this;
                let url = '/labours-all';
                self.$http.get(url).then(response => {
                    response = response.data;
                    this.getLabours=response.data;
                    console.log(this.getLabours,'vava');


                }).catch(error => {
                });
            },

            hideModal() {
                this.resetFormFields();
                this.$refs.myModalRef.hide();
            },
            resetFormFields() {
                let self = this;
             this.labour_id='';
                this.time_slot_id='';
                setTimeout(function () {
                    Vue.nextTick(() => {
                        self.errorMessage = '';
                        self.successMessage = '';
                        self.errorBag.clear();
                    })
                }, 100);
            },
            onSubmit() {
                this.loading = true;
                let url = '/add-labour-timings';
                this.formData={'labour_id':this.labour_id,'time_slot_id':this.time_slot_id};
                var data = Object.assign({}, this.formData);
                var self = this;
                this.$http.post(url, data).then(response => {
                    response = response.data;
                    self.successMessage = response.message;
                    setTimeout(function () {
                        self.successMessage = '';
                        self.loading = false;
                        self.hideModal();
                        self.resetFormFields();
                        self.$emit('call-list');
                    }, 2000);
                    setTimeout(function () {
                        Vue.nextTick(() => {
                            self.errorBag.clear()
                        })
                    }, 10);
                }).catch(error => {
                    console.log(error.response.data);
                    this.errorMessage = error.response.data.error.message;
                    this.loading = false;
                });
            },
        },
        computed: {
            getProjectSpeciality() {
               // return this.$store.getters.getAllTemplates;
            }
        },
        watch: {
            list: function () {
                this.errorMessage = '';
                this.successMessage = '';

            }
        },
    }

</script>
