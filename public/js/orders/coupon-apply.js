const btnApplyCoupon = document.querySelector("#applyCoupon");
const inputCouponCode = document.querySelector("#couponCode");
const couponStatus = document.querySelector("#couponStatus");

btnApplyCoupon.addEventListener("click", async (event) =>{
    couponStatus.innerHTML = "";
    couponStatus.className = "";

    if (inputCouponCode.value.trim() == "") {
        inputCouponCode.classList.add("is-invalid");
        couponStatus.classList.add('alert-danger');
        couponStatus.innerHTML = "O campo é obrigatório";
        return;
    }

    const action = "/api/coupons/apply";
    const formData = {
        code: inputCouponCode.value,
        subtotal: getSubtotal()
    };

    try {

        const response = await fetch(action, {
            method: "POST",
            body: JSON.stringify(formData),
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
            },
        });

        const data = await response.json();
        if (response.status === 200) {
            setDiscount(data.discount);

            const newTotal = getSubtotal() + getShipping() - getDiscount();
            setTotal (newTotal);

            couponStatus.classList.add('alert-success');
            couponStatus.innerHTML = "Cupom aplicado com sucesso";
        } else if (response.status === 422) {

            for (const [key, value] of Object.entries(data.errors)) {
                if (key == "code") {
                    inputCouponCode.classList.add("is-invalid");
                    couponStatus.classList.add('alert-danger');
                    couponStatus.innerText = value;
                }
            }
        }

    } catch (error) {
        console.log(error);
    }


})
