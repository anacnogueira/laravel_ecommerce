const btnWhatsApp = document.querySelector(".btn-whatsapp");

if (btnWhatsApp) {
    btnWhatsApp.addEventListener("click", (event) => {
        const phone = "5512988681452";
        const keyword = document.getElementById("result-keyword").innerText;
        console.log(keyword);

        const message = `Olá, estou procurando por ${keyword} no site mas não achei o que estou buscando`;

        const encodedMessage = encodeURIComponent(message);
        const finalLink = `https://wa.me/${phone}?text=${encodedMessage}`;
        window.open(finalLink, "_blank");
    });
}
