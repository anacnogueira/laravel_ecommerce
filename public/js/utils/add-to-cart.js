document.addEventListener("DOMContentLoaded", function () {
    const frmAddToCart = document.querySelector("#frm-add-to-cart");

    if (frmAddToCart) {
        frmAddToCart.addEventListener("submit", async (event) => {
            event.preventDefault();

            const quantity = frmAddToCart.elements.quantity;

            const divResponseQuantity =
                document.querySelector("#quantity-error");

            cleanErrors();

            const formData = new FormData(frmAddToCart);
            const values = Object.fromEntries(formData.entries());
            const action = frmAddToCart.action;

            try {
                const response = await fetch(action, {
                    method: "POST",
                    body: JSON.stringify(values),
                    headers: {
                        "Content-Type": "application/json",
                    },
                });

                const data = await response.json();

                if (response.status === 201) {
                    window.scrollTo({
                        top: 0,
                        behavior: "smooth",
                    });
                    showHideMiniBag(true);
                } else if (response.status === 422) {
                    for (const [key, value] of Object.entries(data)) {
                        if (key == "quantity") {
                            quantity.classList.add("is-invalid");
                            divResponseQuantity.innerText = value;
                            divResponseQuantity.classList.add("alert-danger");
                        }
                    }
                } else {
                }
            } catch (error) {
                console.log(error.message);
            }

            function cleanErrors() {
                quantity.classList.remove("is-invalid");

                divResponseQuantity.innerText = "";
                divResponseQuantity.classList.remove("alert-danger");
            }
        });
    }

    const btnMiniBag = document.querySelector("#btn-mini-cart");
    const divMiniBag = document.querySelector("#div-mini-cart");

    // Evento de clique no botão
    btnMiniBag.addEventListener("click", (event) => {
        event.stopPropagation();
        showHideMiniBag();
    });

    // Criamos uma função separada para você poder chamar ao adicionar itens
    async function showHideMiniBag(forceOpen = false) {
        const action = "/api/carts/show-cart";

        try {
            const response = await fetch(action);
            const data = await response.json();

            if (response.status === 200) {
                divMiniBag.innerHTML = data.renderHTML;

                // Se já está visível e não estamos forçando a abertura -> FECHAR
                if (divMiniBag.classList.contains("is-visible") && !forceOpen) {
                    divMiniBag.style.maxHeight = "0";
                    divMiniBag.style.opacity = "0";

                    setTimeout(() => {
                        divMiniBag.classList.remove("is-visible");
                        divMiniBag.style.display = "none";
                    }, 1000); // Tempo igual ao da transition
                }
                // Caso contrário -> ABRIR
                else {
                    divMiniBag.style.display = "block";

                    // O segredo: um micro-delay para o display:block ser processado
                    setTimeout(() => {
                        divMiniBag.classList.add("is-visible");
                        // Usar scrollHeight garante que ele abra no tamanho exato do conteúdo
                        divMiniBag.style.maxHeight =
                            divMiniBag.scrollHeight + 100 + "px";
                        divMiniBag.style.opacity = "1";
                    }, 10);
                }
            }
        } catch (error) {
            console.error(error.message);
        }
    }
});
