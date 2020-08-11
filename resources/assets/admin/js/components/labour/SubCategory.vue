<template>
    <div>
        <b-modal id="addSubCategory"  ref="myModalRef"  :hide-footer=true>
            <template slot="modal-title">
                Sub Category
            </template>
            <alert v-if="errorMessage || successMessage" :errorMessage="errorMessage" :successMessage="successMessage"></alert>

            <form  method="" @submit.prevent="onSubmit">
                <div class="form-group">
                    <label>Categories</label>
                    <select class="form-control" v-model="formData.category_id">
                        <option value="" disabled>Select Section</option>
                        <option v-for="cat in getCategories"
                                :value="cat.id">
                            {{cat.category_name}}
                        </option>
                    </select>
                </div>
               <div class="form-group">
                    <label>Category Name</label>
                    <input type="text" class="form-control"  v-model="formData.category_name">
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
        data() {
            return {
                selected: null,
                errorMessage: '',
                successMessage: '',
                loading: false,
                getCategories:[],
                formData: {
                    category_id: "",
                    category_name: "",
                    short_desc: "",
                    long_desc: "",
                },
            }
        }, mounted() {
            this.getAllCategories();
        },
        methods: {
            getAllCategories() {
                let self = this;
                let url = '/categories-all';
                self.$http.get(url).then(response => {
                    response = response.data;
                    this.getCategories=response;
                    console.log(response);

                }).catch(error => {
                });
            },
            hideModal() {
                var self = this;
                this.resetFormFields();
                this.$refs.myModalRef.hide();
            },
            resetFormFields() {
                let self = this;
                this.formData = {
                    category_id: "",
                    category_name: "",
                    short_desc: "",
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
                var self = this;
                this.loading = true;
                let url = '/sub-category';
                var data = Object.assign({}, this.formData);
                self.$http.post(url, data).then(response => {
                    response = response.data;
                    self.successMessage = response.message;
                    setTimeout(function () {
                        self.successMessage = '';
                        self.hideModal();
                        self.resetFormFields();
                        self.$emit('call-list');
                        self.loading = false;
                    }, 2000);
                    setTimeout(function () {
                        Vue.nextTick(() => {
                            self.errorBag.clear()
                        })
                    }, 10);
                }).catch(error => {
                    self.errorMessage = error.response.data.error.message;
                    this.loading = false;
                });
            },
        },

        watch: {
            list: function () {
                this.errorMessage = '';
                this.successMessage = '';
                this.errorBag.clear();
                this.formData.template_id = this.list.template_id;
                this.formData.category_name = this.list.category_name;
            }
        },
        computed: {
            getProjectSpeciality() {
                //return this.$store.getters.getAllTemplates;
            }
        },

    }

</script>
