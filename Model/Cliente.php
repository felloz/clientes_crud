<?php

/**
 * Entidades para la tabla Clientes
 *
 * PHP version 7.4.9
 *
 * @category  Modelo
 * @package   Modelo
 * @author    Luis Serrano <serranol82@gmail.com>
 * @copyright 2020 Luis Serrano
 * @license   MIT https://opensource.org/licenses/MIT
 * @version   SVN: $Id$
 * @link      https://laravel.com/docs/7.x/controllers
 */


namespace Model;

/**
 * Entidades para la tabla Clientes
 *
 * PHP version 7.4.9
 *
 * @category  Class
 * @package   Modelo
 * @author    Luis Serrano <serranol82@gmail.com>
 * @copyright 2020 Luis Serrano
 * @license   MIT https://opensource.org/licenses/MIT
 * @version   SVN: $Id$
 * @link      https://laravel.com/docs/7.x/controllers
 */
class Cliente
{
    private $id;
    private $nombre;
    private $apellido;
    private $telefono;
    private $direccion;
    private $ciudad;
    private $pais;
    private $created_at;
    private $updated_at;



    /**
     * Se generan los getters  y setters para cada uno de los campos de las tablas.
     *
     * @return void
     */

    /**
     * Obtener clave primaria de la tabla
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Establecer el id de la table
     *
     * @param [int] $id clave primaria autoincremental
     * 
     * @return void
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Obteener el campo nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Establecer el campo nombre
     *
     * @param [string] $nombre string de 100
     * 
     * @return void
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * Obtener el campo apellido
     *
     * @return string
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * Establecer  el campo apellido
     *
     * @param [string] $apellido string de 100
     * 
     * @return void
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
    }

    /**
     * Obtener el campo telefono
     *
     * @return string
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Establcer datos para el campo telefono
     *
     * @param [string] $telefono string de 50
     * 
     * @return void
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    }

    /**
     * Obtener datos del campo Direccion
     *
     * @return string
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Establecer Campo Dirección
     *
     * @param [string] $direccion Dirección del cliente
     * 
     * @return void
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    }

    /**
     * Obtener Campo ciudad
     * 
     * @return string
     */
    public function getCiudad()
    {
        return $this->ciudad;
    }

    /**
     * Establecer campo ciudad
     *
     * @param [string] $ciudad ciudad de residencia del cliente
     * 
     * @return void
     */
    public function setCiudad($ciudad)
    {
        $this->ciudad = $ciudad;
    }

    /**
     * Obtener País
     *
     * @return string
     */
    public function getPais()
    {
        return $this->pais;
    }

    /**
     * Establecer Pais
     *
     * @param [string] $pais pais de residencia del cliente
     * 
     * @return void
     */
    public function setPais($pais)
    {
        $this->pais = $pais;
    }

    /**
     * Obtener Fecha de creacion del registro
     *
     * @return void
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Establecer fecha de creacion del registro
     *
     * @param [date] $created_at fecha de registro
     * 
     * @return void
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    /**
     * Obtener fecha de actualización
     *
     * @return void
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Establecer fecha de actualización
     *
     * @param [date] $updated_at fecha de actualizacion del registro
     * 
     * @return void
     */
    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;
    }
}
