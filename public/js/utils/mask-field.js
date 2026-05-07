const cepField = document.querySelector(".cep-mask");
if (cepField) {
    const maskOptionsCep = {
        mask: "00000-000",
    };
    const maskCep = IMask(cepField, maskOptionsCep);
}

const phoneField = document.querySelector(".phone-mask");
if (phoneField) {
    const maskOptionsPhone = {
        mask: [
            {
                mask: "(00) 0000-0000", // telefone fixo
            },
            {
                mask: "(00) 00000-0000", // celular
            },
        ],
    };

    IMask(phoneField, maskOptionsPhone);
}

const dddField = document.querySelector(".ddd-mask");
if (dddField) {
    const maskOptionsDdd = {
        mask: "00",
    };
    const maskDdd = IMask(dddField, maskOptionsDdd);
}

const phoneWithoutDddField = document.querySelector(".phone-without-ddd-mask");
if (phoneWithoutDddField) {
    const maskOptionsPhoneWithoutDdd = {
        mask: [
            {
                mask: "0000-0000", // telefone fixo
            },
            {
                mask: "00000-0000", // celular
            },
        ],
    };
    const maskPhoneWithoutDdd = IMask(
        phoneWithoutDddField,
        maskOptionsPhoneWithoutDdd,
    );
}

const dateField = document.querySelector(".date-mask");
if (dateField) {
    const maskOptionsDate = {
        mask: "00/00/0000",
    };
    const maskDate = IMask(dateField, maskOptionsDate);
}

const cpfField = document.querySelector(".cpf-mask");
if (cpfField) {
    const maskOptionsCpf = {
        mask: "000.000.000-00",
    };
    const maskDate = IMask(cpfField, maskOptionsCpf);
}

const cnpjField = document.querySelector(".cnpj-mask");
if (cnpjField) {
    const maskOptionsCpf = {
        mask: "00.000.000/0000-00",
    };
    const maskDate = IMask(cnpjField, maskOptionsCpf);
}

const creditCardField = document.querySelector(".credit-card-mask");
if (creditCardField) {
    const maskOptionsCreditCard = {
        mask: "0000 0000 0000 0000",
    };
    const maskCreditCard = IMask(creditCardField, maskOptionsCreditCard);
}

const onlyNumberFields = document.querySelectorAll(".only-number");
if (onlyNumberFields) {
    onlyNumberFields.forEach((field) => {
        field.addEventListener("input", function () {
            this.value = this.value.replace(/\D/g, "");
        });
    });
}
