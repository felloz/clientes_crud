<?php

require 'vendor/autoload.php';

require_once './assets/partials/header.php';
?>

<div class="container mt-4" id="tab">
    <h1 v-cloak>{{titulo}}</h1>
    <div class="card mt-4">
        <div class="card-header">
            <strong v-cloak>{{cardTitle}}</strong>
        </div>
        <div class="card-body">
            <table-component></table-component>
        </div>
    </div>
</div>

<?php require_once './assets/partials/footer.php' ?>