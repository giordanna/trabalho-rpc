<?php

$titulo = "Enviar Imagem";
$folha = "../estilo.css";

include_once("../client.php");
include_once("../classes/login.php");

$login = new Login();
$login->verificarSessao();

include_once("header.php");
?>

<section class="container">

    <form method="post" enctype="multipart/form-data" class="form" action="../validacao/enviar.php" >
        <center>
            <div class="form-group">
                <label for="imagem"><h2>Faça upload:</h2></label>
                <input type="file"  class="btn btn-lg btn-primary" required="true" id="imagem" name="imagem" accept="image/jpg, image/jpeg, image/png, image/apng, image/gif">
            </div>
            <button type="submit" class="btn btn-primary btn-lg">Upar!</button>
            <p></p>
        </center>
    </form>

</section>

<?php include_once("../footer.php"); ?>