<?php

/** @var \App\Model\Building[] $buildings */
/** @var \App\Model\Building $building */
/** @var \App\Service\Router $router */

$title = "{$building->getName()}";
$bodyClass = 'show';

ob_start(); ?>
    <div id="mapContainer" style="height:700px"></div>

    <?php
    // do zmiany 
         echo "
         <script>
            let buildingName = '".$building->getName()."';
            let buildingLatitude = '".$building->getLatitude()."';
            let buildingLongitude = '".$building->getLongitude()."';
         </script>
         ";
        ?>
    <script src="/assets/dist/map.js"></script>
    <script src="/assets/dist/mapShow.js"></script>

<?php $main = ob_get_clean();


include __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'base.html.php';
