document.addEventListener("DOMContentLoaded", function () {
    const formsDelete = document.querySelectorAll(".frm-delete");

    formsDelete.forEach((form) => {
        form.addEventListener("submit", (event) => {
            event.preventDefault();

            Swal.fire({
                title: "Você tem certeza?",
                text: "Você não poderá reverter isso!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Excluir",
                cancelButtonText: "Cancelar",
            }).then((result) => {
                if (result.isConfirmed) {
                    event.target.submit();
                }
            });
        });
    });
});
