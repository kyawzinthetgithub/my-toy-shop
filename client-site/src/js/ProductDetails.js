import NavbarPage from "../components/Navbar.vue";
import FooterPage from "../components/Footer.vue";
import axios from "axios";
import { mapGetters } from "vuex";
import StarRating from 'vue-star-rating';

export default {
    name : 'ProductDetails',
    data () {
        return {
           fullPage: false,
           productId : 0,
           qty : 1,
           product:{},
           userId : localStorage.getItem('userId'),
           rating : 0,
           avrating : 0,
        }
    },
    components: {
        NavbarPage,FooterPage,StarRating,
    },
    computed: {
        ...mapGetters (['storeUserToken','storeUserData'])
    },
    methods: {

        setRating(rating){
            let ratevalue = {
                userId : localStorage.getItem('userId'),
                productId : this.productId,
                ratingVal : rating,
            };
            axios.post('http://localhost:8000/api/rating/product',ratevalue)
            .then((response)=>{
                if (response.data.status == 'success') {
                    this.rating= rating;
                    location.reload();
                }
            })
            .catch((error)=>console.log(error));
          },
          getRating(){
            let getdata = {
                userId : localStorage.getItem('userId'),
                productId : this.productId,
            };
            axios.post('http://localhost:8000/api/get/ratings',getdata)
            .then((response)=>{
                this.rating = response.data.ratings.rating_count;
            })
            .catch((error)=>console.log(error));
          },
          //average rating
          AverageRate(){
            let getAverage = {
                productId : this.productId,
            };
            axios.post('http://localhost:8000/api/average/ratings',getAverage)
            .then((response)=>{
                if (response.data.average == null || response.data.average == undefined || response.data.average == '') {
                    this.avrating = 0;
                }else{
                    this.avrating = parseFloat(response.data.average).toFixed(2);
                }
            })
            .catch((error)=>console.log(error));
          },

        incProduct () {
           this.qty++;
           if(this.qty > 10){
            this.qty = 1;
           }
        },
        decProduct (){
            this.qty--;
           if(this.qty == 0){
            this.qty = 10;
           }
        },
        loadproduct(id){
            let loader = this.$loading.show({
                width: 50,
                height: 50,
                color: 'green',
                loader: "dots"
            });
            let product = {
                productId : id
            };
            axios.post('http://localhost:8000/api/product/details',product)
            .then((response)=>{
                if(response.data.product.image != null){
                    response.data.product.image = 'http://localhost:8000/storage/products/' + response.data.product.image;
                }else{
                    response.data.product.image = 'http://localhost:8000/storage/defaultImg.jpg';
                }
                this.product = response.data.product;
                this.totalPrice = this.product.product_price;
                loader.hide();
            })
            .catch((error)=>{
                console.log(error);
                loader.hide();
            });
        },
        addcart(){
            let addProduct =  {
                user : this.userId,
                productId : this.product.id,
                productCat : this.product.category_id,
                qty : this.qty,
                price : this.product.product_price * this.qty,
                image : this.product.image.split('/').slice(-1)[0],
            }
            axios.post('http://localhost:8000/api/add/cart',addProduct)
            .then((response)=>{
                if(response.data.status == 'success'){
                    this.$router.push({
                        name : 'home'
                    });
                }
            })
            .catch((error)=>console.log(error));
        },
    },
    mounted () {
        this.productId = this.$route.query.productId;
        this.loadproduct(this.productId);
        this.getRating();
        this.AverageRate();
    }
}