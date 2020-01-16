<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
  session_start();
}   

//cria variavel com nome do usuario que estava na sessao
$_SESSION['tipo'] = $_POST["Session"];
$User = $_SESSION['nome_login'];
$tipo = $_SESSION['tipo'];

//cria variavel com nome e sobrenome que estavam na sessao
$nome = $_SESSION['nome'];
$sobrenome = $_SESSION['sobrenome'];

$path = "../contas/".$User."/".$tipo."/";
$contagem=1;

if($tipo=="entrada"){
  $arq="recebido";
}
if($tipo=="saida"){
  $arq="enviado";
}
if($tipo=="lixeira"){
  $arq="lixo";
}

// Loop que gera registros
foreach (new DirectoryIterator($path) as $fileInfo) 
{
    
    if($fileInfo->isDir()) continue;
      if($fileInfo->getFilename() != ($path.$arq.$contagem.".xml"))
      {
        //leitura dos arquivos .xml selecionados acima pela contagem
        $xml_string = file_get_contents($path.$arq.($contagem).".xml");
        $xml_objeto = simplexml_load_string($xml_string);
        //retorno de das mensagems incluindo a contagem na variavel
        $retorno["de".$contagem] = trim($xml_objeto->de);
        $retorno["para".$contagem] = trim($xml_objeto->para);
        $retorno["cc".$contagem] = trim($xml_objeto->cc);
        $retorno["titulo".$contagem] = trim($xml_objeto->titulo);
        $retorno["mensagem".$contagem] = trim($xml_objeto->mensagem);
        $retorno["hora".$contagem] = trim($xml_objeto->horario);
        $retorno["login"] = $User;

        $contagem=$contagem+1;
      }

      //contagem para o próximo arquivo
      continue;
}
$retorno["nome"] = $nome;
$retorno["sobrenome"] = $sobrenome;

$retorno["contagemTotal"]=($contagem-1);
echo json_encode($retorno);

?>