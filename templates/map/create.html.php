<?php

/** @var \App\Model\Building $building */
/** @var \App\Service\Router $router */

$title = 'Dodaj budynek';
$bodyClass = "edit";

ob_start(); ?>
    <h1>Dodaj budynek</h1>
    <form action="<?= $router->generatePath('map-create') ?>" method="post" class="edit-form">
        <?php require __DIR__ . DIRECTORY_SEPARATOR . '_form.html.php'; ?>
        <input type="hidden" name="action" value="map-create">
    </form>

    <a href="<?= $router->generatePath('map-index') ?>">Wstecz</a>
<?php $main = ob_get_clean();

include __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'base.html.php';
