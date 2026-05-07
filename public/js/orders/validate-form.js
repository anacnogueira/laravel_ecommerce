frmCheckout = document.getElementById("frm-checkout");

frmCheckout.addEventListener("submit", (e) => {
    e.preventDefault();
    paymentMethod =
        e.submitter.id == "creditCardButton" ? "creditCard" : "others";

    const errors = validate(paymentMethod);

    if (errors.length > 0) {
        showPaymentErrors(errors);
        return false;
    } else {
        if (paymentMethod === "creditCard") {
            const tokenGenerated = generatePaymentToken();
        }

        if (paymentMethod === "others") {
            frmCheckout.submit();
        }
    }
});

function validate(paymentMethod) {
    var errors = [];

    addressId = document.querySelector(
        "input[name='contact_address_id']:checked",
    );
    shipping = document.querySelector("input[name='type_shipping']:checked");
    payment = document.querySelector("input[name='payment_method_id']:checked");

    //Campos comuns
    if (!addressId) {
        errors.push("Escolha o endereço de entrega");
    }

    if (!shipping) {
        errors.push("Selecione o frete");
    }

    if (!payment) {
        errors.push("Nenhuma forma de pagamento selecionada");
    }

    // Cartão de Crédito
    if (paymentMethod === "creditCard") {
        const cardNumber = document.querySelector("#cardNumber").value;
        const cardCvv = document.querySelector("#cardCvv").value;
        const creditCardBrand =
            document.querySelector("#credit-card-brand").value;
        const cardExpirationMonth = document.querySelector(
            "#cardExpirationMonth",
        ).value;
        const cardExpirationYear = document.querySelector(
            "#cardExpirationYear",
        ).value;
        const installmentQuantity = document.querySelector(
            "#installmentQuantity",
        ).value;

        const creditCardHolderName = document.querySelector(
            "#creditCardHolderName",
        ).value;
        const creditCardHolderEmail = document.querySelector(
            "#creditCardHolderEmail",
        ).value;
        const creditCardHolderCPF = document.querySelector(
            "#creditCardHolderCPF",
        ).value;
        const creditCardHolderAreaCode = document.querySelector(
            "#creditCardHolderAreaCode",
        ).value;
        const creditCardHolderPhone = document.querySelector(
            "#creditCardHolderPhone",
        ).value;
        const creditCardHolderBirthDate = document.querySelector(
            "#creditCardHolderBirthDate",
        ).value;

        var date = new Date();
        var month = date.getMonth() + 1;
        var year = date.getFullYear();

        if (!cardNumber) {
            errors.push("Informe o número do cartão de crédito");
        }

        if (cardNumber && !creditCardBrand) {
            errors.push("Cartão de crédito inválido");
        }

        if (!cardCvv || cardCvv.length < 3) {
            errors.push("Código de segurança inválido");
        }

        if (!cardExpirationMonth) {
            errors.push("Informe o mês de expiração do cartão");
        }

        if (!cardExpirationYear) {
            errors.push("Informe o ano de expiração do cartão");
        }

        if (
            (cardExpirationMonth &&
                cardExpirationMonth &&
                year > cardExpirationYear) ||
            (year == cardExpirationYear && month > cardExpirationMonth)
        ) {
            errors.push("Data de expiração inválida.");
        }

        if (!installmentQuantity || installmentQuantity === "0") {
            errors.push("Selecione o parcelamento");
        }

        if (!creditCardHolderName) {
            errors.push("Informe o nome do titular do cartão");
        }

        if (!creditCardHolderCPF || !validateCPF(creditCardHolderCPF)) {
            errors.push("Informe o CPF corretamente");
        }

        if (!creditCardHolderAreaCode) {
            errors.push("Informe o código de area do telefone");
        }

        if (!creditCardHolderPhone) {
            errors.push("Informe o telefone");
        }

        if (!creditCardHolderBirthDate) {
            console.log(creditCardHolderBirthDate);
            errors.push("Informe a data de nascimento corretamente");
        }
    }

    // Boleto
    // Pix

    return errors;
}

function validateCPF(strCPF) {
    var strCPF = strCPF.replace(/[^\d]+/g, "");
    var Resto;
    Soma = 0;

    if (strCPF == "00000000000") return false;

    for (i = 1; i <= 9; i++)
        Soma = Soma + parseInt(strCPF.substring(i - 1, i)) * (11 - i);
    Resto = (Soma * 10) % 11;

    if (Resto == 10 || Resto == 11) Resto = 0;
    if (Resto != parseInt(strCPF.substring(9, 10))) return false;

    Soma = 0;
    for (i = 1; i <= 10; i++)
        Soma = Soma + parseInt(strCPF.substring(i - 1, i)) * (12 - i);
    Resto = (Soma * 10) % 11;

    if (Resto == 10 || Resto == 11) Resto = 0;
    if (Resto != parseInt(strCPF.substring(10, 11))) return false;
    return true;
}

function showPaymentErrors(errors) {
    if (typeof errors == "object") {
        var html = '<ul class="errors">';

        for (i in errors) {
            html += "<li>* " + errors[i] + "</li>";
        }

        html += "</ul>";

        Swal.fire({
            title: "Corrija os erros!",
            html: html,
            type: "error",
            allowEscapeKey: true,
            allowOutsideClick: true,
            input: "hidden",
            customClass: "sweet-alert",
        });
    }
}
