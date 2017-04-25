<?php
namespace Peto16\Content;

class Content
{
    public $id;
    public $title;
    public $path;
    public $slug;
    public $data;
    public $type;
    public $filter;
    public $published;
    public $created;
    public $updated;
    public $deleted;


    public function __construct($data)
    {
        $this->id = $data->id;
        $this->title = $data->title;
        $this->path = $data->path;
        $this->slug = $data->slug;
        $this->data = $data->data;
        $this->type = $data->type;
        $this->filter = $data->filter;
        $this->published = $data->published;
        $this->created = $data->created;
        $this->updated = $data->updated;
        $this->deleted = $data->deleted;
    }



    public function isPage()
    {
        return $this->type == "page" ? true : false;
    }



    public function isBlog()
    {
        return $this->type == "post" ? true : false;
    }



    public function isBlock()
    {
        return $this->type == "block" ? true : false;
    }
}
