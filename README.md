CLIENTES CRUD PHP VUEJS
==========

## Installation

1. Clone App
```
$ git clone https://github.com/felloz/clientes_crud
```

2. Install php dependencias
```
composer install
```

3. Install node modules
```
npm install 
```

## Created in PHP 7.4.9

### Setup

**_NOTE_** The next step wasn't tested  so if you have some troubles just skip  it and find a database copy in the Database folder.

1. First Config the DB Connection in the file helpers\create_database.php:

```php

<?php

use Model\Database;

require_once '../vendor/autoload.php';

//Set your parameters here
$database = new Database('mysql', '127.0.0.1', 'prueba_actual2', 'root');

$database->createDb();
$database->createTable();

```
2. Set up the connection for the system in `Database/Connection.php`, this file is the main connection for the whole Crud.

```php
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

```
3. Execute the Script from `helpers/create_database.php/:

```
$ php created_database.php
```


## Now you can use the Crud :-)


![crud_preview](https://i.imgur.com/8Xm5pOD.png)


Live Demo: http://honeymails:8000/