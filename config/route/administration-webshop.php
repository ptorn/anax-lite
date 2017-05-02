<?php

$app->router->add("administration/webshop/**", function () use ($app) {
    if (!isLoggedInAndActiveAdmin($app)) {
        $app->redirect("login");
    }
    $app->db->connect();
});

$app->router->add("administration/webshop", function () use ($app) {
    // $app->db->connect();
    $query = "SELECT * FROM VProducts";

    $orderBy = getGet('orderby') ?: "id";
    $order = getGet('order') ?: "asc";
    // Only these values are valid
    $orders = ["asc", "desc"];
    $orderColumns = ["id", "name"];
    if (!(in_array($orderBy, $orderColumns) && in_array($order, $orders))) {
        die("Ej godkänd input!");
    }
    $query .= " ORDER BY $orderBy $order";


    // Paginering
    $hits = getGet("hits", 5);
    if (!(is_numeric($hits) && $hits > 0 && $hits <= 20)) {
        die("Not valid for hits.");
    }
    $sql = "SELECT COUNT(id) AS max FROM VProducts;";
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
    $app->view->add("administration/webshop/product/list", [
        "content"   => $content,
        "max"       => $max
    ]);
    $app->view->add("take1/byline");
    $app->view->add("take1/footer");
    $app->response->setBody([$app->view, "render"])
              ->send();
});

$app->router->add("administration/webshop/product/create", function () use ($app) {
    $s = new \Peto16\Webshop\Webshop($app->db);

    $app->view->add("take1/header", ["title" => "Lägg till produkt"]);
    $app->view->add("take1/flash", [
        "img" => "img/security.jpg"
    ]);
    $app->view->add("administration/webshop/product/create", [
        "categories" => $s->getCategories()
    ]);
    $app->view->add("take1/byline");
    $app->view->add("take1/footer");
    $app->response->setBody([$app->view, "render"])
        ->send();
});

$app->router->add("administration/webshop/product/create/process", function () use ($app) {
    $s = new \Peto16\Webshop\Webshop($app->db);
    $params = getPost([
        'name',
        'description',
        'image',
        'price',
    ]);
    $categories = getPost("category");
    if ($s->createProduct(array_values($params), $categories)) {
        $app->redirect("administration/webshop");
    } else {
        $app->redirect("administration/webshop/product/create?error=2");
    };
});

$app->router->add("administration/webshop/product/edit", function () use ($app) {
    $s = new \Peto16\Webshop\Webshop($app->db);
    if (getGet('id')) {
        $data = $s->getProduct(getGet('id'));
        $categories = $s->getCategories();
    }
    $app->view->add("take1/header", ["title" => "Redigera product"]);
    $app->view->add("take1/flash", [
        "img" => "img/security.jpg"
    ]);
    $app->view->add("administration/webshop/product/edit", [
        "data"  => $data,
        "categories" => $categories
    ]);
    $app->view->add("take1/byline");
    $app->view->add("take1/footer");
    $app->response->setBody([$app->view, "render"])
        ->send();
});

$app->router->add("administration/webshop/product/edit/process", function () use ($app) {
    $s = new \Peto16\Webshop\Webshop($app->db);
    $params = getPost([
        'name',
        'description',
        'image',
        'price',
        'id'
    ]);

    $categories = getPost('category');

    if ($s->updateProduct(array_values($params), $categories)) {
        $app->redirect("administration/webshop");
    }
});

$app->router->add("administration/webshop/product/delete", function () use ($app) {

    $id = getPost("id") ?: getGet("id");
    if (!is_numeric($id)) {
        die("Inget giltigt id.");
    }
    if (hasKeyPost("doDelete")) {
        $id = getPost("id");
        $query = "UPDATE anaxlite_Product SET deleted=NOW() WHERE id = ?;";
        $app->db->execute($query, [$id]);
        $app->redirect("administration/webshop");
    }

    $query = "SELECT id, name FROM anaxlite_Product WHERE id = ?;";
    $data = $app->db->executeFetch($query, $id);
    $app->view->add("take1/header", ["title" => "Radera product"]);
    $app->view->add("take1/flash", [
        "img" => "img/security.jpg"
    ]);
    $app->view->add("administration/webshop/product/delete", ["data" => $data]);
    $app->view->add("take1/byline");
    $app->view->add("take1/footer");
    $app->response->setBody([$app->view, "render"])
        ->send();
});

$app->router->add("administration/webshop/product/delete/process", function () use ($app) {
    if (getPost('id')) {
        $app->db->connect();
        $query = "UPDATE anaxlite_Product SET deleted=NOW() WHERE id=?;";
        $app->db->execute($query, getGet('id'));
    }
    $app->redirect("administration/webshop");
});

$app->router->add("administration/webshop/inventory", function () use ($app) {
    // $app->db->connect();
    $query = "SELECT * FROM VInvProducts";

    $orderBy = getGet('orderby') ?: "shelf";
    $order = getGet('order') ?: "asc";
    // Only these values are valid
    $orders = ["asc", "desc"];
    $orderColumns = ["id", "shelf"];
    if (!(in_array($orderBy, $orderColumns) && in_array($order, $orders))) {
        die("Ej godkänd input!");
    }
    $query .= " ORDER BY $orderBy $order";


    // Paginering
    $hits = getGet("hits", 5);
    if (!(is_numeric($hits) && $hits > 0 && $hits <= 20)) {
        die("Not valid for hits.");
    }
    $sql = "SELECT COUNT(id) AS max FROM VInvProducts;";
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
    $app->view->add("take1/header", ["title" => "Innehåll lager"]);
    $app->view->add("take1/flash");
    $app->view->add("administration/webshop/inventory/list", [
        "content"   => $content,
        "max"       => $max
    ]);
    $app->view->add("take1/byline");
    $app->view->add("take1/footer");
    $app->response->setBody([$app->view, "render"])
              ->send();
});

$app->router->add("administration/webshop/inventory/edit", function () use ($app) {
    $s = new \Peto16\Webshop\Webshop($app->db);
    if (getGet('id')) {
        $data = $s->getInvProduct(getGet('id'));
    }
    $app->view->add("take1/header", ["title" => "Redigera lagret"]);
    $app->view->add("take1/flash", [
        "img" => "img/security.jpg"
    ]);
    $app->view->add("administration/webshop/inventory/edit", [
        "data"  => $data,
        "invPositions" => $s->getInvPositions()
    ]);
    $app->view->add("take1/byline");
    $app->view->add("take1/footer");
    $app->response->setBody([$app->view, "render"])
        ->send();
});

$app->router->add("administration/webshop/inventory/edit/process", function () use ($app) {
    $s = new \Peto16\Webshop\Webshop($app->db);
    $params = getPost([
        'shelf_id',
        'items',
        'id'
    ]);

    if ($s->updateInvProduct(array_values($params))) {
        $app->redirect("administration/webshop/inventory");
    }
});
