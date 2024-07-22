function horiscroll(
  $selector,
  $desktop,
  $tab,
  $mobile,
  $margin,
  $dots,
  $loop,
  $center,
  $stage
) {
  jQuery($selector).owlCarousel({
    center: $center,
    stagePadding: $stage,
    items: 4,
    loop: $loop,
    margin: $margin,
    responsiveClass: true,
    dots: $dots,
    responsive: {
      0: {
        items: $mobile,
        nav: false,
      },
      600: {
        items: $tab,
        nav: false,
      },
      1000: {
        items: $desktop,
        nav: false,
        loop: true,
      },
    },
  });
  var owl = jQuery($selector);
  owl.owlCarousel();
  jQuery($selector)
    .siblings(".slider_controls")
    .find(".prevbtn")
    .click(function () {
      owl.trigger("prev.owl.carousel");
    });
  jQuery($selector)
    .siblings(".slider_controls")
    .find(".nextbtn")
    .click(function () {
      owl.trigger("next.owl.carousel");
    });
}
function autoplayslider(
  $selector,
  $desktop,
  $tab,
  $mobile,
  $loop,
  $margin,
  $autoplay,
  $controls
) {
  jQuery($selector).owlCarousel({
    items: 2,
    loop: $loop,
    margin: $margin,
    autoWidth: true,
    responsiveClass: true,
    autoplay: $autoplay,
    autoplayTimeout: 1000,
    autoplayHoverPause: true,
    dots: true,
    responsive: {
      0: {
        items: $mobile,
        nav: false,
      },
      600: {
        items: $tab,
        nav: false,
      },
      1000: {
        items: $desktop,
        nav: false,
        loop: $loop,
      },
    },
  });
  if ($controls) {
    var owl = jQuery($selector);
    owl.owlCarousel();
    jQuery($selector)
      .siblings(".slider_controls")
      .find(".prevbtn")
      .click(function (event) {
        owl.trigger("prev.owl.carousel");
      });
    jQuery($selector)
      .siblings(".slider_controls")
      .find(".nextbtn")
      .click(function (event) {
        owl.trigger("next.owl.carousel");
      });
    owl.on("changed.owl.carousel", function (event) {
      var items = event.item.count; // Number of items
      var item = event.item.index;
      console.log(item);
      console.log(items);
      var transform = jQuery($selector).find(".owl-stage").css("transform");
      console.log(transform);
      if (item == items - 1) {
        jQuery($selector)
          .siblings(".slider_controls")
          .find(".nextbtn")
          .addClass("hideme_ar");
        jQuery(".filled_tabs_ar").css("width", "100%");
        jQuery($selector)
          .siblings(".slider_controls")
          .find(".prevbtn")
          .removeClass("hideme_ar");
      } else {
        jQuery($selector)
          .siblings(".slider_controls")
          .find(".nextbtn")
          .removeClass("hideme_ar");
        jQuery(".filled_tabs_ar").css("width", "67%");

        jQuery($selector)
          .siblings(".slider_controls")
          .find(".prevbtn")
          .addClass("hideme_ar");
      }
    });
  }
}
jQuery(document).ready(function () {
  jQuery(".play_button_for_straight").on("click", function (e) {
    var video = jQuery(this).siblings("video").get(0);
    if (video) {
      video.play();
    }
  });
  horiscroll(".ourrange_slider", 6, 3, 1, 24, true, true, true, 0);
  horiscroll(".testimon_mi_ar", 2, 2, 1, 24, true, true, true, 0);
  horiscroll("#footer_gallery_ar_mi", 4, 2, 1, 20, false, true, true, 0);
  horiscroll("#footer_gallery_ar_mi", 4, 2, 1, 20, false, true, true, 0);

  // horiscroll('#wildedgingslider', 2, 2, 1,20,false,false,false);

  autoplayslider(".auto_slider_play_ar", 5, 3, 2, true, 28, true, false);
  autoplayslider("#wildedgingslider", 2, 2, 1, false, 20, false, true);

  // accordian js
  jQuery(".accordian_ar_mi_head").on("click", function () {
    jQuery(this).siblings(".accordian_ar_mi_desc").slideToggle();
    jQuery(this).find(".accord_icons_ar").find("img").toggle();
  });
  if (window.matchMedia("(max-width: 850px)").matches) {
    horiscroll("#reason_wrapper_ar", 1, 1, 1, 20, true, true, true);
    jQuery(".footerheadings").on("click", function () {
      jQuery(this).siblings(".footer_product_menu_ar").slideToggle();
      jQuery(this).find(".icons_footer_ar").toggleClass("roate_up_down_ar");
    });
  }
  jQuery("#mobile_menu_toggler_ar").on("click", function () {
    jQuery("#mobile_nav_ar").show();
  });
  jQuery("#close_btn_ar").on("click", function () {
    jQuery("#mobile_nav_ar").hide();
  });
});
