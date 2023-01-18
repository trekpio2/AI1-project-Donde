<?php
/** @var $router \App\Service\Router */
/** @var \App\Model\Building[] $buildings */

?>
<ul>
    <?php foreach ($buildings as $building): ?>
            <li><a href="<?= $router->generatePath('building-show', ['id' => $building->getId()]) ?>"> <?= $building->getName() ?> </a></li>
    <?php endforeach; ?>
    <li><a href="<?= $router->generatePath('building-index') ?>">Home</a></li>
    <li><a href="<?= $router->generatePath('post-index') ?>">Posts</a></li>
</ul>
<?php
