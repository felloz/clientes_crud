<?php

/**
 * Este archivo controlará todas las consultas a la base de datos
 *
 * PHP version 7.4.9
 *
 * @category  Class
 * @package   Conexion
 * @author    Luis Serrano <lserranoit@gmail.com>
 * @copyright 2020 Luis Serrano
 * @license   MIT https://opensource.org/licenses/MIT
 * @version   SVN: $Id$
 * @link      https://laravel.com/docs/7.x/controllers
 */

namespace Model;

use Database\Connect;
use Model\Cliente;
use PDO;

/**
 * Clase para controlar todas las consultas a la base de datos
 *
 * PHP version 7.4.9
 *
 * @category  Class
 * @package   Conexion
 * @author    Luis Serrano <lserranoit@gmail.com>
 * @copyright 2020 Luis Serrano
 * @license   MIT https://opensource.org/licenses/MIT
 * @version   SVN: $Id$
 * @link      https://laravel.com/docs/7.x/controllers
 */
class Model extends Connect
{

    /**
     * Este metodo permitira consultar toda la lista de empleados
     * contendia en la base de datos
     *
     * @return json
     */
    public function showAll()
    {
        try {
            $result = array();


            $stmt = $this->pdo->prepare("SELECT * FROM clientes ORDER  BY id DESC");

            $stmt->execute();

            $results = $stmt->fetchAll(PDO::FETCH_OBJ);

            return json_encode($results);
        } catch (\Exception $th) {

            throw $th->getMessage();
        }
    }

    /**
     * Funcion para registrar los clientes
     *
     * @param Cliente $cliente Se inyecta la dependencia Cliente
     * 
     * @return boolean
     */
    public function store(Cliente $cliente)
    {
        try {
            $sql = "INSERT INTO clientes 
                (nombre, apellido, telefono, direccion, ciudad, pais) 
                VALUES (?, ?, ?, ?, ?, ?)";

            $this->pdo->prepare($sql)
                ->execute(
                    array(
                        $cliente->getNombre(),
                        $cliente->getApellido(),
                        $cliente->getTelefono(),
                        $cliente->getDireccion(),
                        $cliente->getCiudad(),
                        $cliente->getPais(),
                    )
                );
            return true;
        } catch (\Exception $e) {
            die($e->getMessage());
        }

        return false;
    }

    /**
     * Metodo que permite editar al cliente
     *
     * @param Cliente $cliente Se hace inyección de la clase Cliente
     * 
     * @return boolean
     */
    public function editar(Cliente $cliente)
    {

        try {
            $sql = "UPDATE clientes SET 
                        nombre     = ?, 
                        apellido   = ?,
                        telefono   = ?, 
                        direccion = ?,
                        ciudad = ?,
                        pais = ?
                    WHERE id = ?";

            $this->pdo->prepare($sql)
                ->execute(
                    array(
                        $cliente->getNombre(),
                        $cliente->getApellido(),
                        $cliente->getTelefono(),
                        $cliente->getDireccion(),
                        $cliente->getCiudad(),
                        $cliente->getPais(),
                        $cliente->getId()
                    )
                );
            return true;
        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Método para consultar  un registro en particular
     * No se utilizó  para la elaboracion de este crud
     *
     * @param [int] $id Id y clave única que identifica al cliente
     * 
     * @return object
     */
    public function mostrarCliente(int $id)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM clientes WHERE id=?");
            $stmt->execute(array($id));
            $data = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $data;
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }

    /**
     * Undocumented function
     *
     * @param integer $id
     * @return void
     */
    public function searchClient($value)
    {
        try {
            $stmt = $this->pdo->prepare(
                "SELECT * FROM clientes WHERE nombre LIKE '%$value%'
                OR apellido LIKE '%$value%' OR telefono LIKE '%$value%' ORDER  BY id DESC"
            );

            $stmt->execute();

            $results = $stmt->fetchAll(PDO::FETCH_OBJ);

            return $results;
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }

    /**
     * Metodo para eliminar al cliente
     *
     * @param [int] $id se requiere el id del cliente
     * 
     * @return boolean
     */
    public function drop(int $id)
    {
        try {
            $stm = $this->pdo
                ->prepare("DELETE FROM clientes WHERE id = ?");

            $stm->execute(array($id));

            return true;
        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }
}
