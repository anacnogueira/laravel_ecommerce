document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".payment-radio").forEach((radio) => {
        radio.addEventListener("change", (e) => {
            if (e.target.checked) {
                const paymentMethod = e.target.dataset.value;
                if (paymentMethod === "creditCard") {
                    const inputCardNumber =
                        document.getElementById("cardNumber");

                    inputCardNumber.addEventListener(
                        "input",
                        async function () {
                            const cardNumberValue =
                                inputCardNumber.value.replace(/ /g, "");
                            identifyBrand(cardNumberValue);
                        },
                    );
                }
            }
        });
    });

    const inputInstallments = document.getElementById("installmentQuantity");
    const installment = document.getElementById("installmentValue");

    inputInstallments.addEventListener("change", function () {
        var optionSelected = this.value;
        if (optionSelected.length && optionSelected.value !== 0) {
            installment.value = optionSelected;
        }
    });

    document.querySelectorAll("input[name='holder_type']").forEach((radio) => {
        radio.addEventListener("change", async (e) => {
            if (e.target.checked) {
                if (e.target.value === "sameHolder") {
                    const url = "/api/customers/get-buyer-information/";
                    const response = await fetch(url, {
                        method: "GET",
                        headers: {
                            "Content-Type": "application/json",
                        },
                    });

                    const data = await response.json();

                    if (response.status === 200) {
                        document.getElementById("creditCardHolderName").value =
                            data.name;
                        document.getElementById("creditCardHolderCPF").value =
                            data.cpf;
                        document.getElementById(
                            "creditCardHolderAreaCode",
                        ).value = data.ddd;
                        document.getElementById("creditCardHolderPhone").value =
                            data.phone;
                        document.getElementById(
                            "creditCardHolderBirthDate",
                        ).value = data.date_birth;
                        document.getElementById("creditCardHolderEmail").value =
                            data.email;
                    }
                } else {
                    document.getElementById("creditCardHolderName").value = "";
                    document.getElementById("creditCardHolderCPF").value = "";
                    document.getElementById("creditCardHolderAreaCode").value =
                        "";
                    document.getElementById("creditCardHolderPhone").value = "";
                    document.getElementById("creditCardHolderBirthDate").value =
                        "";
                    document.getElementById("creditCardHolderEmail").value = "";
                    document.getElementById("creditCardHolderName").focus();
                }
            }
        });
    });
});

async function identifyBrand(cardNumber) {
    try {
        const amountValue =
            document.getElementById("total-amount").dataset.total * 100;

        const brand =
            await EfiPay.CreditCard.setCardNumber(cardNumber).verifyCardBrand();
        document.getElementById("credit-card-brand").value = brand;

        getInstallments(brand, parseInt(amountValue));
    } catch (error) {
        console.log("Código: ", error.code);
        console.log("Nome: ", error.error);
        console.log("Mensagem: ", error.error_description);
    }
}

async function getInstallments(brand, amount) {
    const installmentsWrapper = document.getElementById("installmentsWrapper");
    const inputInstallments = document.getElementById("installmentQuantity");

    try {
        const resultInstallments = await EfiPay.CreditCard.setAccount(
            EFI_ACCOUNT_IDENTIFIER,
        )
            .setEnvironment(EFI_ENVIRONMENT)
            .setBrand(brand)
            .setTotal(amount)
            .getInstallments()
            .then((installments) => {
                let options =
                    '<option value="0">Escolha como deseja pagar</option>';

                for (
                    let index = 0;
                    index < installments.installments.length;
                    index++
                ) {
                    options += `<option value="${
                        installments.installments[index].installment
                    }">${installments.installments[index].installment} x de R$${
                        installments.installments[index].currency
                    } ${
                        installments.installments[index].has_interest === false
                            ? "sem juros"
                            : ""
                    }</option>`;
                }

                installmentsWrapper.style.display = "block";
                inputInstallments.innerHTML = options;
            })
            .catch((err) => {
                console.log("Erro Obter Parcelas");
                console.log("Código: ", err.code);
                console.log("Nome: ", err.error);
                console.log("Mensagem: ", err.error_description);
            });
    } catch (error) {
        console.log(error);
        console.log("Erro Obter Parcelas");
        console.log("Código: ", error.code);
        console.log("Nome: ", error.error);
        console.log("Mensagem: ", error.error_description);
    }
}

async function generatePaymentToken() {
    const brand = document.getElementById("credit-card-brand").value;
    const number = document.getElementById("cardNumber").value;
    const cvv = document.getElementById("cardCvv").value;
    const expirationMonth = document.getElementById(
        "cardExpirationMonth",
    ).value;
    const expirationYear = document.getElementById("cardExpirationYear").value;
    const holderName = document.getElementById("creditCardHolderName").value;
    const holderDocument = document.getElementById("creditCardHolderCPF").value;
    const reuse = false;
    const btnSubmit = document.getElementById("creditCardButton");
    const inputPaymentToken = document.getElementById("payment-token");
    const inputCardMask = document.getElementById("card-mask");

    try {
        btnSubmit.disabled = true;
        btnSubmit.innerHTML =
            '<div class="spinner-border spinner-border-sm text-info" role="status"> <span class="visually-hidden">Carregando...</span></div>';

        const resultPaymentToken = await EfiPay.CreditCard.setEnvironment(
            EFI_ENVIRONMENT,
        )
            .setAccount(EFI_ACCOUNT_IDENTIFIER)
            .setCreditCardData({
                brand,
                number,
                cvv,
                expirationMonth,
                expirationYear,
                holderName,
                holderDocument,
                reuse,
            })
            .getPaymentToken()
            .then((data) => {
                const payment_token = data.payment_token;
                const card_mask = data.card_mask;
                inputPaymentToken.value = payment_token;
                inputCardMask.value = card_mask;

                document.getElementById("frm-checkout").submit();
            })
            .catch((err) => {
                console.log("Erro Obter payment_token");
                console.log("Código: ", err.code);
                console.log("Nome: ", err.error);
                console.log("Mensagem: ", err.error_description);
            });
    } catch (error) {
        console.log(
            `Erro ao buscar ao gerar o payment_token!\n\nCódigo: ${error.code}\nNome: ${error.error}\nMensagem: ${error.error_description}`,
        );
        btnSubmit.disabled = false;
        throw new Error(`Something went wrong.\n ${error}`);
        return false;
    }
}
