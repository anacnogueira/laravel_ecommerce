document.addEventListener("DOMContentLoaded", function () {
    const typePersonRadios = document.querySelectorAll(
        'input[name="type_person"]',
    );

    const typePersonChecked = document.querySelector(
        'input[name="type_person"]:checked',
    );

    const frmFields = document.getElementById("frm-fields");
    const labelName = document
        .querySelector('input[name="name"]')
        .parentElement.parentElement.querySelector("label");
    const divFantasyName = document.getElementById("div-fantasy-name");
    const divCpf = document.getElementById("div-cpf");
    const divCnpj = document.getElementById("div-cnpj");
    const divIe = document.getElementById("div-ie");
    const divGender = document.getElementById("div-gender");
    const divDateBirth = document.getElementById("div-date-birth");

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
        divCpf.style.display = "block";
        divCnpj.style.display = "none";
        divIe.style.display = "none";
        divGender.style.display = "block";
        divDateBirth.style.display = "block";
    }

    function configurePjFields() {
        frmFields.style.display = "block";
        labelName.innerText = "Razão Social:*";
        divFantasyName.style.display = "block";
        divCpf.style.display = "none";
        divCnpj.style.display = "block";
        divIe.style.display = "block";
        divGender.style.display = "none";
        divDateBirth.style.display = "none";
    }
});
