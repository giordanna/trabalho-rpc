<?php
$err = isset($_GET['err']) ? (int) $_GET['err'] : -1;

$mensagens_erro = array(
    1 => "Houve falha na conexão com o banco de dados.",
    2 => "Erro no login: usuário não existe.",
    3 => "Erro no cadastro: nome de usuário já foi cadastrado.",
    4 => "Erro no cadastro: a senha e a sua confirmação precisam ser iguais.",
    5 => "Erro no envio: deve-se enviar uma imagem.",
    6 => "Erro no envio: tamanho da imagem deve ser pelo menos 5MB.",
    7 => "Erro no envio: não foi possível enviar a imagem.",
    8 => "Erro no envio: extensão não permitida.",
    9 => "Erro na visualização: página sem ID da imagem.",
    10 => "Erro na visualização: página incorreta.",
    11 => "Erro na visualização: imagem não existe."
    
);
?>