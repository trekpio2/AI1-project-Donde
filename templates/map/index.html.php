<?php

/** @var \App\Model\Post[] $posts */
/** @var \App\Model\Building[] $buildings */
/** @var \App\Service\Router $router */

$title = 'Strona główna';
$bodyClass = 'index';

ob_start(); ?>
    <div id="mapContainer" style="height:700px"></div>

    <a href="<?= $router->generatePath('map-create') ?>">Dodaj budynek</a>


<?php
$main = ob_get_clean();
ob_start(); 
    // do zmiany?
        echo "
        <script>
        let buildings = '".json_encode($buildings)."';
        </script>
        ";
    ?>
    <script src="/assets/dist/map.js"></script>
    <script src="/assets/dist/mapIndex.js"></script>
<?php $scripts = ob_get_clean();
ob_start(); ?>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.2/dist/leaflet.css" integrity="sha256-sA+zWATbFveLLNqWO2gtiw3HL/lh1giY/Inf1BJ0z14=" crossorigin="" />
<link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />

<script src="https://unpkg.com/leaflet@1.9.2/dist/leaflet.js" integrity="sha256-o9N1jGDZrf5tS+Ft4gbIK7mYMipq9lqpVJ91xHSyKhg=" crossorigin=""></script>
<script src='https://unpkg.com/leaflet-image@0.4.0/leaflet-image.js'></script>
<script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
<?php $leaflet = ob_get_clean();
include __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'base.html.php';
