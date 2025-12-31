const btnWhatsApp = document.querySelector(".btn-whatsapp");

if (btnWhatsApp) {
    btnWhatsApp.addEventListener("click", (event) => {
        const phone = "5512988681452";
        const quantity = document.getElementById("quantity").value;
        const unity = quantity > 1 ? "unidades" : "unidade";
        const productName = document.getElementById("product-name").innerText;
        const brandName =
            document.getElementById("product-brand-name").innerText;
        const message = `Olá, gostaria de comprar ${quantity} ${unity} de ${productName} ${brandName}`;

        if (quantity == 0 || quantity == "") {
            alert("Selecione a quantidade desejada");
            return;
        }

        const encodedMessage = encodeURIComponent(message);
        const finalLink = `https://wa.me/${phone}?text=${encodedMessage}`;
        window.open(finalLink, "_blank");
    });
}
