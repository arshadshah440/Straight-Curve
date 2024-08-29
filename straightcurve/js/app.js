document.addEventListener("DOMContentLoaded", function () {
  const tabs = document.querySelectorAll(".landscape_whychoose_tab_list_item");
  const contents = document.querySelectorAll(
    ".landscape_whychoose_tab_content_item"
  );
  const dropdown = document.getElementById("landscape_whychoose_tab_dropdown");

  function activateTab(tabId) {
    tabs.forEach((tab) => {
      tab.classList.remove("active");
      if (tab.getAttribute("data-tab") === tabId) {
        tab.classList.add("active");
      }
    });

    contents.forEach((content) => {
      content.classList.remove("active");
      if (content.getAttribute("id") === tabId) {
        content.classList.add("active");
      }
    });
  }
  if (dropdown) {
    dropdown.addEventListener("change", function () {
      activateTab(this.value);
    });
  }

  if (tabs) {
    tabs.forEach((tab) => {
      tab.addEventListener("click", function () {
        activateTab(this.getAttribute("data-tab"));
      });
    });
  }
});
// jQuery(document).ready(function($){
//   $('.auto_slider_play_ar').owlCarousel({
//       loop: true, // Loop the items
//       margin: 0, // Space between items, set to 0 for no gap
//       nav: false, // No next/prev buttons
//       autoplay: true, // Enable autoplay
//       slideTransition: 'linear',
//       autoplayTimeout: 600, // 2 seconds between slides (adjust as needed)
//       autoplayHoverPause: false, // Do not pause on hover
//       smartSpeed: 60000, // Faster transition between slides
//       autoplaySpeed: 60000, // Faster autoplay transition
//       navSpeed: 60000, // Faster navigation transition
//       responsive: {
//           0: {
//               items: 1 // Show 1 item on small screens
//           },
//           600: {
//               items: 2 // Show 3 items on medium screens
//           },
//           1000: {
//               items: 4 // Show 6 items on large screens
//           },
//           1500: {
//             items: 6 // Show 9 items on extra large screens
//           }
//       }
//   });
  // var owl = $('.auto_slider_play_ar');
  // owl.owlCarousel({
  //     items: 6,
  //     loop: true,

  //     autoplay: true,
  //     slideTransition: 'linear',
  //     autoplayTimeout: 0,
  //     autoplaySpeed: 3000,
  //     autoplayHoverPause: false

  // });
// });

// document.addEventListener('DOMContentLoaded', function() {
//   const observerOptions = {
//       threshold: 0.1
//   };

//   const observer = new IntersectionObserver((entries, observer) => {
//       entries.forEach(entry => {
//           if (entry.isIntersecting) {
//               entry.target.classList.add('animate');
//               observer.unobserve(entry.target);
//           }
//       });
//   }, observerOptions);

//   document.querySelectorAll('#footer_pricelist_ar, .pointer_ar_mi').forEach(element => {
//       observer.observe(element);
//   });
// });
document.addEventListener("DOMContentLoaded", function() {
  const observerOptions = {
    root: null, // relative to the viewport
    rootMargin: "0px",
    threshold: 0.1 // adjust this to trigger animation earlier or later
  };

  const observer = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add("animate");
        observer.unobserve(entry.target);
      }
    });
  }, observerOptions);

  const elementsToAnimate = document.querySelectorAll(".included_item_ar, .pointer_ar_mi img");

  elementsToAnimate.forEach(element => {
    observer.observe(element);
  });
});


//country drop down


document.addEventListener('DOMContentLoaded', function() {
  const dropdown = document.getElementById('custom-dropdown');
  const selectedOption = dropdown.querySelector('.dropdown-selected-option');
  const options = dropdown.querySelector('.dropdown-options');
  const dropdownOptions = dropdown.querySelectorAll('.dropdown-option');

  // Load the selected option from local storage if it exists
  const savedUrl = localStorage.getItem('selectedDropdownUrl');
  if (savedUrl) {
      const savedOption = Array.from(dropdownOptions).find(option => option.getAttribute('data-url') === savedUrl);
      if (savedOption) {
          const flagIcon = savedOption.querySelector('.flag-icon').src;
          const countryName = savedOption.querySelector('.country-name').textContent;

          selectedOption.querySelector('.flag-icon').src = flagIcon;
          selectedOption.querySelector('.country-name').textContent = countryName;
          selectedOption.setAttribute('data-url', savedUrl);
      }
  }

  selectedOption.addEventListener('click', function() {
      options.style.display = options.style.display === 'block' ? 'none' : 'block';
  });

  document.addEventListener('click', function(event) {
      if (!dropdown.contains(event.target)) {
          options.style.display = 'none';
      }
  });

  dropdownOptions.forEach(option => {
      option.addEventListener('click', function() {
          const url = option.getAttribute('data-url');
          const flagIcon = option.querySelector('.flag-icon').src;
          const countryName = option.querySelector('.country-name').textContent;

          selectedOption.querySelector('.flag-icon').src = flagIcon;
          selectedOption.querySelector('.country-name').textContent = countryName;
          selectedOption.setAttribute('data-url', url);

          options.style.display = 'none';

          // Save the selected option URL to local storage
          localStorage.setItem('selectedDropdownUrl', url);

          // Optionally, navigate to the selected URL immediately
          window.location.href = url;
          
      });
  });
  // local storage reset
  localStorage.removeItem('selectedDropdownUrl');
});


document.addEventListener('DOMContentLoaded', () => {
  const popup = document.getElementById('videoPopup');
  const openPopupLink = document.getElementById('openPopupLink');
  const closeBtn = document.querySelector('.close');
  const video = document.getElementById('popupVideo');

  openPopupLink.addEventListener('click', (event) => {
    event.preventDefault();
    popup.style.display = 'block';
  });

  closeBtn.addEventListener('click', () => {
    popup.style.display = 'none';
    video.src = video.src;  // Reset the video src to stop playback
  });

  window.addEventListener('click', (event) => {
    if (event.target === popup) {
      popup.style.display = 'none';
      video.src = video.src;  // Reset the video src to stop playback
    }
  });
});


// .auto_slider_play_ar

// jQuery(document).ready(function($){
//   $('.auto_slider_play_ar').owlCarousel({
//       loop: true, // Loop the items
//       margin: 0, // Space between items, set to 0 for no gap
//       nav: false, // No next/prev buttons
//       autoplay: true, // Enable autoplay
//       slideTransition: 'linear',
//       autoplayTimeout: 6000, // Increase the time between slides
//       autoplayHoverPause: false, // Do not pause on hover
//       smartSpeed: 3000, // Adjusted transition speed for smoother transitions
//       autoplaySpeed: 3000, // Adjusted autoplay speed
//       navSpeed: 3000, // Adjusted navigation speed
//       responsive: {
//           0: {
//               items: 1 // Show 1 item on small screens
//           },
//           600: {
//               items: 2 // Show 2 items on medium screens
//           },
//           1000: {
//               items: 4 // Show 4 items on large screens
//           },
//           1500: {
//             items: 6 // Show 6 items on extra-large screens
//           }
//       }
//   });
// });


// var swiper = new Swiper('.review_section', {
//   loop: true,
//   autoplay: {
//       delay: 5000, // Time between slides (5 seconds)
//       disableOnInteraction: false, // Continue autoplay after user interaction
//   },
//   speed: 3000, // Transition speed (3 seconds)
//   slidesPerView: 1, // Number of slides visible at a time
//   spaceBetween: 0, // Space between slides
//   breakpoints: {
//       600: {
//           slidesPerView: 2, // Show 2 items on medium screens
//       },
//       1000: {
//           slidesPerView: 4, // Show 4 items on large screens
//       },
//       1500: {
//           slidesPerView: 6, // Show 6 items on extra-large screens
//       }
//   }
// });


