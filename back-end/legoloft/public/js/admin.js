var alertMessage = document.getElementById("alert-message");
if (alertMessage) {
    setTimeout(() => {
        alertMessage.classList.add("fade-out-left");
        setTimeout(() => {
            alertMessage.style.display = "none";
        }, 500);
    }, 3000);
}
