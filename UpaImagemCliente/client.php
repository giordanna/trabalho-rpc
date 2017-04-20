<?php

require_once('autoload.php');

use JsonRPC\Client;

class Cliente {
    static public function rpc($funcao, $array) {
        $client = new Client('http://192.168.0.13:80/server.php');
        return $client->execute($funcao, $array);
    }
}
