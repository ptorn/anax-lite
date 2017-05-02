<?php
namespace Peto16\App;

/**
 * An App class to wrap the resources of the framework.
 */
class App
{
    /**
     * Redirect to url
     * @method redirect
     * @param  string   $url url to redirect to
     * @return void
     */
    public function redirect($url)
    {
        $this->response->redirect($this->url->create($url));
    }



    /**
     * Get content block
     * @method getBlock
     * @param  string   $slug the slug for the block
     * @return text         Stored text in content block.
     */
    public function getBlock($slug)
    {
        $this->db->connect();
        $query = "SELECT * FROM anaxlite_Content WHERE slug = ?;";
        $data = $this->db->executeFetch($query, $slug);
        $block = new \Peto16\Content\Content($data);
        return $block;
    }
}
