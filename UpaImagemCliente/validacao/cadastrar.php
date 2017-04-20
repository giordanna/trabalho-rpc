<?php

include_once("../client.php");
include_once("../classes/login.php");

function erro($msg) {
    header("location: ../index.php?err=$msg");
    exit;
}

$username = strtolower(filter_input(INPUT_POST, 'username'));
$senha = filter_input(INPUT_POST, 'senha');
$senhaconfirma = filter_input(INPUT_POST, 'senhaconfirma');

if ($senha != $senhaconfirma) {
    erro(4);
}
// conexão
if (Cliente::rpc('verificarUsernameExistente', [$username])) {
    erro(3);
}


$user = array("username" => $username, "senha" => $senha);

Cliente::rpc('setUsuario', [$user]);

$login = new Login();
$login->logar($username, sha1($senha));
