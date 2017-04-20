<?php

class Imagem {

    private $id = null;
    private $idhash = null;
    private $usuario;
    private $horario = null;
    private $tipo = null;

    public function __construct($usuario) {
        $this->usuario = $usuario;
    }

    public static function __construct5($id, $idhash, $usuario, $horario, $tipo) {
        $instancia = new self($usuario);

        $instancia->id = $id;
        $instancia->idhash = $idhash;
        $instancia->horario = $horario;
        $instancia->tipo = $tipo;
        
        return $instancia;
    }

    public function setImagem() {
        $this->id = Cliente::rpc('setImagem', [$this->usuario]);
        $this->idhash = hash("crc32b", $this->id);
    }

    public function getId() {
        return $this->id;
    }

    public function getIdHash() {
        return $this->idhash;
    }
    
    public function getUsuario() {
        return $this->usuario;
    }
    
    public function getHorario() {
        return $this->horario;
    }
    
    public function getTipo() {
        return $this->tipo;
    }
    
    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }
}
