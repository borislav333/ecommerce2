<template>
    <div class="container mb-4">
      <!--  {{cart.items[88]['product'].name}}-->
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col"> </th>
                            <th scope="col">Product</th>
                            <th scope="col">Single price</th>
                            <th scope="col" class="text-center">Quantity</th>
                            <th scope="col" class="text-right">Price</th>
                            <th> </th>
                        </tr>
                        </thead>
                        <tbody>


                        <tr v-for="item in cart.items">
                            <td><img :src="'images/head_img/'+item['product'].head_image" height="50"/> </td>
                            <td>{{item['product'].name}}</td>
                            <td>$ {{item['product'].newprice}}</td>
                            <td><input class="form-control" min="1" :max="item['product']['quantity']" type="number"
                                       v-model.number="item['productsQuantity']" @input="changedQuantity(item)"/><span class=""></span></td>
                            <td class="text-right dqdq" ><b id="product">$ {{item['productsPrice']}}</b></td>
                            <td class="text-right"><button class="btn btn-sm btn-danger" :formaction="'/cartremove/'+item['product'].id"><i class="fa fa-trash"></i> </button> </td>
                        </tr>
                       <!-- <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Sub-Total</td>
                            <td class="text-right">255,90 €</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Shipping</td>
                            <td class="text-right">6,90 €</td>
                        </tr>-->
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><strong>Total</strong></td>
                            <td class="text-right"><strong id="totalPrice">$ {{totalPrice()}}</strong></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col mb-2">
                <div class="row">
                    <div class="col-sm-12  col-md-6">
                        <a class="btn btn-block btn-primary" href="/">Continue Shopping</a>
                    </div>
                    <div class="col-sm-12 col-md-6 text-right">
                        <button class="btn btn-lg btn-block btn-success text-uppercase">Checkout</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props:['cart'],
        computed:{

        },
        methods:{
            changedQuantity(item){

                item['productsPrice']=parseFloat(item['productsQuantity']*item['product'].newprice).toFixed(2);
            },
            totalPrice(){
                let totalPrice=0;
                for(let prod in this.cart.items){
                    totalPrice+=parseFloat(this.cart.items[prod]['productsPrice']);
                }
                return parseFloat(totalPrice).toFixed(2);
            }
        },
        mounted() {
        }
    }
</script>
