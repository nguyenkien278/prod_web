<?php

/*
Plugin Name: [AS] Partner
Plugin URI: http://amsterdamstandard.com/
Description: AS Component - Partner
Author: Amsterdam Standard
Version: 1.1
Author URI: http://amsterdamstandard.com/
*/

class AS_Partner extends WP_Widget
{

    function AS_Partner()
    {
        parent::__construct(false, $name = __('AS Partner', 'wp_widget_plugin')); 
    }

    function widget($args, $instance)
    { ?>
        <main role="main">
            <article>
                <div class="wrapper-sm">
                    <section class="page-item find-a-partner highlight">
                        <header><h1 class="h3">Find a partner to build your app</h1></header>

                        <?php
                        $terms = get_terms( array(
                            'taxonomy' => 'partners_countries',
                            'hide_empty' => false,
                        ) );
                        $o= '';
                        foreach( $terms as $term ){
                            $o.='<option value="'.$term->slug.'">'.$term->name.'</option>';
                        }
                        ?>
                        <select id="partner-selector" class="form-control">
                            <?php echo $o; ?>
                        </select>
                    </section>
                </div>
                <section id="our-partners" class="page-item our-partners">
                    <!-- ajax stuff here-->
                </section>
            </article>
        </main>
      <?php
    }

}
add_action('widgets_init', create_function('', 'return register_widget("AS_Partner");'));
