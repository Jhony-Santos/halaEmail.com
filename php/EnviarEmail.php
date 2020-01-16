<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
  }   
  
    $User = $_SESSION['nome_login'];


    $contagem = $_POST["EmailCont"];
    $EmailPara = $_POST["EmailPara"];
    $EmailCc = $_POST["EmailCc"];
    $EmailTitulo = $_POST["EmailTitulo"];
    $EmailMensagem = $_POST["EmailMensagem"];
    $horario = date("H:i:s");

    $xml = new DOMDocument("1.0");

    $xml_email = $xml->createElement("email");
    $xml_horario = $xml->createElement("horario",$horario);
    $xml_de = $xml->createElement("de",$User);
    $xml_para = $xml->createElement("para",$EmailPara);
    $xml_cc = $xml->createElement("cc",$EmailCc);
    $xml_titulo = $xml->createElement("titulo",$EmailTitulo);
    $xml_msg = $xml->createElement("mensagem",$EmailMensagem);

    $xml_email->appendChild($xml_horario);
    $xml_email->appendChild($xml_de);
    $xml_email->appendChild($xml_para);
    $xml_email->appendChild($xml_cc);
    $xml_email->appendChild($xml_titulo);
    $xml_email->appendChild($xml_msg);

    $xml->appendChild($xml_email);

    $pathUSER = "../contas/".$User."/"."saida/";
    $pathPARA = "../contas/".$EmailPara."/"."entrada/";
    $pathCC = "../contas/".$EmailCc."/"."entrada/";

    $contUser = 1;
    $contPara = 1;
    $contCc = 1;

 /*   foreach (new DirectoryIterator($pathUSER) as $fileInfo) 
    {
      if($fileInfo->isDir()) continue;

        $contUser=$contUser+1;
    }
    foreach (new DirectoryIterator($pathPARA) as $fileInfo) 
    {
      if($fileInfo->isDir()) continue;
        
        $contPara=$contPara+1;
    }*/
    if($EmailCc==""){// ENTRA NESSE ELSE CASO NAO TENHA NINGUEM NO CC
      foreach (new DirectoryIterator($pathUSER) as $fileInfo) 
      {
        if($fileInfo->isDir()) continue;

          $contUser=$contUser+1;
      }
      foreach (new DirectoryIterator($pathPARA) as $fileInfo) 
      {
        if($fileInfo->isDir()) continue;
          
          $contPara=$contPara+1;
      }
    }
    else{ // ENTRA NESSE ELSE CASO TENHA NINGUEM NO CC
      foreach (new DirectoryIterator($pathUSER) as $fileInfo) 
      {
        if($fileInfo->isDir()) continue;

          $contUser=$contUser+1;
      }
      foreach (new DirectoryIterator($pathPARA) as $fileInfo) 
      {
        if($fileInfo->isDir()) continue;
          
          $contPara=$contPara+1;
      }
      foreach (new DirectoryIterator($pathCC) as $fileInfo) 
      {
        if($fileInfo->isDir()) continue;
          
          $contCc=$contCc+1;
      }
    }



    $xml->save("../contas/".$EmailPara."/entrada/recebido".$contPara.".xml"); //RECEBIDO DO PARA
    $xml->save("../contas/".$EmailCc."/entrada/recebido".$contCc.".xml"); //RECEBIDO DO CC
    $xml->save("../contas/".$User."/saida/enviado".$contUser.".xml"); //ENVIADO DE

    echo json_encode("Isso ai!!");
?>