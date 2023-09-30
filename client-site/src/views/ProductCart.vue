<template>
  <div>
    <NavbarPage />
    <div class="container py-5">
      <h3 class="text-center text-muted">Cart Details</h3>
      <div class="row">
        <div class="col-lg-8 my-3">
            
            <table class="table table-hover" v-if="showCartItems.length">
              <thead>
                <th>Product Name &amp; Details</th>
                <th>Qty</th>
                <th>Price</th>
                <th></th>
              </thead>
              <tbody>
                <tr v-for="(cart, index) in showCartItems" :key="index">
                  <td class="text-capitalize align-middle">
                        <div class="d-flex">
                            <div class="">
                                <img :src="cart.image" style="width:100px;height:100px;" class="img-thumbnail">
                            </div>
                            <div class="my-auto ms-5">
                                <h5>{{cart.product_name}}</h5>
                                <small>
                                    <span class="mx-2">Size : {{cart.size}}</span>
                                    <span class="mx-2">Metarial : {{cart.made_by}}</span>
                                    <span class="mx-2">Country : {{cart.made_country}}</span>
                                </small>
                            </div>
                        </div>
                    </td>
                  <td class="align-middle">{{cart.qty}}</td>
                  <td class="align-middle">{{cart.price}} <span>MMK</span></td>
                  <td class="align-middle">
                    <button type="button" class="btn btn-danger" @click="removeCart(cart.id)">
                      <i class="fa-solid fa-xmark"></i>
                    </button>
                  </td>
                </tr>
                <tr>
                    <td colspan="4" class="text-center">
                        <button class="btn btn-sm btn-info text-muted" v-if="visibleCart < cartItems.length" @click="loadMore()">Load More...</button>
                    </td>
                </tr>
              </tbody>
            </table>
            <div class="" v-else>
              <h3 class="text-center text-warning mt-5">There is no product in the cart...</h3>
            </div>
        </div>
        <div class="col-lg-4 my-3">
          <div class="card mb-3" style="max-width: 540px">
            <div class="row g-0">
              <div class="col">
                <div class="card-body">
                  <h5 class="card-title">Sammary</h5>
                  <div class="card">
                    <div class="card-body">
                      <div class="row">
                        <dt class="col-6">Total Qty</dt>
                        <dd class="col-6 text-capitalize">{{total}}</dd>
                        <dt class="col-6">Shipping Feed</dt>
                        <dd class="col-6 text-capitalize">{{delifeed}} <span> MMK</span></dd>
                        <dt class="col-6">Total Price</dt>
                        <dd class="col-6 text-capitalize">{{totalPrice}}<span> MMK</span></dd>
                        <dt class="col-6">Arrivial Time</dt>
                        <dd class="col-6 text-capitalize"><small>During 3 Days - 7 Days.</small></dd>
                      </div>
                      <hr />
                      <div class="d-flex justify-content-around">
                        <router-link to="/home" type="button" class="btn btn-primary">Back to home</router-link>
                        <button type="button" class="btn btn-success" @click="order()" v-if="(cartItems.length != 0)"><i class="fa-solid fa-cash-register me-2"></i>Order</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <FooterPage />
  </div>
</template>
<script src="../js/Cart.js"></script>
