const divSubtotalAmount = document.querySelector("#subtotal-amount");
const divShippingAmount = document.querySelector("#shipping-amount");
const divDiscountAmount = document.querySelector("#discount-amount");
const divTotalAmount = document.querySelector("#total-amount");

function setSubtotal (amount) {
    amount = parseFloat(amount);
    divSubtotalAmount.dataset.subtotal = amount
    divSubtotalAmount.textContent = `R$ ${amount.toLocaleString(
        "pt-BR",
        {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
        },
    )}`;
}

function setShipping (amount) {
    amount = parseFloat(amount);
    divShippingAmount.dataset.shipping = amount
    divShippingAmount.textContent = `R$ ${amount.toLocaleString(
        "pt-BR",
        {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
        },
    )}`;
}

function setDiscount (amount) {
    amount = parseFloat(amount);
    divDiscountAmount.dataset.discount = amount
    divDiscountAmount.textContent = `R$ ${amount.toLocaleString(
        "pt-BR",
        {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
        },
    )}`;
}

function setTotal (amount) {
    amount = parseFloat(amount);
    divTotalAmount.dataset.total = amount
    divTotalAmount.textContent = `R$ ${amount.toLocaleString(
        "pt-BR",
        {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
        },
    )}`;
}

function getSubtotal() {
    return parseFloat(divSubtotalAmount.dataset.subtotal);
}

function getShipping() {
    return parseFloat(divShippingAmount.dataset.shipping);
}

function getDiscount() {
    return parseFloat(divDiscountAmount.dataset.discount);
}

function getTotal() {
    return parseFloat(divTotalAmount.dataset.total);
}

