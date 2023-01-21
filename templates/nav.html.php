<?php
/** @var $router \App\Service\Router */
/** @var \App\Model\Building[] $buildings */

?>
<ul>
    <li><a href="<?= $router->generatePath('map-index') ?>">Home</a></li>
    <?php foreach ($buildings as $building): ?>
            <li><a href="<?= $router->generatePath('map-show', ['id' => $building->getId()]) ?>"> <?= $building->getName() ?> </a></li>
    <?php endforeach; ?>
</ul>
<?php
