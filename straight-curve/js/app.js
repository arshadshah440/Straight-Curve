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
