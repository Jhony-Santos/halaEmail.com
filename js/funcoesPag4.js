$(document).ready(function(){
    $("#bFinalizar").click(function(){
        Cadastrar(); 
    });
});
function Cadastrar(){
    var ajax_nome=$("#nome").val();
    var ajax_sobrenome=$("#sobrenome").val();
    var ajax_usuario=$("#usuario").val();
    var ajax_senha=$("#senha").val();
    var confirmarSenha=$("#cSenha").val();


    if(confirmarSenha != ajax_senha){
        alert("A confirmação de senha está incorreta!");
    }
    else{
        $.ajax({
            type:"POST",
            url:"../php/CadastrarEmail.php",
            data:{
                nome: ajax_nome,
                sobrenome: ajax_sobrenome,
                usuario: ajax_usuario,
                senha: ajax_senha,
            },
            success: function(){
                alert("Cadastrado Com Sucesso!");
                window.location.href="../Index.html";
            }
        });
        


    }
}