$(document).ready(function(){
    var cont = 0;
    $contagem = cont;

    $("#bNovaMsg").click(function(){
        window.location.href="../paginas/pag3CriarMensagem.html";
    });
    $("#bEntrada").click(function(){
        window.location.href="../paginas/pag1CaixaDeEntrada.html";
    });
    $("#bEnviados").click(function(){
        window.location.href="../paginas/pag2CaixaDeEnvio.html";
    });
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
    setTimeout(function(){
        $("#loader").remove();
    },750);

    $("#bEnviar").click(function(){
        fLocalEnvioMsg($contagem);
    });
});

function fLocalEnvioMsg(cont){
    $contagem = cont+1;
    var ajax_EmailCont = ($contagem);
    var ajax_EmailPara = $("#tPara").val();
    var ajax_EmailCc = $("#tCc").val();
    var ajax_EmailTitulo = $("#tTitulo").val();
    var ajax_EmailMensagem = $("#tMensagem").val();

    $.ajax({
        type: "POST",
        url: "../php/EnviarEmail.php",
        data: {
            EmailCont: ajax_EmailCont,
            EmailPara: ajax_EmailPara,
            EmailCc: ajax_EmailCc,
            EmailTitulo: ajax_EmailTitulo,
            EmailMensagem: ajax_EmailMensagem
            
        },
        success: function(){
            alert("Email enviado com sucesso!!");
            //window.location.href="pag1CaixaDeEntrada.html";

        }
    });
}