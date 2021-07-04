<template>
    <div class="couple-product">
    <h2>Bộ đôi hoàn hảo</h2>
    <div class="flexslider-2">
      <ul class="slides list-product">
        <li v-for="couple in couples" v-bind:key="couple.id">
          <ul class="list-product index-slide index-coupon-slide" :data-id="couple.id">
            <li style="float: left; margin: 0px auto">
              <a :href="'product/detail/' + couple.product1.id">
                <p class="label">
                  <span class="off" v-if="couple.product1.sale.length > 0">
                    {{couple.product1.sale[0].name}}
                  </span>
                  <span class="off" v-else-if="couple.product1.tag_sale">
                    {{couple.product1.tag_sale}}
                  </span>
                  <span class="best" v-if="couple.product1.tag_best == 1">Best seller</span>
                  <span class="best" v-if="couple.product1.tag_recommend == 1">Nên mua</span>
                </p>
                <img :src="couple.product1_image" />
                <p class="subcats">{{ couple.product1.category.name }}</p>
                <h3>{{ couple.product1.name }}</h3>
                <p class="price">
                  <span class="sale-price">{{ Number(couple.product1.discount_price).toLocaleString() }} VND</span>
                  <span class="old-price" v-if="couple.product1.price > couple.product1.discount_price">{{ Number(couple.product1.price).toLocaleString() }} VND</span>
                </p>
              </a>
            </li>
            <li style="float: right; margin: 0px auto">
              <a :href="'product/detail/' + couple.product2.id">
                <p class="label">
                  <span class="off" v-if="couple.product2.sale.length > 0">
                    {{couple.product2.sale[0].name}}
                  </span>
                  <span class="off" v-else-if="couple.product2.tag_sale">
                    {{couple.product2.tag_sale}}
                  </span>
                  <span class="best" v-if="couple.product2.tag_best == 1">Best seller</span>
                  <span class="best" v-if="couple.product2.tag_recommend == 1">Nên mua</span>
                </p>
                <img :src="couple.product2_image" />
                <p class="subcats">{{ couple.product2.category.name }}</p>
                <h3>{{ couple.product2.name }}</h3>
                <p class="price">
                  <span class="sale-price">{{ Number(couple.product2.discount_price).toLocaleString() }} VND</span>
                  <span class="old-price" v-if="couple.product2.price > couple.product2.discount_price">{{ Number(couple.product2.price).toLocaleString() }} VND</span>
                </p>
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </div>
    <div class="button">
      <a class="common-button" href="javascript:;" onclick="addCouple()">MUA NGAY</a>
    </div>
  </div>
</template>

<script>
export default {
  data: function () {
    return {
      couples: [],
    };
  },
  mounted() {
    this.loadCoupleProduct();
  },
  methods: {
    loadCoupleProduct: function () {
      axios
        .get("/component/listCoupleProduct")
        .then((response) => {
          this.couples = response.data;
        })
        .catch(function (error) {
          console.log(error);
        });
    },
  },
};
</script>
