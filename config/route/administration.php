<?php

$app->router->add("administration/**", function () use ($app) {
    if (!isLoggedInAndActive($app)) {
        $app->redirect("login");
    }
});
