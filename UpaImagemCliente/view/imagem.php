<?php
$titulo = "Visualizar Imagem";
$folha = "../estilo.css";

include_once("../client.php");
include_once("../classes/login.php");
include_once("../classes/imagem.php");

function erro($msg) {
    header("location: perfil.php?err=$msg");
    exit;
}

$idimghash = isset($_GET['img']) ? $_GET['img'] : -1;
if ($idimghash == -1) {
    erro(9);
}

$login = new Login();
$header = $login->verificarHeader();

$imagem = Cliente::rpc('getImagem',[$idimghash]);
if ($imagem == null) {
    erro(11);
}

$data1 = new DateTime($imagem["horario"], new DateTimeZone('America/Belem'));
$data2 = new DateTime();
$data2->setTimezone(new DateTimeZone('America/Belem'));

$tempo = $data2->diff($data1);

if ($header == "../view/header.php") {
    if ($imagem["usuario"] == Cliente::rpc('getUsuarioId', [$_SESSION["username"], $_SESSION["senhahash"]])){
        $html = '<div class="list-group-item-heading"><form method="post" action="../validacao/deletar.php" >
                <input type="hidden" id="imagem" value="'. $idimghash . '" name="imagem">
                <button type="submit" class="btn btn-danger btn-lg btn-block">Deletar</button>
            </form>
        </div>';
    }
    else {
        $html = "";
    }
}
else {
    $html = "";
}

include_once($header);
?>
<section class="container">
    <div class = "list-group">
        <div class = "list-group-item active">
            <h4 class = "list-group-item-heading">
                <center>Imagem:</center>
            </h4>
        </div>
        <div class = "list-group-item">
            <p class="list-group-item-text">
            <center>
                <img max-width="700" max-height="700" src="../img/<?php echo $idimghash . '.' . $imagem["tipo"]; ?>" class="img-thumbnail" alt="Não funcionou a imagem. Ela pode ter sido deletada pelos administradores." />
            </center>
            </p>
        </div>
        <p></p>
        <div class = "list-group-item active">
            <h4 class = "list-group-item-heading">
                <center>Upada em:</center>
            </h4>
        </div>
        <div class = "list-group-item">
            <p class="list-group-item-text">
            <center>
                <p><?php echo $data1->format('d/m/Y à\s H:i:s') ?></p>
                <p><?php echo $tempo->format('Há %a Dias e %h horas.'); ?></p>
            </center>
        </div>
        <div class = "list-group-item active">
            <a target="_blank" href="../img/<?php echo $idimghash . '.' . $imagem["tipo"]; ?>">
                <h4 class = "list-group-item-heading">
                    <center>
                        Clique aqui para obter o link direto
                    </center>
                </h4>
            </a>
        </div>
        <p></p>
        <?php echo $html; ?>
    </div>
    <p></p>
</section>

<?php include_once("../footer.php"); ?>