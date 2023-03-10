<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'autoload.php';

$config = new \App\Service\Config();

$templating = new \App\Service\Templating();
$router = new \App\Service\Router();

$action = $_REQUEST['action'] ?? null;
switch ($action) {
    case 'map-index':
    case null:
        $controller = new \App\Controller\MapController();
        $view = $controller->indexAction($templating, $router);
        break;
    case 'map-create':
        $controller = new \App\Controller\MapController();
        $view = $controller->createAction($_REQUEST['building'] ?? null, $templating, $router);
        break;
    case 'map-edit':
        if (! $_REQUEST['id']) {
            break;
        }
        $controller = new \App\Controller\MapController();
        $view = $controller->editAction($_REQUEST['id'], $_REQUEST['building'] ?? null, $templating, $router);
        break;
    case 'map-show':
        if (! $_REQUEST['id']) {
            break;
        }
        $controller = new \App\Controller\MapController();
        $view = $controller->showAction($_REQUEST['id'], $templating, $router);
        break;
    case 'map-delete':
        if (! $_REQUEST['id']) {
            break;
        }
        $controller = new \App\Controller\MapController();
        $view = $controller->deleteAction($_REQUEST['id'], $router);
        break;
    default:
        $view = 'Not found';
        break;
}

if ($view) {
    echo $view;
}