<template>
    <NavbarPage></NavbarPage>
    <div class="container py-5">
            <h3 class="text-muted text-center" style="margin-bottom:50px;text-shadow:0 0 3px rgba(0,0,0,0.5)">Ordered Items</h3>
        <div class="row">
            <div class="col-12 table-responsive">
                <table class="table table-dark table-hover text-center">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Product Name</th>
                    <th>Order Code</th>
                    <th>Product Price</th>
                    <th>Qty</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(Orders,idx) in allOrderLists" :key="idx">
                    <td class="align-middle">
                        <img :src="Orders.image" alt="" width="50">
                    </td>
                    <td class="align-middle">{{Orders.product_name}}</td>
                    <td class="align-middle">{{Orders.order_code}}</td>
                    <td class="align-middle">{{Orders.product_price}}</td>
                    <td class="align-middle">{{Orders.qty}}</td>
                    <td class="align-middle">{{Orders.total}}</td>
                </tr>
            </tbody>
        </table>
            </div>
        </div>
    </div>
    <FooterPage></FooterPage>
</template>

<script src="../js/CheckOrderList.js"></script>