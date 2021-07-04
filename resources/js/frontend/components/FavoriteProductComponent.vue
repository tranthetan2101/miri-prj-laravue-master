<template>
  <div class="favorite-product">
    <h1>Sản phẩm yêu thích</h1>
    <div class="flexslider-1">
      <ul class="slides list-product">
        <li v-for="product in products" v-bind:key="product.id">
          <a :href="'product/detail/' + product.id">
            <p class="label">
              <span class="off" v-if="product.sale.length > 0">
                {{product.sale[0].name}}
              </span>
              <span class="off" v-else-if="product.tag_sale">
                {{product.tag_sale}}
              </span>
              <span class="best" v-if="product.tag_best == 1">Best seller</span>
              <span class="best" v-if="product.tag_recommend == 1">Nên mua</span>
            </p>
            <img v-if="product.images.length > 0" :src="product.images[0]['picture']" />
            <p class="subcats">{{ product.category.name }}</p>
            <h3>{{ product.name }}</h3>
            <p class="price">
              <span class="sale-price">{{ Number(product.discount_price).toLocaleString() }} VND</span>
              <span class="old-price" v-if="product.price > product.discount_price">{{ Number(product.price).toLocaleString() }} VND</span>
            </p>
            <div class="countdown">
              <count-down v-if="product.sale.length > 0" :date="product.sale[0].period_end_unix_ts"></count-down>
            </div>
          </a>
          <a class="common-button" :href="'product/detail/' + product.id" v-if="product.stock > 0 || product.stock_unlimited == 1">MUA NGAY</a>
          <a class="common-button sale-out" :href="'product/detail/' + product.id" v-else>HẾT HÀNG</a>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
export default {
  data: function () {
    return {
      products: [],
    };
  },
  mounted() {
    this.loadFavoriteProduct();
  },
  methods: {
    loadFavoriteProduct: function () {
      axios
        .get("component/favoriteProduct")
        .then((response) => {
          this.products = response.data;
        })
        .catch(function (error) {
          console.log(error);
        });
    },
  },
};
</script>
