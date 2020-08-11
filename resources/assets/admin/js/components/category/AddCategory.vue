<template>
    <div>
        <b-modal id="addCategory" ref="myModalRef" :hide-footer=true>
            <template slot="modal-title">
                Add category
            </template>
            <alert v-if="errorMessage || successMessage" :errorMessage="errorMessage" :successMessage="successMessage"></alert>
            <form @submit.prevent="onSubmit">

                <div class="form-group">
                    <label>Category Name</label>
                    <input type="text" class="form-control" v-model="formData.category_name">
                </div>
                <div class="form-group">
                    <label>Short Desc.</label>
                    <b-form-textarea
                        id="textarea1"
                        placeholder=""
                        rows="3"
                        max-rows="6"
                        v-model="formData.short_desc"
                    ></b-form-textarea>
                </div>
                <div class="form-group">
                    <label>Long Desc.</label>
                    <b-form-textarea
                        id="textarea2"
                        placeholder=""
                        rows="3"
                        max-rows="6"
                        v-model="formData.long_desc"
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
                    short_desc: "",
                    category_name: "",
                    long_desc: "",
                },
            }
        },
        mounted() {
           // this.getAllProjectSpeciality();
        },
        methods: {
            getAllProjectSpeciality() {
                let self = this;
                let url = '/api/template';
                self.$http.get(url).then(response => {
                    response = response.data;
                    self.$store.commit('setAllTemplate', response.data);
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
                    short_desc: "",
                    category_name: "",
                    long_desc: "",
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
                let url = '/category';
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
                this.formData.category_name = this.list.category_name;
                this.formData.short_desc = this.list.short_desc;
                this.formData.long_desc = this.list.long_desc;
                this.formData.id = this.list.id;
            }
        },
    }

</script>
