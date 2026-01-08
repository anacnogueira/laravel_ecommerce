document.addEventListener("DOMContentLoaded", function () {
    const buttonAdd = document.getElementById("add-event-date");
    buttonAdd.addEventListener("click", addFieldsToTable);

    loadInitialData();
});

let listDates = [];

function addFieldsToTable(event) {
    event.preventDefault();

    const start_date = document
        .querySelector('input[name="start_date"]')
        .value.trim();

    const start_hour = document
        .querySelector('input[name="start_hour"]')
        .value.trim();

    const end_date = document
        .querySelector('input[name="end_date"]')
        .value.trim();

    const end_hour = document
        .querySelector('input[name="end_hour"]')
        .value.trim();

    const newEventDate = {
        id: Date.now(),
        start_date,
        start_hour,
        end_date,
        end_hour,
    };

    listDates.push(newEventDate);

    document.querySelector("#all-event-dates").value =
        JSON.stringify(listDates);

    insertLineTable(newEventDate);

    cleanFields();
}

/**
 * Cria e insere uma nova linha (<tr>) na tabela HTML.
 * @param {object} eventDate - O objeto de contato com os dados.
 */
function insertLineTable(eventDate) {
    const tableBody = document.querySelector("#tbl_event_dates tbody");

    const newRow = tableBody.insertRow();
    newRow.setAttribute("data-id", eventDate.id);

    newRow.insertCell().textContent = eventDate.start_date;
    newRow.insertCell().textContent = eventDate.start_hour;
    newRow.insertCell().textContent = eventDate.end_date;
    newRow.insertCell().textContent = eventDate.end_hour;

    const actionsCell = newRow.insertCell();
    const removeBtn = document.createElement("button");
    removeBtn.innerHTML = "<i class='fa fa-fw fa-lg fa-minus'></i>";
    removeBtn.classList.add("btn");
    removeBtn.classList.add("btn-primary");
    removeBtn.classList.add("btn-sm");
    removeBtn.classList.add("remove-btn");

    removeBtn.onclick = function () {
        removeDateOfTable(eventDate.id, newRow);
    };

    actionsCell.appendChild(removeBtn);
}

/**
 * Remove a data do evento do array e da linha da tabela.
 * @param {number} id - O ID único da data a ser removida.
 * @param {HTMLElement} rowElement - O elemento <tr> a ser removido da DOM.
 */
function removeDateOfTable(id, rowElement) {
    listDates = listDates.filter((dateEvent) => dateEvent.id !== id);

    rowElement.remove();
}

function cleanFields() {
    document.querySelector('input[name="start_date"]').value = "";
    document.querySelector('input[name="start_hour"]').value = "";
    document.querySelector('input[name="end_date"]').value = "";
    document.querySelector('input[name="end_hour"]').value = "";
}

function loadInitialData() {
    const inputAllContactsInfo = document.querySelector("#all-event-dates");
    const valorRaw = inputAllContactsInfo.value;

    try {
        if (valorRaw && valorRaw !== "[]") {
            listDates = JSON.parse(valorRaw);

            listDates.forEach((eventDate, index) => {
                insertLineTable(eventDate);
            });
        }
    } catch (e) {
        console.error("Erro ao processar JSON inicial:", e);
    }
}
