<?php

class IndexController
{
    public function indexAction()
    {
//        echo "i am INDEX action";
    }

    public function testAction()
    {
        return date("H:i:s d/m/Y");
    }
}