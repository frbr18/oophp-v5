<?php

namespace Frbr18\Movie;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

require "function.php";

class MovieController implements AppInjectableInterface
{
    use AppInjectableTrait;



    /**
     * @var string $db a sample member variable that gets initialised
     */
    private $db = "not active";



    /**
     * The initialize method is optional and will always be called before the
     * target method/action. This is a convienient method where you could
     * setup internal properties that are commonly used by several methods.
     *
     * @return void
     */
    public function initialize() : void
    {
        // Use to initialise member variables.
        $this->db = "active";
        // Use $this->app to access the framework services.
    }



    /**
     * @return string
     */
    public function indexAction()
    {
        $title = "Movie database | oophp";
        $this->app->page->add("movie/index");
        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    public function showMoviesAction()
    {
        $title = "Movie database | oophp";

        $this->app->db->connect();
        $sql = "SELECT * FROM movie;";
        $res = $this->app->db->executeFetchAll($sql);

        $this->app->page->add("movie/navbar");
        $this->app->page->add("movie/show-movies", [
            "resultset" => $res,
        ]);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    public function searchTitleActionGet() 
    {
        $title = "SELECT * WHERE title";

        $this->app->db->connect();
        $sql = "SELECT * FROM movie WHERE title LIKE ?;";
        $searchTitle = $this->app->request->getGet("searchTitle");
        $res = $this->app->db->executeFetchAll($sql, [$searchTitle]);
        
        $this->app->page->add("movie/navbar");
        $this->app->page->add("movie/search-title", [
            "searchTitle" => $searchTitle
        ]);
        $this->app->page->add("movie/show-movies", [
            "resultset" => $res
        ]);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    public function searchYearAction()
    {
        $title = "SELECT * WHERE year";
        $this->app->db->connect();
        $year1 = $this->app->request->getGet("year1");
        $year2 = $this->app->request->getGet("year2");
        $resultset = "";
        if ($year1 && $year2) {
            $sql = "SELECT * FROM movie WHERE year >= ? AND year <= ?;";
            $resultset = $this->app->db->executeFetchAll($sql, [$year1, $year2]);
        } elseif ($year1) {
            $sql = "SELECT * FROM movie WHERE year >= ?;";
            $resultset = $this->app->db->executeFetchAll($sql, [$year1]);
        } elseif ($year2) {
            $sql = "SELECT * FROM movie WHERE year <= ?;";
            $resultset = $this->app->db->executeFetchAll($sql, [$year2]);
        }
        $this->app->page->add("movie/navbar");
        $this->app->page->add("movie/search-year", [
            "year1" => $year1,
            "year2" => $year2
        ]);
        $this->app->page->add("movie/show-movies", [
            "resultset" => $resultset
        ]);
        
        return $this->app->page->render([
            "title" => $title
        ]);
    }

    public function movieSelectActionGet() 
    {
        $title = "SELECT * WHERE title";

        $this->app->db->connect();
        $sql = "SELECT * FROM movie;";
        $searchTitle = $this->app->session->get("searchTitle");
        $res = $this->app->db->executeFetchAll($sql);

        $this->app->page->add("movie/navbar");
        $this->app->page->add("movie/movie-select", [
            "searchTitle" => $searchTitle,
            "movies" => $res
        ]);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    public function movieSelectActionPost() 
    {
        $this->app->db->connect();
        $movieId = $this->app->request->getPost("movieId");
        var_dump($movieId);
        if ($this->app->request->getPost("doDelete")) {
            $sql = "DELETE FROM movie WHERE id = ?;";
            $this->app->db->execute($sql, [$movieId]);
            $this->app->response->redirect("movie2/movie-select");
        } elseif ($this->app->request->getPost("doAdd")) {
            $sql = "INSERT INTO movie (title, year, image) VALUES (?, ?, ?);";
            $this->app->db->execute($sql, ["A title", 2017, "img/noimage.png"]);
            $movieId = $this->app->db->lastInsertId();
            $_SESSION["editMovieID"] = $movieId;
            $this->app->response->redirect("movie2/movie-edit");
        } elseif ($this->app->request->getPost("doEdit") && is_numeric($movieId)) {
            $_SESSION["editMovieID"] = $movieId;
            $this->app->response->redirect("movie2/movie-edit");
        }
    }

    public function movieEditActionGet()
    {
        $title = "Edit Movie";
        $movieId = $_SESSION["editMovieID"];
        $this->app->db->connect();
        $sql = "SELECT * FROM movie WHERE id = ?;";
        $movie = $this->app->db->executeFetchAll($sql, [$movieId]);

        $this->app->page->add("movie/movie-edit", [
            "movie" => $movie[0]
        ]);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    public function movieEditActionPost()
    {
        $this->app->db->connect();

        $movieId = $this->app->request->getPost("movieId") ?: getGet("movieId");
        $movieTitle = $this->app->request->getPost("movieTitle");
        $movieYear  = $this->app->request->getPost("movieYear");
        $movieImage = $this->app->request->getPost("movieImage");

        if ($this->app->request->getPost("doSave")) {
            $sql = "UPDATE movie SET title = ?, year = ?, image = ? WHERE id = ?;";
            $this->app->db->execute($sql, [$movieTitle, $movieYear, $movieImage, $movieId]);
        }

        $this->app->response->redirect("movie2/movie-select");
    }
    /**
     * This sample method dumps the content of $app.
     * GET mountpoint/dump-app
     *
     * @return string
     */
    public function dumpAppActionGet() : string
    {
        // Deal with the action and return a response.
        $services = implode(", ", $this->app->getServices());
        return __METHOD__ . "<p>\$app contains: $services";
    }



    // /**
    //  * Add the request method to the method name to limit what request methods
    //  * the handler supports.
    //  * GET mountpoint/info
    //  *
    //  * @return string
    //  */
    // public function infoActionGet() : string
    // {
    //     // Deal with the action and return a response.
    //     return __METHOD__ . ", \$db is {$this->db}";
    // }



    // /**
    //  * This sample method action it the handler for route:
    //  * GET mountpoint/create
    //  *
    //  * @return string
    //  */
    // public function createActionGet() : string
    // {
    //     // Deal with the action and return a response.
    //     return __METHOD__ . ", \$db is {$this->db}";
    // }



    // /**
    //  * This sample method action it the handler for route:
    //  * POST mountpoint/create
    //  *
    //  * @return string
    //  */
    // public function createActionPost() : string
    // {
    //     // Deal with the action and return a response.
    //     return __METHOD__ . ", \$db is {$this->db}";
    // }



    // /**
    //  * This sample method action takes one argument:
    //  * GET mountpoint/argument/<value>
    //  *
    //  * @param mixed $value
    //  *
    //  * @return string
    //  */
    // public function argumentActionGet($value) : string
    // {
    //     // Deal with the action and return a response.
    //     return __METHOD__ . ", \$db is {$this->db}, got argument '$value'";
    // }



    // /**
    //  * This sample method action takes zero or one argument and you can use - as a separator which will then be removed:
    //  * GET mountpoint/defaultargument/
    //  * GET mountpoint/defaultargument/<value>
    //  * GET mountpoint/default-argument/
    //  * GET mountpoint/default-argument/<value>
    //  *
    //  * @param mixed $value with a default string.
    //  *
    //  * @return string
    //  */
    // public function defaultArgumentActionGet($value = "default") : string
    // {
    //     // Deal with the action and return a response.
    //     return __METHOD__ . ", \$db is {$this->db}, got argument '$value'";
    // }



    // /**
    //  * This sample method action takes two typed arguments:
    //  * GET mountpoint/typed-argument/<string>/<int>
    //  *
    //  * NOTE. Its recommended to not use int as type since it will still
    //  * accept numbers such as 2hundred givving a PHP NOTICE. So, its better to
    //  * deal with type check within the action method and throuw exceptions
    //  * when the expected type is not met.
    //  *
    //  * @param mixed $value with a default string.
    //  *
    //  * @return string
    //  */
    // public function typedArgumentActionGet(string $str, int $int) : string
    // {
    //     // Deal with the action and return a response.
    //     return __METHOD__ . ", \$db is {$this->db}, got string argument '$str' and int argument '$int'.";
    // }



    // /**
    //  * This sample method action takes a variadic list of arguments:
    //  * GET mountpoint/variadic/
    //  * GET mountpoint/variadic/<value>
    //  * GET mountpoint/variadic/<value>/<value>
    //  * GET mountpoint/variadic/<value>/<value>/<value>
    //  * etc.
    //  *
    //  * @param array $value as a variadic parameter.
    //  *
    //  * @return string
    //  */
    // public function variadicActionGet(...$value) : string
    // {
    //     // Deal with the action and return a response.
    //     return __METHOD__ . ", \$db is {$this->db}, got '" . count($value) . "' arguments: " . implode(", ", $value);
    // }



    // /**
    //  * Adding an optional catchAll() method will catch all actions sent to the
    //  * router. You can then reply with an actual response or return void to
    //  * allow for the router to move on to next handler.
    //  * A catchAll() handles the following, if a specific action method is not
    //  * created:
    //  * ANY METHOD mountpoint/**
    //  *
    //  * @param array $args as a variadic parameter.
    //  *
    //  * @return mixed
    //  *
    //  * @SuppressWarnings(PHPMD.UnusedFormalParameter)
    //  */
    // public function catchAll(...$args)
    // {
    //     // Deal with the request and send an actual response, or not.
    //     //return __METHOD__ . ", \$db is {$this->db}, got '" . count($args) . "' arguments: " . implode(", ", $args);
    //     return;
    // }
}
