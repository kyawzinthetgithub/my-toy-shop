import { createRouter, createWebHistory, RouteRecordRaw } from 'vue-router'

const routes: Array<RouteRecordRaw> = [
  {
    path: '/',
    name: 'Login',
    component: ()=> import('../views/LoginView.vue')
  },
  {
    path: '/register',
    name:'Register',
    component:() => import ('../views/RegisterView.vue')
  },
  {
    path: '/home',
    name: 'home',
    component: () => import( '../views/HomeView.vue')
  },
  {
    path : '/details',
    name : 'details',
    component : () => import('../views/ProductDetails.vue')
  },
  {
    path : '/cart',
    name : 'cart',
    component : () => import('../views/ProductCart.vue')
  },
  {
    path : '/orderList',
    name : 'orderList',
    component : () => import('../views/OrderList.vue')
  },
  {
    path : '/checkOrder',
    name : 'checkOrder',
    component : () => import('../views/CheckOrderList.vue')
  },
  {
    path : '/contact',
    name : 'contact',
    component : () => import('../views/CustomerContact.vue')
  },
  {
    path : '/:pathMatch(.*)*',
    name : '404Page',
    component : () => import('../views/404Page.vue')
  },
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

router.beforeEach((to,from,next)=>{
  
  if(to.path === '/home'){
    const userToken =  localStorage.getItem('userToken');
  if(userToken == "" || userToken == null || userToken == undefined){
    next('/');
  }else{
    next();
  }
  }else{
    next();
  }  
});

export default router
