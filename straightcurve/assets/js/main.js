window.addEventListener("load", () => {
  const savedScrollPosition = sessionStorage.getItem("scrollPosition");
  console.log(savedScrollPosition);
  if (savedScrollPosition && parseInt(savedScrollPosition) > 20) {
    jQuery("#header").addClass("sticky");
  } else {
    jQuery("#header").removeClass("sticky");
  }
});

window.addEventListener("beforeunload", function (event) {
  const scrollPosition = window.scrollY;
  sessionStorage.setItem("scrollPosition", scrollPosition);
});

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
  $controls
) {
  jQuery($selector).owlCarousel({
    items: 2,
    loop: $loop,
    margin: $margin,
    autoWidth: true,
    responsiveClass: true,
    dots: true, // Faster navigation transition
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

      var transform = jQuery($selector).find(".owl-stage").css("transform");
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
jQuery(document).ready(function ($) {
  $(".play_button_for_straight").on("click", function (e) {
    var videoUrl = $(this).data("videourl");
    $("#videoIframe_testi").attr("src", videoUrl + "?autoplay=1");
    $("#videoModal_testi").css("display", "block");
  });

  $(".close_testi").on("click", function () {
    $("#videoModal_testi").css("display", "none");
    $("#videoIframe_testi").attr("src", "");
  });

  $(window).on("click", function (e) {
    if (e.target == $("#videoModal_testi")[0]) {
      $("#videoModal_testi").css("display", "none");
      $("#videoIframe_testi").attr("src", "");
    }
  });
  //video play on click
  jQuery(".video_file_ar").on("click", ".playbutton_ar_mi", function (e) {
    var video = jQuery(this).siblings("video").get(0);
    if (video) {
      video.controls = true;
      video.play();
    }
    $(this).hide();
  });

  //autoplay slider
  $(".slick-carousel").slick({
    speed: 5000,
    autoplay: true,
    autoplaySpeed: 0,
    cssEase: "linear",
    slidesToShow: 5,
    slidesToScroll: 1,
    infinite: true,
    swipeToSlide: true,
    centerMode: true,
    variableWidth: true,
    focusOnSelect: true,
    responsive: [
      {
        breakpoint: 750,
        settings: {
          slidesToShow: 1,
        },
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
        },
      },
    ],
  });
  jQuery("#review_section_temp")
    .delay(5000)
    .hide(0, function () {
      jQuery("#review_section").show();
    });

  autoplayslider("#wildedgingslider", 2, 2, 1, false, 20, true);

  // accesories selection on click
  var activeHeadings_acc = "";
  // jQuery(".product_acc_in_wrapper_ar").on(
  //   "click",
  //   ".acc_loop_wrapper_ar",
  //   function () {
  //     if (jQuery(this).hasClass("active_accessr_diy_option")) {
  //       jQuery(this).removeClass("active_accessr_diy_option");
  //     } else {
  //       jQuery(this).addClass("active_accessr_diy_option");
  //     }

  //     // Initialize an empty array to store the heading texts
  //     activeHeadings_acc = "";
  //     // Iterate over each active element and get the heading text
  //     jQuery(".acc_loop_wrapper_ar.active_accessr_diy_option").each(
  //       function () {
  //         var headingText = jQuery(this).find("h5").text(); // Assuming the heading is an h2 tag
  //         activeHeadings_acc += headingText + ", ";
  //       }
  //     );
  //   }
  // );

  // accordian js
  jQuery(".accordian_wrapper_ar").on(
    "click",
    ".accordian_ar_mi_head",
    function () {
      // Check if the clicked item is not already active
      if (!jQuery(this).hasClass("active_ar_mi_head")) {
        // Close only the first active item if it exists
        jQuery(".accordian_ar_mi_head.active_ar_mi_head")
          .first()
          .removeClass("active_ar_mi_head")
          .siblings(".accordian_ar_mi_desc")
          .slideUp()
          .end()
          .find(".accord_icons_ar img")
          .toggle(); // Toggle icon for the closed item
      }

      // Toggle the current item
      jQuery(this).toggleClass("active_ar_mi_head");
      jQuery(this).siblings(".accordian_ar_mi_desc").slideToggle();
      jQuery(this).find(".accord_icons_ar img").toggle(); // Toggle icon for the opened/closed item
    }
  );
  jQuery(".tabs_edge_heading_ar").on("click", function () {
    jQuery(".tabs_edge_heading_ar").removeClass("active_tab_ar");
    var $selector = jQuery(this).attr("tab-data-wrap");
    jQuery(this).addClass("active_tab_ar");
    jQuery(".tabs_content_wrapper").removeClass("active_tab_content");
    jQuery(`#${$selector}`).addClass("active_tab_content");
  });

  //********* */

  //******** */

  //click after submit form
  //   jQuery('#nf-field-180').on('click', function () {
  //     // Delay in milliseconds (e.g., 2000ms = 2 seconds)
  //     setTimeout(function() {
  //         jQuery('.thankyou-section_diy').css('display', 'block');
  //     }, 2000);
  // });
  jQuery(document).ready(function ($) {
    // Debug: Check if jQuery is loaded
    console.log("jQuery is ready");

    // Listen for Ninja Forms submission response
    $(document).on("nfFormSubmitResponse", function (event, data) {
      console.log("Ninja Forms submission event triggered");
      console.log("Submission Response Data:", data); // Inspect the entire data object

      // Check if there are errors
      if (data.response.errors.length === 0) {
        console.log("Form submission successful");
        // Show the thank you section and hide the form section
        $(".thankyou-section_diy").show();
        $(".pricelist-section_diy").hide();
      } else {
        console.log("Form submission failed");
        // Check if there are any error messages
        if (data.response.errors.length > 0) {
          console.log("Errors:", data.response.errors);
        }
        if (data.response.debug.length > 0) {
          console.log("Debug info:", data.response.debug);
        }
      }
    });

    // Debug: Check if elements are found
    console.log("Thank you section:", $(".thankyou-section_diy").length);
    console.log("Form section:", $(".pricelist-section_diy").length);
  });

  jQuery("#diyselect_options").on("change", function () {
    var $selector = jQuery(this).val();
    jQuery(".tabs_content_wrapper").removeClass("active_tab_content");
    jQuery(`#${$selector}`).addClass("active_tab_content");
  });

  // codes

  if (window.matchMedia("(max-width: 850px)").matches) {
    horiscroll("#reason_wrapper_ar", 1, 1, 1, 10, true, true, true, 30);
    jQuery(".footerheadings").on("click", function () {
      jQuery(this).siblings(".footer_product_menu_ar").slideToggle();
      jQuery(this).find(".icons_footer_ar").toggleClass("roate_up_down_ar");
    });
    horiscroll(".ourrange_slider", 6, 3, 1, 10, true, true, false, 60);
    horiscroll("#footer_gallery_ar_mi", 4, 2, 1, 10, false, true, true, 60);
    horiscroll(".testimon_mi_ar", 6, 3, 1, 10, true, true, true, 20);
  } else {
    horiscroll(".ourrange_slider", 4, 3, 1, 24, true, true, false, 60);
    horiscroll("#footer_gallery_ar_mi", 4, 2, 1, 20, false, true, true, 0);
    horiscroll(".testimon_mi_ar", 2, 2, 1, 24, true, true, true, 0);
  }
  jQuery("#mobile_nav_ar").on(
    "click",
    ".mainmenulist li > a span",
    function (e) {
      var $li = $(this).closest("li");
      $(this).toggleClass("reotate_chev_180");
      if ($li.find(".submenulist").length > 0) {
        e.preventDefault(); // Prevent the default action if there is a submenu
        $li.find(".submenulist").slideToggle(); // Toggle the visibility of the submenu
      }
    }
  );

  jQuery("#mobile_menu_toggler_ar").on("click", function () {
    jQuery("#mobile_nav_ar").show();
  });
  jQuery("#close_btn_ar").on("click", function () {
    jQuery("#mobile_nav_ar").hide();
  });
  jQuery("#tabs_find_edege_ar")
    .find("#setcalc_button_ar")
    .on("click", function (e) {
      e.preventDefault();
      console.log("clicked");
      var productid = jQuery("#setcalc_button_ar").attr("prod_id");
      var quantity = jQuery("#numberofsets_ar").text();
      var meters = 0;
      // if (jQuery("#text_inform_ar").length > 0) {
      //   meters = jQuery("#text_inform_ar").find(".rednotice_ar").text();
      // }

      if (quantity > 0 && productid !== "") {
        meters = parseFloat(parseInt(quantity) * 7.2).toFixed(2);
        jQuery.ajax({
          type: "POST",
          url: "/au/wp-admin/admin-ajax.php",
          data: {
            action: "addtocart",
            product_id: productid,
            quantity: quantity,
            meters: meters,
          },
          success: function (response) {
            if (response.success) {
              jQuery("#notification_ar").find("#cross_icon_ar").hide();
              jQuery("#notification_ar").find("#check_icon_ar").show();
              jQuery("#notification_ar").find("p").text(response.data.message);
              jQuery("#stock_error_ar").hide();
              jQuery("#notification_ar").show();
              setTimeout(function () {
                jQuery("#notification_ar").hide();
              }, 1500);
              if (
                response.data.minicart != undefined &&
                response.data.minicart != null &&
                response.data.minicart != ""
              ) {
                jQuery("#minicart_ar").html(response.data.minicart);
                jQuery("#minicart_ar").find(".str-cart-section-am").show();
                jQuery("#minicart_ar").find(".str-cart-addquote-btn-am").hide();
                jQuery("#minicart_ar")
                  .find(".str-cart-addquote-btn-am")
                  .addClass("hide_it_ar");
              }
            } else {
              // jQuery("#notification_ar").find("#cross_icon_ar").show();
              // jQuery("#notification_ar").find("#check_icon_ar").hide();
              jQuery("#error_ar").find("span").text(response.data.message);
              jQuery("#stock_error_ar").show();
            }
          },
          error: function (error) {
            console.log(error);
          },
        });
      } else {
        jQuery("#error_ar")
          .find("span")
          .text(" kindly select number of sets...");
        jQuery("#stock_error_ar").show();
      }
    });

  jQuery(".get_price_list_popup a").on("click", function (e) {
    e.preventDefault();
    jQuery("#form-overlay-pricelist").show();
  });
  // DIY Form Details

  jQuery("#findyouredging_ar").on(
    "submit",
    ".form_side_ar_mi form",
    function (e) {
      e.preventDefault();
      console.log("clicked");
      var productid = jQuery("#setcalc_button_ar").attr("prod_id");
      var quantity = jQuery("#numberofsets_ar").text();

      if (quantity > 0 && productid !== "") {
        jQuery.ajax({
          type: "POST",
          url: "/au/wp-admin/admin-ajax.php",
          data: {
            action: "addtocart",
            product_id: productid,
            quantity: quantity,
          },
          success: function (response) {
            if (response.success) {
              jQuery("#notification_ar").find("#cross_icon_ar").hide();
              jQuery("#notification_ar").find("#check_icon_ar").show();
              jQuery("#notification_ar").find("p").text(response.data.message);
              jQuery("#notification_ar").show();
              setTimeout(function () {
                jQuery("#notification_ar").hide();
              }, 1500);
              if (
                response.data.minicart != undefined &&
                response.data.minicart != null &&
                response.data.minicart != ""
              ) {
                jQuery("#minicart_ar").html(response.data.minicart);
                jQuery("#minicart_ar").find(".str-cart-section-am").show();
                jQuery("#minicart_ar").find(".str-cart-addquote-btn-am").hide();
                jQuery("#minicart_ar")
                  .find(".str-cart-addquote-btn-am")
                  .addClass("hide_it_ar");
              }
            } else {
              jQuery("#error_ar").find("span").text(response.data.message);
              jQuery("#stock_error_ar").show();
            }
          },
          error: function (error) {
            console.log(error);
          },
        });
      } else {
        jQuery("#notification_ar")
          .find("p")
          .text("kindly select number of sets...");
        jQuery("#notification_ar").find("#cross_icon_ar").show();
        jQuery("#notification_ar").find("#check_icon_ar").hide();
        jQuery("#notification_ar").show();
        setTimeout(function () {
          jQuery("#notification_ar").hide();
        }, 1500);
      }
    }
  );

  // diy calculator

  jQuery("#setcalc_input_ar").on("change input", function () {
    var value = jQuery(this).val();
    jQuery("#stock_error_ar").hide();
    calculatorset(value);
  });
  let previousValue = jQuery("#setincrease_ar").val();

  jQuery("#setincrease_ar").on("change input", function () {
    var value = jQuery(this).val();
    var differance = parseInt(value) - parseInt(previousValue);
    var setnumbers = jQuery("#numberofsets_ar").text();
    setnumbers = parseInt(setnumbers) + differance;
    var currentmeters = parseFloat(parseInt(setnumbers) * 7.2).toFixed(2);
    jQuery("#numberofsets_ar").text(setnumbers);
    jQuery("#setcalc_input_ar").val(currentmeters);
    previousValue = value;
    jQuery("#stock_error_ar").hide();
    calculatorset(currentmeters);
  });

  function calculatorset(val) {
    var onesetlength = 7.2;
    var oneset = 7;
    var extrashort = 0;
    var value = val;
    var totalsets = parseInt(value / oneset);
    jQuery("#numberofsets_ar").text(totalsets);
    if (jQuery(".diypaymentprice_ar").length > 0) {
      var pprice = jQuery(".diypaymentprice_ar")
        .find(".price_arq h6")
        .attr("proprice");
      pprice = pprice.replace(/\$/g, "");
      var totalprice = parseFloat(pprice * totalsets);
      if (totalprice > 0) {
        jQuery(".diypaymentprice_ar")
          .find(".price_arq bdi")
          .text(`$ ${totalprice.toFixed(2)}`);
      }
    }
    if (totalsets > 0) {
      extrashort = totalsets * onesetlength - value;
    }

    var totalprice = (totalsets * onesetlength).toFixed(2);
    jQuery("#text_inform_ar").html(
      `Please add an additional set <span>(7.2m)</span> OR to reduce waste, choose one of the  <a href='#accessroies_tabs_wrapper' >  short packs </a> `
    );
  }

  jQuery(".input_wrapper_ar_mi")
    .find("input[type='radio']")
    .on("change", function () {
      var currentactive = jQuery("#tabs_find_edege_ar")
        .find(".active_tab_content")
        .attr("id");
      var sizevalue = jQuery(this)
        .closest("form")
        .find("input.size_input_ar:checked")
        .val();
      var stylevalue = jQuery(this)
        .closest("form")
        .find("input.style_input_ar:checked")
        .val();
      var categoryvalue = jQuery(this)
        .closest("form")
        .find("input.category_input_ar:checked")
        .val();
      var currentpageid = jQuery(this)
        .closest("form")
        .find("input.size_input_ar:checked")
        .attr("current-page");
      var current_type = jQuery(this)
        .closest("form")
        .find("input.size_input_ar:checked")
        .attr("current-type");
      jQuery("#stock_error_ar").hide();

      jQuery.ajax({
        type: "POST",
        url: "/au/wp-admin/admin-ajax.php", // Using localized variable for AJAX URL
        data: {
          action: "showproductsar",
          stylevalue: stylevalue,
          sizevalue: sizevalue,
          categoryvalue: categoryvalue,
          currentpageid: currentpageid,
          current_type: current_type,
          currentactivetabs: currentactive,
        },
        success: function (data) {
          var parsedData = JSON.parse(data);

          var setval = jQuery("#setcalc_input_ar").val();

          jQuery(".accordian_wrapper_ar").html(parsedData.accordion);
          jQuery(".video_file_ar").html(parsedData.video);
          jQuery(".p_image_wrapper img").attr("src", parsedData.thumbnail);
          jQuery(".pdesc_ar_wrapper h3.p_title_ar").html(parsedData.title);
          jQuery(".pdesc_ar_wrapper p.edge_size_ar").html(
            `Edge Size : ${parsedData.size}`
          );
          jQuery("#setcalc_button_ar").attr("prod_id", parsedData.product_id);
          if (parsedData.loggedin == true) {
            var currentprice =
              "$ " + parseFloat(parsedData.current_price).toFixed(2);
            jQuery(".diypaymentprice_ar")
              .find(".price_arq h6")
              .find("bdi")
              .text(currentprice);
            jQuery(".diypaymentprice_ar")
              .find(".price_arq h6")
              .attr("proprice", currentprice);
            jQuery(".diypaymentprice_ar").find(".price_arq h6").show();
          } else {
            jQuery(".diypaymentprice_ar").find(".price_arq h6").hide();
          }
          if (parsedData.accer == "" || parsedData.accer == null) {
            jQuery(".accessroies_tabs_wrapper").hide();
            jQuery(".product_acc_in_wrapper_ar").html("");
            jQuery("#moreaccesspries_ar").hide();
          } else {
            jQuery(".product_acc_in_wrapper_ar").html(parsedData.accer);
            jQuery(".accessroies_tabs_wrapper").show();
            jQuery("#moreaccesspries_ar").show();
          }
          if (parsedData.product_id == 0) {
            jQuery("#setcalc_button_ar").addClass("disabledbtn_ar");
          } else {
            jQuery("#setcalc_button_ar").removeClass("disabledbtn_ar");
          }
          if (setval > 0) {
            calculatorset(setval);
          } else {
            jQuery(".pdesc_ar_wrapper .text_inform_ar p").html(parsedData.html);
          }
          jQuery("#nf-field-186").val(parsedData.title);
          jQuery("#nf-field-185").val(parsedData.pro_url);

          activeHeadings_acc = "";
        },
        error: function (error) {
          console.log(error);
        },
      });
    });

  function adddatatodom(data, currenttab) {
    jQuery(`#${currenttab}`).find(".pdesc_ar_wrapper h3").html(data.ptitle);
    jQuery(`#${currenttab}`)
      .find(".pdesc_ar_wrapper > p")
      .html(`Edge Size : ${data.pinfo.details}`);
    jQuery(`#${currenttab}`)
      .find(".p_image_wrapper img")
      .attr("src", data.pimage);
    if (data.pfiletext == "") {
      jQuery(`#${currenttab}`).find(".donwload_wrapper").hide();
    } else {
      jQuery(`#${currenttab}`).find(".donwload_wrapper").show();
    }
    jQuery(`#${currenttab}`)
      .find(".videowrapper video")
      .attr("src", data.pvideo);
    jQuery(`#${currenttab}`)
      .find(".donwload_wrapper a")
      .attr("href", data.pfile);
    jQuery(`#${currenttab}`).find(".donwload_wrapper a").text(data.pfiletext);
  }
});
jQuery(document).scroll(function () {
  var header = jQuery("#header");
  var specificScrollPosition = 20; // Change this value to your desired scroll position

  if (jQuery(window).scrollTop() >= specificScrollPosition) {
    header.addClass("sticky");
  } else {
    header.removeClass("sticky");
  }
  sessionStorage.setItem("scrollPosition", jQuery(window).scrollTop());
});

jQuery(function ($) {
  "use strict";
  $(".ourrange_slider_ar .slide img").click(function () {
    console.log("sdcdscds");
    var $src = $(this).attr("src");
    $(".show_slide_img").fadeIn();
    $(".img-show_slide img").attr("src", $src);
  });

  $("span, .overlay").click(function () {
    $(".show_slide_img").fadeOut();
  });
});

jQuery("#findyouredging_ar").on(
  "click",
  ".addtocart_loop_ar button[type='submit']",
  function (e) {
    e.preventDefault();
    console.log("clicked");
    var currentcart = jQuery(this).closest(".addtocart_loop_ar");
    var quantity = jQuery(this).closest("form.cart").find("input").val();
    var productid = jQuery(this).attr("value");
    if (quantity > 0 && productid !== "") {
      jQuery.ajax({
        type: "POST",
        url: "/au/wp-admin/admin-ajax.php",
        data: {
          action: "addtocart",
          product_id: productid,
          quantity: quantity,
        },
        success: function (data) {
          if (data.success) {
            jQuery("#notification_ar").find("#cross_icon_ar").hide();
            jQuery("#notification_ar").find("#check_icon_ar").show();
            jQuery("#notification_ar").find("p").text(data.data.message);
            jQuery("#notification_ar").show();
            currentcart.find(".stock_error_ar").css("opacity", "0");
            setTimeout(function () {
              jQuery("#notification_ar").hide();
            }, 1500);
            if (
              data.data.minicart != undefined &&
              data.data.minicart != null &&
              data.data.minicart != ""
            ) {
              jQuery("#minicart_ar").html(data.data.minicart);
              jQuery("#minicart_ar").find(".str-cart-section-am").show();
              jQuery("#minicart_ar").find(".str-cart-addquote-btn-am").hide();
              jQuery("#minicart_ar")
                .find(".str-cart-addquote-btn-am")
                .addClass("hide_it_ar");
            }
          } else {
            currentcart
              .find(".stock_error_ar")
              .find("span")
              .text(data.data.message);
            currentcart.find(".stock_error_ar").css("opacity", "1");
          }
        },
        error: function (error) {
          console.log(error);
        },
      });
    } else {
      jQuery("#notification_ar")
        .find("p")
        .text("kindly select number of sets...");

      jQuery("#notification_ar").find("#cross_icon_ar").show();
      jQuery("#notification_ar").find("#check_icon_ar").hide();
      jQuery("#notification_ar").show();
      setTimeout(function () {
        jQuery("#notification_ar").hide();
      }, 1500);
    }
  }
);

jQuery("#notification_ar").on("click", ".close_icon_ar", function () {
  jQuery("#notification_ar").hide();
});
jQuery("#header").on("click", ".str-cart-cross-icon-am", function () {
  jQuery(".str-cart-section-am").hide();
});
jQuery("#header").on("click", "#minicart_ar", function (e) {
  if (e.target.closest(".str-cart-section-inner-am") == null) {
    jQuery(".str-cart-section-am").hide();
  }
});
jQuery("#header").on("click", ".mini_cart_ar", function () {
  jQuery(".str-cart-section-am").show();
});
jQuery("body").on(
  "input change",
  ".mini_cart_quantity_ar input[type='number']",
  function () {
    var quantity = $(this).val();
    var thisis = jQuery(this);
    var cart_item_key = $(this)
      .closest(".mini_cart_quantity_ar")
      .attr("data-cart-key");

    if (jQuery("#pdf_wrapper_ar").length > 0) {
      jQuery("#pdf_wrapper_ar")
        .find("td[data-cart-key='" + cart_item_key + "']")
        .text(quantity);
    }
    if (jQuery("#update_cart_ar").length > 0) {
      jQuery("#update_cart_ar").addClass("disabledbtn_ar ");
    }
    $.ajax({
      type: "POST",
      url: "/au/wp-admin/admin-ajax.php",
      data: {
        action: "update_cart_item",
        cart_item_key: cart_item_key,
        quantity: quantity,
      },
      success: function (response) {
        if (response.success) {
          if (jQuery("#update_cart_ar").length > 0) {
            jQuery("#update_cart_ar").removeClass("disabledbtn_ar ");
          }
          // Reload cart fragment (mini-cart, cart totals, etc.) without refreshing the page
          // $(document.body).trigger("wc_fragment_refresh");
          jQuery("#notification_ar").find("#cross_icon_ar").hide();
          jQuery("#notification_ar").find("#check_icon_ar").show();
          jQuery("#notification_ar").find("p").text(response.data.message);
          jQuery("#stock_error_ar").hide();
          jQuery("#notification_ar").show();
          setTimeout(function () {
            jQuery("#notification_ar").hide();
          }, 1500);

          thisis
            .closest(".cart_closer_wrapper_ar")
            .find(".remvoer_side_ar h6")
            .text(`$ ${response.data.line_total}`);
          thisis
            .closest(".cart_closer_wrapper_ar")
            .find(".str-cart-order-name-am p")
            .text(response.data.title);
          thisis
            .closest(".cart_closer_wrapper_ar")
            .find(".str-qoute-order-name-am p")
            .text(response.data.title);
          if (jQuery("#mini_total_quantity_ar").length > 0) {
            jQuery("#mini_total_quantity_ar")
              .find("h6")
              .html(response.data.totalquantity);
            jQuery("#mini_total_price_ar")
              .find("h6")
              .html(response.data.totalprice);
          }
          if (jQuery("#quotepage_total_ar").length > 0) {
            jQuery("#quotepage_total_ar")
              .find("h6")
              .html(response.data.totalprice);
          }
        } else {
          jQuery("#error_ar").find("span").text(response.data.message);
          jQuery("#stock_error_ar").show();
          if (response.data.is_stock_error) {
            jQuery("#notification_ar").find("#check_icon_ar").hide();
            jQuery("#notification_ar").find("#cross_icon_ar").show();
            jQuery("#notification_ar").find("p").text(response.data.message);
            jQuery("#stock_error_ar").hide();
            jQuery("#notification_ar").show();
            setTimeout(function () {
              jQuery("#notification_ar").hide();
            }, 1500);
            thisis.val(response.data.stock);
            if (jQuery("#update_cart_ar").length > 0) {
              jQuery("#update_cart_ar").removeClass("disabledbtn_ar ");
            }
          }
        }
      },
      error: function (xhr, status, error) {
        console.log("AJAX error:", error);
      },
    });
  }
);
jQuery("#header").on("click", "#update_cart_ar", function () {
  window.location.href = "/au/quote";
});

jQuery(function ($) {
  // Listen for the mini-cart update event
  $(document.body).on("added_to_cart updated_wc_div", function () {
    // Redirect to the desired page URL
    window.location.href = "/au/quote"; // Replace '/au/quote' with your desired page slug
  });
});

jQuery("#submit_quote_ar").on("click", function (e) {
  var username = jQuery("#str-first-name-am").val();
  var email = jQuery("#str-email-am").val();
  var postalcode = jQuery("#str-postal-code-am").val();
  var suburb = jQuery("#str-suburb-am").val();
  var profession = jQuery("#str-country-am").val();
  var products = [];
  jQuery(".str-quote-order-content-am").each(function () {
    var itemname = jQuery(this).find(".str-qoute-order-name-am > p").text();
    var quantity = jQuery(this).find("input[type='number']").val();
    products.push({ itemname: itemname, quantity: quantity });
  });
  var streetaddress = "";
  if (jQuery("#str-street-am").length > 0) {
    if (
      jQuery("#str-street-am")
        .closest(".str-form-group-main-am")
        .hasClass("showme_login_ar")
    ) {
      streetaddress = jQuery("#str-street-am").val();
      if (streetaddress == "") {
        alert("Please fill all the fields");
      }
    }
  } else {
    streetaddress = "";
  }
  var comments = "";
  if (jQuery("#str-comnent-am").length > 0) {
    if (
      jQuery("#str-comnent-am")
        .closest(".str-form-group-main-am")
        .hasClass("showme_login_ar")
    ) {
      comments = jQuery("#str-comnent-am").val();
    }
  } else {
    comments = "";
  }
  if (
    username == "" ||
    email == "" ||
    postalcode == "" ||
    suburb == "" ||
    profession == "" ||
    products.length == 0
  ) {
    alert("Please fill all the fields");
  } else {
    // jQuery("#submit_quote_ar").addClass("disabledbtn_ar");
    if (!isValidEmail(email)) {
      alert("Please enter a valid email address.");
      return false;
    } else {
      // Generate PDF and send AJAX request with PDF attached
      jQuery("#customer_name_ar").text(username);
      jQuery("#pdf_wrapper_ar").show();

      // Use html2pdf to generate the PDF
      html2pdf()
        .from(jQuery("#pdf_wrapper_ar").html())
        .output("blob") // Generates the PDF as a blob
        .then(function (pdfBlob) {
          // Create FormData object
          var formData = new FormData();
          formData.append("action", "submit_quote");
          formData.append("username", username);
          formData.append("email", email);
          formData.append("postalcode", postalcode);
          formData.append("suburb", suburb);
          formData.append("streetaddress", streetaddress);
          formData.append("comments", comments);
          formData.append("profession", profession);
          formData.append("products", JSON.stringify(products));
          formData.append("pdf", pdfBlob, "quote.pdf"); // Attach the PDF blob as 'quote.pdf'

          // Send AJAX request
          jQuery.ajax({
            type: "POST",
            url: "/au/wp-admin/admin-ajax.php",
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
              if (data.success) {
                window.location.href = data.data.redirect;
              }
            },
            error: function (error) {
              console.log(error);
            },
          });
        });

      jQuery("#pdf_wrapper_ar").hide();
    }
  }
});
function isValidEmail(email) {
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return emailRegex.test(email);
}
jQuery("#minicart_ar").on("click", ".remove_from_cart_ar", function (e) {
  e.preventDefault();
  var productevent = jQuery(this);
  var productid = jQuery(this).attr("data-product_id");
  jQuery.ajax({
    type: "POST",
    url: "/au/wp-admin/admin-ajax.php",
    data: {
      action: "remove_from_cart",
      product_id: productid,
    },
    success: function (data) {
      if (data.success) {
        var carrofquote = data.data.cartorquote;
        jQuery("#notification_ar").find("p").text(data.data.message);
        jQuery("#notification_ar").find("#cross_icon_ar").hide();
        jQuery("#notification_ar").find("#check_icon_ar").show();
        jQuery("#notification_ar").show();
        setTimeout(function () {
          jQuery("#notification_ar").hide();
        }, 1500);
        productevent.closest(".str-cart-order-content-am").remove();
        if (
          jQuery("#minicart_ar").find(".str-cart-order-content-am").length == 0
        ) {
          jQuery("#minicart_ar")
            .find(".str-cart-content-am .str-cart-content-inner-am")
            .append(`<p>Your ${carrofquote} is currently empty.</p>`);
          jQuery("#update_cart_ar").addClass("disabledbtn_ar");
          jQuery("#minicart_ar")
            .find(".str-cart-addquote-btn-am")
            .css("display", "flex");
          jQuery("#minicart_ar")
            .find(".str-cart-addquote-btn-am")
            .removeClass("hide_it_ar");
          if (jQuery("#mini_total_quantity_ar").length > 0) {
            jQuery("#mini_total_quantity_ar").find("h6").html("$0");
            jQuery("#mini_total_price_ar").find("h6").html("$0");
          }
          if (jQuery("#quotepage_total_ar").length > 0) {
            jQuery("#quotepage_total_ar").find("h6").html("$0");
          }
        }
      }
    },
    error: function (error) {
      console.log(error);
    },
  });
});
jQuery("#quotepage_cart_wrapper_ar").on(
  "click",
  ".remove_from_cart_ar",
  function (e) {
    e.preventDefault();
    var productevent = jQuery(this);
    var productid = jQuery(this).attr("data-product_id");
    jQuery.ajax({
      type: "POST",
      url: "/au/wp-admin/admin-ajax.php",
      data: {
        action: "remove_from_cart",
        product_id: productid,
      },
      success: function (data) {
        if (data.success) {
          productevent.closest(".str-quote-order-content-am").remove();
          if (
            jQuery("#quotepage_cart_wrapper_ar").find(
              ".str-quote-order-content-am"
            ).length == 0
          ) {
            jQuery("#submit_quote_ar").addClass("disabledbtn_ar");
            if (jQuery("#mini_total_quantity_ar").length > 0) {
              jQuery("#mini_total_quantity_ar").find("h6").html("$0");
              jQuery("#mini_total_price_ar").find("h6").html("$0");
            }
            if (jQuery("#quotepage_total_ar").length > 0) {
              jQuery("#quotepage_total_ar").find("h6").html("$0");
            }
          } else {
            jQuery("#submit_quote_ar").removeClass("disabledbtn_ar");
          }
        }
      },
      error: function (error) {
        console.log(error);
      },
    });
  }
);
