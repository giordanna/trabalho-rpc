<?php

class Usuario {

    private $id = null;
    private $username;
    private $senha;
    private $senhahash;

    public function __construct($username, $senha) {
        $this->username = $username;
        $this->senha = $senha;
    }
    
    public static function __construct4($id, $username, $senha, $senhahash) {
        $instancia = new self($username, $senha);
        
        $instancia->id = $id;
        $instancia->senhahash = $senhahash; 
        
        return $instancia;
    }

    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getSenha() {
        return $this->senha;
    }
    
    public function getSenhaHash() {
        return $this->senhahash;
    }

}
