const ordersItems = document.querySelectorAll(".item-product");

ordersItems.forEach((orderItem) => {
    orderItem.addEventListener("click", () => {
        const item = orderItem.parentElement;
        const detail = item.querySelector(".item-product-detail");
        const isOpen = item.classList.contains("active");

        document.querySelectorAll(".order-item-item").forEach((otherItem) => {
            otherItem.classList.remove("active");
            otherItem.querySelector(".item-product-detail").style.maxHeight =
                null;
        });

        if (!isOpen) {
            item.classList.add("active");
            detail.style.maxHeight = answer.scrollHeight + "px";
        }
    });
});
