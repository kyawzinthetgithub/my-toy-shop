import NavbarPage from "../components/Navbar.vue";
import FooterPage from "../components/Footer.vue";
import axios from "axios";
export default {
    name : "orderList",
    data () {
        return {
            OrderDatas : {},
            UserId : localStorage.getItem('userId'),
        }
    },
    components: {
        NavbarPage,FooterPage
    },
    methods: {
        getOrderData () {
            let loader = this.$loading.show({
                width: 50,
                height: 50,
                color: 'green',
                loader: "dots"
            });
            let user = {
                userId : this.UserId
            };
            axios.post('http://localhost:8000/api/get/order',user)
            .then((response)=>{
                
                for (let i = 0; i < response.data.orders.length; i++) {
                    response.data.orders[i].created_at = response.data.orders[i].created_at.slice(0,10);
                }

                this.OrderDatas = response.data.orders;
                loader.hide();
            })
            .catch((error)=>console.log(error.data));
        },
        getlists(OC){

            this.$router.push({
                path : '/checkOrder',
                query : {
                    ListCode : OC,
                }
            });
        }
    },
    mounted () {
        this.getOrderData();
    },
}