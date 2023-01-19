<?php
namespace App\Controller;

use App\Exception\NotFoundException;
use App\Model\Building;
use App\Service\Router;
use App\Service\Templating;

class MapController
{
    public function indexAction(Templating $templating, Router $router): ?string
    {
        $buildings = Building::findAll();
        $html = $templating->render('map/index.html.php', [
            'buildings' => $buildings,
            'router' => $router,
        ]);
        return $html;
    }

    public function createAction(?array $requestBuilding, Templating $templating, Router $router): ?string
    {
        $buildings = Building::findAll();

        if ($requestBuilding) {
            $building = Building::fromArray($requestBuilding);
            // @todo missing validation
            $building->save();

            $path = $router->generatePath('map-index');
            $router->redirect($path);
            return null;
        } else {
            $building = new Building();
        }

        $html = $templating->render('map/create.html.php', [
            'building' => $building,
            'buildings' => $buildings,
            'router' => $router,
        ]);
        return $html;
    }

    public function editAction(int $buildingId, ?array $requestBuilding, Templating $templating, Router $router): ?string
    {
        $building = Building::find($buildingId);
        if (! $building) {
            throw new NotFoundException("Missing building with id $buildingId");
        }

        $buildings = Building::findAll();
        
        if ($requestBuilding) {
            $building->fill($requestBuilding);
            // @todo missing validation
            $building->save();

            $path = $router->generatePath('map-show', ['id' => $building->getId()]);
            $router->redirect($path);
            return null;
        }

        $html = $templating->render('map/edit.html.php', [
            'building' => $building,
            'buildings' => $buildings,
            'router' => $router,
        ]);
        return $html;
    }

    public function showAction(int $buildingId, Templating $templating, Router $router): ?string
    {
        $buildings = Building::findAll();
        $building = Building::find($buildingId);
        if (! $building) {
            throw new NotFoundException("Missing post with id $buildingId");
        }

        $html = $templating->render('map/show.html.php', [
            'buildings' => $buildings,
            'building' => $building,
            'router' => $router,
        ]);
        return $html;
    }

    public function deleteAction(int $buildingId, Router $router): ?string
    {
        $building = Building::find($buildingId);
        if (! $building) {
            throw new NotFoundException("Missing post with id $buildingId");
        }

        $building->delete();
        $path = $router->generatePath('map-index');
        $router->redirect($path);
        return null;
    }
}
