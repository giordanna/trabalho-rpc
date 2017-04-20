<?php

include_once("../client.php");

$idhash = filter_input(INPUT_POST, 'imagem');
echo $idhash;
// conexão
$imagem = Cliente::rpc('getImagem', [$idhash]);

unlink("../img/" . $idhash . "." . $imagem["tipo"]);
Cliente::rpc('apagarImagem', [$idhash]);

header("location: ../view/perfil.php");