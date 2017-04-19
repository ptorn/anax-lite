<?php

/**
 * Routes.
 */
$app->router->add("user/login", function () use ($app) {
    $status = "";
    $username = htmlentities(getPost('username'));
    $password = htmlentities(getPost('password'));
    $user = new \Peto16\User\User();
    if ($username && $password) {
        $app->db->connect();
        $dbUser = $app->db->executeFetchAll("SELECT * FROM Users WHERE username=?", [$username]);
        if (!empty($dbUser)) {
            $user->setUserData($dbUser[0]);
            $status = $user->loginUser($password) ?: "Fel användaruppgifter!";
        } else {
            $status = "Fel användaruppgifter";
        }
    }
    if (isLoggedInAndActive($app)) {
        $app->response->redirect($app->url->create("user"));
    }
    $app->view->add("take1/header", ["title" => "Login"]);
    $app->view->add("take1/flash", [
        "img" => "img/security.jpg"
    ]);
    $app->view->add("user/login", ["status" => $status]);
    $app->view->add("take1/byline");
    $app->view->add("take1/footer");
    $app->response->setBody([$app->view, "render"])
        ->send();
});


$app->router->add("user/logout", function () use ($app) {
    $app->session->delete("user");
    $app->response->redirect($app->url->create("user/login"));
});


$app->router->add("user", function () use ($app) {
    if (!isLoggedInAndActive($app)) {
        $app->response->redirect($app->url->create("user/login"));
    }
    $cookie = new \Peto16\Cookie\Cookie();
    $lastLoggedIn = $cookie->get("loggedIn");
    $app->view->add("take1/header", ["title" => "Användarsidan"]);
    $app->view->add("take1/flash", [
        "img" => "img/security.jpg"
    ]);
    $app->view->add("user/user", [
        "user"          => $app->session->get("user"),
        "lastLoggedIn"  => $lastLoggedIn
    ]);
    $app->view->add("take1/byline");
    $app->view->add("take1/footer");
    $app->response->setBody([$app->view, "render"])
        ->send();
});


$app->router->add("user/create", function () use ($app) {
    $error = getGet('error') && getGet('error') == 1 ? "Username is already taken!" : false;
    $app->view->add("take1/header", ["title" => "Skapa användare"]);
    $app->view->add("take1/flash", [
        "img" => "img/security.jpg"
    ]);
    $app->view->add("user/create", [
        "error" => $error
    ]);
    $app->view->add("take1/byline");
    $app->view->add("take1/footer");
    $app->response->setBody([$app->view, "render"])
        ->send();
});


$app->router->add("user/create/process", function () use ($app) {
    $param = [
        $username = getPost('username'),
        $firstname = getPost('firstname'),
        $lastname = getPost('lastname'),
        $email = getPost('email'),
        $password = getPost('password') ? password_hash(getPost('password'), PASSWORD_DEFAULT) : false
    ];
    $app->db->connect();
    $query = "SELECT * FROM Users WHERE username=?;";
    if ($app->db->dataExcist($query, $param[0])) {
        $app->response->redirect($app->url->create("user/create?error=1"));
    } else {
        $query = "INSERT INTO Users(username, firstname, lastname, email, password) VALUES (?, ?, ?, ?, ?);";
        if ($app->db->addData($query, $param)) {
            $app->response->redirect($app->url->create("user/login"));
        } else {
            $app->response->redirect($app->url->create("user/create?error=1"));
        };
    }
});


$app->router->add("user/edit", function () use ($app) {
    if (!isLoggedInAndActive($app)) {
        $app->response->redirect($app->url->create("user/login"));
    }
    $app->view->add("take1/header", ["title" => "Redigera användare"]);
    $app->view->add("take1/flash", [
        "img" => "img/security.jpg"
    ]);
    $app->view->add("user/edit", [
        "user"  => $app->session->get("user")
    ]);
    $app->view->add("take1/byline");
    $app->view->add("take1/footer");
    $app->response->setBody([$app->view, "render"])
        ->send();
});


$app->router->add("user/edit/process", function () use ($app) {
    $previousUserData = $app->session->get('user');
    $user = $app->session->get('user');
    $param = [
        $user->firstname = getPost('firstname'),
        $user->lastname = getPost('lastname'),
        $user->email = getPost('email'),
        $previousUserData->username
    ];
    $app->db->connect();
    $query = "UPDATE Users SET firstname = ?, lastname = ?, email = ? WHERE username = ?;";
    if ($app->db->editData($query, $param)) {
        $app->session->set('user', $user);
        $app->response->redirect($app->url->create("user"));
    }
});


$app->router->add("user/edit/password", function () use ($app) {
    if (!isLoggedInAndActive($app)) {
        $app->response->redirect($app->url->create("user/login"));
    }
    $errorCode = getGet('error');

    switch ($errorCode) {
        case 1:
            $error = "Lösenorden matchar inte!";
            break;
        case 2:
            $error = "Lösenorden är tomma!";
            break;
        default:
            $error = false;
            break;
    }
    $app->view->add("take1/header", ["title" => "Ändra lösenord"]);
    $app->view->add("take1/flash", [
        "img" => "img/security.jpg"
    ]);
    $app->view->add("user/password", [
        "error"  => $error
    ]);
    $app->view->add("take1/byline");
    $app->view->add("take1/footer");
    $app->response->setBody([$app->view, "render"])
        ->send();
});


$app->router->add("user/edit/password/process", function () use ($app) {
    $password = getPost('password');
    $password2 = getPost('password2');
    $user = $app->session->get("user");
    if ($password == $password2 && $password != "") {
        $app->db->connect();
        $query = "UPDATE Users SET password = ? WHERE username = ?;";
        if ($app->db->editData($query, [password_hash($password, PASSWORD_DEFAULT), $user->username])) {
            $app->response->redirect($app->url->create("user"));
        }
    } elseif ($password != "") {
        $app->response->redirect($app->url->create("user/edit/password?error=2"));
    } else {
        $app->response->redirect($app->url->create("user/edit/password?error=1"));
    }
});
