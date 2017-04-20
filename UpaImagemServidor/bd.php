<?php

class BD {
    
    private $host = "localhost";
    private $usuario = "giordanna";
    private $senha = "88986521";
    private $nomebd = "upaimagem";
    
    private $dbh;
    public $erro = false;
    public $mensagemerro;
    private $stmt;

    public function __construct() {
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->nomebd . ';charset=utf8';

        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        try {
            $this->dbh = new PDO($dsn, $this->usuario, $this->senha, $options);
        } catch (PDOException $e) {
            $this->erro = true;
            $this->mensagemerro = $e->getMessage();
        }

        if ($this->erro) {
            if (!isset($_SESSION)) {
                session_start();
            }
            session_destroy();
        }
    }
    
    public static function __construct1($host) {

        $instancia = new self();

        $instancia->host = $host;
        $instancia->usuario = "giordanna";
        $instancia->senha = "88986521";
        $instancia->nomebd = "upaimagem";

        $dsn = 'mysql:host=' . $instancia->host . ';dbname=' . $instancia->nomebd . ';charset=utf8';

        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        try {
            $instancia->dbh = new PDO($dsn, $instancia->usuario, $instancia->senha, $options);
        } catch (PDOException $e) {
            $instancia->erro = true;
            $instancia->mensagemerro = $e->getMessage();
        }

        return $instancia;
    }

    public function close() {
        $this->dbh = null;
    }
    
    public function getImagensUsuario($id) {
        $sql = "SELECT * FROM Imagem WHERE usuario = :usuario ORDER BY Imagem.id DESC";

        $this->query($sql);
        $this->bind(':usuario', $id);
        $imagens = array();
        if ($this->stmt->execute()) {
            while ($row = $this->stmt->fetch(PDO::FETCH_ASSOC)) {
                $imagens[] = array("id" => $row["id"], "idhash" => $row["idhash"],
                    "usuario" => $row["usuario"], "horario" => $row["horario"],
                    "tipo" => $row["tipo"]);
            }
        }
        return $imagens;
    }
    
    public function getImagem($idhash) {
        $sql = "SELECT * FROM Imagem WHERE idhash = :idhash";

        $this->query($sql);
        $this->bind(':idhash', $idhash);
        $row = $this->single();

        if (!empty($row)) {
            return array("id" => $row["id"], "idhash" => $row["idhash"],
                    "usuario" => $row["usuario"], "horario" => $row["horario"],
                    "tipo" => $row["tipo"]);
        } else {
            return null;
        }
    }

    public function setImagem($usuario) {
        $sql = "INSERT INTO Imagem (usuario)"
                ." VALUES (:usuario)";

        $this->query($sql);
        $this->bind(':usuario', $usuario);

        $this->execute();
        
        $id = $this->lastInsertId();
        
        $sql = "UPDATE Imagem SET idhash = :idhash"
                ." WHERE id = :id";
        
        $this->query($sql);
        $this->bind(':idhash', hash("crc32b", $id));
        $this->bind(':id', $id);

        $this->execute();

        return $id;
    }
    
    public function atualizarTipo($idhash, $tipo) {
        $sql = "UPDATE Imagem SET tipo = :tipo"
                ." WHERE idhash = :idhash";

        $this->query($sql);
        $this->bind(':tipo', $tipo);
        $this->bind(':idhash', $idhash);

        $this->execute();
    }

    public function apagarImagem($idhash) {
        $sql = "DELETE FROM Imagem"
                . " WHERE idhash = :idhash";

        $this->query($sql);
        $this->bind(':idhash', $idhash);

        $this->execute();
    }
    

    public function getUsuario($username, $senhahash) {
        $sql = "SELECT * FROM Usuario WHERE username = :username AND senhahash = :senhahash";

        $this->query($sql);
        $this->bind(':username', $username);
        $this->bind(':senhahash', $senhahash);
        $row = $this->single();

        if (!empty($row)) {
            
            return array("id" => $row["id"], "username" => $row["username"],
                "senha" => $row["senha"], "senhahash" => $row["senhahash"]);
        } else {
            return null;
        }
    }

    public function verificarLogin($username, $senhahash) {
        $sql = "SELECT * FROM Usuario WHERE username = :username AND senhahash = :senhahash";

        $this->query($sql);
        $this->bind(':username', $username);
        $this->bind(':senhahash', $senhahash);
        $row = $this->single();

        if (!empty($row)) {
            return true;
        } else {
            return false;
        }
    }

    public function getUsuarioId($username, $senhahash) {
        $sql = "SELECT * FROM Usuario WHERE username = :username AND senhahash = :senhahash";

        $this->query($sql);
        $this->bind(':username', $username);
        $this->bind(':senhahash', $senhahash);
        $row = $this->single();

        if (!empty($row)) {
            return $row["id"];
        } else {
            return null;
        }
    }

    public function verificarUsernameExistente($username) {
        $sql = "SELECT * FROM Usuario WHERE username = :username";

        $this->query($sql);
        $this->bind(':username', $username);
        $row = $this->single();

        if (!empty($row)) {
            return true;
        } else {
            return false;
        }
    }

    public function setUsuario($obj_usuario) {
        $sql = "INSERT INTO Usuario (username, senha, senhahash)"
                . "VALUES (:username, :senha, :senhahash)";

        $this->query($sql);
        $this->bind(':username', $obj_usuario["username"]);
        $this->bind(':senha', $obj_usuario["senha"]);
        $this->bind(':senhahash', sha1($obj_usuario["senha"]));
        $this->execute();
    }

    // métodos privados
    private function query($query) {
        $this->stmt = $this->dbh->prepare($query);
    }

    private function bind($param, $value, $type = null) {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    private function execute() {
        return $this->stmt->execute();
    }

    private function resultset() {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    private function single() {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    private function rowCount() {
        return $this->stmt->rowCount();
    }

    private function lastInsertId() {
        return $this->dbh->lastInsertId();
    }

    private function beginTransaction() {
        return $this->dbh->beginTransaction();
    }

    private function endTransaction() {
        return $this->dbh->commit();
    }

    private function cancelTransaction() {
        return $this->dbh->rollBack();
    }

    private function debugDumpParams() {
        return $this->stmt->debugDumpParams();
    }

}
