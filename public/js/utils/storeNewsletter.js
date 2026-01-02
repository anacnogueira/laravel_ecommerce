export function storeNewsletter(formElement) {
    formElement.addEventListener("submit", async (event) => {
        event.preventDefault();
        const action = event.target.action;
        const formData = new FormData(event.target);
        const email = document.getElementById("email-newsletter");
        const divResponse = event.target.nextElementSibling;

        email.classList.remove("is-invalid");
        divResponse.classList.remove("alert-success", "alert-danger");
        divResponse.innerText = "";

        try {
            const response = await fetch(action, {
                method: "POST",
                body: JSON.stringify({
                    email: email.value,
                }),
                headers: {
                    "Content-Type": "application/json",
                },
            });

            const data = await response.json();

            if (response.status === 201) {
                divResponse.classList.add("alert-success");
                divResponse.innerText = data;
                formElement.reset();
            } else if (response.status === 422) {
                email.classList.add("is-invalid");
                divResponse.classList.add("alert-danger");
                divResponse.innerText = data.email;
            } else {
                divResponse.classList.add("alert-danger");
                divResponse.innerTex =
                    "Houve um erro inesperado, por favor tente novamente mais tarde";
            }
        } catch (error) {
            console.log(error.message);
        }
    });
}
