$(document).ready(function () {
    const disabled = !$("#city-id").val() ? true : false;
    get_cities($("#state-id"), $("#city-id"), "", disabled);

    $("#state-id").change(function () {
        get_cities($("#state-id"), $("#city-id"));
    });
});
