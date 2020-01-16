$(document).ready(function(){
    $Session = $("button.opcoes").val();
    var cont = 1;
    $contagem = cont;
    fLocalListarTabela($contagem);

    $("#bNovaMsg").click(function(){
        window.location.href="../paginas/pag3CriarMensagem.html";
    });
    $("#bEntrada").click(function(){
        window.location.href="../paginas/pag1CaixaDeEntrada.html";
    });
    $("#bEnviados").click(function(){
        window.location.href="../paginas/pag2CaixaDeEnvio.html";
    });
});

function fLocalListarTabela(cont){
    var ajax_Sessao = ($Session);

    $.ajax({
        type: "POST",
        beforeSend : function(){
            //TELA DE LOADING
            $("#carregando").html(
            '<div id="loader" class="loader">'+
                '<div class="loader-inner">'+
                    '<div class="loader-line-wrap">'+
                        '<div class="loader-line"></div>'+
                    '</div>'+
                    '<div class="loader-line-wrap">'+
                        '<div class="loader-line"></div>'+
                    '</div>'+
                    '<div class="loader-line-wrap">'+
                        '<div class="loader-line"></div>'+
                    '</div>'+
                    '<div class="loader-line-wrap">'+
                        '<div class="loader-line"></div>'+
                    '</div>'+
                    '<div class="loader-line-wrap">'+
                        '<div class="loader-line"></div>'+
                    '</div>'+
                '</div>'+
            '</div>'
            );
            //FIM DA TELA DE LOGIN - INCLUI CODIGO NO CSS
        },
        url: "../php/AbrirEmail.php",
        data: {
            Session: ajax_Sessao
        },
        dataType: "json",
        error: function() {alert("Servidor não conseguiu computar seus dados!");
        
        },
        success: function(retorno){
            setTimeout(function(){
                $User = retorno["login"];
                $("#loader").remove();
                var conteudo = "";
                var i = cont;
                conteudo += "<table border='1px' id='tabelaEmails'>";
                conteudo += "<tr>";
                conteudo += "<td> <b>Horário de Envio</b> </td>";
                conteudo += "<td> <b>De</b> </td>";
                conteudo += "<td> <b>Destinatário(s)</b> </td>";
                conteudo += "<td> <b>Título</b> </td>";
                conteudo += "<td> <b>Mensagem</b> </td>";
                conteudo += "<td> <b>Qnt. de E-mails: "+retorno.contagemTotal+"</b> </td>";
                conteudo += "</tr>";


                while(i <= retorno.contagemTotal)
                {
                    i++;

                    conteudo += "<tr>";
                    conteudo += "<td>"+retorno["hora"+cont]+"</td>";
                    conteudo += "<td>"+retorno["de"+cont]+"</td>";
                    conteudo += "<td>"+retorno["para"+cont]+", "+retorno["cc"+cont]+"</td>";
                    conteudo += "<td>"+retorno["titulo"+cont]+"</td>";
                    conteudo += "<td>"+retorno["mensagem"+cont]+"</td>";
                    conteudo += "</tr>";
                    cont++;
                }
                //apenas fecha a table depois de todos os emails estiverem carregados (quando sair do while)
                conteudo += "</table>";
                $("#divCaixa").html(conteudo);

                //Printar na tela o nome e sobrenome nas caixas do email
                nomeSobrenome = "";
                nomeSobrenome += "<h3><b>"+retorno["nome"]+" "+retorno["sobrenome"]+"</b></h3>";
                $("#usuario").html(nomeSobrenome);
            },2000);
        }
    });


}