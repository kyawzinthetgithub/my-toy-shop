import NavbarPage from "../components/Navbar.vue";
import FooterPage from "../components/Footer.vue";
import axios from "axios";
export default {
    name: 'CheckOrderList',
    data () {
        return {
            ListCode : this.$route.query.ListCode,
            allOrderLists : {},
        }
    },
    components : {
        NavbarPage,FooterPage
    },
    methods : {
        getAllList(OC){
            let lists = {
                ListCode : OC,
            };
            axios.post('http://localhost:8000/api/get/order/list',lists)
            .then((response)=>{
                for(let i=0; i < response.data.allLists.length; i++){
                    if(response.data.allLists[i].image != null){
                        response.data.allLists[i].image = 'http://localhost:8000/storage/products/'+ response.data.allLists[i].image;
                    }else{
                        response.data.allLists[i].image = 'http://localhost:8000/storage/defaultImg.jpg';
                    }
                }
                this.allOrderLists = response.data.allLists;
            })
            .catch((error)=>console.log(error));
        }
    },
    mounted () {
        this.getAllList(this.ListCode);
    },
}