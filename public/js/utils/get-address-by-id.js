const radioAddressesId = document.querySelectorAll("[name='address_id']");

radioAddressesId.forEach((addressId) => {
    addressId.addEventListener("change", async (event) => {
        const id = event.target.value;
        const url = "/api/addresses/set-order-default/" + id;

        try {
            const response = await fetch(url, {
                method: "GET",
                headers: {
                    "Content-Type": "application/json",
                },
            });

            const data = await response.json();

            if (response.status === 200) {
                window.location.href = "/checkout";
            }
        } catch (error) {
            console.log(error.message);
        }
    });
});
