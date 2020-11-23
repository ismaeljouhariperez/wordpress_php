<?php

namespace Admin;

class View 
{
    public static function paginate() 
    {
        add_action('page_navigate', [self::class, 'ninetyninetyone_pagination']);
    }

    public static function search_posts($per_page, $category_name)
    {
        $display_categories = new \WP_Query(array(
        'post_type' => 'post',
        'posts_per_page' => $per_page,
        'category_name' => $category_name
        ));
        return $display_categories;
    }

    public static function display_latest_posts(int $per_page)
    {
        $latest_posts = new \WP_Query(
            array(
            'post_type' => 'post',
            'posts_per_page' => $per_page,
            'orderby'         => 'post_date',
            'order'           => 'DESC',
            'post_status'     => 'publish'
            )
        );
        return $latest_posts;
    }

    public static function count_words() 
    {
        ob_start();
        the_content();
        $content = ob_get_clean();
        $words = sizeof(explode(" ", $content));
        return round($words/200);
    }

    public static function render(string $path, array $variables = []) : void
    {
        extract($variables); // Displays all variables one by one
        get_template_part( 'parts/' . $path, 'page' );
    }   

    public static function navigate_tabs()
    {
        wp_register_script('select', get_template_directory_uri() . '/js/form-min.js', array(), rand(111,9999), 'all');
        wp_enqueue_script('select');
    }

    public static function search_categories()
    {
        $args = array(
            'hide_empty'=> 1,
            'orderby' => 'name',
            'order' => 'ASC'
        );
        $categories = get_categories($args);
        return $categories;
    }
       
    public static function search_slug(string $slug)
    {
        $args = array
        (
            'post_type'  => 'post',
            'tax_query'  => array
            (
                array
                (
                    'taxonomy'  => 'post_tag',
                    'field'     => 'slug',
                    'terms'     =>  $slug
                ),
            ),
        );
        $query = new \WP_Query($args);
        return $query;
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
}