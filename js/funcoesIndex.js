$(document).ready(function(){
    $("#bEntrar").click(function(){
        var login = $("#tLogin").val();
        var senha = $("#tSenha").val();
        
        fLocalAutenticacao(login,senha);
    });
    $("#bCadastrar").click(function(){
        window.location.href="paginas/pagCadastrar.html";
    });

});

function fLocalAutenticacao(login,pwd){
    var ajax_login = login;
    var ajax_pwd = pwd;
    var conteudo = "";

    $.ajax({
        type: "POST",
        url: "php/AutenticarUser.php",
        data: {
            login: ajax_login,
            pwd: ajax_pwd,
        },
        dataType: "json",
        success: function(retorno){
                
            if(login == retorno.user && pwd == retorno.pwd){
                alert("Autenticado com sucesso!");
                window.location.href="paginas/pag1CaixaDeEntrada.html";
            }
            else{
                conteudo = "Login e/ou senha incorreto(s). Tente novamente!";
            }
            $("#divSituacao").html(conteudo);

        }

    });
}
