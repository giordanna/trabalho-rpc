<?php
$home = "/";
$enviar = "enviar.php";
$perfil = "perfil.php";
$sair = "../validacao/sair.php";

include_once("../mensagemerro.php");

?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <title><?php print $titulo ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

        <link rel="stylesheet" type="text/css" href="<?php print $folha ?>">
        
        <script type="text/javascript">
            var erro = function () {
                var id = <?php echo $err; ?>;
                var tamanho = <?php echo count($mensagens_erro); ?>;
                if (id > 0 && id <= tamanho) {
                    var mensagem = "<?php echo $mensagens_erro[$err]; ?>";
                    var html = '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Atenção!</strong>  ' + mensagem + '</div>';
                    document.getElementById("erro").innerHTML = html;

                }
            };
        </script>
    </head>
    <body onload="erro()">
        <header class="container">
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="<?php print $home ?>">UpaImagem</a>
                    </div>
                    <div class="collapse navbar-collapse" id="myNavbar">
                        <ul class="nav navbar-nav navbar-right">
                            <li style="font-size: medium;"><a href="<?php print $enviar ?>"><span class="glyphicon glyphicon-upload"></span> Enviar</a></li>
                            <li style="font-size: medium;"><a href="<?php print $perfil ?>"><span class="glyphicon glyphicon-user"></span> Perfil</a></li>
                            <li style="font-size: medium;"><a href="<?php print $sair ?>"><span class="glyphicon glyphicon-log-out"></span> Sair</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <div id="erro" class="container"></div>