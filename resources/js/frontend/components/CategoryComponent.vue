<template>
  <div class="cat-of-product">
    <h2>Các dòng sản phẩm</h2>
    <div class="cat-of-product-inner flexslider-1">
      <ul class="list-of-cats slides" >
        <li v-for="category in categories" v-bind:key="category.id">
          <a :href="'product/list/' + category.id">
            <img :src="category.picture" />
            <h3>{{category.name}}</h3>
            <p>{{category.product.length}} sản phẩm</p>
          </a>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
export default {
  data: function () {
    return {
      categories: [],
    };
  },
  mounted() {
    this.loadCategory();
  },
  methods: {
    loadCategory: function () {
      axios
        .get("/component/listCategory")
        .then((response) => {
          this.categories = response.data;
        })
        .catch(function (error) {
          console.log(error);
        });
    },
  },
};
</script>
