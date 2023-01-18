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
        $html = $templating->render('building/index.html.php', [
            'buildings' => $buildings,
            'router' => $router,
        ]);
        return $html;
    }

    public function createAction(?array $requestPost, Templating $templating, Router $router): ?string
    {
        if ($requestPost) {
            $post = Post::fromArray($requestPost);
            // @todo missing validation
            $post->save();

            $path = $router->generatePath('post-index');
            $router->redirect($path);
            return null;
        } else {
            $post = new Post();
        }

        $html = $templating->render('post/create.html.php', [
            'post' => $post,
            'router' => $router,
        ]);
        return $html;
    }

    public function editAction(int $postId, ?array $requestPost, Templating $templating, Router $router): ?string
    {
        $post = Post::find($postId);
        if (! $post) {
            throw new NotFoundException("Missing post with id $postId");
        }

        if ($requestPost) {
            $post->fill($requestPost);
            // @todo missing validation
            $post->save();

            $path = $router->generatePath('post-index');
            $router->redirect($path);
            return null;
        }

        $html = $templating->render('post/edit.html.php', [
            'post' => $post,
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

        $html = $templating->render('building/show.html.php', [
            'buildings' => $buildings,
            'building' => $building,
            'router' => $router,
        ]);
        return $html;
    }

    public function deleteAction(int $postId, Router $router): ?string
    {
        $post = Post::find($postId);
        if (! $post) {
            throw new NotFoundException("Missing post with id $postId");
        }

        $post->delete();
        $path = $router->generatePath('post-index');
        $router->redirect($path);
        return null;
    }
}
