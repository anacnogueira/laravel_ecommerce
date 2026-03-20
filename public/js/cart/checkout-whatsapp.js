const btnCheckoutWhatsAppMobile = document.querySelector(
    "#checkout-button-whatsapp-mobile",
);

const btnCheckoutWhatsApp = document.querySelector("#checkout-button-whatsapp");

btnCheckoutWhatsAppMobile.addEventListener("click", (event) => {
    handleCheckoutWhatsApp(event);
});

btnCheckoutWhatsApp.addEventListener("click", (event) => {
    handleCheckoutWhatsApp(event);
});

function handleCheckoutWhatsApp(event) {
    const phone = "5512988681452";
    const cep = document.getElementsByName("cep")[0].value;
    let message = `Olá, gostaria de comprar os produtos do meu carrinho`;
    const carts = JSON.parse(document.getElementById("carts").value);
    console.log(typeof carts);

    if (cep) {
        message += ` e meu CEP é ${cep}`;
    }

    Object.entries(carts).forEach(([productId, cart]) => {
        gift = cart.gift ? " (presente)" : "";
        message += `\n- ${cart.quantity} ${cart.name} ${cart.brand_name} ${gift}`;
    });

    const encodedMessage = encodeURIComponent(message);
    const finalLink = `https://wa.me/${phone}?text=${encodedMessage}`;
    window.open(finalLink, "_blank");
}
