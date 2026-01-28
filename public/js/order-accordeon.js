const orders = document.querySelectorAll(".order-number");

orders.forEach((question) => {
    question.addEventListener("click", () => {
        const item = question.parentElement;
        const detail = item.querySelector(".order-detail");
        const isOpen = item.classList.contains("active");

        document.querySelectorAll(".order-item").forEach((otherItem) => {
            otherItem.classList.remove("active");
            otherItem.querySelector(".order-detail").style.maxHeight = null;
        });

        if (!isOpen) {
            item.classList.add("active");
            detail.style.maxHeight = answer.scrollHeight + "px";
        }
    });
});
