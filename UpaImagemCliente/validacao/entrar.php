<?php
include_once("../client.php");
include_once('../classes/login.php');

$username = strtolower(filter_input(INPUT_POST, 'username'));
$senha = filter_input(INPUT_POST, 'senha');

// conexão
$login = new Login();
$login->logar($username, sha1($senha));