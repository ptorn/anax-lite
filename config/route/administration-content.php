<?php
$app->router->add("administration/content", function () use ($app) {
    $app->db->connect();
    $query = "SELECT * FROM anaxlite_content";

    $orderBy = getGet('orderby') ?: "id";
    $order = getGet('order') ?: "asc";
    // Only these values are valid
    $orders = ["asc", "desc"];
    $orderColumns = ["id", "title"];
    if (!(in_array($orderBy, $orderColumns) && in_array($order, $orders))) {
        die("Ej godkänd input!");
    }
    $query .= " ORDER BY $orderBy $order";


    // Paginering
    $hits = getGet("hits", 4);
    if (!(is_numeric($hits) && $hits > 0 && $hits <= 8)) {
        die("Not valid for hits.");
    }
    $sql = "SELECT COUNT(id) AS max FROM anaxlite_users;";
    $max = $app->db->executeFetchAll($sql);
    $max = ceil($max[0]->max / $hits);

    // Get current page
    $page = getGet("page", 1);
    if (!(is_numeric($hits) && $page > 0 && $page <= $max)) {
        die("Not valid for page.");
    }
    $offset = $hits * ($page - 1);

    $query .= " LIMIT $hits OFFSET $offset;";

    $content = $app->db->executeFetchAll($query);

    $app->view->add("take1/header", ["title" => "Innehåll"]);
    $app->view->add("take1/flash");
    $app->view->add("administration/content/list", [
        "content"   => $content,
        "max"       => $max
    ]);
    $app->view->add("take1/byline");
    $app->view->add("take1/footer");
    $app->response->setBody([$app->view, "render"])
              ->send();
});

$app->router->add("administration/content/create", function () use ($app) {
    $app->view->add("take1/header", ["title" => "Skapa innehåll"]);
    $app->view->add("take1/flash", [
        "img" => "img/security.jpg"
    ]);
    $app->view->add("administration/content/create");
    $app->view->add("take1/byline");
    $app->view->add("take1/footer");
    $app->response->setBody([$app->view, "render"])
        ->send();
});

$app->router->add("administration/content/create/process", function () use ($app) {

    $params = getPost([
        'title',
        'path',
        'slug',
        'data',
        'type',
        'filter',
        'published'
    ]);

    if (!$params["slug"]) {
        $params["slug"] = slugify($params["title"]);
    }

    if (!$params["path"]) {
        $params["path"] = null;
    }

    $app->db->connect();

    $query = "SELECT * FROM anaxlite_content WHERE slug = ?;";
    if ($app->db->dataExcist($query, $params["slug"])) {
        $app->redirect("administration/content/create?error=1");
    }

    $query = "SELECT * FROM anaxlite_content WHERE path = ?;";
    if ($app->db->dataExcist($query, $params["path"])) {
        $app->redirect("administration/content/create?error=2");
    }

    $query = "INSERT INTO anaxlite_content(title, path, slug, data, type, filter, published) VALUES (?, ?, ?, ?, ?, ?, ?);";
    if ($app->db->addData($query, array_values($params))) {
        $app->redirect("administration/content");
    } else {
        $app->redirect("administration/content/create?error=2");
    };
});

$app->router->add("administration/content/edit", function () use ($app) {
    if (getGet('id')) {
        $app->db->connect();
        $query = $query = "SELECT * FROM anaxlite_content WHERE id = ?;";
        $data = $app->db->executeFetchAll($query, $_GET['id']);
    }
    $app->view->add("take1/header", ["title" => "Redigera innehåll"]);
    $app->view->add("take1/flash", [
        "img" => "img/security.jpg"
    ]);
    $app->view->add("administration/content/edit", [
        "data"  => $data[0]
    ]);
    $app->view->add("take1/byline");
    $app->view->add("take1/footer");
    $app->response->setBody([$app->view, "render"])
        ->send();
});

$app->router->add("administration/content/edit/process", function () use ($app) {
    $params = getPost([
        'title',
        'path',
        'slug',
        'data',
        'type',
        'filter',
        'published',
        'id'
    ]);

    if (!$params["slug"]) {
        $params["slug"] = slugify($params["title"]);
    }

    if (!$params["path"]) {
        $params["path"] = null;
    }

    $app->db->connect();

    $query = "SELECT * FROM anaxlite_content WHERE slug = ?;";
    if ($app->db->dataExcist($query, $params["slug"])) {
        $app->redirect("administration/content/edit?id=" . $params["id"] . "&error=1");
    }

    $query = "SELECT * FROM anaxlite_content WHERE path = ?;";
    if ($app->db->dataExcist($query, $params["path"])) {
        $app->redirect("administration/content/edit?id=" . $params["id"] . "&error=2");
    }

    $query = "UPDATE anaxlite_content SET title = ?, path = ?, slug = ?, data = ?, type = ?, filter = ?, published = ? WHERE id = ?;";
    if ($app->db->editData($query, array_values($params))) {
        $app->redirect("administration/content");
    }
});

$app->router->add("administration/content/delete", function () use ($app) {
    $app->db->connect();

    $id = getPost("id") ?: getGet("id");
    if (!is_numeric($id)) {
        die("Inget giltigt id.");
    }
    var_dump(hasKeyPost("doDelete"));

    if (hasKeyPost("doDelete")) {
        $id = getPost("id");
        var_dump($id);
        $query = "UPDATE anaxlite_content SET deleted=NOW() WHERE id = ?;";
        $app->db->execute($query, [$id]);
        $app->redirect("administration/content");
    }

    $query = "SELECT id, title FROM anaxlite_content WHERE id = ?;";
    $data = $app->db->executeFetch($query, $id);
    $app->view->add("take1/header", ["title" => "Radera innehåll"]);
    $app->view->add("take1/flash", [
        "img" => "img/security.jpg"
    ]);
    $app->view->add("administration/content/delete", ["data" => $data]);
    $app->view->add("take1/byline");
    $app->view->add("take1/footer");
    $app->response->setBody([$app->view, "render"])
        ->send();
});

$app->router->add("administration/content/delete/process", function () use ($app) {
    if (getPost('id')) {
        $app->db->connect();
        $query = "UPDATE anaxlite_content SET deleted=NOW() WHERE id=?;";
        $app->db->execute($query, getGet('id'));
    }
    $app->redirect("administration/content");
});
