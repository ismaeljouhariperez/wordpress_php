<?php

namespace Admin;

class View 
{
    public static function paginate() 
    {
        add_action('page_navigate', [self::class, 'ninetyninetyone_pagination']);
    }

    public static function ninetyninetyone_pagination()
    {
        $pages = paginate_links(['type' => 'array']);
        if ($pages === null)
        {
            return;
        }
        echo '<nav aria-label="Page navigation" class="my-4" >';
        echo '<ul class="pagination">';
        foreach($pages as $page)
        {
            $active = strpos($page, 'current') !== false;
            $class = 'page-item';
            if ($active)
            {
                $class .= ' active ';
            }
            echo '<li class="' . $class .'  ">';
            echo str_replace('page-numbers', 'page-link', $page);
            echo '</li>';
        }
        echo '</ul>';
        echo '</nav>';
    }

    public static function render(string $folder, string $path, array $variables = []) : void
    {
        extract($variables); // Displays all variables one by one
        ob_start();
        require('parts/' . $path . '.html.php');
        $pageContent = ob_get_clean();

        require_once('view/' . $folder . '/layout.html.php');
    }   

    public static function navigate_tabs()
    {
        wp_register_script('select', get_template_directory_uri() . '/js/form.js', array(), rand(111,9999), 'all');
        wp_enqueue_script('select');
    }
}