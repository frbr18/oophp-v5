<?php

namespace Frbr18\Blog;

trait BlogCrudTrait
{
    public function editActionGet($id)
    {
        $title = "edit the post";
        $this->app->db->connect();
        $sql = "select * from content where id = ?";
        $res = $this->app->db->executeFetchAll($sql, [$id]);

        $this->app->page->add("blog/blog-edit", [
            "content" => $res[0]
        ]);
        return $this->app->page->render([
            "title" => $title
        ]);
    }

    public function editActionPost($id)
    {
        $this->app->db->connect();
        $sql = "update content set title = ?, path = ?, slug = ?, data = ?, type = ?, filter = ?, published = ? where id = ?;";
        $this->app->db->execute($sql, [
            $this->app->request->getPost("contentTitle"),
            $this->app->request->getPost("contentPath"),
            $this->app->request->getPost("contentSlug"),
            $this->app->request->getPost("contentData"),
            $this->app->request->getPost("contentType"),
            $this->app->request->getPost("contentFilter"),
            $this->app->request->getPost("contentPublish"),
            $id
        ]);
        $this->app->response->redirect("blog/admin");
    }

    public function deleteAction($id)
    {
        $this->app->db->connect();
        $sql = "update content set deleted = CURRENT_TIMESTAMP where id = ?;";
        $this->app->db->execute($sql, [$id]);
        $this->app->response->redirect("blog/admin");
    }

    public function createActionPost()
    {
        $this->app->db->connect();
        $sql = "insert into content (path, slug, title, data, type, filter) values (?, ?, ?,? ,? ,?)";
        $this->app->db->execute($sql, [
            $this->app->request->getPost("contentTitle"),
            $this->app->request->getPost("contentPath"),
            $this->app->request->getPost("contentSlug"),
            $this->app->request->getPost("contentData"),
            $this->app->request->getPost("contentType"),
            $this->app->request->getPost("contentFilter")
        ]);
        $this->app->response->redirect("blog/show-all");
    }

    public function createActionGet()
    {
        $title = "Create Post";
        $this->app->page->add("blog/blog-create");
        return $this->app->page->render([
            "title" => $title
        ]);
    }
}
