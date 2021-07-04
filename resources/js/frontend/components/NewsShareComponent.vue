<template>
<div class="blog">
		<h2>Góc chia sẻ</h2>
		<div class="blog-inner flexslider-3">
			<ul class="list-of-blog slides">
				<li v-for="blog in news" v-bind:key="blog.id">
          <a :href="'blog-miri/detail/' + blog.id">
            <img :src="blog.picture" />
            <h3>{{blog.name}}</h3>
            <p v-html="blog.description"></p>
            <button>Đọc tiếp</button>
          </a>
        </li>
			</ul>
		</div>
		<div class="button">
			<a class="common-button" href="/blog-miri">xem tất cả bài viết</a>
		</div>
	</div>
</template>

<script>
export default {
  data: function () {
    return {
      news: [],
    };
  },
  mounted() {
    this.loadNews();
  },
  methods: {
    loadNews: function () {
      axios
        .get("component/listNewsShare")
        .then((response) => {
          this.news = response.data;
        })
        .catch(function (error) {
          console.log(error);
        });
    },
  },
};
</script>
