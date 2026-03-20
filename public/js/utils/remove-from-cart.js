document.addEventListener("submit", async function (event) {
    const frmDeleteProductBag = event.target.closest(
        "form.frm-delete-product-bag",
    );

    if (frmDeleteProductBag) {
        event.preventDefault();
        const action = frmDeleteProductBag.action;
        const formData = new FormData(frmDeleteProductBag);

        try {
            const response = await fetch(action, {
                method: "DELETE",
                body: formData,
            });

            if (response.status === 200) {
                location.reload();
            } else {
                console.log("Error removing item from cart");
            }
        } catch (error) {
            console.log(error.message);
        }
    }
});
