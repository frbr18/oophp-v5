<?php
/**
 * Show all movies.
 */

require "../src/movie/function.php";
$app->router->get("movie", function () use ($app) {
    $title = "Movie database | oophp";

    $app->db->connect();
    $sql = "SELECT * FROM movie;";
    $res = $app->db->executeFetchAll($sql);

    $app->page->add("movie/navbar");
    $app->page->add("movie/index", [
        "resultset" => $res,
    ]);

    return $app->page->render([
        "title" => $title,
    ]);
});


$app->router->get("movie/search-title", function () use ($app) {
    $title = "SELECT * WHERE title";

    $app->db->connect();
    $sql = "SELECT * FROM movie WHERE title LIKE ?;";
    $searchTitle = getGet("searchTitle");
    $res = $app->db->executeFetchAll($sql, [$searchTitle]);
    
    $app->page->add("movie/search-title", [
        "searchTitle" => $searchTitle
    ]);
    $app->page->add("movie/index", [
        "resultset" => $res
    ]);

    return $app->page->render([
        "title" => $title,
    ]);
});

$app->router->get("movie/search-year", function () use ($app) {
    $title = "SELECT * WHERE year";
    $app->db->connect();
    $year1 = getGet("year1");
    $year2 = getGet("year2");
    $resultset = "";
    if ($year1 && $year2) {
        $sql = "SELECT * FROM movie WHERE year >= ? AND year <= ?;";
        $resultset = $app->db->executeFetchAll($sql, [$year1, $year2]);
    } elseif ($year1) {
        $sql = "SELECT * FROM movie WHERE year >= ?;";
        $resultset = $app->db->executeFetchAll($sql, [$year1]);
    } elseif ($year2) {
        $sql = "SELECT * FROM movie WHERE year <= ?;";
        $resultset = $app->db->executeFetchAll($sql, [$year2]);
    }
    $app->page->add("movie/search-year", [
        "year1" => $year1,
        "year2" => $year2
    ]);
    $app->page->add("movie/index", [
        "resultset" => $resultset
    ]);
    return $app->page->render([
        "title" => $title
    ]);
});

$app->router->get("movie/movie-select", function () use ($app) {
    $title = "SELECT * WHERE title";

    $app->db->connect();
    $sql = "SELECT * FROM movie;";
    $searchTitle = getGet("searchTitle");
    $res = $app->db->executeFetchAll($sql);
    
    $app->page->add("movie/movie-select", [
        "searchTitle" => $searchTitle,
        "movies" => $res
    ]);

    return $app->page->render([
        "title" => $title,
    ]);
});

$app->router->post("movie/movie-select", function () use ($app) {
    $app->db->connect();
    $movieId = getPost("movieId");

    if (getPost("doDelete")) {
        $sql = "DELETE FROM movie WHERE id = ?;";
        $app->db->execute($sql, [$movieId]);
        $app->response->redirect("movie/movie-select");
    } elseif (getPost("doAdd")) {
        $sql = "INSERT INTO movie (title, year, image) VALUES (?, ?, ?);";
        $app->db->execute($sql, ["A title", 2017, "img/noimage.png"]);
        $movieId = $app->db->lastInsertId();
        $_SESSION["editMovieID"] = $movieId;
        $app->response->redirect("movie/movie-edit");
    } elseif (getPost("doEdit") && is_numeric($movieId)) {
        $_SESSION["editMovieID"] = $movieId;
        $app->response->redirect("movie/movie-edit");
    }
});

$app->router->get("movie/movie-edit", function () use ($app) {
    $title = "Edit Movie";
    $movieId = $_SESSION["editMovieID"];
    $app->db->connect();
    $sql = "SELECT * FROM movie WHERE id = ?;";
    $movie = $app->db->executeFetchAll($sql, [$movieId]);

    $app->page->add("movie/movie-edit", [
        "movie" => $movie[0]
    ]);

    return $app->page->render([
        "title" => $title,
    ]);
});

$app->router->post("movie/movie-edit", function () use ($app) {
    $title = "UPDATE movie";
    $app->db->connect();

    $movieId = getPost("movieId") ?: getGet("movieId");
    $movieTitle = getPost("movieTitle");
    $movieYear  = getPost("movieYear");
    $movieImage = getPost("movieImage");

    if (getPost("doSave")) {
        $sql = "UPDATE movie SET title = ?, year = ?, image = ? WHERE id = ?;";
        $app->db->execute($sql, [$movieTitle, $movieYear, $movieImage, $movieId]);
    }

    $app->response->redirect("movie/movie-select");
});
