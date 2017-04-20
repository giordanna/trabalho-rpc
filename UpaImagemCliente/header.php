<?php
$home = "/";

include_once("mensagemerro.php");
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
                            <li style="font-size: medium;"><a  data-toggle="modal" data-target="#modCadastro"><span class="glyphicon glyphicon-user"></span> Cadastro</a></li>
                            <li style="font-size: medium;"><a  data-toggle="modal" data-target="#modEntrar" role="button"><span class="glyphicon glyphicon-log-in"></span> Entrar</a></li>
                        </ul>
                    </div>
                </div>
                <div class="modal fade" id="modEntrar" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Entrar</h4>
                            </div>
                            <div class="modal-body">
                                <form class="form" method="post" class="form" action="validacao/entrar.php" >
                                    <div class="form-group">
                                        <label for="usuario">Usuário:</label>
                                        <input type="text" pattern="^[_A-z0-9]{1,}$" maxlength="16" required="true" class="form-control" name="username" id="username" placeholder="Digite o seu nome de usuário">
                                    </div>
                                    <div class="form-group">
                                        <label for="senha">Senha: </label>
                                        <input type="password" maxlength="64" required="true" class="form-control" name="senha" id="senha" placeholder="Digite a sua senha">
                                    </div>
                                    <center><button type="submit" class="btn btn-default btn-lg">Entrar</button></center>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal fade" id="modCadastro" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Cadastro</h4>
                            </div>
                            <div class="modal-body">
                                <form class="form" method="post" class="form" action="validacao/cadastrar.php">
                                    <div class="form-group">
                                        <label for="usuario">Usuário:</label>
                                        <input type="text" pattern="^[_A-z0-9]{1,}$" maxlength="16" required="true" class="form-control" id="username" name="username" placeholder="Digite um nome de usuário">
                                    </div>
                                    <div class="form-group">
                                        <label for="senha">Senha: </label>
                                        <input type="password" maxlength="64" required="true" class="form-control" id="senha" name="senha" placeholder="Digite uma senha">
                                    </div>
                                    <div class="form-group">
                                        <label for="senha">Digite Novamente a Senha: </label>
                                        <input type="password" maxlength="64" required="true" class="form-control" id="senhaconfirma" name="senhaconfirma" placeholder="Digite novamente a senha">
                                    </div>

                                    <center><button type="submit" class="btn btn-default btn-lg" value="Exibir">Cadastrar</button></center>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </header>
        <div id="erro" class="container"></div>