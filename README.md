CLIENTES CRUD PHP VUEJS
==========

## Installation

```
composer install
```

```
npm install 
```

## Created in PHP 7.4.9

### Setup

**_NOTE_** The next step its only to generate the database and table through Script. The database can be generated with the script or just you can look for it in the `helpers` folder

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
2. Execute the Script from `helpers/create_database.php/:

```
$ php created_database.php
```
**_NOTE_** After generate de Database and tables you can config the file to connect the Crud to the Database.

1. Config the crud database connection in `Database/Connect.php`

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

## Now you can use the Crud :-)


![crud_preview](https://i.imgur.com/8Xm5pOD.png)