export function selectedOption(select, value) {
    const options = document.querySelectorAll(select + " option");
    options.forEach(function (option) {
        if (option.textContent.trim() === value.trim()) {
            option.selected = true;
        }
    });
}
