<?php

/**
 * Routes.
 */
$app->router->add("", function () use ($app) {
    $app->view->add("take1/header", ["title" => "Start"]);
    $app->view->add("take1/flash");
    $app->view->add("take1/home");
    $app->view->add("take1/byline");
    $app->view->add("take1/footer");

    $app->response->setBody([$app->view, "render"])
              ->send();
});

$app->router->add("about", function () use ($app) {
    $app->view->add("take1/header", ["title" => "Om"]);
    $app->view->add("take1/flash");
    $app->view->add("take1/about");
    $app->view->add("take1/byline");
    $app->view->add("take1/footer");

    $app->response->setBody([$app->view, "render"])
              ->send();
});

$app->router->add("report", function () use ($app) {
    $app->view->add("take1/header", ["title" => "Redovisning"]);
    $app->view->add("take1/flash");
    $app->view->add("take1/report");
    $app->view->add("take1/byline");
    $app->view->add("take1/footer");

    $app->response->setBody([$app->view, "render"])
              ->send();
});

$app->router->add("test", function () use ($app) {
    $app->view->add("take1/header", ["title" => "Test"]);
    $app->view->add("take1/flash");
    $app->view->add("take1/test");
    $app->view->add("take1/byline");
    $app->view->add("take1/footer");

    $app->response->setBody([$app->view, "render"])
              ->send();
});

$app->router->add("calendar", function () use ($app) {
    $app->view->add("take1/header", ["title" => "Kalender"]);
    $app->view->add("take1/calendar", [
        "calendar" => new \Peto16\Calendar\Calendar()
    ]);
    $app->view->add("take1/byline");
    $app->view->add("take1/footer");
    $app->response->setBody([$app->view, "render"])
              ->send();
});

$app->router->add("status", function () use ($app) {
    $data = [
        "Server" => php_uname(),
        "PHP version" => phpversion(),
        "Included files" => count(get_included_files()),
        "Memory used" => memory_get_peak_usage(true),
        "Execution time" => microtime(true) - $_SERVER['REQUEST_TIME_FLOAT'],
    ];

    $app->response->sendJson($data);
});

$app->router->add("search/{string}", function ($string) use ($app) {
    $data = [
        "Searchstring was" => $string
    ];

    $app->response->sendJson($data);
});
