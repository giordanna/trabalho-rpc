<?php

require_once('autoload.php');
include_once("bd.php");

use JsonRPC\Server;

$server = new Server();

$server->getProcedureHandler()
        ->withCallback('getImagensUsuario', function ($id) {
            $bd = new BD();
            
            $retorno = $bd->getImagensUsuario($id);
            $bd->close();
            return $retorno;
        })
        
        ->withCallback('getImagem', function ($idhash) {
            $bd = new BD();
            
            $retorno = $bd->getImagem($idhash);
            $bd->close();
            return $retorno;
        })
        
        ->withCallback('setImagem', function ($obj_imagem) {
            $bd = new BD();
            
            $retorno = $bd->setImagem($obj_imagem);
            $bd->close();
            return $retorno;
        })
        
        ->withCallback('atualizarTipo', function ($idhash, $tipo) {
            $bd = new BD();
            
            $bd->atualizarTipo($idhash, $tipo);
            $bd->close();
        })
        
        ->withCallback('apagarImagem', function ($idhash) {
            $bd = new BD();
            
            $bd->apagarImagem($idhash);
            $bd->close();
        })
        
        ->withCallback('getUsuario', function ($username, $senhahash) {
            $bd = new BD();
            
            $retorno = $bd->getUsuario($username, $senhahash);
            $bd->close();
            
            return $retorno;
        })
        
        ->withCallback('verificarLogin', function ($username, $senhahash) {
            $bd = new BD();
            
            $retorno = $bd->verificarLogin($username, $senhahash);
            $bd->close();
            
            return $retorno;
        })
        
        ->withCallback('getUsuarioId', function ($username, $senhahash) {
            $bd = new BD();
            
            $retorno = $bd->getUsuarioId($username, $senhahash);
            $bd->close();
            return $retorno;
        })
        
        ->withCallback('verificarUsernameExistente', function ($username) {
            $bd = new BD();
            
            $retorno = $bd->verificarUsernameExistente($username);
            $bd->close();
            return $retorno;
        })
        
        ->withCallback('setUsuario', function ($obj_usuario) {
            $bd = new BD();
            
            $bd->setUsuario($obj_usuario);
            $bd->close();
        })
        
;

echo $server->execute();