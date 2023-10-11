import NavbarPage from "../components/Navbar.vue";
import FooterPage from "../components/Footer.vue";
import axios from "axios";
import Paginate from "vuejs-paginate-next";
import { mapGetters } from "vuex";

export default ({
    name: 'HomeView',
    components: {
        NavbarPage, FooterPage, paginate: Paginate,
    }, data() {
        return {
            searchKey: '',
            fullPage: false,
            categoryList: [],
            productList: {},
            visibleCate : 2,
            details : '',
        }
    },
    computed :{
        ...mapGetters(['storeUserToken','storeUserData']),
        showCategory() {
            return this.categoryList.slice(0, this.visibleCate)
          },
    },
    methods: {

        loadMore() {
            if (this.visibleCate > this.categoryList.length) return;
            this.visibleCate = this.visibleCate + 3;
          },


        // get all category
        getallCategory() {
            let loader = this.$loading.show({
                width: 50,
                height: 50,
                color: 'green',
                loader: "dots"
            });
            axios.get('http://localhost:8000/api/category/all')
                .then((response) => {
                    this.categoryList = response.data.categories;
                    loader.hide();
                })
                .catch((error) => {
                    console.log(error);
                    loader.hide();
                });
        },

        // get all products
        getallProduct(page = 1) {
            let loader = this.$loading.show({
                width: 50,
                height: 50,
                color: 'green',
                loader: "dots"
            });
            axios.get('http://localhost:8000/api/product/all?page='+page)
                .then((response) => {
                    for (let i = 0; i < response.data.products.data.length; i++) {
                        if (response.data.products.data[i].image != null) {
                            response.data.products.data[i].image = 'http://localhost:8000/storage/products/' + response.data.products.data[i].image;
                        } else {
                            response.data.products.data[i].image = 'http://localhost:8000/storage/defaultImg.jpg';
                        }
                    }
                    this.productList = response.data.products;
                    loader.hide();
                })
                .catch((error) => {
                    console.log(error);
                    loader.hide();
                });
        },

        // search with postname
        searchProduct(){
            let loader = this.$loading.show({
                width: 50,
                height: 50,
                color: 'green',
                loader: "dots"
            });
            let search = {
                Key : this.searchKey,
            }
            axios.post('http://localhost:8000/api/product/search',search)
            .then((response)=>{
                for (let i = 0; i < response.data.products.data.length; i++) {
                    if (response.data.products.data[i].image != null) {
                        response.data.products.data[i].image = 'http://localhost:8000/storage/products/' + response.data.products.data[i].image;
                    } else {
                        response.data.products.data[i].image = 'http://localhost:8000/storage/defaultImg.jpg';
                    }
                }
                this.productList = response.data.products;
                loader.hide();
            })
            .catch((error)=>{
                console.log(error);
                loader.hide();
            });
        },

        //search with category name
        searchByCate(searchKey){
            let search = {
                key : searchKey
            }
            let loader = this.$loading.show({
                width: 50,
                height: 50,
                color: 'green',
                loader: "dots"
            });
            axios.post('http://localhost:8000/api/category/search',search)
            .then((response)=>{
                for (let i = 0; i < response.data.categories.data.length; i++) {
                    if (response.data.categories.data[i].image != null) {
                        response.data.categories.data[i].image = 'http://localhost:8000/storage/products/' + response.data.categories.data[i].image;
                    } else {
                        response.data.categories.data[i].image = 'http://localhost:8000/storage/defaultImg.jpg';
                    }
                }
                this.productList = response.data.categories;
                loader.hide();
            })
            .catch((error)=>{
                console.log(error);
                loader.hide();
            });
        },

        //redirect to detail page
        godetails(id){
            this.$router.push({
                path : '/details',
                query : {
                    productId : id,
                }
            });
        },
        gocart(){
            this.$router.push({
                path : '/cart',
            });
        },
    },
    mounted() {
        this.getallCategory();
        this.getallProduct();
    }
});
