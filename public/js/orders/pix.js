function copy(event) {
    event.preventDefault();
    var copyText = document.querySelector("#pixQrCode");
    copyText.select();
    document.execCommand("copy");

    Swal.fire({
        title: "Código Pix copiado!",
        icon: "success",
        allowEscapeKey: true,
        allowOutsideClick: true,
        position: "top",
    });
}

async function confirmPayment(event) {
    event.preventDefault();

    event.target.disabled = true;
    event.target.innerHTML = "Aguarde ...";

    const orderId = parseInt(document.querySelector("#order-id").innerText);

    const url = `/api/pix/confirm-payment/${orderId}`;
    const response = await fetch(url, {
        method: "GET",
        headers: {
            "Content-Type": "application/json",
        },
    });

    const data = await response.json();

    if (response.status === 200) {
        event.target.disabled = false;
        event.target.innerHTML =
            "<i class='fa fa-check'></i> JÁ REALIZEI O PAGAMENTO";

        Swal.fire({
            title: data.title,
            html: data.text,
            icon: data.type,
            allowEscapeKey: true,
            allowOutsideClick: true,
            position: "top",
        }).then((result) => {
            if (data.type === "success") {
                window.scrollTo({
                    top: 0,
                    behavior: "smooth",
                });
                location.reload();
            }
        });
    } else {
        Swal.fire({
            title: "Não foi possível confirmar o pagamento!",
            type: "error",
            allowEscapeKey: true,
            allowOutsideClick: true,
            position: "top",
        });
    }
}

const pixKeyButtton = document.querySelector("#pixKeyButtton");
const confirmPixPayment = document.querySelector("#confirmPixPayment");

if (confirmPixPayment) {
    confirmPixPayment.addEventListener("click", confirmPayment);
}

if (pixKeyButtton) {
    pixKeyButtton.addEventListener("click", copy);
}
