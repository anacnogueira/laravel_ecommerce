$(".cep")
    .blur(function () {
        var cep = this.value.replace(/[^0-9]/gi, "");
        if (cep.length != 8) return false;
        $.getJSON("//viacep.com.br/ws/" + cep + "/json/", function (data) {
            if (typeof data.erro == "undefined") {
                $("#address").val(data.logradouro);
                $("#neighborhood").val(data.bairro);
                selected_option("#country-id", "Brasil");
                selected_option("#state-id", data.estado);
                get_cities($("#state-id"), $("#city-id"), data.localidade);
            } else {
                $(".cep")
                    .next("span")
                    .addClass("error")
                    .html(
                        " <a href='http://www.buscacep.correios.com.br/sistemas/buscacep/buscaCep.cfm' target='_blank'>CEP não encontrado, consultar site dos Correios</a></span>"
                    );
            }
        });
    })
    .trigger("blur");
