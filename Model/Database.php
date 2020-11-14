<?php

namespace Model;

use Database\Connect;
use PDO;

/**
 * Undocumented class
 */
class Database extends Connect
{
    private $driver;
    private $dbname;
    private $host;
    private $password;
    private $user;

    /**
     * Se debe pasar el nombre de  la base de datos al instanciar
     *
     * @param string $dbname el nombre debe ser un string
     */
    public function __construct(
        string $driver,
        string $host,
        string $dbname,
        string $user,
        string $password = ""
    ) {
        $this->driver = $driver;
        $this->dbname = $dbname;
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
        parent::__construct();
    }

    /**
     * Crea una base de datos
     *
     * @return boolean
     */
    public function createDB()
    {
        try {

            $query = "CREATE DATABASE $this->dbname";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
            echo "Base de datos $this->dbname creada exitosamente \n";
            return true;
        } catch (\PDOException $th) {

            echo "Ha ocurrido un error SQL: " . $th->getMessage() . "\n";
            return false;
        }

        return true;
    }

    /**
     * Metodo que permite crear tabla de la base  de datos
     *
     * @return boolean
     */
    public function createTable()
    {
        $pdo = "";
        try {
            $pdo = new \PDO(
                $this->driver . ':host=' . $this->host . ';dbname=' . $this->dbname,
                $this->user,
                $this->password
            );
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            die($e->getMessage());
        }
        try {
            $query = "CREATE TABLE clientes (
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
                nombre VARCHAR(50) NOT NULL,
                apellido VARCHAR(50) NOT NULL,
                telefono VARCHAR(50) NOT NULL,
                direccion VARCHAR(150) NOT NULL,
                ciudad VARCHAR(50) NOT NULL,
                pais VARCHAR(50) NOT NULL,
                fecha_registro TIMESTAMP DEFAULT NOW()
                )";
            $stmt = $pdo->prepare($query);
            $stmt->execute();
            echo "Tabla clientes creada exitosamente \n";
            return true;
        } catch (\PDOException $th) {
            echo "Ha ocurrido un error SQL: " .  $th->getMessage();
        }
    }

    public function dbExist()
    {
        try {
            $query = "SHOW DATABASES LIKE $this->dbname";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
            echo $stmt;
            return true;
        } catch (\PDOException $th) {
            echo $th->getMessage();
            return false;
        }
    }

    /**
     * Obtener el nombre de la base de datos
     *
     * @return string
     */
    public function getDbName()
    {
        return $this->dbname;
    }
}
