<?php

class View
{
    protected $path = "../app/views/layout.html";
    protected $data;

    public function __construct($path = null, $content = null)
    {
        if (!is_null($path)) {
            $this->path = "../app/views/" . $path . ".html";
        }
        
        $this->data = $content;
    }

    public function render()
    {
        $data = $this->data;

        ob_start();
        include $this->path;
        $content = ob_get_clean();

        return $content;
    }
}