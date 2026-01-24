$(document).ready(function () {
    $("#product-id").change(function () {
        $.ajax({
            type: "GET",
            url: "/api/admin/products/" + $(this).val(),
            async: true,
            processData: true,
            success: function (data) {
                const sellingPrice = data.selling_price.toLocaleString(
                    "pt-BR",
                    {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2,
                    },
                );
                $("#selling-price").val(sellingPrice);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log("Status: " + xhr.status);
                console.log("Message: " + thrownError);
            },
        });
    });

    $("#percent-promotion").keyup($.debounce(250, calculatePercent));

    function calculatePercent() {
        var sellingPrice = parseFloat(
            $("#selling-price").val().replace(/\./g, "").replace(",", "."),
        );

        var percent = parseFloat(
            $(this).val().replace(/\./g, "").replace(",", "."),
        );
        var pricePromotion = $("#price-promotion");
        var total = sellingPrice - (sellingPrice * percent) / 100;
        console.log(sellingPrice);
        console.log(percent);
        pricePromotion.val(
            total.toLocaleString("pt-BR", {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2,
            }),
        );
    }
});
