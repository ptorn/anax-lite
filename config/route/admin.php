<?php

/**
 * Routes.
 */
$app->router->add("admin", function () use ($app) {
    if (!isLoggedInAndActiveAdmin($app)) {
        $app->response->redirect($app->url->create("user/login"));
    }
    $app->db->connect();
    $columns = ["firstname", "lastname", "username", "email"];
    $route = getGet('route');
    switch ($route) {
        case "search":
            $keyword = getGet('keyword');
            $searchQuery = [];
            foreach ($columns as $column) {
                array_push($searchQuery, $column . " LIKE '%" . $keyword . "%'");
            }
            $where = implode(' OR ', $searchQuery);
            $query = "SELECT * FROM Users WHERE $where";
            break;
        default:
            $query = "SELECT * FROM Users";
            break;
    }
    $orderBy = getGet('orderby') ?: "id";
    $order = getGet('order') ?: "asc";
    // Only these values are valid
    $orders = ["asc", "desc"];
    $orderColumns = ["id", "username", "firstname", "lastname"];
    if (!(in_array($orderBy, $orderColumns) && in_array($order, $orders))) {
        die("Ej godkänd input!");
    }
    $query .= " ORDER BY $orderBy $order";


    // Paginering
    $hits = getGet("hits", 4);
    if (!(is_numeric($hits) && $hits > 0 && $hits <= 8)) {
        die("Not valid for hits.");
    }
    $sql = "SELECT COUNT(id) AS max FROM Users;";
    $max = $app->db->executeFetchAll($sql);
    $max = ceil($max[0]->max / $hits);

    // Get current page
    $page = getGet("page", 1);
    if (!(is_numeric($hits) && $page > 0 && $page <= $max)) {
        die("Not valid for page.");
    }
    $offset = $hits * ($page - 1);

    $query .= " LIMIT $hits OFFSET $offset;";

    $users = $app->db->executeFetchAll($query);
    $app->view->add("take1/header", ["title" => "Adminsidan"]);
    $app->view->add("take1/flash", [
        "img" => "img/security.jpg"
    ]);
    $app->view->add("admin/admin", [
        "users" => $users,
        "user"  => $app->session->get("user"),
        "max"   => $max
    ]);
    $app->view->add("take1/byline");
    $app->view->add("take1/footer");
    $app->response->setBody([$app->view, "render"])
        ->send();
});


$app->router->add("admin/delete", function () use ($app) {
    if (!isLoggedInAndActiveAdmin($app)) {
        $app->response->redirect($app->url->create("user/login"));
    }
    if (getGet('id')) {
        $app->db->connect();
        $query = "DELETE FROM Users WHERE id = ?;";
        $app->db->execute($query, $_GET['id']);
    }
    $app->response->redirect($app->url->create("admin"));
});


$app->router->add("admin/edit", function () use ($app) {
    if (!isLoggedInAndActiveAdmin($app)) {
        $app->response->redirect($app->url->create("user/login"));
    }
    if (getGet('id')) {
        $app->db->connect();
        $query = $query = "SELECT * FROM Users WHERE id = ?;";
        $user = $app->db->executeFetchAll($query, $_GET['id']);
    }
    $app->view->add("take1/header", ["title" => "Admin redigera"]);
    $app->view->add("take1/flash", [
        "img" => "img/security.jpg"
    ]);
    $app->view->add("admin/edit", [
        "user"  => $user[0]
    ]);
    $app->view->add("take1/byline");
    $app->view->add("take1/footer");
    $app->response->setBody([$app->view, "render"])
        ->send();
});


$app->router->add("admin/edit/process", function () use ($app) {
    $param = [
        $firstname = getPost('firstname'),
        $lastname = getPost('lastname'),
        $email = getPost('email'),
        $level = getPost('level'),
        $administrator = getPost('administrator') ? getPost('administrator') == "on" ? true : false : false,
        $enabled = getPost('enabled') ? getPost('enabled') == "on" ? true : false : false,
        $id = getPost('id')
    ];
    $app->db->connect();
    $query = "UPDATE Users SET firstname = ?, lastname = ?, email = ?, level = ?, administrator = ?, enabled = ? WHERE id = ?;";
    if ($app->db->editData($query, $param)) {
        $app->response->redirect($app->url->create("admin"));
    }
});


$app->router->add("admin/create", function () use ($app) {
    $error = getGet('error') && getGet('error') == 1 ? "Användaren är redan tagen!" : false;
    $app->view->add("take1/header", ["title" => "Admin skapa användare"]);
    $app->view->add("take1/flash", [
        "img" => "img/security.jpg"
    ]);
    $app->view->add("admin/create", [
        "error" => $error
    ]);
    $app->view->add("take1/byline");
    $app->view->add("take1/footer");
    $app->response->setBody([$app->view, "render"])
        ->send();
});


$app->router->add("admin/create/process", function () use ($app) {
    $param = [
        $username = getPost('username'),
        $firstname = getPost('firstname'),
        $lastname = getPost('lastname'),
        $email = getPost('email'),
        $administrator = getPost('administrator') ?: 0,
        $enabled = getPost('enabled') ?: 1,
        $password = getPost('password') ? password_hash(getPost('password'), PASSWORD_DEFAULT) : false
    ];
    $app->db->connect();
    $query = "SELECT * FROM Users WHERE username=?;";
    if ($app->db->dataExcist($query, $param[0])) {
        $app->response->redirect($app->url->create("admin/create?error=1"));
    } else {
        $query = "INSERT INTO Users(username, firstname, lastname, email, administrator, enabled, password) VALUES (?, ?, ?, ?, ?, ?, ?);";
        if ($app->db->addData($query, $param)) {
            $app->response->redirect($app->url->create("admin"));
        } else {
            $app->response->redirect($app->url->create("admin/create?error=1"));
        };
    }
});
