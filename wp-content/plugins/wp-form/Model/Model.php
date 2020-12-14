<?php

namespace Model;

class Model
{
    /**
     * Operations in Wordpress database
     * 
     * @property table Name of the table in WP database
     * @method insert Insert data in WP DB
     * @method select_data Select id, name, surname and email from WP DB
     * @method delete Delete information from WP DB
     */

    protected $table = "wp_forms";

    public function __construct()
    {
        global $wpdb;
        $this->wpdb = $wpdb;
        $this->table = $this->wpdb->forms . "wp_forms";
    }

    public function insert(string $name, string $surname, string $email, string $message) : void
    {
        /* FILLED INFORMATION */
        $user_data = [$name, $surname, $email, $message];
        $data_filled = [
                    "name" => $name,
                    "surname" => $surname, 
                    "email" => $email,
                    "message" => $message
                ];
       
        /* Identification de la BDD */
        $wp_forms = $this->wpdb->forms . "wp_forms";

        /* LOOK INTO DB */
        $in_db = $this->wpdb->prepare("SELECT name,surname,email,message FROM {$wp_forms} WHERE email=%s", [$email]);

        $count = $this->wpdb->prepare("SELECT COUNT(*) FROM {$wp_forms} WHERE email=%s", [$email]);
        $result = $this->wpdb->get_var($count);
        $count_in_db = intval($result,10);
        
        /* PREVENT DUPLICATES */
        $object = $this->wpdb->get_results($in_db);
        $data_in_db = json_decode(json_encode($object), true)[0];

        /* PREPARE SQL REQUEST */
        $sql = $this->wpdb->prepare("INSERT INTO {$wp_forms} SET name=%s, surname=%s, email=%s, message=%s", $user_data);

        if ( ($data_filled != $data_in_db) && ($count_in_db <= 1))
        {
            $this->wpdb->query($sql);
        }
    }

    public function select_data()
    {
        $wp_forms = $this->wpdb->forms . "wp_forms";
        $info = $this->wpdb->prepare("SELECT id,name,surname,email,message FROM {$wp_forms}");
        $result = $this->wpdb->get_results($info);
        return $result;
    }

    public function delete(int $id) : void
    {
        $sql = $this->wpdb->prepare("DELETE FROM {$this->table} WHERE id = ($id)");
        $this->wpdb->query($sql);
    }
}

?>