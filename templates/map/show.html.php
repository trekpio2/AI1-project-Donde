<?php

/** @var \App\Model\Building[] $buildings */
/** @var \App\Model\Building $building */
/** @var \App\Service\Router $router */

$title = "{$building->getName()}";

$bodyClass = 'show';

ob_start(); ?>
    <aside style="float:left">
        <h2>Wybrano budynek: <?= $building->getName();?></h1>
        <?php //reszta info?>
    </aside>
    
    <div id="mapContainer" style="height:700px"></div>
    <div style="clear:both"></div>
    <a href="<?= $router->generatePath('map-index') ?>">Wstecz</a>
    <a href="<?= $router->generatePath('map-edit', ['id'=> $building->getId()]) ?>">Edytuj</a>
<?php
$main = ob_get_clean();
ob_start();
    // do zmiany? 
    echo "
    <script>
        let building = '".json_encode($building)."';
    </script>
    ";
?>
    <script src="/assets/dist/map.js"></script>
    <script src="/assets/dist/mapShow.js"></script>
<?php $scripts = ob_get_clean();
ob_start(); ?>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.2/dist/leaflet.css" integrity="sha256-sA+zWATbFveLLNqWO2gtiw3HL/lh1giY/Inf1BJ0z14=" crossorigin="" />
<link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />

<script src="https://unpkg.com/leaflet@1.9.2/dist/leaflet.js" integrity="sha256-o9N1jGDZrf5tS+Ft4gbIK7mYMipq9lqpVJ91xHSyKhg=" crossorigin=""></script>
<script src='https://unpkg.com/leaflet-image@0.4.0/leaflet-image.js'></script>
<script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
<?php $leaflet = ob_get_clean();
include __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'base.html.php';
