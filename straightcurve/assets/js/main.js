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

  //accesories selection on click
  var activeHeadings_acc = "";
  jQuery(".product_acc_in_wrapper_ar").on(
    "click",
    ".acc_loop_wrapper_ar",
    function () {
      if (jQuery(this).hasClass("active_accessr_diy_option")) {
        jQuery(this).removeClass("active_accessr_diy_option");
      } else {
        jQuery(this).addClass("active_accessr_diy_option");
      }

      // Initialize an empty array to store the heading texts
      activeHeadings_acc = "";
      // Iterate over each active element and get the heading text
      jQuery(".acc_loop_wrapper_ar.active_accessr_diy_option").each(
        function () {
          var headingText = jQuery(this).find("h5").text(); // Assuming the heading is an h2 tag
          activeHeadings_acc += headingText + ", ";
        }
      );
    }
  );

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
  jQuery("#mobile_nav_ar").on("click", ".mainmenulist li > a span", function (e) {
    var $li = $(this).closest("li");
    $(this).toggleClass("reotate_chev_180");
    if ($li.find(".submenulist").length > 0) {
      e.preventDefault(); // Prevent the default action if there is a submenu
      $li.find(".submenulist").slideToggle(); // Toggle the visibility of the submenu
    }
  });

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
      jQuery(this).closest("form").trigger("submit");
      console.log(jQuery(this).closest("form"));
      jQuery("#nf-field-187").val(activeHeadings_acc);
    });

  jQuery(".get_price_list_popup").on("click", function (e) {
    e.preventDefault();
    jQuery("#form-overlay-pricelist").show();
  });
  // DIY Form Details
  
jQuery("#findyouredging_ar").on("submit",'form',function(e){
  e.preventDefault();
  console.log("clicked");
   var productid= jQuery("#setcalc_button_ar").attr("prod_id");
   var quantity= jQuery("#numberofsets_ar").text();

   if(quantity > 0 && productid !== ''){
     jQuery.ajax({
       type: "POST",
       url: "/wp-admin/admin-ajax.php",
       data: {
         action: "addtocart",
         product_id: productid,
         quantity: quantity
       },
       success: function (response) {
         console.log(response);
         
       },
       error: function (error) {
         console.log(error);
       }

     })
   }

})

  // diy calculator
  
  jQuery("#setcalc_input_ar").on("change", function () {
     var onesetlength=7.2;
     var oneset=7;
     var extrashort=0;
     var value = jQuery(this).val();
     var totalsets=parseInt(value/oneset);
     jQuery("#numberofsets_ar").text(totalsets);

     if(totalsets > 0){
       extrashort=(totalsets*onesetlength)-value;
     }

     if(extrashort < 0){
       jQuery("#text_inform_ar").html(`We've  added ${totalsets*onesetlength}m to your cart, we recommend you add filler packs to make up the difference (${extrashort.toFixed(1)})`);
     }else{
      jQuery("#text_inform_ar").html('');
     }
     console.log(extrashort.toFixed(1));
  })

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

      jQuery.ajax({
        type: "POST",
        url: "/wp-admin/admin-ajax.php", // Using localized variable for AJAX URL
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

          jQuery(".accordian_wrapper_ar").html(parsedData.accordion);
          jQuery(".video_file_ar").html(parsedData.video);
          jQuery(".p_image_wrapper img").attr("src", parsedData.thumbnail);
          jQuery(".pdesc_ar_wrapper h3.p_title_ar").html(parsedData.title);
          jQuery(".pdesc_ar_wrapper p.edge_size_ar").html(`Edge Size : ${parsedData.size}`);
          jQuery("#setcalc_button_ar").attr("prod_id", parsedData.product_id);
          if (parsedData.accer == "" || parsedData.accer == null) {
            jQuery(".accessroies_tabs_wrapper").hide();
            jQuery(".product_acc_in_wrapper_ar").html('');
            jQuery("#moreaccesspries_ar").hide();
          } else {
            jQuery(".product_acc_in_wrapper_ar").html(parsedData.accer);
            jQuery(".accessroies_tabs_wrapper").show();
            jQuery("#moreaccesspries_ar").show();
          }
          jQuery(".pdesc_ar_wrapper .text_inform_ar p").html(parsedData.html);
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
});


jQuery(function ($) {
  "use strict";
  $(".ourrange_slider_ar .slide img").click(function () {
    console.log('sdcdscds');
      var $src = $(this).attr("src");
      $(".show_slide_img").fadeIn();
      $(".img-show_slide img").attr("src", $src);
  });
  
  $("span, .overlay").click(function () {
      $(".show_slide_img").fadeOut();
  });
  
});
