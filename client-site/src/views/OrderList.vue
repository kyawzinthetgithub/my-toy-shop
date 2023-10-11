<template>
  <NavbarPage />
  <div class="container" style="min-height: 50vh">
    <h3 class="py-5">Order List</h3>
    <div class="row">
      <div class="col-10 table-responsive">
        <table
          class="table table-hover text-center my-5"
          v-if="OrderDatas.length"
        >
          <thead>
            <tr>
              <th>Data</th>
              <th>Order Code</th>
              <th>Total Price</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(orders, index) in OrderDatas" :key="index">
              <td class="align-middle">{{ orders.created_at }}</td>
              <td
                class="align-middle text-primary"
                @click="getlists(orders.order_code)"
              >
                {{ orders.order_code }}
              </td>
              <td class="align-middle">
                {{ orders.total_price }} <span>MMK</span>
              </td>
              <td class="align-middle">
                <span v-if="orders.status == 0" class="text-warning fw-bold"
                  >Pending <i class="fa-solid fa-circle-exclamation"></i></span
                >
                <span v-if="orders.status == 1" class="text-success fw-bold"
                  >Success <i class="fa-solid fa-check"></i></span
                >
                <span v-if="orders.status == 2" class="text-danger fw-bold"
                  >Reject <i class="fa-solid fa-xmark"></i></span
                >
              </td>
            </tr>
          </tbody>
        </table>
        <div class="d-flex justify-content-center align-items-center" style="height-50vh;" v-else>
            <h3 class="text-danger">There is no order...</h3>
        </div>
      </div>
    </div>
  </div>
  <FooterPage />
</template>

<script src="../js/OrderList.js"></script>
