<?php

$titulo = "Perfil";
$folha = "../estilo.css";

include_once("../classes/imagem.php");
include_once("../classes/usuario.php");
include_once("../client.php");
include_once("../classes/login.php");

$login = new Login();
$login->verificarSessao();

include_once("header.php");

$imagens = Cliente::rpc('getImagensUsuario',[
    Cliente::rpc('getUsuarioId',[$_SESSION["username"], $_SESSION["senhahash"]])
            ]);

function divdeImagens($img) {
    $html = '<div resize="both"><table align="center"><tr>';
    $total = count($img);
    $contador = 0;
    if ($total > 0) {
        foreach ($img as $imagem) {
            $contador += 1;
            $html .= '<td><a href="imagem.php?img=' . $imagem["idhash"] . '">';
            $html .= '<img width="500" height="500" src="../img/' . $imagem["idhash"] . '.' . $imagem["tipo"] . '" ';
            $html .= 'class="img-thumbnail" alt="Não funcionou a imagem. Ela pode ter sido deletada pelos administradores." />';
            $html .= '</a></td>';
            if (($contador % 3 == 0) AND $contador != $total) {
                $html .= "</tr><tr>";
            }
        }
        $html .= "</tr></table></div>";
    } else {
        $html = '<div class="alert alert-info">';
        $html .= '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
        $html .= '<p class="text-info"><strong>Atenção!</strong> Não existe nenhuma imagem upada por você... ainda.</p></div>';
    }
    return $html;
}

?>
<section class="container">
    
    <img class="img-responsive" src="../img/logo.png" />
    <div><h2 class="text-primary"><center>Minhas Imagens Upadas</center></h2></div>
    <?php echo divdeImagens($imagens); ?>
    <p></p>
</section>

<?php include_once("../footer.php"); ?>