<?php

$titulo = "UpaImagem";
$folha = "estilo.css";

include_once("client.php");
include_once("classes/login.php");

$login = new Login();
$login->verificarBD();

include_once("header.php");
?>
<section class="container">
    <div class="row"><img  class="img-responsive" src="img/logo.png"></div>
    <div><h3 class="text-primary"><center>Faça upload de imagens!</center></h3></div>
</section>

<?php include_once("footer.php"); ?>