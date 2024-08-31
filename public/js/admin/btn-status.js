document.addEventListener("DOMContentLoaded", function () {
    const elements = document.querySelectorAll(".status-change");
    const url = "../api/admin/status-change";
    elements.forEach((item) => {
        item.addEventListener("click", async (event) => {
            let inputCheckbox =
                event.target.parentNode.parentNode.querySelector(
                    "input[type=checkbox]"
                );

            let table = inputCheckbox.dataset.table;

            let status = "";
            if (table == "payment_gateways") {
                status = inputCheckbox.checked == true ? 0 : 1;
            } else {
                status = inputCheckbox.checked == true ? "N" : "S";
            }

            formData = {
                table,
                status,
                id: inputCheckbox.dataset.id,
            };

            try {
                const response = await fetch(url, {
                    method: "POST",
                    body: JSON.stringify(formData),
                    headers: {
                        "Content-Type": "application/json",
                    },
                });

                const data = await response.json();

                if (response.status === 200) {
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
});
