document.addEventListener("DOMContentLoaded", function () {
    const frmShippingCalculate = document.querySelector(
        "#frm-shipping-calculate",
    );

    frmShippingCalculate.addEventListener("submit", async (event) => {
        event.preventDefault();

        const formData = new FormData(frmShippingCalculate);
        const values = Object.fromEntries(formData.entries());
        const action = event.target.action;

        try {
            const response = await fetch(action, {
                method: "POST",
                body: JSON.stringify(values),
                headers: {
                    "Content-Type": "application/json",
                },
            });

            const data = await response.json();

            if (response.status === 200) {
                const shippings = data.original.shippings;
                const shippingsSize = shippings.length;
                const divShippingInfo =
                    document.querySelector("#shipping-info");

                const table = document.querySelector("#tbl-shipping-info");
                const tableBody = table.querySelector("tbody");
                const divError = document.querySelector("#shipping-error");
                tableBody.innerText = "";
                divError.innerText = "";

                if (shippingsSize > 0) {
                    shippings.forEach((shipping) => {
                        const newRow = tableBody.insertRow();
                        valorFrete = shipping.valorFrete.toLocaleString(
                            "pt-BR",
                            {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2,
                            },
                        );
                        deliveryTime =
                            shipping.PrazoEntrega == 1
                                ? `${shipping.PrazoEntrega} dia útil`
                                : `${shipping.PrazoEntrega} dias úteis`;

                        if (values["page"] === "cart-view") {
                            newRow.insertCell().innerHTML = `<input type='radio' name='shipping' value='${shipping.valorFrete}' />`;
                        }
                        newRow.insertCell().textContent = shipping.nome;
                        newRow.insertCell().textContent = `R$ ${valorFrete}`;
                        newRow.insertCell().textContent = deliveryTime;
                    });

                    divShippingInfo.style.display = "block";
                    table.style.display = "table";
                    divError.style.display = "none";
                } else {
                    divShippingInfo.style.display = "block";
                    table.style.display = "none";
                    divError.innerText = "Daddos Inválidos";
                    divError.style.display = "block";
                }
            } else if (response.status === 422) {
                console.log("Erro de validação");
            } else {
                console.log("Erro inesperado");
            }
        } catch (error) {
            console.log(error.message);
        }
    });

    document.addEventListener("change", async function (event) {
        const radioShipping = event.target.closest("input[name='shipping']");

        if (radioShipping) {
            event.preventDefault();
            const selectedShipping = radioShipping.value;
            const divShippingAmount =
                document.querySelector("#shipping-amount");
            const divTotalAmount = document.querySelector("#total-amount");

            divShippingAmount.textContent = `R$ ${parseFloat(
                selectedShipping,
            ).toLocaleString("pt-BR", {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2,
            })}`;
            const currentTotal = parseFloat(divTotalAmount.dataset.total);
            const newTotal = currentTotal + parseFloat(selectedShipping);
            divTotalAmount.textContent = `R$ ${newTotal.toLocaleString(
                "pt-BR",
                {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2,
                },
            )}`;
        }
    });
});
