import { Modal } from "../Modal.js";

document.addEventListener("DOMContentLoaded", function () {
    const starRatingSelect = document.querySelector("#select-rate");
    const frmProductRate = document.querySelector("#frm-product-rate");
    const divResponseRate = document.querySelector("#response-rate");

    starRatingSelect.addEventListener("change", async (event) => {
        const formData = new FormData(frmProductRate);
        const values = Object.fromEntries(formData.entries());
        const action = frmProductRate.action;

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
                divResponseRate.innerHTML =
                    "<p class='panel success'>Nota computada com sucesso.</p>";
            } else if (response.status === 422) {
                console.log("Erro de validação");
            } else {
                divResponseRate.innerHTML =
                    "<p class='panel alert'>Não foi foi possível salvar seu voto, por favor tenta novamente.</p>";
                console.log("Erro inesperado");
            }
        } catch (error) {
            console.log(error.message);
        }
    });

    const modal = new Modal(
        "#write-comment",
        "#btn-write-comment",
        ".modal-close",
    );
    modal.init();

    const frmProductComment = document.querySelector("#frm-product-comment");

    frmProductComment.addEventListener("submit", async (event) => {
        event.preventDefault();

        const selectRateParent = frmProductComment.elements.rate.parentNode;
        const fieldName = frmProductComment.elements.name;
        const fieldEmail = frmProductComment.elements.email;
        const fieldText = frmProductComment.elements.text;

        const divResponseRate = document.querySelector("#rate-error");
        const divResponseName = document.querySelector("#name-error");
        const divResponseEmail = document.querySelector("#email-error");
        const divResponseText = document.querySelector("#text-error");

        cleanErrors();

        const responseComment = document.querySelector("#response-comment");
        const formData = new FormData(frmProductComment);
        const values = Object.fromEntries(formData.entries());
        const action = frmProductComment.action;

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
                modal.close();
                responseComment.classList.add("panel", "success");
                responseComment.innerText = data.success;
            } else if (response.status === 422) {
                for (const [key, value] of Object.entries(data)) {
                    switch (key) {
                        case "rate":
                            selectRateParent.classList.add("is-invalid");
                            divResponseRate.innerText = value;
                            divResponseRate.classList.add("alert-danger");
                            break;
                        case "name":
                            fieldName.classList.add("is-invalid");
                            divResponseName.innerText = value;
                            divResponseName.classList.add("alert-danger");
                            break;
                        case "email":
                            fieldEmail.classList.add("is-invalid");
                            divResponseEmail.innerText = value;
                            divResponseEmail.classList.add("alert-danger");
                            break;
                        case "text":
                            fieldText.classList.add("is-invalid");
                            divResponseText.innerText = value;
                            divResponseText.classList.add("alert-danger");
                            break;
                    }
                }
            } else {
                modal.close();
                divResponseRate.classList.add("panel", "alert");
                responseComment.innerText = data.error;
            }
        } catch (error) {
            console.log(error.message);
        }

        function cleanErrors() {
            selectRateParent.classList.remove("is-invalid");

            if (fieldName) {
                fieldName.classList.remove("is-invalid");
            }

            if (fieldEmail) {
                fieldEmail.classList.remove("is-invalid");
            }

            fieldText.classList.remove("is-invalid");

            divResponseRate.innerText = "";
            divResponseRate.classList.remove("alert-danger");

            if (divResponseName) {
                divResponseName.innerText = "";
                divResponseName.classList.remove("alert-danger");
            }

            if (divResponseEmail) {
                divResponseEmail.innerText = "";
                divResponseEmail.classList.remove("alert-danger");
            }

            divResponseText.innerText = "";
            divResponseText.classList.remove("alert-danger");
        }
    });
});
