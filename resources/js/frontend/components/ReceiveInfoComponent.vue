<template>
  <div class="newletter">
    <h2>Đăng ký nhận thông tin</h2>
    <p>
      Đăng ký tài khoản ngay bây giờ để là người đầu tiên biết về ưu đãi, sản
      phẩm độc quyền, cập nhật, tin tức và thông báo thú vị về MIRI nhé.
    </p>
    <span v-if="errors.length" style="">
    <ul style="margin-bottom: 10px">
      <li v-for="error in errors">{{ error }}</li>
    </ul>
    </span>
    <input type="email" v-model="email" name placeholder="E-mail của bạn" />
    <input
      type="submit"
      v-on:click="SendEmail(email)"
      class="common-button"
      value="GỬI E-MAIL"
      :disabled="email_active == 1"
    />
  </div>
</template>

<script>
export default {
  data: function () {
    return {
      errors: [],
      email: "",
      email_active: 0,
    };
  },
  methods: {
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
  },
};
</script>