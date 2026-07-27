document.addEventListener("DOMContentLoaded", function () {
    const frmProductNotification = document.querySelector(
        "#product-notification"
    );

    frmProductNotification.addEventListener("submit", async (event) => {
        event.preventDefault();
        const action = event.target.action;
        const productId = document.querySelector("#product-id");
        const token = document.querySelector("input[name='_token']");
        const name = document.querySelector("#name");
        const email = document.querySelector("#email");

        formData = {
            name: name.value,
            email: email.value,
            product_id: productId.value,
            _token: token.value
        };

        try {
            const response = await fetch(action, {
                method: "POST",
                body: JSON.stringify(formData),
                headers: {
                    "Content-Type": "application/json",
                },
            });

            const data = await response.json();

            if (response.status === 201) {
                alert("Formulário enviado");
                frmProductNotification.reset();
            } else if (response.status === 422) {
                console.log("Erro de validação");
            } else {
                console.log("Erro inesperado");
            }
        } catch (error) {
            console.log(error.message);
        }
    });
});
