<?php
    $nome= $_POST["nome"];
    $sobrenome= $_POST["sobrenome"];
    $usuario= $_POST["usuario"];
    $senha= $_POST["senha"];


$xml=new DomDocument("1.0");
$xml_root=$xml->createElement("root");

$xml_nome=$xml->createElement("nome",$nome);
$xml_sobrenome=$xml->createElement("sobrenome",$sobrenome);
$xml_usuario=$xml->createElement("usuario",$usuario);
$xml_senha=$xml->createElement("senha",$senha);

$xml_root->appendChild($xml_nome);
$xml_root->appendChild($xml_sobrenome);
$xml_root->appendChild($xml_usuario);
$xml_root->appendChild($xml_senha);

$xml->appendChild($xml_root);


mkdir(dirname(__FILE__)."../../contas/".$usuario."/", 0777, true);
mkdir(dirname(__FILE__)."../../contas/".$usuario."/"."entrada/", 0777, true);
mkdir(dirname(__FILE__)."../../contas/".$usuario."/"."saida/", 0777, true);
$xml->save("../Contas/".$usuario."/login.xml");
echo json_encode("Usuario cadastrado");


?>