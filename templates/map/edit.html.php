<?php

/** @var \App\Model\Map $building */
/** @var \App\Service\Router $router */

$title = "Edytuj budynek: {$building->getName()}";
$bodyClass = "edit";

ob_start(); ?>
    <h1><?= $title ?></h1>
    <form action="<?= $router->generatePath('map-edit') ?>" method="post" class="edit-form">
        <?php require __DIR__ . DIRECTORY_SEPARATOR . '_form.html.php'; ?>
        <input type="hidden" name="action" value="map-edit">
        <input type="hidden" name="id" value="<?= $building->getId() ?>">
    </form>

    <ul class="action-list">
        <li>
            <a href="<?= $router->generatePath('map-show', ['id' => $building->getId()]) ?>">Wstecz</a></li>
        <li>
            <form action="<?= $router->generatePath('map-delete') ?>" method="post">
                <input type="submit" value="Usuń budynek" onclick="return confirm('Na pewno chcesz usunąć budynek?')">
                <input type="hidden" name="action" value="map-delete">
                <input type="hidden" name="id" value="<?= $building->getId() ?>">
            </form>
        </li>
    </ul>

<?php $main = ob_get_clean();

include __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'base.html.php';
