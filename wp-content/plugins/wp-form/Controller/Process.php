<?php

namespace Controller;

require_once(WPF_PLUGIN_DIR . '/Model/Model.php');
require_once(WPF_PLUGIN_DIR . '/Controller/Controller.php');

class Process extends Controller
{   
    /**
     * Process data filled by user
     * 
    * @method get_form Get information from contact form and insert it in WP database
    */

    public function get_form()
    {   
        // Empty form ?
        if ( !empty($_POST) )
        {
            session_start();
    
            if ( !empty($_POST['init']) ) 
            {
                /* Redirects if user clicks on Send a new message */
                header("Location: /contact");
                exit();
            }

            else if(isset( $_POST['contact_form'] ) )
            {
                /* Get data from form */
                $name = htmlspecialchars($_POST['user_name']);
                $surname = htmlspecialchars($_POST['user_surname']);
                $email = htmlspecialchars($_POST['user_email']);
                $message = htmlspecialchars($_POST['user_message']);
                
                /* Database process */
                $this->model->insert($name,$surname, $email, $message);

                /* Session data storage */
                $_SESSION['user_name'] = $_POST['user_name'] ;
                $_SESSION['user_surname'] = $_POST['user_surname'] ;
                $_SESSION['user_email'] = $_POST['user_email'] ;
                $_SESSION['user_message'] = $_POST['user_message'] ;
            }
        }
    }
}

$new_form = new Process;
$new_form->get_form();

?>