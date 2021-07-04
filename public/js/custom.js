$(document).ready(function () {
    loadCart();
})

function addEventListenerForCityOption(c, page) {
    c.addEventListener("click", function (e) {
        addEventListenerForOption(this);
        getDataForDistrict(page);
    });
}

function addEventListenerForDistrictOption(c, page) {
    c.addEventListener("click", function (e) {
        addEventListenerForOption(this);
        getDataForWard(page);
    });
}

function addEventListenerForOption(c) {
    var y, i, k, s, h, sl, yl;
    // get the select
    s = c.parentNode.parentNode.getElementsByTagName("select")[0];
    sl = s.length;
    h = c.parentNode.previousSibling;
    for (i = 0; i < sl; i++) {
        // neu trung data thi cung select option nay
        if (s.options[i].innerHTML == c.innerHTML) {
            s.selectedIndex = i;
            h.innerHTML = c.innerHTML;
            y = c.parentNode.getElementsByClassName("same-as-selected");
            yl = y.length;
            for (k = 0; k < yl; k++) {
                y[k].removeAttribute("class");
            }
            c.setAttribute("class", "same-as-selected");
            break;
        }
    }
    h.click();

}

function getDataForCity(page) {
    $.ajax({
        type: 'get',
        url: '/getCity',
        success: function (response) {
            var html = '';
            response.forEach(data => {
                html += '<option value="' + data.id + '">' + data.name + '</option>'
                c = document.createElement("p");
                c.innerHTML = data.name;
                addEventListenerForCityOption(c, page);
                $('select[id="' + page + '_city_id"]').next().next().append(c);
            });
            $('select[id="' + page + '_city_id"]').append(html);
        }
    });
}

function getDataForDistrict(page) {
    $.ajax({
        type: 'get',
        url: '/getDistrict',
        data: "city_id=" + this.value,
        success: function (response) {
            var html = '';
            response.forEach(data => {
                html += '<option value="' + data.id + '">' + data.name + '</option>';
                c = document.createElement("p");
                c.innerHTML = data.name;
                addEventListenerForDistrictOption(c, page);
                $('select[id="' + page + '_district_id"]').next().next().append(c);
            });
            $('select[id="' + page + '_district_id"]').append(html);
        }
    });
}

function getDataForWard(page) {
    $.ajax({
        type: 'get',
        url: '/getWard',
        data: "district_id=" + this.value,
        success: function (response) {
            var html = '';
            response.forEach(data => {
                html += '<option value="' + data.id + '">' + data.name + '</option>';
                c = document.createElement("p");
                c.innerHTML = data.name;
                c.addEventListener("click", function (e) {
                    addEventListenerForOption(this);
                });
                $('select[id="' + page + '_ward_id"]').next().next().append(c);
            });
            $('select[id="' + page + '_ward_id"]').append(html);
        }
    });
}



function addItem() {
    var values = {};
    var $inputs = $('.addItemForm :input');

    $inputs.each(function () {
        values[this.name] = $(this).val();
    });
    console.log(values);
    showReloadIcon();
    $.ajax({
        type: 'post',
        url: '/cart/addItem?',
        data: values,
        success: function (response) {
            loadCart();
            showCartModel();
        }
    });
}

function loadCart() {
    console.log('load');
    function onCartAjax() {
        return $.ajax({
            type: 'get',
            url: '/cart/getOnCart',
            success: function (response) {
                $('#on-cart').html(response);
            }
        });
    }

    function pageCartAjax() {
        $.ajax({
            type: 'get',
            url: '/cart/getPageCart',
            success: function (response) {
                $('.cart-page-detail').html(response);
                moveDiv();
            }
        });
    }

    function cartQuantityAjax() {
        $.ajax({
            type: 'get',
            url: '/component/getCartQuantity',
            success: function (response) {
                $('.cart').text(response);
                if (response > 0) {
                    $('.cart').addClass('active');
                } else {
                    $('.cart').remove('active');
                }
            }
        });
    }

    $.when(onCartAjax(), pageCartAjax(), cartQuantityAjax()).done(function (a1, a2, a3) {
        hideReloadIcon();
    });
}

function moveDiv() {
    if ($(window).width() < 600) {
        $('.brand-story-right').appendTo('.brand-story-img');
        $(".get-double-img").insertBefore(".get-double-content > button");
        $(".order-overview").insertBefore(".delivery-info");
        $(".payment-method .common-button").insertBefore(".payment-method .back-to-buy");
        $(".story-2-img").insertBefore(".story-2-content");
        $(".mission-img").insertAfter(".mission-content h1");

        $('.header-order-overview h2').click(function () {
            $(this).toggleClass('up-arrow');
            $('.body-order-overview, .footer-order-overview').slideToggle(250);
        })

    } else {
        $('.brand-story-right').appendTo('.brand-story-right-mobile');
    }
}
function addEventOnCart() {
    $('.cart-more').click(function () {
        handleCart($(this).data('id'), 'up');
    });

    $('.cart-less').click(function () {
        handleCart($(this).data('id'), 'down');
    });

    $('input.cart-qty').focusout(function () {
        if ($(this).val() == '') $(this).val(0);
        handleCart($(this).data('id'), 'change', $(this).val());
    })

    $('.delete').click(function () {
        handleCart($(this).data('id'), 'delete');
    })
}

function handleCart($id, $operation, $quantity = null) {
    showReloadIcon();
    $.ajax({
        type: 'get',
        url: '/cart/handleCart?item_id=' + $id + '&operation=' + $operation + '&quantity=' + $quantity,
        success: function (response) {
            loadCart();
        }
    });

    return false;
}

function showReloadIcon() {
    $('.model-reload-page').show();
}

function hideReloadIcon() {
    $('.model-reload-page').hide();
}

function addCouple() {
    showReloadIcon();
    var index = $('.couple-product .flex-active').text();
    var id = $('.index-coupon-slide').eq(index - 1).data('id');
    $.ajax({
        type: 'get',
        url: '/cart/addCoupleProduct?' +
            'couple_id=' + id,
        success: function (response) {
            loadCart();
            showCartModel();
        }
    });
}

function addGiftSet(id, discount_price) {
    showReloadIcon();
    $.ajax({
        type: 'get',
        url: '/cart/addGiftSet?' +
            'product_id=' + id +
            '&discount_price=' + discount_price,
        success: function (response) {
            loadCart();
            showCartModel();
        }
    });
}

function addDiscount(text) {
    showReloadIcon();
    $.ajax({
        type: 'get',
        url: '/cart/addDiscount?' +
            'code=' + text,
        success: function (response) {
            loadCart();
            if (response == false) {
                var waitForDiscountLoad = setInterval(function () {
                    if ($('input[name="coupon"]').val() == '') {
                        $('button[name="coupon-submit"]').after('<p style="color:red; padding-top:15px;height:35px">Mã khuyến mãi không tồn tại hoặc đã hết hạn</p>');
                        clearInterval(waitForDiscountLoad);
                    }
                }, 100);
            }
        }
    });
}

function showCartModel() {
    $('.cart').click();
}