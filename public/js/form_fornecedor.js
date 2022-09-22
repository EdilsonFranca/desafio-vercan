function getCep(appCep) {
    let cep = appCep.replaceAll("-", "").replaceAll(".", "")
    let url = `https://viacep.com.br/ws/${cep}/json/`

    if (cep.length == 8)
    {
        let request = $.ajax({
            crossDomain: true,
            dataType   : 'jsonp',
            url        : url
        })

        request.done(function (response)
        {
            let cidade = response.localidade.toUpperCase()
                                            .normalize('NFD')
                                            .replace(/[\u0300-\u036f]/g, "")

            $('input[name="logradouro"]').val(response.logradouro)
            $('input[name="bairro"]').val(response.bairro)
            $("input[name=uf][value='"+ response.uf + "']").prop("checked",true);
            $('input[name="uf"]').val(response.uf)
            $("#selected_uf").text(response.uf)
            $("#selected_cidade").text(cidade)

            let input  = $('<input type="radio" checked class="d-none" name="cidade" value="'+cidade+'">')
            $("#cidade_box").append(input);
        })

        request.fail(function (error) {
            console.error(error);
        })
    }
}

$(document).ready(function () {

    function ajusta_required(value) {
        if (value == "pessoa_juridica") {
            $("#pessoa_juridica ").css({"display": "block"});
            $("#pessoa_fisica ").css({"display": "none"});

            $("#pessoa_juridica ").find('#cnpj , #razao_social, #nome_fantasia, #indicador_inscricao_estadual, #ativo , #recolhimento').prop('required', true)

            $("#pessoa_fisica ").find('#cpf , #nome, #rg, #ativo').prop('required', false)

        } else {

            $("#pessoa_fisica ").css({"display": "block"});
            $("#pessoa_juridica ").css({"display": "none"});

            $("#pessoa_juridica ").find('#cnpj , #razao_social, #nome_fantasia, #indicador_inscricao_estadual, #ativo , #recolhimento').prop('required', false)

            $("#pessoa_fisica ").find('#cpf , #nome, #rg, #ativo').prop('required', true)
        }
    }

//  alternar entre pessoa fisica e juridica
    $('input[name="tipo"]').change(function ()
    {
        ajusta_required($(this).val());
    });

    ajusta_required($("input[name=tipo]:checked").val());

    $('select[name="indicador_inscricao_estadual"]').change(function ()
    {
        let contribuinte_ou_isento = this.value == 'contribuinte' || this.value == 'contribuinte_isento'

        if (!contribuinte_ou_isento)
            $('input[name="inscricao_estadual"]').addClass('disabled');
        else
            $('input[name="inscricao_estadual"]').removeClass('disabled');
    });

    $('input[name="cnpj"]').keydown(function ()
    {
        let cnpj = this.value.replaceAll(".", "")
                             .replaceAll("-", "")
                             .replaceAll("/", "")

        let url  = 'https://receitaws.com.br/v1/cnpj/'+cnpj

        if (cnpj.length == 14)
        {
            if (validarCNPJ(cnpj))
            {
                let request = $.ajax({
                    crossDomain: true,
                    dataType   : 'jsonp',
                    url        : url
                })

                request.done(function (response)
                {
                    $('input[name="razao_social"]').val(response.nome)
                    $('input[name="nome_fantasia"]').val(response.fantasia)
                    $('input[name="situacao_cnpj"]').val(response.situacao)
                    $('input[name="cep"]').val(response.cep)
                    getCep(response.cep);
                })

                request.fail(function (error)
                {
                    console.error(error);
                })
            }
        }
    });

    function validarCNPJ(cnpj)
    {
        cnpj = cnpj.replace(/[^\d]+/g,'');

        if(cnpj == '') return false;

        if (cnpj.length != 14) return false;

        // Elimina CNPJs invalidos conhecidos
        if (cnpj == "00000000000000" ||
            cnpj == "11111111111111" ||
            cnpj == "22222222222222" ||
            cnpj == "33333333333333" ||
            cnpj == "44444444444444" ||
            cnpj == "55555555555555" ||
            cnpj == "66666666666666" ||
            cnpj == "77777777777777" ||
            cnpj == "88888888888888" ||
            cnpj == "99999999999999")
            return false;

        // Valida DVs
        tamanho = cnpj.length - 2
        numeros = cnpj.substring(0,tamanho);
        digitos = cnpj.substring(tamanho);
        soma = 0;
        pos = tamanho - 7;

        for (i = tamanho; i >= 1; i--)
        {
            soma += numeros.charAt(tamanho - i) * pos--;
            if (pos < 2)
                pos = 9;
        }

        resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
        if (resultado != digitos.charAt(0)) return false;

        tamanho = tamanho + 1;
        numeros = cnpj.substring(0,tamanho);
        soma = 0;
        pos = tamanho - 7;

        for (i = tamanho; i >= 1; i--)
        {
            soma += numeros.charAt(tamanho - i) * pos--;
            if (pos < 2)
                pos = 9;
        }

        resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
        if (resultado != digitos.charAt(1)) return false;

        return true;
    }


    $('input[name="cep"]').change(function ()
    {
        getCep(this.value)
    })

    $("#filter_uf").keyup(function()
    {
        let filter  = $(this).val()
        let list_uf = $('.label_uf')
        let txtValue;

        for (let i = 0; i < list_uf.length; i++)
        {
            txtValue = list_uf[i].textContent;
            if (txtValue.toUpperCase().indexOf(filter.toUpperCase()) > -1)
            {
                list_uf[i].style.display = "";
            }
            else
            {
                list_uf[i].style.display = "none";
            }
        }
    });

    $('input[name="uf"]').change(function ()
    {
        $("#selected_uf").text(this.value)

        let url  = `/api/estado/${this.value}/cidades`

        let request = $.ajax({
            crossDomain: true,
            dataType   : 'json',
            url        : url
        })

        request.done(function (response)
        {
            $(".label_cidade" ).remove();

            response.forEach(function(elemento)
            {
                let input  = $('<input type="radio" class="d-none" name="cidade" value="'+elemento+'">')
                let label  = $("<label class='label_cidade'>"+elemento+"</label>").append(input);
                $("#cidade_box").append(label);
                $("#selected_cidade").removeClass("disabled");
            });

            $('input[name="cidade"]').change(function ()
            {
                $("#selected_cidade").text(this.value)
            })
        })

        request.fail(function (error) {
            console.error(error);
        })
    });

    $("#filter_cidade").keyup(function()
    {
        let filter      = $(this).val()
        let list_cidade = $('.label_cidade')
        let txtValue;

        for (let i = 0; i < list_cidade.length; i++)
        {
            txtValue = list_cidade[i].textContent;

            if (txtValue.toUpperCase().indexOf(filter.toUpperCase()) > -1)
                list_cidade[i].style.display = "";
            else
                list_cidade[i].style.display = "none";
        }
    });


    $('select[name="condominio"]').change(function ()
    {
        if(this.value == 1)
            $('.box_condominio_endereco').fadeIn("slow");
        else
            $('.box_condominio_endereco').fadeOut("slow");
    })


    function adicionar_telefone() {
        return function ()
        {
            let clone = $(".telefone_clone").clone()
            clone.removeClass("telefone_clone")
            clone.css("display", "flex")
            clone.find(".remover_telefone").css("display", "block")
            clone.find(".telefone").mask('(00) 00000-0000')

            if ($(this).attr("data-type") == 'adicionais')
            {
                clone.find("input").attr("name" ,"telefone_contato_adicional["+$(this).parent().parent().data( "number" ) +"][]" )
                clone.find("select").attr("name" ,"tipo_telefone_contato_adicional["+$(this).parent().parent().data( "number" ) +"][]" )
            }

            clone.appendTo($(this).parent())

            clone.find('.remover_telefone').click(function ()
            {
                $(this).parent().remove()
            })

        };
    }

    $('.adicionar_telefone').click(adicionar_telefone())

    function adicionar_email() {
        return function ()
        {
            let clone = $(".email_clone").clone()
            clone.removeClass("email_clone")
            clone.css("display", "flex")
            clone.find(".remover_email").css("display", "block")

            if ($(this).attr("data-type") == 'adicionais')
            {
                clone.find("input").attr("name" ,"email_contato_adicional["+$(this).parent().parent().data( "number" ) +"][]" )
                clone.find("select").attr("name" ,"tipo_email_contato_adicional["+$(this).parent().parent().data( "number" ) +"][]" )
            }

            clone.appendTo($(this).parent());

            clone.find('.remover_email').click(function ()
            {
                $(this).parent().remove()
            })

        };
    }

    $('.adicionar_email').click(adicionar_email())

    function remover_contato_adicionais() {
        return function ()
        {
            $(this).parent().parent().remove()

            if($('.contato_adicionais').length == 1)
            {
                $('.mensagem_sem_contato').show()
            }
        };
    }

    $('.add_contato_adicionais').click(function ()
    {
        let count = $(".contato_adicionais").last().data( "number" )
        let clone = $(".contato_adicionais_clone").clone()
        clone.removeClass("contato_adicionais_clone")
        clone.addClass("count_clone")
        clone.find('.adicionar_email').click(adicionar_email())
        clone.find('.adicionar_telefone').click(adicionar_telefone())
        clone.find('.remover_contato_adicionais').click(remover_contato_adicionais())
        clone.find('input, select').prop('disabled', false);
        clone.css("display", "flex")

        count = parseInt(count)
        count = count+1
        clone.attr("data-number" , count)
        clone.appendTo($(".box_contato_adicionais"))

        clone.find("input.telefone_contato_adicional").attr("name" ,"telefone_contato_adicional["+ count +"][]" )
        clone.find("select.tipo_telefone_contato_adicional").attr("name" ,"tipo_telefone_contato_adicional["+ count+"][]" )

        clone.find("input.email_contato_adicional").attr("name" ,"email_contato_adicional["+ count +"][]" )
        clone.find("select.tipo_email_contato_adicional").attr("name" ,"tipo_email_contato_adicional["+ count +"][]" )

        $('.mensagem_sem_contato').hide()
    })

    $('.remover_contato_adicionais').click(remover_contato_adicionais())
    $(".telefone").mask('(00) 00000-0000')

   if($("#tipo_de_acao").val() == "ver")
   {
       $("input , select, textarea").prop('disabled', true);
       $("a.dropdown-toggle ").addClass("disabled")
       $('.wysihtml5-sandbox , .wysihtml5-toolbar').css("pointer-events", "none")
       $('.adicionar_telefone, .adicionar_email, .remover_telefone , .remover_email').css("pointer-events", "none")
   }

    $('.remover_email , .remover_telefone').click(function ()
    {
        $(this).parent().remove()
    })
})

