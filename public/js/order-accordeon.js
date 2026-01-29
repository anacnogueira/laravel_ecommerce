const orders = document.querySelectorAll(".order-number");

orders.forEach((order) => {
    order.addEventListener("click", () => {
        const item = order.parentElement;
        const detail = item.querySelector(".order-detail");
        const isOpen = item.classList.contains("active");

        document.querySelectorAll(".order-item").forEach((otherItem) => {
            otherItem.classList.remove("active");
            otherItem.querySelector(".order-detail").style.maxHeight = null;
        });

        if (!isOpen) {
            item.classList.add("active");
            detail.style.maxHeight = detail.scrollHeight + "px";
        }
    });
});
