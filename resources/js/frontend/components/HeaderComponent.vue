<template>
  <div class="header">
    <div class="header-top" v-if="announcement">
      <div class="header-top-inner">
        <p>{{ announcement }}</p>
        <a class="close-header-top">
          <img src="/images/close-header-top.svg" />
        </a>
      </div>
    </div>
    <div class="header-second">
      <div class="logo">
        <a href="/">
          <img src="/images/miri-logo.svg" alt="MIRI" />
        </a>
      </div>
      <div class="menu-container">
        <div class="menu">
          <ul>
            <li>
              <a class="product-mega" href="/product/list" id="menu_product">
                Sản phẩm
              </a>
                <span class="up-down-arrow"></span>
              <ul class="sub-menu">
                <div class="sub-menu-inner">
                  <div class="list-sub-cats">
                    <li class="accordion" v-for="categorie in categories" v-bind:key="categorie.id">
                      <a :href="'/product/list/' + categorie.id">
                        {{categorie.name}}
                      </a>
                        <span :key="categorie.id" class="up-down-arrow" @click="megaAccor"></span>
                      <ul class="sub-menu-level-2">
                        <li
                          v-for="product in categorie.product.slice(0, 3)"
                          v-bind:key="product.id"
                        >
                          <a :href="'/product/detail/' + product.id" :title="product.name">{{product.name}}</a>
                        </li>
                      </ul>
                    </li>
                  </div>
                  <div class="sub-banner">
                    <p>
                      <img src="/images/sub-banner.png" />
                    </p>
                  </div>
                </div>
              </ul>
            </li>
            <li>
              <a href="/promotion" id="menu_promo">Khuyến mãi</a>
            </li>
            <li>
              <a href="/gift-set" id="menu_gift">Combo</a>
            </li>
            <li>
              <a href="/quiz-miri" id="menu_quiz">Góc tư vấn</a>
            </li>
            <li>
              <a href="/blog-miri" id="menu_blog">GÓC CHIA SẺ</a>
            </li>
            <li>
              <a class="about-dropmenu" href="/story-miri" id="menu_about">
                VỀ MIRI
              </a><span class="up-down-arrow"></span>
              <ul class>
                <div class="sub-menu-inner" id="about-sub-menu">
                  <li>
                    <a href="/story-miri">Về chúng tôi</a>
                  </li>
                  <li>
                    <a href="/about-miri">Câu chuyện thương hiệu</a>
                  </li>
                  <li>
                    <a href="/process-miri">Quy trình và thành phần</a>
                  </li>
                </div>
              </ul>
            </li>
            <li>
              <a href="/contact-miri" id="menu_contact">LIÊN HỆ</a>
            </li>
              <li>
                  <a target="_blank" href="https://doitackinhdoanh.miri.com.vn">ĐỐI TÁC KINH DOANH</a>
              </li>
          </ul>
        </div>
      </div>
      <!--End menu-container-->

      <div class="icon-group">
        <div class="search">
          <button id="toggle-search"></button>
          <form id="search-form" action='/search'>
            <fieldset>
              <input
                name="search-terms"
                type="search"
                placeholder="Tìm kiếm (ví dụ: kem chống nắng)"
              />
              <span class="form-control-clear form-control-feedback hidden"></span>
            </fieldset>
          </form>
        </div>
        <div class="cart-group">
          <ul>
            <li>
              <a class="user-avatar" href="/mypage/"></a>
            </li>
            <li>
              <a class="cart" href="#on-cart" rel="modal:open">{{quantity}}</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: ['announcement'],
  data: function () {
    return {
      categories: [],
      quantity: 0,
    };
  },
  created() {
    this.loadCategories();
    // this.megaAccor();
  },
  methods: {
    loadCategories: function () {
      axios
        .get("/component/listCategory")
        .then((response) => {
          this.categories = response.data;
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    megaAccor: function(event) {
        console.log($(window).width());
        console.info('megaAccor');
          if ($(window).width() < 600) {
              // Store variables
              var $this = $(event.target),
                  accordion_head = $('.accordion > span'),
                  accordion_body = $('.accordion > .sub-menu-level-2');
              if ($this.attr('class') != 'active-accordion') {
                  accordion_body.slideUp('normal');
                  $this.next().stop(true, true).slideToggle('normal');
                  accordion_head.removeClass('active-accordion');
                  $this.addClass('active-accordion');
              }
          }
      }
  },
};
</script>
