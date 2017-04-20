<?php
include_once("../client.php");
include_once("../classes/imagem.php");


function erro($msg) {
    header("location: ../view/enviar.php?err=$msg");
    exit;
}

if (!isset($_SESSION)) {
    session_start();
}

if ($_FILES['imagem']['size'] == 0) {
    erro(5);
}

$usuario = Cliente::rpc('getUsuarioId', [$_SESSION['username'], $_SESSION['senhahash']]);

// cria objeto
$imagem = new Imagem($usuario);
$imagem->setImagem();

// diretório que irá receber a imagem
$diretorio = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR
        . 'img' . DIRECTORY_SEPARATOR;

$_UP['pasta'] = $diretorio;
// Tamanho máximo do arquivo (em Bytes)
$_UP['tamanho'] = 1024 * 1024 * 5; // 5Mb
// Array com as extensões permitidas
$_UP['extensoes'] = array('jpg', 'jpeg', 'png', 'apng', 'gif');
// Verifica se houve algum erro com o upload. Se sim, exibe a mensagem do erro
if ($_FILES['imagem']['error'] != 0) {
    erro(7);
}
// Caso script chegue a esse ponto, não houve erro com o upload e o PHP pode continuar
// Faz a verificação da extensão do arquivo
$extensao = strtolower(end(explode('.', $_FILES['imagem']['name'])));

Cliente::rpc('atualizarTipo', [$imagem->getIdHash(), $extensao]);

if (array_search($extensao, $_UP['extensoes']) === false) {
    erro(8);
}
// Faz a verificação do tamanho do arquivo
if ($_UP['tamanho'] < $_FILES['imagem']['size']) {
    erro(6, $nivel);
}

$nome_final = $imagem->getIdHash() . "." . $extensao;

if (move_uploaded_file($_FILES['imagem']['tmp_name'], $_UP['pasta'] . $nome_final)) {
} else {
    erro(7);
}

header('Location: ../view/imagem.php?img=' . $imagem->getIdHash());