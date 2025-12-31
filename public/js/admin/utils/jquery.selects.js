(function ($) {
    $.fn.emptySelect = function () {
        return this.each(function () {
            if (this.tagName == "SELECT") this.options.length = 0;
        });
    };

    $.fn.loadSelect = function (optionsDataArray, selValue, selText) {
        if (selText !== "") {
            var selType = "text";
            var sel = selText;
        } else {
            var selType = "value";
            var sel = selValue;
        }

        return $(this)
            .emptySelect()
            .each(function () {
                if (this.tagName == "SELECT") {
                    var selectElement = this;
                    $.each(optionsDataArray, function (index, optionData) {
                        var option = new Option(
                            optionData.caption,
                            optionData.value
                        );
                        selectElement.add(option);
                    });
                }
                for (i = 0; i < selectElement.length; i++) {
                    if (
                        selType == "text" &&
                        selectElement.options[i].text == sel
                    ) {
                        break;
                    }
                    if (
                        selType == "value" &&
                        selectElement.options[i].value == sel
                    ) {
                        break;
                    }
                }
                selectElement.options.selectedIndex = i;
            });
    };
})(jQuery);

function selected_option(select, value) {
    $(select + " option")
        .filter(function () {
            return $(this).text() == value.trim();
        })
        .attr("selected", true);
}
