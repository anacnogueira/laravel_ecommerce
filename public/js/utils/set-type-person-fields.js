document.addEventListener("DOMContentLoaded", function () {
    const typePersonRadios = document.querySelectorAll(
        'input[name="type_person"]'
    );

    const typePersonChecked = document.querySelector(
        'input[name="type_person"]:checked'
    );

    const frmFields = document.getElementById("frm-fields");
    const labelName =
        document.querySelector('input[name="name"]').previousElementSibling;
    const divFantasyName = document.getElementById("div-fantasy-name");
    const divCpf = document.getElementById("div-cpf");
    const divCnpj = document.getElementById("div-cnpj");
    const divIe = document.getElementById("div-ie");
    const divGender = document.getElementById("div-gender");
    const DivDateBirth = document.getElementById("div-date-birth");

    if (typePersonChecked) {
        selectedValue = typePersonChecked.value;
        verifySelectedPerson(selectedValue);
    }

    typePersonRadios.forEach((typePerson) => {
        typePerson.addEventListener("change", function () {
            const selectedValue = this.value;
            verifySelectedPerson(selectedValue);
        });
    });

    function verifySelectedPerson(valueField) {
        if (valueField === "pf") {
            configurePfFields();
        }

        if (valueField === "pj") {
            configurePjFields();
        }
    }

    function configurePfFields() {
        frmFields.style.display = "block";
        labelName.innerText = "Nome Completo:*";
        divFantasyName.style.display = "none";
        divCpf.style.display = "flex";
        divCnpj.style.display = "none";
        divIe.style.display = "none";
        divGender.style.display = "block";
        DivDateBirth.style.display = "flex";
    }

    function configurePjFields() {
        frmFields.style.display = "block";
        labelName.innerText = "Razão Social:*";
        divFantasyName.style.display = "flex";
        divCpf.style.display = "none";
        divCnpj.style.display = "flex";
        divIe.style.display = "flex";
        divGender.style.display = "none";
        DivDateBirth.style.display = "none";
    }
});
