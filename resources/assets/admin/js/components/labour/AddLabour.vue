<template>
    <div>
        <b-modal id="addLabour" ref="myModalRef" :hide-footer=true>
            <template slot="modal-title">
                Add category
            </template>
            <alert v-if="errorMessage || successMessage" :errorMessage="errorMessage" :successMessage="successMessage"></alert>
            <form @submit.prevent="onSubmit">

                <div class="form-group">
                    <label>CNIC</label>
                    <input type="text" class="form-control" v-model="formData.cnic">
                </div>
                <div class="form-group">
                    <label>Phone</label>
                    <input type="text" class="form-control" v-model="formData.phone">
                </div>
                <div class="form-group">
                    <label>Registeration Number.</label>
                    <input type="text" class="form-control" v-model="formData.registeration_num">
                </div>
                <div class="form-group">
                    <label>Cities</label>
                    <select class="form-control" v-model="formData.city_id">
                        <option value="" disabled>Select Section</option>
                        <option v-for="city in myCities"
                                :value="city.id">
                            {{city.name}}
                        </option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Address.</label>
                    <b-form-textarea
                        id="textarea2"
                        placeholder=""
                        rows="3"
                        max-rows="6"
                        v-model="formData.address"
                    ></b-form-textarea>
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
                formData: {
                    cnic: "",
                    registeration_num: "",
                    phone: "",
                    city_id: "",
                    address:""

                },
                myCities:[]
            }
        },
        mounted() {
            this.getCities();
           // this.getAllProjectSpeciality();
        },
        methods: {
            getCities()
            {
                let self = this;
                let url = '/get-cities';
                self.$http.get(url).then(response => {
                    response = response.data;
                    this.myCities=response;
                }).catch(error => {
                });

            },
            hideModal() {
                this.resetFormFields();
                this.$refs.myModalRef.hide();
            },
            resetFormFields() {
                let self = this;
                this.formData = {
                    cnic: "",
                    registeration_num: "",
                    phone: "",
                    city_id: "",
                    address:""
                };
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
                let url = '/labour';
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
                this.errorBag.clear();
                this.formData.id = this.list.id;
                this.formData.cnic = this.list.cnic;
                this.formData.registeration_num = this.list.registeration_num;
                this.formData.phone = this.list.phone;
                this.formData.city_id = this.list.city_id;
                this.formData.address = this.list.address;
            }
        },
    }

</script>
