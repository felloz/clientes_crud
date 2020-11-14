<?php

if (!function_exists('show')) {
    /**
     * Funcion para escapar string
     *
     * @param [mix] $v puede ser entero o string
     * 
     * @return void
     */
    function show($v)
    {
        echo addslashes($v);
    }
}
