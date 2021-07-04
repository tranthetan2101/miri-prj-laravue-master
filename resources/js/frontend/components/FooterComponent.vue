<template>
  <div class="footer">
    <div class="footer-inner">
      <div class="col miri">
        <h3>MIRI VIỆT NAM</h3>
        <ul>
          <!-- <li>
            <a href="/product/list/">sản phẩm</a>
          </li>
          <li>
            <a href="/promotion">khuyến mãi</a>
          </li>
          <li>
            <a href="/gift-set">combo</a>
          </li>
          <li>
            <a href="/quiz-miri">góc tư vấn</a>
          </li>
          <li>
            <a href="/blog-miri">chia sẻ kinh nghiệm</a>
          </li>
          <li>
            <a href="/about-miri">về miri</a>
          </li> -->
          <li>
            <a href="/story-miri">VỀ CHÚNG TÔI</a>
          </li>
          <li>
            <a href="/temsofagreement">ĐIỀU KHOẢN THỎA THUẬN</a>
          </li>
          <li>
            <a href="/privacypolocy">CHÍNH SÁCH BẢO MẬT</a>
          </li>
          <li>
            <a href="/delivery">CHÍNH SÁCH GIAO HÀNG</a>
          </li>
          <li>
            <a href="/returnpolicy">CHÍNH SÁCH ĐỔI TRẢ</a>
          </li>
          <li>
            <a href="/useacceptb">CHÍNH SÁCH SỬ DỤNG ĐƯỢC CHẤP THUẬN</a>
          </li>
          <li>
            <a href="/gncheck">hƯỚNG DẪN KIỂM TRA HÀNG CHÍNH HÃNG</a>
          </li>
        </ul>
      </div>
      <div class="col contact-miri">
        <h3>LIÊN HỆ VỚI MIRI</h3>
        <ul>
          <li>
            <a href="javascript:;" v-if="contact[0]"
              >E-mail: {{ contact[0].email }}</a
            >
          </li>
          <li>
            <a href="javascript:;" v-if="contact[0]"
              >Hotline: {{ contact[0].phone_number }}</a
            >
          </li>
          <li>
            <a href="javascript:;" v-if="contact[0]"
              >Địa chỉ: {{ contact[0].address }}</a
            >
          </li>
        </ul>
        <div
          class="img has-hover x md-x lg-x y md-y lg-y"
          id="image_548187164"
          style="height: auto; width: 60%"
        >
          <a
            class=""
            href="http://online.gov.vn/Home/WebDetails/64850"
            target="_blank"
            rel="noopener noreferrer"
          >
            <div class="img-inner dark">
              <img
                width="1405"
                height="533"
                src="http://online.gov.vn/Content/EndUser/LogoCCDVSaleNoti/logoSaleNoti.png"
                class="attachment-original size-original wp-post-image"
                alt="20150827110756 Dathongbao"
                srcset="http://online.gov.vn/Content/EndUser/LogoCCDVSaleNoti/logoSaleNoti.png   1405w,"

                sizes="(max-width: 1405px) 100vw, 1405px"
                style="height: auto; width: 100%"
              />
            </div>
          </a>
          <!--                 https://miri.com.vn/wp-content/uploads/2019/09/20150827110756-dathongbao-800x303.png   800w,
                  https://miri.com.vn/wp-content/uploads/2019/09/20150827110756-dathongbao-768x291.png   768w,
                  https://miri.com.vn/wp-content/uploads/2019/09/20150827110756-dathongbao-1400x531.png 1400w,
                  https://miri.com.vn/wp-content/uploads/2019/09/20150827110756-dathongbao-300x114.png   300w,
                  https://miri.com.vn/wp-content/uploads/2019/09/20150827110756-dathongbao-900x341.png   900w
            -->
        </div>
      </div>
      <div class="col miribt vxfm">
        <!-- <h3>THAM GIA VỚI CHÚNG TÔI</h3>
        <p>
          Đăng ký ngay bây giờ để là người đầu tiên biết về ưu đãi, sản phẩm độc
          quyền, cập nhật, tin tức và thông báo thú vị về MIRI nhé.
        </p>
        <form @submit.prevent="preventSubmit">
          <input type="email" v-model="email" placeholder="E-mail của bạn" />
          <input
            type="submit"
            v-on:click="SendEmail(email)"
            value="GỬI E-MAIL"
            :disabled="email_active == 1"
          />
        </form> -->
        <!-- <span v-if="errors.length" style="">
          <ul style="margin-top: 10px; color:white;">
            <li v-for="error in errors">{{ error }}</li>
          </ul>
        </span> -->

          <h3>CÔNG TY TNHH VẠN XUÂN FMCG INVESTMENT</h3>
          <p>
            Giấy chứng nhận đăng ký kinh doanh số 0314579042 cấp bởi Sở Kế hoạch
            & Đầu tư Tp. Hồ Chí Minh ngày 17/08/2017, đăng ký thay đổi lần thứ 3
            ngày 05/12/2018.
          </p>
      </div>
    </div>
    <div class="footer-inner footer-second">
      <div class="col">
        <a href="#" >
          <img class="logo-bottom-ft" src="/images/miri-white.svg" />
        </a>
      </div>
      <div class="col copyright">
        <ul>
          <li>@ 2020 Bản quyền thuộc về MIRI Việt Nam</li>
          <li>
            <a href="/terms">Điều khoản sử dụng</a>
          </li>
          <li>
            <a href="/privacy">Chính sách quyền riêng tư</a>
          </li>
        </ul>
      </div>
      <div class="col social">
        <ul>
          <li v-if="facebook">
            <a v-bind:href="facebook">
              <img src="/images/fb.svg" />
            </a>
          </li>
          <li v-if="youtube">
            <a v-bind:href="youtube">
              <img src="/images/you.svg" />
            </a>
          </li>
          <li v-if="instagram">
            <a v-bind:href="instagram">
              <img src="/images/insta.svg" />
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: ["facebook", "youtube", "instagram"],
  data: function () {
    return {
      errors: [],
      email: "",
      email_active: 0,
      contact: [],
    };
  },
  created() {
    this.loadContact();
  },
  methods: {
    loadContact: function () {
      axios
        .get("/component/contact")
        .then((response) => {
          this.contact = response.data;
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    SendEmail: function (email) {
      this.errors = [];
      if (this.checkEmail(email)) {
        axios
          .post("/component/receiveInfo", {
            email,
          })
          .then((response) => {
            console.log(response.data);
            this.email_active = 1;
            alert("Đăng ký mail thành công");
          })
          .catch(function (error) {
            console.log(error);
          });
      }
    },
    checkEmail: function (email) {
      if (!email) {
        this.errors.push("Xin hãy nhập email");
      } else if (!this.validEmail(email)) {
        this.errors.push("Email không đúng định dạng");
      }

      if (!this.errors.length) {
        return true;
      }

      return false;
    },
    validEmail: function (email) {
      var re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(email);
    },
    preventSubmit: function () {
      console.log("sendEmail");
    },
  },
};
</script>
