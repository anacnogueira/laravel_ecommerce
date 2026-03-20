const inputQuantity = document.querySelectorAll(".input-quantity");
const frmCartUpdate = document.querySelector("#frm-cart-update");
const giftCheckboxes = document.querySelectorAll("input[type='checkbox']");

giftCheckboxes.forEach((checkbox) => {
    checkbox.addEventListener("change", (event) => {
        frmCartUpdate.submit();
    });
});

inputQuantity.forEach((input) => {
    input.addEventListener("input", (event) => {
        if (event.target.value !== "") {
            frmCartUpdate.submit();
        }
    });
});
