<?php

/**
 * Routes.
 */
$app->router->add("administration/user/admin/**", function () use ($app) {
    if (!isLoggedInAndActiveAdmin($app)) {
        $app->redirect("login");
    }
});

$app->router->add("administration/user/admin", function () use ($app) {
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
            $query = "SELECT * FROM anaxlite_Users WHERE $where";
            break;
        default:
            $query = "SELECT * FROM anaxlite_Users";
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
    $sql = "SELECT COUNT(id) AS max FROM anaxlite_Users;";
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
    $app->view->add("administration/user/admin/admin", [
        "users" => $users,
        "user"  => $app->session->get("user"),
        "max"   => $max
    ]);
    $app->view->add("take1/byline");
    $app->view->add("take1/footer");
    $app->response->setBody([$app->view, "render"])
        ->send();
});


$app->router->add("administration/user/admin/delete", function () use ($app) {
    if (getGet('id')) {
        $app->db->connect();
        $query = "DELETE FROM anaxlite_Users WHERE id = ?;";
        $app->db->execute($query, $_GET['id']);
    }
    $app->redirect("administration/user/admin");
});


$app->router->add("administration/user/admin/edit", function () use ($app) {
    if (getGet('id')) {
        $app->db->connect();
        $query = $query = "SELECT * FROM anaxlite_Users WHERE id = ?;";
        $user = $app->db->executeFetchAll($query, $_GET['id']);
    }
    $app->view->add("take1/header", ["title" => "Admin redigera"]);
    $app->view->add("take1/flash", [
        "img" => "img/security.jpg"
    ]);
    $app->view->add("administration/user/admin/edit", [
        "user"  => $user[0]
    ]);
    $app->view->add("take1/byline");
    $app->view->add("take1/footer");
    $app->response->setBody([$app->view, "render"])
        ->send();
});


$app->router->add("administration/user/admin/edit/process", function () use ($app) {
    $firstname = getPost('firstname');
    $lastname = getPost('lastname');
    $email = getPost('email');
    $level = getPost('level');
    $administrator = getPost('administrator') ? getPost('administrator') == "on" ? 1 : 0 : 0;
    $enabled = getPost('enabled') ? getPost('enabled') == "on" ? 1 : 0 : 0;
    $id = getPost('id');
    $password = getPost('password');
    $password2 = getPost('password2');

    if ($password == $password2 && $password != "") {
        $param = [
            $firstname,
            $lastname,
            $email,
            $level,
            $administrator,
            $enabled,
            password_hash($password, PASSWORD_DEFAULT),
            $id
        ];
        $query = "UPDATE anaxlite_Users SET firstname = ?, lastname = ?, email = ?, level = ?, administrator = ?, enabled = ?, password = ? WHERE id = ?;";
    } else {
        $param = [
            $firstname,
            $lastname,
            $email,
            $level,
            $administrator,
            $enabled,
            $id
        ];
        $query = "UPDATE anaxlite_Users SET firstname = ?, lastname = ?, email = ?, level = ?, administrator = ?, enabled = ? WHERE id = ?;";
    }

    $app->db->connect();
    if ($app->db->execute($query, $param)) {
        $app->redirect("administration/user/admin");
    }
});


$app->router->add("administration/user/admin/create", function () use ($app) {
    $error = getGet('error') && getGet('error') == 1 ? "Användaren är redan tagen!" : false;
    $app->view->add("take1/header", ["title" => "Admin skapa användare"]);
    $app->view->add("take1/flash", [
        "img" => "img/security.jpg"
    ]);
    $app->view->add("administration/user/admin/create", [
        "error" => $error
    ]);
    $app->view->add("take1/byline");
    $app->view->add("take1/footer");
    $app->response->setBody([$app->view, "render"])
        ->send();
});


$app->router->add("administration/user/admin/create/process", function () use ($app) {
    $param = [
        $username = getPost('username'),
        $firstname = getPost('firstname'),
        $lastname = getPost('lastname'),
        $email = getPost('email'),
        $administrator = getPost('administrator') ? getPost('administrator') == "on" ? true : false : false,
        $enabled = getPost('enabled') ? getPost('enabled') == "on" ? 1 : 0 : 0,
        $password = getPost('password') ? password_hash(getPost('password'), PASSWORD_DEFAULT) : false
    ];
    $app->db->connect();
    $query = "SELECT * FROM anaxlite_Users WHERE username=?;";
    if ($app->db->dataExcist($query, $param[0])) {
        $app->redirect("administration/user/admin/create?error=1");
    } else {
        $query = "INSERT INTO anaxlite_Users(username, firstname, lastname, email, administrator, enabled, password) VALUES (?, ?, ?, ?, ?, ?, ?);";
        if ($app->db->execute($query, $param)) {
            $app->redirect("administration/user/admin");
        } else {
            $app->redirect("administration/user/admin/create?error=1");
        };
    }
});
