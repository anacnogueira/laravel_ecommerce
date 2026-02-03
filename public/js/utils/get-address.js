import { selectedOption } from "./selected-option.js";

const cepField = document.querySelector("#cep");
const addressField = document.querySelector("#address");
const neighborhoodField = document.querySelector("#neighborhood");

cepField.addEventListener("blur", async (event) => {
    const cepValue = event.target.value.replace(/[^0-9]/gi, "");
    if (cepValue.length != 8) return false;

    const url = `https://viacep.com.br/ws/${cepValue}/json/`;

    try {
        const response = await fetch(url, {
            method: "GET",
            headers: {
                "Content-Type": "application/json",
            },
        });

        const data = await response.json();

        if (response.status === 200) {
            if (!data.erro) {
                addressField.value = data.logradouro;
                neighborhoodField.value = data.bairro;
                selectedOption("#country-id", "Brasil");
                selectedOption("#state-id", data.estado);
                selectedOption("#city-id", data.localidade);
            } else {
                console.log("Erro");
                const spanError = document.createElement("span");
                spanError.textContent =
                    "CEP não encontrado, consultar site dos Correios";
                spanError.classList.add("invalid-feedback", "d-block");

                cepField.parentNode.insertBefore(
                    spanError,
                    cepField.nextSibling,
                );
            }
        }
    } catch (error) {
        console.log(error.message);
    }
});
