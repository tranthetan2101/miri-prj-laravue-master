<template>
  <div class="slideshow">
    <div class="slideshow_inner">
      <div id="owl-demo" class="owl-carousel owl-theme">
        <div class="item" v-for="banner in banners" v-bind:key="banner.id">
          <a :href="banner.url"><img class="slideshow-img" :src="banner.picture" alt /></a>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data: function () {
    return {
      banners: [],
    };
  },
  mounted() {
    this.loadBanner();
  },
  methods: {
    loadBanner: function () {
      axios
        .get("/component/banner")
        .then((response) => {
          this.banners = response.data;
        })
        .catch(function (error) {
          console.log(error);
        });
    },
  },
};
</script>