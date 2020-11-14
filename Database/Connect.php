<?php

/**
 * Este archivo controlará la conexión a la base de datos
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

namespace Database;

use PDO;
use FFI\Exception;


/**
 * Clase para la conexion a la base de datos
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
class Connect
{
    public $pdo;

    /**
     * Constructor para crear la conexion al instanciar
     */
    public function __construct()
    {
        try {
            $this->pdo = new PDO('mysql:host=127.0.0.1;dbname=prueba_actual2', 'root', '');
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
