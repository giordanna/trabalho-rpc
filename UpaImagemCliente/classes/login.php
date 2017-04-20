<?php

class Login {

    public function logar($username, $senhahash) {

        $resultado = Cliente::rpc('getUsuario', [$username, $senhahash]);

        if (!isset($_SESSION)) {
            session_start();
        }

        if (!empty($resultado)) { // encontrou
            $_SESSION['username'] = $username;
            $_SESSION['senhahash'] = $senhahash;
            
            header('location: ../view/perfil.php');
        } else { // não encontrou
            session_destroy();
            header('location: ../index.php?err=2');
            exit;
        }
    }

    public function deslogar() {
        if (!isset($_SESSION)) {
            session_start();
        }
        session_destroy();
        header("location: ../index.php");
        exit;
    }

    public function verificarSessao() {
        if (!isset($_SESSION)) {
            session_start();
        }
        if (!isset($_SESSION['username'])) {
            session_destroy();
            
            if (isset($_GET['err'])){
                $id = (int) $_GET['err'];
                header("location: ../index.php?err=".$id);
                exit;
            }
            header("location: ../index.php");
            exit;
        }
        // verifica se usuário ainda está no banco de dados
        $resultado = Cliente::rpc('verificarLogin', [$_SESSION['username'], $_SESSION['senhahash']]);
        
        if ($resultado == false) { // não encontrou
            session_destroy();
            header("location: ../index.php?err=2");
            exit;
        }
    }

    public function verificarBD() {
        if (!isset($_SESSION)) {
            session_start();
        }
        if (!isset($_SESSION['username'])) {
            session_destroy();
        } else {
            // existe sessão, mas precisamos ver se está no bd ainda
            $resultado = Cliente::rpc('verificarLogin', [$_SESSION['username'], $_SESSION['senhahash']]);
            
            if ($resultado == false) { // não encontrou, mas não precisa sair da page
                session_destroy();
            }
            else {
                header("location: ../view/perfil.php");
            }
        }
    }
    
    public function verificarHeader() {
        if (!isset($_SESSION)) {
            session_start();
        }
        if (!isset($_SESSION['username'])) {
            session_destroy();
            return "../header.php";
        } else {
            // existe sessão, mas precisamos ver se está no bd ainda
            $resultado = Cliente::rpc('verificarLogin', [$_SESSION['username'], $_SESSION['senhahash']]);

            if ($resultado == false) { // não encontrou, mas não precisa sair da page
                session_destroy();
                return "../header.php";
            }
            else {
                return "../view/header.php";
            }
        }
    }

}
