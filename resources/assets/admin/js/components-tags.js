//Vue.component('example-component', require('./components/ExampleComponent.vue').default);
// Common files
Vue.component('main-header', require('./components/common-components/MainHeader.vue').default);
Vue.component('main-sidebar', require('./components/common-components/MainSidebar.vue').default);
Vue.component('alert', require('./components/common-components/Alert.vue').default);

// Add Category
Vue.component('add-category-modal', require('./components/category/AddCategory.vue').default);
Vue.component('sub-category-modal', require('./components/category/SubCategory.vue').default);

// Add Labour
Vue.component('add-labour-modal', require('./components/labour/AddLabour.vue').default);
Vue.component('add-labour-timings-modal', require('./components/labour/AddLabourTimings.vue').default);
