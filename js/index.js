document.addEventListener("DOMContentLoaded", function () {
  const toggleSubmenuButtons = document.querySelectorAll(".toggle-submenu");
  const toggleMenuButton = document.querySelector(".toggle-menu");
  const submenu = document.querySelector(".main_bar_menu.submenu");
  const submenuCloseButton = document.querySelector(".submenu_close");
  const menuTitleItems = document.querySelectorAll(".main_bar_menu_title li");
  const menuList = document.querySelector(".main_bar_menu_list");
  const backButton = document.querySelector(".back-button");

  toggleSubmenuButtons.forEach((button) => {
    button.addEventListener("click", (event) => {
      event.preventDefault();
      submenu.classList.toggle("show");
    });
  });

  if (toggleMenuButton) {
    toggleMenuButton.addEventListener("click", (event) => {
      event.preventDefault();
      submenu.classList.toggle("show");
    });
  }

  submenuCloseButton.addEventListener("click", (event) => {
    event.preventDefault();
    submenu.classList.remove("show");
  });

  menuTitleItems.forEach((item) => {
    item.addEventListener("click", (event) => {
      event.preventDefault();
      menuList.classList.add("show"); // Hiển thị menu list
      submenu.querySelector(".main_bar_menu_title").classList.add("hide"); // Ẩn menu title
    });
  });

  backButton.addEventListener("click", (event) => {
    event.preventDefault();
    menuList.classList.remove("show"); // Ẩn menu list
    submenu.querySelector(".main_bar_menu_title").classList.remove("hide"); // Hiển thị menu title
  });
});
