<template>
  <div>
    <NavbarPage />
    <div class="container my-5">
      <div class="row py-3">
        <h5 class="text-muted fs-3">Product Details</h5>
        <div class="col-md-5 p-5 mb-5">
          <div class="card">
            <img
              :src="product.image"
              alt=""
              class="img-thumbnail"
              style="max-height: 450px"
            />
          </div>
        </div>
        <div class="col-md-7 p-5">
          <div class="ps-lg-3">
            <h4 class="title text-dark text-uppercase">
              {{ product.product_name }}
            </h4>

            <!-- rating start -->
              
              <div v-if="(rating <= 0)">
                <star-rating :show-rating="false" @update:rating ="setRating"></star-rating>
              <div style="margin-top:10px;font-weight:bold;">Rate this product : {{rating}} / 5</div>
              </div>
              <div v-else-if="rating">
                <star-rating :show-rating="false" :read-only="true" :rating="rating"></star-rating>
              <div style="margin-top:10px;font-weight:bold;">You selected : {{rating}} / 5</div>
              </div>

            <!-- rating end -->

            <div>
              <span>Average Rating : <span>{{avrating}} / 5</span></span>
            </div>

            <div class="my-3">
              <span class="h5"
                >{{ product.product_price }} <span>MMK</span></span
              >
            </div>

            <p>{{ product.product_detail }}</p>

            <div class="row">
              <dt class="col-3">Category</dt>
              <dd class="col-9 text-capitalize">{{ product.category_name }}</dd>

              <dt class="col-3">Size</dt>
              <dd class="col-9">{{ product.size }}</dd>

              <dt class="col-3">Material</dt>
              <dd class="col-9 text-capitalize">{{ product.made_by }}</dd>

              <dt class="col-3">Country</dt>
              <dd class="col-9">{{ product.made_country }}</dd>

              <dt class="col-3">Total Price</dt>
              <dd class="col-9">{{ product.product_price * qty }}</dd>
            </div>

            <hr />

            <div
              class="row mb-4 d-flex justify-content-center align-items-center"
            >
              <div class="col-md-4 col-6 mb-3">
                <label class="mb-2 d-block">Quantity</label>
                <div class="input-group mb-3" style="width: 170px">
                  <button
                    class="btn btn-white border border-secondary px-3"
                    type="button"
                    id="button-addon1"
                    data-mdb-ripple-color="dark"
                    @click="decProduct()"
                  >
                    <i class="fas fa-minus"></i>
                  </button>
                  <input
                    type="text"
                    class="form-control text-center border border-secondary"
                    placeholder="14"
                    aria-label="Example text with button addon"
                    aria-describedby="button-addon1"
                    readonly
                    v-model="qty"
                  />
                  <button
                    class="btn btn-white border border-secondary px-3"
                    type="button"
                    id="button-addon2"
                    data-mdb-ripple-color="dark"
                    @click="incProduct()"
                  >
                    <i class="fas fa-plus"></i>
                  </button>
                </div>
              </div>
              <div class="col-md-8">
                <button
                  type="button"
                  class="btn btn-primary shadow-0 w-100"
                  @click="addcart()"
                >
                  Add to cart
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <FooterPage />
  </div>
</template>

<script src="../js/ProductDetails.js"></script>

<style lang="stylus" scoped></style>
