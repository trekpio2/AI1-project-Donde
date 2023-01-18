<?php

/** @var \App\Model\Post[] $posts */
/** @var \App\Model\Building[] $buildings */
/** @var \App\Service\Router $router */

$title = 'Strona główna';
$bodyClass = 'index';

ob_start(); ?>
    <div id="mapContainer" style="height:700px"></div>

    
    <script src="/assets/dist/map.js"></script>
    <script src="/assets/dist/mapIndex.js"></script>
<?php $main = ob_get_clean();

include __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'base.html.php';
