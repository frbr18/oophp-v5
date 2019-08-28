<?php

namespace Frbr18\Blog;

trait PagePostTrait
{
    public function postsActionGet()
    {
        $textFilter = new MyTextFilter();
        $title = "Posts";
        $sql = "select * from content where type = ? order by published desc;";
        $this->app->db->connect();

        $resultset = $this->app->db->executeFetchAll($sql, ["post"]);
        foreach ($resultset as $res) {
            $res->filter = explode(",", $res->filter);
            $res->data = $textFilter->parse($res->data, $res->filter);
        }
        $this->app->page->add("blog/blog-posts", [
            "resultset" => $resultset
        ]);
        return $this->app->page->render([
            "title" => $title
        ]);
    }

    public function postActionGet($id)
    {
        $textFilter = new MyTextFilter();
        $title = "Post";
        $sql = "select * from content where id = ?;";
        $this->app->db->connect();
        $res = $this->app->db->executeFetchAll($sql, [$id]);
        $res[0]->filter = explode(",", $res[0]->filter);
        $res[0]->data = $textFilter->parse($res[0]->data, $res[0]->filter);
        $this->app->page->add("blog/blog-post", [
            "content" => $res[0]
        ]);
        return $this->app->page->render([
            "title" => $title
        ]);
    }

    public function pagesActionGet()
    {
        $textFilter = new MyTextFilter();
        $title = "Pages";
        $sql = "select * from content where type = ? order by published desc;";
        $this->app->db->connect();

        $resultset = $this->app->db->executeFetchAll($sql, ["page"]);
        foreach ($resultset as $res) {
            $res->filter = explode(",", $res->filter);
            $res->data = $textFilter->parse($res->data, $res->filter);
        }
        $this->app->page->add("blog/blog-pages", [
            "resultset" => $resultset
        ]);
        return $this->app->page->render([
            "title" => $title
        ]);
    }

    public function pageActionGet($id)
    {
        $textFilter = new MyTextFilter();
        $title = "Page";
        $sql = "select * from content where id = ?;";
        $this->app->db->connect();
        $res = $this->app->db->executeFetchAll($sql, [$id]);
        $res[0]->filter = explode(",", $res[0]->filter);
        $res[0]->data = $textFilter->parse($res[0]->data, $res[0]->filter);
        $this->app->page->add("blog/blog-page", [
            "content" => $res[0]
        ]);
        return $this->app->page->render([
            "title" => $title
        ]);
    }
}
