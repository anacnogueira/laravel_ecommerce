function get_cities(state_id, city_id, text) {
    var city_sel = city_id.val();
    var state_sel = state_id.val();
    var dropdownSet = city_id;

    dropdownSet.attr({
        disabled: true,
        tabindex: -1,
        "aria-disabled": true,
    });
    $(dropdownSet).emptySelect();

    if (state_sel != "") {
        dropdownSet.attr({
            disabled: false,
            tabindex: 0,
            "aria-disabled": false,
        });

        $.ajax({
            type: "GET",
            url: "/api/cities/" + state_sel,
            async: true,
            processData: true,
            success: function (data) {
                //json = $.parseJSON($.trim(data));
                $(dropdownSet).loadSelect(data, city_sel, text);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log("Status: " + xhr.status);
                console.log("Message: " + thrownError);
            },
        });
    }
}
