<?php
/**
 * Routes.
 */
$app->router->add("session", function () use ($app) {
    $app->view->add("take1/header", ["title" => "Session"]);
    $app->view->add("take1/flash");
    $app->view->add("take1/session");
    $app->view->add("take1/byline");
    $app->view->add("take1/footer");
    $app->response->setBody([$app->view, "render"])
              ->send();
});


$app->router->add("session/increment", function () use ($app) {
    $app->session->set("number", $app->session->get("number") + 1);
    $app->redirect("session");
});


$app->router->add("session/decrement", function () use ($app) {
    $app->session->set("number", $app->session->get("number") - 1);
    $app->redirect("session");
});


$app->router->add("session/status", function () use ($app) {
    $jsonObj = [
        "sessionId"             => session_id(),
        "sessionName"           => session_name(),
        "sessionStatus"         => session_status(),
        "sessionCacheExpire"    => session_cache_expire()
    ];
    $app->response->sendJson($jsonObj);
});


$app->router->add("session/dump", function () use ($app) {
    $app->view->add("take1/header", ["title" => "Session"]);
    $app->view->add("take1/flash");
    $app->view->add("take1/dump");
    $app->view->add("take1/byline");
    $app->view->add("take1/footer");
    $app->response->setBody([$app->view, "render"])
              ->send();
});


$app->router->add("session/destroy", function () use ($app) {
    $app->session->destroy();
    $app->redirect("session/dump");
});
