import NavbarPage from "../components/Navbar.vue";
import FooterPage from "../components/Footer.vue";
import axios from "axios";
export default {
    name : 'CustomerContact',
    data () {
        return {
            userInfo: {
                userId : localStorage.getItem('userId'),
                message : '',
                name : '',
                email : '',
            },
            validateError: {},
        }
    },
    components : {
        NavbarPage,FooterPage
    },
    methods: {
        sentMessage () {
            axios.post('http://localhost:8000/api/customer/contact',this.userInfo)
            .then((response)=>{
                console.log(response.data.status);
                if(response.data.status == 'success'){
                    this.$router.push({
                        path:'/home'
                    });
                }
            })
            .catch((error)=>{
                this.validateError = error.response.data.errors;
            });
        }
    }
}