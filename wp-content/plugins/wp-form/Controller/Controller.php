<?php

namespace Controller;

require_once(WPF_PLUGIN_DIR . '/Model/Model.php');

abstract class Controller
{
    /**
     * @property model Creates a new model
     */

    protected $model;

    public function __construct()
    {
        $this->model = new \Model\Model();
    }

}
?>