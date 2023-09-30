<template>
    <div>
        <!-- footer section -->

    <section class="py-5 footers">
      <div class="container border-bottoms">
        <div class="row">
          <div class="col-md-4 px-3">
            <h5>My Shop</h5>
            <ul>
              <li><i class="fa-solid fa-location-dot me-2"></i>No.123 , 0<sup>st</sup> , Yangon.</li>
              <li><a href="tel:09777777777"><i class="fa-solid fa-phone me-2"></i>09777777777</a></li>
              <li><a href="mailto:myshop@gmail.com"><i class="fa-solid fa-envelope me-2"></i>myshop@gmail.com</a></li>
            </ul>
          </div>

          <div class="col-md-4 px-3">
            <h5>Products</h5>
            <div class="card">
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3818.9647409620684!2d96.1523668108318!3d16.8281051839!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30c193dbc054b8b7%3A0x94d068f9508f755c!2z4YCZ4YC84YCU4YC64YCZ4YCs4YCV4YCc4YCs4YCH4YCs!5e0!3m2!1smy!2smm!4v1695339641262!5m2!1smy!2smm" width="100%" height="200" style="border:0;" allowfullscreen="false" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
          </div>

          <div class="col-md-4 px-3">
            <h5>Feature Info</h5>
            <ul>
              <li><router-link to="/home">Home</router-link></li>
              <li><router-link to="/contact">Contact</router-link></li>
              <li><router-link to="/orderList">Order</router-link></li>
              <li><router-link to="/cart">Cart</router-link></li>
            </ul>
          </div>
        </div>
      </div>
    </section>

   <div class="d-flex justify-content-center align-items-center copyrights">
    <p class="my-auto py-3">CopyRight &copy; <span>{{footerYear}}</span> by My Shop.</p>
   </div>

    <!-- end footer section -->
    </div>
</template>

<script>
export default {
    name: 'FooterPage',
    data() {
        return {
            footerYear: new Date().getFullYear(),
            categoryList: {},
        }
    },
}</script>