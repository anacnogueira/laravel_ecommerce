$(document).ready(function () {
    const disabled = !$("#city-id").val() ? true : false;
    get_cities($("#state-id"), $("#city-id"), "", disabled);

    $("#state-id").change(function () {
        get_cities($("#state-id"), $("#city-id"));
    });

    //Frete grátis
    ShippingFree($("#free").is(":checked"));

    $("#free").click(function () {
        ShippingFree($(this).is(":checked"));
    });
});

function ShippingFree(checked) {
    if ($("#price").val() == "0,00") {
        $("#free").attr("checked", true);
    }

    if (checked == true) {
        $("#price").val("0,00");
    }
}
