import axios from "axios";
import { mapGetters } from "vuex";
export default {
    name:'LoginView',
    data(){
        return{
            userData : {
                email : '',
                password : ''
            },
            message : '',
            tokenStatus : false
        }
    },
    computed: {
       ...mapGetters(['storeUserToken','storeUserData'])
    },
    methods: {
        goregister () {
            this.$router.push({
                name:'Register',
            });
        },

        accountLogin(){
            axios.post('http://localhost:8000/api/user/login',this.userData).then((response)=>{
               if(response.data.token == null){
                this.message = 'Wrong Email or Password Try again.';
               }else{
                this.storeuserInfo(response);
                this.$router.push({
                    name : 'home'
                });
               }
            }).catch((error)=>{
                console.log(error);
            });
        },

        storeuserInfo(response){
            this.$store.dispatch('setToken',response.data.token);
            localStorage.setItem('userToken',JSON.stringify(response.data.token));
            localStorage.setItem('userId',JSON.stringify(response.data.user.id));
            this.$store.dispatch('setUserData',response.data.user);
        },
    },
}