import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({

    // You can use it as state property
    state: {
        authAdminUser : localStorage.getItem('admin_user')?localStorage.getItem('admin_user'):false,
        urlPrefix: '',
        languages: [],
        allBanners: [],
        allBannerCategories: [],
        bannerTypes: [],
        allProducts: [],
        allProductCategories: [],
        productTypes: [],
        allManufacturers: [],
        allManufacturerCategories: [],
        allCategories: [],
        allCategorySection: [],
        categoryTypes: [],
        linkTypes:[],
        allSubadmin: [],
        allRole: [],
        allParentCategories: [],
        allSearchEngine: [],
        allFilters: [],
        allBusiness:[],
        allTemplates:[],
        allFeatureCategory:[],
        allGroups:[],
        allFeatures:[],


    },

    // You can use it as a state getter function (probably the best solution)
    getters: {
        getServiceUrlPrefix(state){
            return state.urlPrefix;
        },
        getAuthAdminUser(state){
            return     state.authAdminUser;
        },
        getLanguageList(state){
            return     state.languages;
        },
        getAllBanners(state){
            return     state.allBanners;
        },
        getAllBannerCategories(state){
            return     state.allBannerCategories;
        },
        getBannerTypeList(state){
            return     state.bannerTypes;
        },
        getAllProducts(state){
            return     state.allProducts;
        },
        getAllProductCategories(state){
            return     state.allProductCategories;
        },
        getProductTypeList(state){
            return     state.productTypes;
        },
        getAllManufacturers(state){
            return     state.allManufacturers;
        },
        getAllManufacturerCategories(state){
            return     state.allManufacturerCategories;
        },
        getAllCategories(state){
            return     state.allCategories;
        },
        getAllCategorySection(state){
            return     state.allCategorySection;
        },
        getCategoryTypeList(state){
            return     state.categoryTypes;
        },
        getLinkTypeList(state){
            return     state.linkTypes;
        },
        getAllSubadmin(state){
            return     state.allSubadmin;
        },
        getAllRole(state){
            return     state.allRole;
        },
        getAllParentCategories(state){
            return     state.allParentCategories;
        },
        getAllSearchEngine(state){
            return     state.allSearchEngine;
        },
        getAllFilters(state){
            return     state.allFilters;
        },
        getAllBusiness(state, data){
            return    state.allBusiness;
        },
        getAllTemplates(state, data){
            return    state.allTemplates;
        },
        getFeatureCategory(state, data){
            return    state.allFeatureCategory;
        },
        getGroups(state, data){
            return    state.allGroups;
        },
        getAllFeatures(state, data){
            return    state.allFeatures;
        }

    },

    // Mutation for when you use it as state property
    mutations: {
        setServiceUrlPrefix(state , data){
            state.urlPrefix = data;
        },
        setAuthAdminUser(state, data){
            localStorage.setItem('admin_user', JSON.stringify(data));
            state.authAdminUser = localStorage.getItem('admin_user');
        },
        setLanguageList(state, data){
            state.languages = data;
        },
        setAllBanners(state, data){
            state.allBanners = data;
        },
        setAllBannerCategories(state, data){
            state.allBannerCategories = data;
        },
        setBannerTypeList(state, data){
            state.bannerTypes = data;
        },
        setAllProducts(state, data){
            state.allProducts = data;
        },
        setAllProductCategories(state, data){
            state.allProductCategories = data;
        },
        setProductTypeList(state, data){
            state.productTypes = data;
        },
        setAllManufacturers(state, data){
            state.allManufacturers = data;
        },
        setAllManufacturerCategories(state, data){
            state.allManufacturerCategories = data;
        },
        setAllCategories(state, data){
            state.allCategories = data;
        },
        setAllCategorySection(state, data){
            state.allCategorySection = data;
        },
        setCategoryTypeList(state, data){
            state.categoryTypes = data;
        },
        setLinkTypeList(state, data){
            state.linkTypes = data;
        },
        setAllSubadmin(state, data){
            state.allSubadmin = data;
        },
        setAllRole(state, data){
            state.allRole = data;
        },
        setAllParentCategories(state, data){
            state.allParentCategories = data;
        },
        setAllSearchEngine(state, data){
            state.allSearchEngine = data;
        },
        setAllFilters(state, data){
            state.allFilters = data;
        },
        setAllBusiness(state, data){
            state.allBusiness = data;
        },
        setAllTemplate(state,data){
            state.allTemplates = data;
        },
        setFeatureCategory(state,data){
            state.allFeatureCategory = data;
        },
        setGroups(state,data){
            state.allGroups = data;
        },
        setAllFeatures(state,data){
            state.allFeatures = data;
        },
    },
});
