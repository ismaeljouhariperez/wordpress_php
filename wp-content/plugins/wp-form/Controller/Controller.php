<?php

namespace Controller;

require_once(WPF_PLUGIN_DIR . '/Model/Model.php');

abstract class Controller
{
    /**
     * @property model Creates a new model 
     * @property modelName Name of the model
     * @property item Item condition for restore @method
     
     * @method restore Restores an item from SQL Database
     * @method delete Delete an item from SQL Database
     */

    protected $model;
    protected $modelName;
    protected $item;

    public function __construct()
    {
        $this->model = new \Model\Model();
    }

}
?>