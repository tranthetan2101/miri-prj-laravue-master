$(document).ready(function () {

  /////////////////////////////////
  ////////////////Favorite carousel
  /////////////////////////////////
  (function () {

    // store the slider in a local variable
    var $window = $(window),
      flexslider = { vars: {} };

    // tiny helper function to add breakpoints
    function getGridSize() {
      return (window.innerWidth < 600) ? 2 :
        (window.innerWidth < 900) ? 3 : 4;
    }


    $window.load(function () {
      console.log('load flexslider');
        setInterval(function () {
            $('.flexslider-1').flexslider({
                animation: "slide",
                animationLoop: false,
                itemWidth: 275,
                itemMargin: 19,
                minItems: getGridSize(), // use function to pull in initial value
                maxItems: getGridSize() // use function to pull in initial value
            });
        }, 500);

    });


    // check grid size on resize event
    $window.resize(function () {
      var gridSize = getGridSize();

      flexslider.vars.minItems = gridSize;
      flexslider.vars.maxItems = gridSize;
    });
  }());

  (function () {

    // store the slider in a local variable
    var $window = $(window),
      flexslider = { vars: {} };

    // tiny helper function to add breakpoints
    function getGridSize() {
      return (window.innerWidth < 600) ? 2 :
        (window.innerWidth < 900) ? 2 : 3;
    }


    $window.load(function () {
        setInterval(function () {
            $('.flexslider-3').flexslider({
                animation: "slide",
                animationLoop: false,
                itemWidth: 275,
                itemMargin: 40,
                minItems: getGridSize(), // use function to pull in initial value
                maxItems: getGridSize() // use function to pull in initial value
            });
        }, 500);
    });


    // check grid size on resize event
    $window.resize(function () {
      var gridSize = getGridSize();

      flexslider.vars.minItems = gridSize;
      flexslider.vars.maxItems = gridSize;
    });
  }());

  /////////////////////////////////
  ////////////////Couple product carousel
  /////////////////////////////////
  (function () {

    // store the slider in a local variable
    var $window = $(window),
      flexslider = { vars: {} };

    // tiny helper function to add breakpoints
    function getGridSize() {
      return (window.innerWidth < 600) ? 1 :
        (window.innerWidth < 900) ? 1 : 2;
    }

    $window.load(function () {
        setInterval(function () {
            $('.flexslider-2').flexslider({
                animation: "slide",
                animationLoop: false,
                itemWidth: 485,
                itemMargin: 40,
                minItems: 1, // use function to pull in initial value
                maxItems: 1 // use function to pull in initial value
            });
        }, 500);
    });

    // check grid size on resize event
    $window.resize(function () {
      var gridSize = getGridSize();

      flexslider.vars.minItems = gridSize;
      flexslider.vars.maxItems = gridSize;
    });
  }());

  $(window).load(function () {
    $('.gallery-inner').flexslider({
      animation: "slide"
    });
  });


  //Close header top
  $('.close-header-top').on('click', function () {
    $('.header-top').css("display", "none");
  });

  //Move div position
  function moveDiv() {
    if ($(window).width() < 600) {
      $('#filter-modal').addClass('modal');
    } else {
      $('#filter-modal').removeClass('modal');
    }
  }
  moveDiv();
  $(window).resize(moveDiv);

  //Keep position
  $(window).scroll(function () {
    if ($(window).scrollTop() > 1) {
      $('#scroll-top').addClass('show');
    }
    else {
      $('#scroll-top').removeClass('show');
    }
  });

  $(window).scroll(function () {
    var target = $('#processing').offset();
    if ($(window).scrollTop() > target) {
      $('.step-by-step li .nummer').addClass('show');
    }
    else {
      $('.step-by-step li .nummer').removeClass('show');
    }
  });


  $('#scroll-top').on('click', function (e) {
    event.preventDefault();
    $('html,body').animate({ scrollTop: 0 }, 800);
  });


  //Tab
  $('.description-tabs li').on('click', function () {
    var tab_id = $(this).attr('data-tab');

    $('.description-tabs li').removeClass('current');
    $('.tab-content-inner').removeClass('current');

    $(this).addClass('current');
    $('#' + tab_id).addClass('current');
  });

  $('.payment-method-tabs li').on('click', function () {
    var tab_id = $(this).attr('data-tab');

    $('.payment-method-tabs li').removeClass('current');
    $('.tab-content-inner-payment').removeClass('current');

    $(this).addClass('current');
    $('#' + tab_id).addClass('current');
  });

  $('.user-tabs li').on('click', function () {
    var tab_id = $(this).attr('data-tab');

    $('.user-tabs li').removeClass('current');
    $('.tab-content-inner-order').removeClass('current');

    $(this).addClass('current');
    $('#' + tab_id).addClass('current');
  });

  $('.ingredient-tabs li').on('click', function () {
    var tab_id = $(this).attr('data-tab');

    $('.ingredient-tabs li').removeClass('current');
    $('.tab-content-inner-ingredient').removeClass('current');

    $(this).addClass('current');
    $('#' + tab_id).addClass('current');
  });
  $('.result-tabs li').on('click', function () {
    var tab_id = $(this).attr('data-tab');

    $('.result-tabs li').removeClass('current');
    $('.tab-content-inner-result').removeClass('current');

    $(this).addClass('current');
    $('#' + tab_id).addClass('current');
  });

});


/////////////////////////////////
////////////////Megamenu + Moble menu
/////////////////////////////////

$(document).ready(function () {

  "use strict";

  // $('.menu > ul > li > ul:not(:has(ul))').addClass('normal-sub');
    $('.menu > ul > li > ul:not(.sub-menu)').addClass('normal-sub');
  //
  $(".menu > ul").before("<a href=\"#\" class=\"menu-mobile\"></a>");

  $(".menu > ul > li").hover(function (e) {
    if ($(window).width() > 600) {
      $(this).children("ul").stop(true, false).fadeToggle(150);
      e.preventDefault();
    }
  });

  $(".product-mega").next('span').click(function () {
    if ($(window).width() <= 600) {
      $(".sub-menu").fadeToggle(150);
        $(this).toggleClass('active-accordion');
    }
  });

  $(".about-dropmenu").next('span').click(function () {
    if ($(window).width() <= 600) {
      $(this).next(".normal-sub").fadeToggle(150);
        $(this).toggleClass('active-accordion');
    }
  });
  $(".menu-mobile").click(function (e) {
    $(".menu > ul").toggleClass('show-on-mobile');
    $(".menu-mobile").toggleClass('close');
    $(".menu").toggleClass('overlay');
    e.preventDefault();
  });
});

/////////////////////////////////
////////////////Accordion Moble menu
/////////////////////////////////

$(document).ready(function () {

  // function megaAccor() {
  //   if ($(window).width() < 600) {
  //
  //     // Store variables
  //     var accordion_head = $('.accordion > a').next('span'),
  //       accordion_body = $('.accordion > .sub-menu-level-2');
  //
  //     // Open the first tab on load
  //
  //     // accordion_head.first().addClass('active').next().slideDown('normal');
  //
  //     // Click function
  //
  //     accordion_head.on('click', function (event) {
  //       // Disable header links
  //
  //       event.preventDefault();
  //
  //       // Show and hide the tabs on click
  //
  //       if ($(this).attr('class') != 'active-accordion') {
  //         accordion_body.slideUp('normal');
  //         $(this).next().stop(true, true).slideToggle('normal');
  //         accordion_head.removeClass('active-accordion');
  //         $(this).addClass('active-accordion');
  //       }
  //
  //     });
  //   }
  // }
  //
  // // megaAccor();
  // $(window).resize(megaAccor);

});

$(document).ready(function () {


  // Store variables
  var accordion_head = $('.my-accordion > a'),
    accordion_body = $('.my-accordion > .my-accordion-open');

  // Open the first tab on load

  accordion_head.first().addClass('my-active-accordion').next().slideDown('normal');

  // Click function

  accordion_head.on('click', function (event) {

    // Disable header links

    event.preventDefault();

    // Show and hide the tabs on click

    if ($(this).attr('class') != 'my-active-accordion') {
      accordion_body.slideUp('normal');
      $(this).next().stop(true, true).slideToggle('normal');
      accordion_head.removeClass('my-active-accordion');
      $(this).addClass('my-active-accordion');
    }

  });

});

/////////////////////////////////
////////////////History page

$(document).ready(function () {
  $('.accordion-toggle').on('click', function (event) {
    event.preventDefault();
    // create accordion variables
    var accordion = $(this);
    var accordionContent = accordion.next('.panel');

    // toggle accordion link open class
    accordion.toggleClass("open");
    // toggle accordion content
    accordionContent.slideToggle(250);

  });
});

/////////////////////////////////
////////////////Slideshow with progress bar
/////////////////////////////////
$(document).ready(function () {

  var time = 5; // time in seconds

  var $progressBar,
    $bar,
    $elem,
    isPause,
    tick,
    percentTime;

  //Init the carousel
  var waitForImgLoad = setInterval(function () {
    if ($('.slideshow-img').length) {
      $("#owl-demo").owlCarousel({
        slideSpeed: 500,
        paginationSpeed: 500,
        singleItem: true,
        afterInit: progressBar,
        afterMove: moved,
        startDragging: pauseOnDragging
      });

      clearInterval(waitForImgLoad);
    }
  }, 100);

  //Init progressBar where elem is $("#owl-demo")
  function progressBar(elem) {
    $elem = elem;
    //build progress bar elements
    buildProgressBar();
    //start counting
    start();
  }

  //create div#progressBar and div#bar then prepend to $("#owl-demo")
  function buildProgressBar() {
    $progressBar = $("<div>", {
      id: "progressBar"
    });
    $bar = $("<div>", {
      id: "bar"
    });
    $progressBar.append($bar).prependTo($elem);
  }

  function start() {
    //reset timer
    percentTime = 0;
    isPause = false;
    //run interval every 0.01 second
    tick = setInterval(interval, 10);
  };

  function interval() {
    if (isPause === false) {
      percentTime += 1 / time;
      $bar.css({
        width: percentTime + "%"
      });
      //if percentTime is equal or greater than 100
      if (percentTime >= 100) {
        //slide to next item
        $elem.trigger('owl.next')
      }
    }
  }

  //pause while dragging
  function pauseOnDragging() {
    isPause = true;
  }

  //moved callback
  function moved() {
    //clear interval
    clearTimeout(tick);
    //start again
    start();
  }

  //uncomment this to make pause on mouseover
  // $elem.on('mouseover',function(){
  //   isPause = true;
  // })
  // $elem.on('mouseout',function(){
  //   isPause = false;
  // })

});

$(document).ready(function () {
  //Move div position
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
  moveDiv();
  $(window).resize(moveDiv);


})

/////////////////////////////////
////////////////Scolling syns
/////////////////////////////////
$(document).ready(function () {
  var div1 = $('#scrollLeft');
  var div2 = $('.scrollAsWell');

  div1.scroll(function () {
    div2.scrollLeft($(this).scrollLeft());
  });

  div2.scroll(function () {
    div1.scrollLeft($(this).scrollLeft());
  });
});

$(document).ready(function () {

  // Handle click on toggle search button
  $('#toggle-search').click(function () {
    $('#search-form, #toggle-search').toggleClass('open');
    $('#search-form input[type="search"]').focus();
    return false;
  });

  // Handle click on search submit button
  $('#search-form input[type=submit]').click(function () {
    $('#search-form, #toggle-search').toggleClass('open');
    return true;
  });

  // Clicking outside the search form closes it
  $(document).click(function (event) {
    var target = $(event.target);

    if (!target.is('#toggle-search') && !target.closest('#search-form').size()) {
      $('#search-form, #toggle-search').removeClass('open');
    }
  });

  //
  $('#search-form input[type="search"]').on('input propertychange', function () {
    var $this = $(this);
    var visible = Boolean($this.val());
    $this.siblings('.form-control-clear').toggleClass('hidden', !visible);
  }).trigger('propertychange');

  $('.form-control-clear').click(function () {
    $(this).siblings('input[type="search"]').val('')
      .trigger('propertychange').focus();
  });

    $(document).ready(function () {
        $('.fb-share-btn').on('click', function () {
            var link = $(this).data('link');
            FB.ui({
                method: 'share',
                href: link
            }, function(response){});
            return false;
        });
    });

});
