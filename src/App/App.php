<?php
namespace Peto16\App;

/**
 * An App class to wrap the resources of the framework.
 */
class App
{
    public function redirect($url)
    {
        $this->response->redirect($this->url->create($url));
    }

    public function getBlock($slug)
    {
        $this->db->connect();
        $query = "SELECT * FROM anaxlite_content WHERE slug = ?;";
        $data = $this->db->executeFetch($query, $slug);
        $block = new \Peto16\Content\Content($data);
        return $block;
    }
}
