<template>
    <div>
        {{item}}
        <!--<div class="product-img" >
            <img :src="'images/head_img/'+cartItem['product'].head_image" class="shop-cart-img" alt="" style="width: 60px;height: 60px">
        </div>
        <div class="product-body">
            <h3 class="product-name" ><a href="#" class="text-wrap product-name-alink" >cartItem['product'].name</a></h3>
            <h4 class="product-price"><span class="qty">cartItem['productsQuantity']x</span>cartItem['product'].newprice</h4>
        </div>-->
    </div>

</template>

<script>
    export default {
        name: "Cart",
        props:['item'],

    }
</script>

<style scoped>

</style>