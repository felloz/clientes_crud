<?php

/**
 * Este archivo controlará todaslas peticiones HTTP.
 *
 * PHP version 7.4.9
 *
 * @category Class
 *
 * @author    Luis Serrano <lserranoit@gmail.com>
 * @copyright 2020 Luis Serrano
 * @license   MIT https://opensource.org/licenses/MIT
 *
 * @version SVN: $Id$
 *
 * @see https://laravel.com/docs/7.x/controllers
 */

namespace App\Classes;

use Model\Cliente;
use Model\Model;

/**
 * Este archivo controlará todaslas peticiones HTTP.
 *
 * PHP version 7.4.9
 *
 * @category Class
 *
 * @author    Luis Serrano <lserranoit@gmail.com>
 * @copyright 2020 Luis Serrano
 * @license   MIT https://opensource.org/licenses/MIT
 *
 * @version SVN: $Id$
 *
 * @see https://laravel.com/docs/7.x/controllers
 */
class Request
{
    private $request;
    private $data;
    private $model;

    /**
     * El constructor debe recibir dos paramentros.
     *
     * @param [request]  $request Server Request que recibe el backend
     * @param [function] $json    file_get_contents('php://input')
     */
    public function __construct($request, $json)
    {
        $this->request = $request;
        $this->data = json_decode($json);
        $this->model = new Model();
        $this->cliente = new Cliente();
    }

    /**
     * Esté método se encargara de procesar todos los request que se
     * Reciban en el constructor.
     *
     * @return json
     */
    public function processRequest()
    {
        switch ($this->request) {

        case 'GET':

            return $this->model->showAll();
                break;

        case 'POST':

            if (isset($this->data->action) && $this->data->action === "search") {

                return json_encode(
                    $this->model->searchClient($this->data->value)
                );
            }

            if (!empty($this->data->nombre)
                && !empty($this->data->apellido)
                && !empty($this->data->telefono)
                && !empty($this->data->direccion)
                && !empty($this->data->ciudad)
                && !empty($this->data->pais)
            ) {
                $this->cliente->setNombre($this->data->nombre);
                $this->cliente->setApellido($this->data->apellido);
                $this->cliente->setTelefono($this->data->telefono);
                $this->cliente->setDireccion($this->data->direccion);
                $this->cliente->setCiudad($this->data->ciudad);
                $this->cliente->setPais($this->data->pais);

                if ($this->model->store($this->cliente)) {
                    $response = [
                        'code' => '200',
                        'message' => 'Cliente ' . $this->cliente->getNombre() . ' agregado exitosamente!',
                    ];

                    return json_encode($response);
                } else {
                    $response = [
                        'code' => '500',
                        'message' => 'Error al registrar',
                    ];

                    return json_encode($response);
                }
            } else {
                return [
                    'code' => '403',
                    'message' => 'Faltan Campos',
                ];
            }
            break;

        case 'PUT':
            $response = [
                'code' => '200',
                'message' => 'Edicion Exitosa',
            ];
            if (!empty($this->data->id)) {
                $this->cliente->setId($this->data->id);

                if (!empty($this->data->nombre)) {
                    $this->cliente->setNombre($this->data->nombre);
                }

                if (!empty($this->data->apellido)) {
                    $this->cliente->setApellido($this->data->apellido);
                }

                if (!empty($this->data->telefono)) {
                    $this->cliente->setTelefono($this->data->telefono);
                }

                if (!empty($this->data->direccion)) {
                    $this->cliente->setDireccion($this->data->direccion);
                }

                if (!empty($this->data->ciudad)) {
                    $this->cliente->setCiudad($this->data->ciudad);
                }

                if (!empty($this->data->pais)) {
                    $this->cliente->setPais($this->data->pais);
                }

                if ($this->model->editar($this->cliente)) {
                    $response = [
                        'code' => '200',
                        'message' => 'Edicion Exitosa',
                    ];
                }

                return json_encode($response);
            } else {
                return json_encode(
                    [
                        'code' => 403,
                        'message' => 'Se necesita el id del cliente',
                    ]
                );
            }
            break;

        case 'DELETE':
            //return "Backend " . $this->data->id;
            $this->model->drop($this->data->id);
            $response = [
                'code' => '200',
                'message' => 'Registro Eliminado',
            ];

            return json_encode($response);
                break;
        default:
            // code...
            break;
        }
    }
}
