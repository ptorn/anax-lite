<?php

/**
 * Routes.
 */

$app->router->add("page/{slug}", function ($slug) use ($app) {
    if ($slug) {
        $app->db->connect();
        $query = "SELECT * FROM anaxlite_content WHERE slug = ?;";
        $data = $app->db->executeFetchAll($query, $slug);
        $content = new \Peto16\Content\Content($data[0]);
        if (!$content->isPage()) {
            $app->redirect("404");
        }
    } else {
        // $app->redirect("404");
    }
    $app->view->add("take1/header", ["title" => $content->title]);
    $app->view->add("take1/flash");
    $app->view->add("content/page", [
        "content" => $content
    ]);
    $app->view->add("take1/byline");
    $app->view->add("take1/footer");

    $app->response->setBody([$app->view, "render"])
              ->send();
});

$app->router->add("blog/{slug}", function ($slug) use ($app) {
    if ($slug) {
        $app->db->connect();
        $query = "SELECT * FROM anaxlite_content WHERE slug = ?;";
        $data = $app->db->executeFetchAll($query, $slug);
        $content = new \Peto16\Content\Content($data[0]);
        if (!$content->isBlog()) {
            $app->redirect("404");
        }
    } else {
        // $app->redirect("404");
    }
    $app->view->add("take1/header", ["title" => $content->title]);
    $app->view->add("take1/flash");
    $app->view->add("content/blog-post", [
        "content" => $content
    ]);
    $app->view->add("take1/byline");
    $app->view->add("take1/footer");

    $app->response->setBody([$app->view, "render"])
              ->send();
});
