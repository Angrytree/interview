<?php

namespace database;

use PDO;

class Database {

    private PDO $pdo;

    private $statement;

    public function __construct() {
        $config = new DbConfig();
        $config = $config->settings;

        $this->pdo = new PDO($config['dsn'], $config['username'], $config['password']);
    }

    public function query($query) {
        $this->statement = $this->pdo->query($query, PDO::FETCH_ASSOC);
        return $this;
    }

    public function result(){
        return $this->statement->fetchAll();
    }

}