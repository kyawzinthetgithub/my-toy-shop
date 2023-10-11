<template>
  <div>
    <!-- Start Top Nav -->
    <section class="navsections mb-5">
      <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
          <a href="javascript:void(0)" class="navbar-brand">My Shop</a>
          <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#mynav"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="mynav">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
              <li class="nav-item mx-5">
                <router-link to="/home" class="nav-link text-light"
                  >Home</router-link
                >
              </li>
              <li class="nav-item mx-5">
                <router-link to="/contact" class="nav-link text-light"
                  >Contact</router-link
                >
              </li>
              <li class="nav-item mx-5">
                <router-link
                  to="/orderList"
                  class="nav-link text-light position-relative d-inline-block"
                  >Order<i class="fa-solid fa-clock-rotate-left ms-2"></i>
                </router-link>
              </li>
              <ul class="navbar-nav ms-5">
                <li class="nav-item">
                  <router-link
                    to="/cart"
                    class="nav-link text-light position-relative d-inline-block"
                  >
                    Cart<i class="fa-solid fa-cart-shopping ms-2"></i>
                    <span
                      v-if="cartItems.length != 0"
                      class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle"
                    >
                    </span>
                  </router-link>
                </li>
                <li class="nav-item">
                  <router-link
                    to="/"
                    class="nav-link text-light"
                    @click="userlogout()"
                  >
                    Logout
                  </router-link>
                </li>
              </ul>
            </ul>
          </div>
        </div>
      </nav>
    </section>
    <!-- Close Top Nav -->
  </div>
</template>

<script>
import axios from "axios";
import { mapGetters } from "vuex";
export default {
  name: "NavbarPage",
  data() {
    return {
      cartItems: {},
      OrderDatas: {},
    };
  },
  computed: {
    ...mapGetters(["storeUserToken", "storeUserData"]),
  },
  methods: {
    userlogout() {
      this.$store.dispatch("setToken", null);
      localStorage.clear();
      this.$router.push({
        path: "/",
      });
    },
    getCartItems() {
      let user = {
        userId: localStorage.getItem("userId"),
      };
      axios
        .post("http://localhost:8000/api/get/cartItems", user)
        .then((response) => {
          for (let i = 0; i < response.data.cartItems.length; i++) {
            response.data.cartItems[i].image =
              "http://localhost:8000/storage/products/" +
              response.data.cartItems[i].image;
          }
          this.cartItems = response.data.cartItems;
        })
        .catch((error) => {
          console.log(error);
        });
    },

    getOrderData() {
      let user = {
        userId: this.UserId,
      };
      axios
        .post("http://localhost:8000/api/get/order", user)
        .then((response) => {
          for (let i = 0; i < response.data.orders.length; i++) {
            response.data.orders[i].created_at = response.data.orders[i].created_at.slice(0, 10);
          }

          this.OrderDatas = response.data.orders;
        })
        .catch((error) => console.log(error.data));
    },
  },
  mounted() {
    this.getCartItems();
    this.getOrderData();
  },
};
</script>

<style>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

.navsections nav {
  background: #35352a;
}

.navbar .navbar-brand {
  color: #eee;
}

.navbar .navbar-toggler:focus,
.navbar .navbar-toggler:active {
  border: 0;
  box-shadow: none;
}

.nav-link{
  color: #8d8686 !important;
}

.nav-link.router-link-active{
  color: #d6d07a !important;
  transition: 0.5s ease-in;
}
</style>
