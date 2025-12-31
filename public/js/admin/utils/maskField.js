$(".cnpj").inputmask({
    mask: ["99.999.999/9999-99"],
    keepStatic: true,
    clearIncomplete: true,
});

$(".phone").inputmask({
    // duas máscaras possíveis: 14 dígitos (DDD+4+4+4) ou 15 dígitos (DDD+5+4+4)
    mask: ["(99) 9999-9999", "(99) 99999-9999"],
    keepStatic: true, // mantém estática a escolha até o último dígito ser digitado
    clearIncomplete: false, // permite apagar e recomeçar sem travar
    showMaskOnHover: false,
    showMaskOnFocus: true,
});

$(".cep").inputmask({
    mask: ["99999-999"],
    keepStatic: true,
    clearIncomplete: true,
});

$(".float").inputmask("decimal", {
    digits: 3,
    digitsOptional: false,
    placeholder: "0,000",
    autoGroup: true,
    groupSeparator: ".",
    radixPoint: ",",
    unmaskAsNumber: true,
    removeMaskOnSubmit: true,
    rightAlign: false,
    numericInput: false,
    onBeforeMask: function (value, opts) {
        return value.replace(".", ",");
    },
});

$(".money").inputmask("currency", {
    radixPoint: ",",
    groupSeparator: ".",
    allowMinus: false,
    digits: 2,
    digitsOptional: false,
    placeholder: "0,00",
    rightAlign: false,
    unmaskAsNumber: true,
    removeMaskOnSubmit: true,
    numericInput: true,
});
