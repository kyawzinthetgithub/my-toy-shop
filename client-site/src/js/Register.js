import  axios  from "axios";
import { mapGetters } from "vuex";
export default {
    name: "RegisterView",
    data() {
      return {
        userData : {
            name : '',
            email : '',
            address : '',
            phone : '',
            gender : '',
            password : '',
            password_confirmation : ''
        },
        errors : {},
        message : '',
      };
    },
    computed: {
       ...mapGetters(['storeUserToken','storeUserData'])
    },
    methods: {
      gologin() {
        this.$router.push({
          name: "Login",
        });
      },
      userRegister(){
        axios.post("http://localhost:8000/api/user/register",this.userData).then((response)=>{
          if(response.data.token == null){
            this.message = 'Registation Failed ! Please Try again.';
           }else{
            this.storeuserInfo(response);
            this.$router.push({
                name : 'home'
            });
           }
          
        }).catch((error)=>{
          this.message = 'Registation Failed ! Please Try again.';
          this.errors = error.response.data.errors;
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