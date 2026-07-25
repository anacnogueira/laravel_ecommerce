document.addEventListener("DOMContentLoaded", function () {
    const frmShippingCalculate = document.querySelector(
        "#frm-shipping-calculate",
    );

    if (frmShippingCalculate) {
        frmShippingCalculate.addEventListener("submit", async (event) => {
            event.preventDefault();
            const divShippingOptions =
                document.querySelector("#shipping-options");
            divShippingOptions.innerHTML = "";
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
                    divShippingOptions.innerHTML = data.renderHTML;
                } else if (response.status === 422) {
                    console.log("Erro de validação");
                } else {
                    console.log("Erro inesperado");
                }
            } catch (error) {
                console.log(error.message);
            }
        });
    }

    document.addEventListener("change", async function (event) {
        const radioShipping = event.target.closest(
            "input[name='type_shipping']",
        );

        if (radioShipping) {
            event.preventDefault();
            const valueSelectedShipping = radioShipping.dataset.value;
            const DeliveryTimeSelectedShipping =
                radioShipping.dataset.deliveryTime;
            const divShippingAmount =
                document.querySelector("#shipping-amount");
            const divSubtotalAmount = document.querySelector("#subtotal-amount");
            const divTotalAmount = document.querySelector("#total-amount");
            const inputValueShipping =
                document.querySelector("#value-shipping");
            const inputDeliveryTime = document.querySelector("#delivery-time");

            divShippingAmount.textContent = `R$ ${parseFloat(
                valueSelectedShipping,
            ).toLocaleString("pt-BR", {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2,
            })}`;
            const currentSubTotal = parseFloat(divSubtotalAmount.dataset.subtotal);
            const newTotal = currentSubTotal + parseFloat(valueSelectedShipping);
            divTotalAmount.textContent = `R$ ${newTotal.toLocaleString(
                "pt-BR",
                {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2,
                },
            )}`;

            divTotalAmount.dataset.total = newTotal.toFixed(2);
            inputValueShipping.value = valueSelectedShipping;
            inputDeliveryTime.value = DeliveryTimeSelectedShipping;
        }
    });
});
