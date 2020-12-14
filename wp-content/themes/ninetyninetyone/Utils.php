<?php

namespace Admin;

class View 
{
    /**
    * Only static functions
    * View utilities that can be used to display frontend components

    * @method search_posts Retrieves posts by category
    * @method display_latest_posts Displays the latest posts published 
    * @method count_words Calculates an average content reading time
    * @method get_tag Displays tag for a given post
    * @method navigate_tabs Enable navigation tab on articles categories with JS
    * @method search_categories Return all the existing categories
    * @method search_slug Displays articles by slug
    * @method check_plugin Checks if a plugin is activated
    * @method render Renders a specific page
    * @method paginate Adds pagination on pages
    */

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

    public static function get_tag()
    {
        $post_tags = get_the_tags();
        if ( $post_tags ) {
            foreach( $post_tags as $tag ) {
            return $tag->name; 
            }
        }
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

    public static function check_plugin(string $folder, string $plugin) 
    {
        // get array of active plugins
        $active_plugins = (array) get_option( 'active_plugins', array() );
        // see active plugins 'plugin-dir-name/plugin-base-file.php'
        if ( ! empty( $active_plugins ) && in_array( $folder . "/" . $plugin . ".php", $active_plugins ) ) 
        {
            return $result = true;
        }
    }

    public static function render(string $path, array $variables = []) : void
    {
        extract($variables); // Displays all variables one by one
        get_template_part( 'parts/' . $path, 'page' );
    }   

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

    public static function comment_form_utils()
    {
        $html5 = TRUE; // False if xhtml
        $req = get_option( 'require_name_email' );
        $html_req = ( $req ? " required='required'" : '' );
        $commenter = wp_get_current_commenter();
        $aria_req = ( $req ? " aria-required='true'" : '' );

        if(!isset($commenter['comment_author']))
        {
            $commenter['comment_author']='';
        }

        if(!isset($commenter['comment_author_email']))
        {
            $commenter['comment_author_email']='';
        }

        if(!isset($commenter['comment_author_url']))
        {
            $commenter['comment_author_url']='';
        }

        // Comments form
        $comment_args = array
        (
            'class_submit' => 'btn btn-primary submit',
            'comment_field' => '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun' ) . '</label> <textarea id="comment" name="comment" class="form-control" cols="45" rows="8" aria-required="true" required="required"></textarea></p>',
            'fields' => array
            (
                'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Name' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' . '<input id="author" name="author" class="form-control" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . $html_req . ' /></p>',
                'email'  => '<p class="comment-form-email"><label for="email">' . __( 'Email' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' . '<input id="email" name="email" class="form-control" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-describedby="email-notes"' . $aria_req . $html_req  . ' /></p>',
                'url'    => '<p class="comment-form-url"><label for="url">' . __( 'Website' ) . '</label> ' . '<input id="url" name="url" class="form-control" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>',
            )
        );

        return $comment_args;
    }

}