<template>
  <div>
    <NavbarPage />
    <!-- start category -->
    <section class="p-5 categorysections">
      <div class="container">
        <div class="row">
          <div class="col-lg-3 col-sm-12 my-2">
            <div class="categoryMenus">
              <div class="menubtns">
                <span class="menutexts">Product Category</span
                ><i class="fa-solid fa-sort-down"></i>
              </div>
              <ul class="list-group rounded">
                <li
                  class="list-group-item btn btn-outline-dark"
                  @click="searchByCate('')"
                >
                  All
                </li>
                <li
                  class="list-group-item btn btn-outline-dark"
                  v-for="(category, index) in showCategory"
                  :key="index"
                  @click="searchByCate(category.category_name)"
                >
                  {{ category.category_name }}
                </li>
                 <button class="btn btn-sm btn-info text-muted" @click="loadMore" v-if="visibleCate < categoryList.length">Load More...</button>
              </ul>
            </div>
          </div>
          <div class="col-lg-9 col-sm-12 my-2">
            <div class="row">
              <div class="row my-2">
                <div class="col-lg-4 offset-lg-8">
                  <form @submit.prevent>
                    <div class="input-group mb-3">
                      <input
                        type="text"
                        name=""
                        id=""
                        class="form-control"
                        placeholder="Search..."
                        v-model="searchKey"
                        @keypress.enter="searchProduct()"
                      />
                      <button
                        class="btn btn-secondary"
                        type="button"
                        @click="searchProduct()"
                      >
                        <i class="fa-solid fa-magnifying-glass"></i>
                      </button>
                    </div>
                  </form>
                </div>
              </div>
              <h3
                class="text-center text-danger mt-5"
                v-if="productList.data == 0"
              >
                There is no product...
              </h3>
              <div
                class="col-md-4 col-sm-12 mb-2"
                v-for="(product, index) in productList.data"
                :key="index"
                v-else-if="productList.data != 0"
              >
                <div class="card rounded hovercards">
                  <img
                    :src="product.image"
                    class="card-img-top img-thumbnail"
                    style="height: 260px"
                  />
                  <div class="card-body">
                    <h5>{{ product.product_name }}</h5>
                    <p>{{product.product_detail}}</p>
                    <div class="hoveritems">
                      <button type="button" class="hoverbtns" @click="gocart()">
                        <i class="fa-solid fa-cart-shopping"></i>
                      </button>
                      <button type="button" class="hoverbtns" @click="godetails(product.id)">
                        <i class="fa-solid fa-circle-info"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="d-flex justify-content-end mt-5">
              <paginate
              :page-count='productList.last_page'
              :page-range="2"
              :click-handler="getallProduct"
              :prev-text="'Prev'"
              :next-text="'Next'"
              :container-class="'pagination'"
              :page-class="'page-item'"
            >
            </paginate>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- end category -->
    <FooterPage />
  </div>
</template>
<script src="../js/HomePage.js"></script>
