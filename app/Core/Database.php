<?php


namespace App\Core;


class Database
{
    /**
     * @var
     */
    protected $pdo;

    /**
     * @var
     */
    protected static $instance;

    /**
     * Database constructor.
     */
    public function __construct()
    {
        $this->pdo = new \PDO(
            Config::env('db.driver') . ':dbname=' .
            Config::env('db.name') . ';host=' .
            Config::env('db.host'),
            Config::env('db.username'),
            Config::env('db.password'));
    }

    /**
     * @return Database
     */
    public static function getInstance()
    {
        if (! isset(self::$instance)){
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @return \PDO
     */
    public function testConnection()
    {
        try {
            return $this->pdo;
        }catch (\PDOException $e){
            $e->getMessage();
        }
    }
}