<?php

namespace Controller;

require_once(WPF_PLUGIN_DIR . '/Controller/Controller.php');
require_once(WPF_PLUGIN_DIR . '/Model/Model.php');
require_once(WPF_PLUGIN_DIR . '/Utils/Render.php');

class Admin extends Controller
{
    public function __construct() 
    {
        parent::__construct();
        add_action( 'admin_menu', array( $this, 'wpforms_plugin_menu') );
    }

    public function wpforms_plugin_menu()
    {
        add_dashboard_page( __( 'WPForm Plugin Dashboard', 'textdomain' ), __( 'Contact Forms', 'textdomain' ), 'read', 'wpform-unique-identifier', array($this,'wpform_plugin_function') );
    }

    public function wpform_plugin_function() 
    {
        // Get Data
        $data = $this->model->select_data();
        // Get Bootstrap Style
        wp_register_style('bootstrap', get_template_directory_uri() . '/scss/custom.css', array(), rand(111,9999), 'all');
        // Render the menu panel
        \Render::view('panel', compact('data') );
    }

    public function edit()
    {
        if(is_admin()) 
        {
            switch(isset($_POST))
            {
                case isset($_POST['delete']):
                //do something
                //ask id SELECT id for 
                //delete in db DELETE
                //        \Render::view('panel', compact('data') );
                $id = ($_POST['get_id']);
                $this->model->delete($id);

                break;
                case isset($_POST['B']):
                //do something
                break;
                case isset($_POST['C']):
                //do something
                break;
            } 
        }
    }
}


$edit = new Admin;
$edit->edit();



?>