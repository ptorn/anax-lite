<?php

$app->router->add("administration/admin/**", function () use ($app) {
    if (!isLoggedInAndActive($app)) {
        $app->redirect("login");
    }
});


$app->router->add("administration/user/**", function () use ($app) {
    if (!isLoggedInAndActive($app)) {
        $app->redirect("login");
    }
});


$app->router->add("administration/create", function () use ($app) {
    $error = getGet('error') && getGet('error') == 1 ? "Username is already taken!" : false;
    $app->view->add("take1/header", ["title" => "Skapa användare"]);
    $app->view->add("take1/flash", [
        "img" => "img/security.jpg"
    ]);
    $app->view->add("administration/user/create", [
        "error" => $error
    ]);
    $app->view->add("take1/byline");
    $app->view->add("take1/footer");
    $app->response->setBody([$app->view, "render"])
        ->send();
});


$app->router->add("administration/create/process", function () use ($app) {
    $param = [
        $username = getPost('username'),
        $firstname = getPost('firstname'),
        $lastname = getPost('lastname'),
        $email = getPost('email'),
        $password = getPost('password') ? password_hash(getPost('password'), PASSWORD_DEFAULT) : false
    ];
    $app->db->connect();
    $query = "SELECT * FROM anaxlite_Users WHERE username=?;";
    if ($app->db->dataExcist($query, $param[0])) {
        $app->redirect("administration/create?error=1");
    } else {
        $query = "INSERT INTO anaxlite_Users(username, firstname, lastname, email, password) VALUES (?, ?, ?, ?, ?);";
        if ($app->db->execute($query, $param)) {
            $app->redirect("login");
        } else {
            $app->redirect("administration/create?error=1");
        };
    }
});
