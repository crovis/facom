<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Database
 *
 * @author ngaletti
 */
class Database {

    // Guarda uma instância da classe
    private static $instance;
    private $host;
    private $db;
    private $port;
    private $user;
    private $password;
    private $conecta;

    public function getConexao() {
        return $this->conecta;
    }

    public function getHost() {
        return $this->host;
    }

    public function setHost($host) {
        $this->host = $host;
    }

    public function getDb() {
        return $this->db;
    }

    public function setDb($db) {
        $this->db = $db;
    }

    public function getPort() {
        return $this->port;
    }

    public function setPort($port) {
        $this->port = $port;
    }

    public function getUser() {
        return $this->user;
    }

    public function setUser($user) {
        $this->user = $user;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    // Um construtor privado; previne a criação direta do objeto
    private function __construct($con) {
        $config = Config::$config;
        $this->setDb($config[$con]['dbname']);
        $this->setHost($config[$con]['host']);
        $this->setPassword($config[$con]['pass']);
        $this->setPort($config[$con]['port']);
        $this->setUser($config[$con]['user']);

        $conexao = 'pgsql:dbname=' . $this->db . ';host=' . $this->host . ';port=' . $this->port;

        try {
            $this->conecta = new PDO($conexao, $this->user, $this->password);
            $this->conecta->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            if(key_exists('schema', $config[$con]))
                $this->conecta->exec("SET search_path = ".$config[$con]['schema']);
        } catch (PDOexception $error_conecta) {
            echo htmlentities('Erro ao conectar' . $error_conecta->getMessage());
        }
    }

    // O método singleton 
    public static function singleton($con = 0) {

        if (!isset(self::$instance)) {
            $c = __CLASS__;
            self::$instance = new $c($con);
        }

        return self::$instance;
    }

    // Previne que o usuário clone a instância
    public function __clone() {
        trigger_error('Clone is not allowed.', E_USER_ERROR);
    }

}

?>
