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

// ------------------------- DETAIL PRODUCT IMAGES -----------------------
// document
//   .querySelectorAll(".detail_product_left_img_item ul li img")
//   .forEach((smallImg) => {
//     smallImg.addEventListener("click", function () {
//       const largeImg = document.querySelector(".detail_product_left_img img");
//       largeImg.computedStyleMap.opacity = 0;
//       setTimeout(() => {
//         largeImg.src = this.src;
//         largeImg.computedStyleMap.opacity = 1;
//       }, 100);
//     });
//   });

const detailImages = document.querySelectorAll(
  ".detail_product_left_img_item ul li img"
);
const largeImg = document.querySelector(".detail_product_left_img img");
let currentIndex = 0;
// hàm cập nhật ảnh lớn
function updateLargeImage(i) {
  largeImg.style.opacity = 0; // ẩn ảnh lớn
  setTimeout(() => {
    largeImg.src = detailImages[i].src; // Thay đổi hình ảnh lớn
    largeImg.style.opacity = 1; // ẩn ảnh lớn
  }, 100);
}

// Sự kiện click vào hình ảnh nhỏ
detailImages.forEach((smallImg, i) => {
  smallImg.addEventListener("click", function () {
    currentIndex = i; // Cập nhật chỉ số hình ảnh hiện tại
    updateLargeImage(currentIndex);
  });
});

//nút lùi
document.getElementById("prevBtn").addEventListener("click", function () {
  currentIndex = currentIndex > 0 ? currentIndex - 1 : detailImages.length - 1;
  updateLargeImage(currentIndex);
});

document.getElementById("nextBtn").addEventListener("click", function () {
  currentIndex = currentIndex < detailImages.length - 1 ? currentIndex + 1 : 0;
  updateLargeImage(currentIndex);
});
