$(document).ready(function () {
    $("#btn-generate-code").click(function () {
        $.ajax({
            type: "GET",
            url: "/api/admin/coupons/generate-code/",
            async: true,
            processData: true,
            success: function (code) {
                $("#coupon-code").val($.trim(code));
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log("Status: " + xhr.status);
                console.log("Message: " + thrownError);
            },
        });
    });
});
