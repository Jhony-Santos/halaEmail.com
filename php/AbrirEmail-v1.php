<?php
$User="vinicius@hotmail.com";
$tipo="entrada";
$path = "../contas/".$User."/".$tipo."/";
$contagem=1;

if($tipo=="entrada"){
  $nome="recebido";
}
if($tipo=="saida"){
  $nome="enviado";
}
if($tipo=="lixeira"){
  $nome="lixo";
}

// Título
echo "<h2>Lista de E-mais:</h2><br />";

// Abre a tabela, cria títulos
echo "<table>";
echo "<tr> <th>Nome</th> </tr>";

// Loop que gera registros
foreach (new DirectoryIterator($path) as $fileInfo) {
    
    if($fileInfo->isDir()) continue;
      if($fileInfo->getFilename() == ($nome.$contagem.".xml")){
        $contagem=$contagem+1;

        // Imprime linhas de registros
        echo "<tr>
              <td>".$fileInfo->getFilename()."<br/> </td>
            </tr>";
      continue;
      }
}

echo "<tr> <th>Qnt. de Arquivos: ".($contagem-1)."</th> </tr>";

// Fecha a tabela
echo "</table>";

?>