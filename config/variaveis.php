<?php 

$nomeArquivo= __DIR__."/../produtos.json";
$produtos= json_decode(file_get_contents($nomeArquivo), true);

?>