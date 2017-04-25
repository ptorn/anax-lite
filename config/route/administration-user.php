<?php

/**
 * Routes.
 */
$app->router->add("login", function () use ($app) {
    $status = "";
    $username = htmlentities(getPost('username'));
    $password = htmlentities(getPost('password'));
    $user = new \Peto16\User\User();
    if ($username && $password) {
        $app->db->connect();
        $dbUser = $app->db->executeFetchAll("SELECT * FROM anaxlite_users WHERE username=?", [$username]);
        if (!empty($dbUser)) {
            $user->setUserData($dbUser[0]);
            $status = $user->loginUser($password) ?: "Fel användaruppgifter!";
        } else {
            $status = "Fel användaruppgifter";
        }
    }
    if (isLoggedInAndActive($app)) {
        $app->redirect("administration/user");
    }
    $app->view->add("take1/header", ["title" => "Login"]);
    $app->view->add("take1/flash", [
        "img" => "img/security.jpg"
    ]);
    $app->view->add("administration/user/login", ["status" => $status]);
    $app->view->add("take1/byline");
    $app->view->add("take1/footer");
    $app->response->setBody([$app->view, "render"])
        ->send();
});


$app->router->add("administration/user/logout", function () use ($app) {
    $app->session->delete("user");
    $app->redirect("login");
});


$app->router->add("administration/user", function () use ($app) {
    $cookie = new \Peto16\Cookie\Cookie();
    $lastLoggedIn = $cookie->get("loggedIn");
    $app->view->add("take1/header", ["title" => "Användarsidan"]);
    $app->view->add("take1/flash", [
        "img" => "img/security.jpg"
    ]);
    $app->view->add("administration/user/user", [
        "user"          => $app->session->get("user"),
        "lastLoggedIn"  => $lastLoggedIn
    ]);
    $app->view->add("take1/byline");
    $app->view->add("take1/footer");
    $app->response->setBody([$app->view, "render"])
        ->send();
});


$app->router->add("administration/user/create", function () use ($app) {
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


$app->router->add("administration/user/create/process", function () use ($app) {
    $param = [
        $username = getPost('username'),
        $firstname = getPost('firstname'),
        $lastname = getPost('lastname'),
        $email = getPost('email'),
        $password = getPost('password') ? password_hash(getPost('password'), PASSWORD_DEFAULT) : false
    ];
    $app->db->connect();
    $query = "SELECT * FROM anaxlite_users WHERE username=?;";
    if ($app->db->dataExcist($query, $param[0])) {
        $app->redirect("administration/user/create?error=1");
    } else {
        $query = "INSERT INTO anaxlite_users(username, firstname, lastname, email, password) VALUES (?, ?, ?, ?, ?);";
        if ($app->db->addData($query, $param)) {
            $app->redirect("login");
        } else {
            $app->redirect("administration/user/create?error=1");
        };
    }
});


$app->router->add("administration/user/edit", function () use ($app) {
    $app->view->add("take1/header", ["title" => "Redigera användare"]);
    $app->view->add("take1/flash", [
        "img" => "img/security.jpg"
    ]);
    $app->view->add("administration/user/edit", [
        "user"  => $app->session->get("user")
    ]);
    $app->view->add("take1/byline");
    $app->view->add("take1/footer");
    $app->response->setBody([$app->view, "render"])
        ->send();
});


$app->router->add("administration/user/edit/process", function () use ($app) {
    $previousUserData = $app->session->get('user');
    $user = $app->session->get('user');
    $param = [
        $user->firstname = getPost('firstname'),
        $user->lastname = getPost('lastname'),
        $user->email = getPost('email'),
        $previousUserData->username
    ];
    $app->db->connect();
    $query = "UPDATE anaxlite_users SET firstname = ?, lastname = ?, email = ? WHERE username = ?;";
    if ($app->db->editData($query, $param)) {
        $app->session->set('user', $user);
        $app->redirect("administration/user");
    }
});


$app->router->add("administration/user/edit/password", function () use ($app) {
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
    $app->view->add("administration/user/password", [
        "error"  => $error
    ]);
    $app->view->add("take1/byline");
    $app->view->add("take1/footer");
    $app->response->setBody([$app->view, "render"])
        ->send();
});


$app->router->add("administration/user/edit/password/process", function () use ($app) {
    $password = getPost('password');
    $password2 = getPost('password2');
    $user = $app->session->get("user");
    if ($password == $password2 && $password != "") {
        $app->db->connect();
        $query = "UPDATE anaxlite_users SET password = ? WHERE username = ?;";
        if ($app->db->editData($query, [password_hash($password, PASSWORD_DEFAULT), $user->username])) {
            $app->redirect("administration/user");
        }
    } elseif ($password != "") {
        $app->redirect("administration/user/edit/password?error=2");
    } else {
        $app->redirect("administration/user/edit/password?error=1");
    }
});
