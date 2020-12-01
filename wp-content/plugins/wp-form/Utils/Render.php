<?php

class Render
{
    /**
     * @param string path Path of the file to read
     * @param array $variables Variables to transpose
     * @return void
     */

    public static function view(string $path, array $variables = []) : void
    {
        extract($variables); // Displays all variables one by one
        require_once(WPF_PLUGIN_DIR . '/View/' . $path . ".html.php");
    }    
}

?>