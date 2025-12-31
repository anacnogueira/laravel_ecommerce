document.addEventListener("DOMContentLoaded", function () {
    const buttonAdd = document.getElementById("add-contact");
    buttonAdd.addEventListener("click", addFieldsToTable);

    loadInitialData();
});

let listContacts = [];

function addFieldsToTable(event) {
    event.preventDefault();

    const name = document
        .querySelector('input[name="contact_info_name"]')
        .value.trim();

    const sector = document
        .querySelector('input[name="contact_info_sector"]')
        .value.trim();

    const email = document
        .querySelector('input[name="contact_info_email"]')
        .value.trim();

    const phone = document
        .querySelector('input[name="contact_info_phone"]')
        .value.trim();

    const branchLine = document
        .querySelector('input[name="contact_info_branch_line"]')
        .value.trim();

    const newContact = {
        id: Date.now(),
        name,
        sector,
        email,
        phone,
        branchLine,
    };

    listContacts.push(newContact);

    document.querySelector("#all-contacts-infos").value =
        JSON.stringify(listContacts);

    insertLineTable(newContact);

    cleanFields();
}

/**
 * Cria e insere uma nova linha (<tr>) na tabela HTML.
 * @param {object} contact - O objeto de contato com os dados.
 */
function insertLineTable(contact) {
    const tableBody = document.querySelector("#tbl_contact_infos tbody");

    const newRow = tableBody.insertRow();
    newRow.setAttribute("data-id", contact.id);

    newRow.insertCell().textContent = contact.name;
    newRow.insertCell().textContent = contact.sector;
    newRow.insertCell().textContent = contact.email;
    newRow.insertCell().textContent = contact.phone;
    newRow.insertCell().textContent = contact.branchLine;

    const actionsCell = newRow.insertCell();
    const removeBtn = document.createElement("button");
    removeBtn.innerHTML = "<i class='fa fa-fw fa-lg fa-minus'></i>";
    removeBtn.classList.add("btn");
    removeBtn.classList.add("btn-primary");
    removeBtn.classList.add("btn-sm");
    removeBtn.classList.add("remove-btn");

    removeBtn.onclick = function () {
        removeContactOfTable(contact.id, newRow);
    };

    actionsCell.appendChild(removeBtn);
}

/**
 * Remove o contato do array e da linha da tabela.
 * @param {number} id - O ID único do contato a ser removido.
 * @param {HTMLElement} rowElement - O elemento <tr> a ser removido da DOM.
 */
function removeContactOfTable(id, rowElement) {
    listContacts = listContacts.filter((contact) => contact.id !== id);

    rowElement.remove();
}

function cleanFields() {
    document.querySelector('input[name="contact_info_name"]').value = "";
    document.querySelector('input[name="contact_info_sector"]').value = "";
    document.querySelector('input[name="contact_info_email"]').value = "";
    document.querySelector('input[name="contact_info_phone"]').value = "";
    document.querySelector('input[name="contact_info_branch_line"]').value = "";
}

function loadInitialData() {
    const inputAllContactsInfo = document.querySelector("#all-contacts-infos");
    const valorRaw = inputAllContactsInfo.value;

    try {
        if (valorRaw && valorRaw !== "[]") {
            listContacts = JSON.parse(valorRaw);

            listContacts.forEach((contact, index) => {
                //if (!contact.id) contact.id = Date.now() + index;

                insertLineTable(contact);
            });

            console.log("Contatos carregados do banco:", listContacts.length);
        }
    } catch (e) {
        console.error("Erro ao processar JSON inicial:", e);
    }
}
