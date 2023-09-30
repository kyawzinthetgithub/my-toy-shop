import NavbarPage from "../components/Navbar.vue";
import FooterPage from "../components/Footer.vue";
import axios from "axios";

export default{
    name : 'ProductCart',
    data () {
        return {
            fullPage: false,
            delifeed : 3000,
            cartItems : [],
            visibleCart : 3,
            totalQty : 0,
            Tprice : 0
        }
    },
    components : {
        NavbarPage,FooterPage
    },
    computed: {
        showCartItems() {
            return this.cartItems.slice(0, this.visibleCart)
          },
        total(){
            for (let i = 0; i < this.cartItems.length; i++) {
                this.totalQty += this.cartItems[i].qty;
            }
            return this.totalQty;
        },
        totalPrice(){
            for (let i = 0; i < this.cartItems.length; i++) {
                this.Tprice += this.cartItems[i].price;
            }
            return this.Tprice + this.delifeed;
        },
    },
    methods: {
        loadMore() {
            if (this.visibleCart > this.cartItems.length) return;
            this.visibleCart = this.visibleCart + 3;
          },
        getCartItems () {
            let loader = this.$loading.show({
                width: 50,
                height: 50,
                color: 'green',
                loader: "dots"
            });
            let user = {
                userId : localStorage.getItem('userId')
            };
            axios.post('http://localhost:8000/api/get/cartItems',user)
            .then((response)=>{
                for(let i = 0; i < response.data.cartItems.length; i++){
                    response.data.cartItems[i].image = 'http://localhost:8000/storage/products/'+response.data.cartItems[i].image;
                }
                this.cartItems = response.data.cartItems;
                loader.hide();
            })
            .catch((error)=>{
                console.log(error);
                loader.hide();
            });
        },

        //remove single cart
        removeCart(id){
            let currentId = {
                cartId : id
            };
            axios.post('http://localhost:8000/api/remove/currentCart',currentId)
            .then((response)=>{
                if(response.data.status == 'success'){
                    this.getCartItems();
                }
            })
            .catch();
        },
        order(){
            let orderData = [];
            let orderCode =  'MTS' + Math.floor(Math.random()*1000001);
                for (let j = 0; j < this.cartItems.length; j++) {
                    orderData.push({
                        userId : this.cartItems[j].user_id,
                        productId : this.cartItems[j].product_id,
                        qty : this.cartItems[j].qty,
                        total : this.cartItems[j].price,
                        orderCode : orderCode,
                    });
                }
                
            axios.post('http://localhost:8000/api/create/order',orderData)
            .then((response)=>{
                if(response.data.status == 'success'){
                    location.reload();
                }
            })
            .catch((error)=>console.log(error));
            this.$router.push({
                path : '/home',
            });
        },
    },
    mounted () {
        this.getCartItems();
    }
}