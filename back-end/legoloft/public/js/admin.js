var alertMessage = document.getElementById("alert-message");
if (alertMessage) {
    setTimeout(() => {
        alertMessage.classList.add("fade-out-left");
        setTimeout(() => {
            alertMessage.style.display = "none";
        }, 500);
    }, 3000);
}

/*--------------------------------------------------------------------------------------------------------------------------------------------------------------------*/

const sidebarItems = document.querySelectorAll(".sidebar-item");

sidebarItems.forEach((item) => {
    item.addEventListener("click", () => {
        // Xóa lớp active từ tất cả các mục
        sidebarItems.forEach((el) => el.classList.remove("active"));

        // Thêm lớp active cho mục hiện tại
        item.classList.add("active");
    });
});

/*--------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
