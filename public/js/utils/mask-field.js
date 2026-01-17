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
        // dispatch: function (appended, dynamicMasked) {
        //     const number = (dynamicMasked.value + appended).replace(/\D/g, "");

        //     return number.length > 10
        //         ? dynamicMasked.compiledMasks[1] // celular
        //         : dynamicMasked.compiledMasks[0]; // fixo
        // },
    };

    IMask(phoneField, maskOptionsPhone);
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
