<?php

namespace Frbr18\Blog;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample controller to show how a controller class can be implemented.
 * The controller will be injected with $app if implementing the interface
 * AppInjectableInterface, like this sample class does.
 * The controller is mounted on a particular route and can then handle all
 * requests for that mount point.
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class BlogController implements AppInjectableInterface
{
    use AppInjectableTrait;
    use BlogCrudTrait;
    use PagePostTrait;

    public function indexAction() : string
    {
        // Deal with the action and return a response.
        return $this->app->response->redirect("blog/showall");
    }

    public function debugAction() : string
    {
        // Deal with the action and return a response.
        return "Debug my game";
    }

    
    public function adminAction()
    {
        $this->app->db->connect();
        $title = "Admin content";
        
        $sql = "SELECT * FROM content;";
        $resultset = $this->app->db->executeFetchAll($sql);
        // $data = [
        //     "resultset" => $resultset
        // ];
        $this->app->page->add("blog/admin", [
            "resultset" => $resultset
        ]);
        return $this->app->page->render([
            "title" => $title
        ]);
    }

    public function showallAction()
    {
        $this->app->db->connect();
        $title = "Show all content";
        $sql = "SELECT * FROM content;";
        $resultset = $this->app->db->executeFetchAll($sql);
        $data = [
            "resultset" => $resultset
        ];
        $this->app->page->add("blog/navbar");
        $this->app->page->add("blog/show-all", $data);
        return $this->app->page->render([
            "title" => $title
        ]);
    }

    public function resetActionGet()
    {
        $title = "Show all content";

        $this->app->page->add("blog/reset");
        return $this->app->page->render([
            "title" => $title
        ]);
    }
}
