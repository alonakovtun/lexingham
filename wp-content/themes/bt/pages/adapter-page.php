<?php

/**
 * Template name: Adapter Search Page
 */

get_header();

//$customer_country = ip_info("country", true);

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

?>



<div id="primary" class="content-area site-light-gray-bg adaptor-page">
    <?php if ((isset($_GET['need_usb']) || isset($_GET['pins']) || !empty($_GET['country_from']) || !empty($_GET['country_to'])) && ($_GET['country_from'] !== $_GET['country_to'])) : ?>
        <main id="main" class="site-main adapter-search-page found-smth">
        <?php else : ?>
            <main id="main" class="site-main adapter-search-page">
            <?php endif; ?>

            <?php
            while (have_posts()) : the_post();

                $countries_from = get_terms(array(
                    'taxonomy' => 'country_from',
                    'hide_empty' => false,
                ));
                $countries_to = get_terms(array(
                    'taxonomy' => 'country_to',
                    'hide_empty' => false,
                ));

            ?>

                <section class="adaptor-finder container-1020">
                    <div class="respons-wraper">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="contact-headline-paragraph text-center">
                                    <p class="font30px-to-em no-margin font400 padding-bottom-25"><?php _e('Travel Adaptor Finder', 'bt') ?></p>
                                    <p class="paragraph line-height-15 font18px-to-em content-no-margin-top-bottom header-content"><?php _e("Not sure what's the right adaptor for you? We're here to help.", 'bt') ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="adaptor-tabs-wrap">
                                        <ul>
                                            <?php if (isset($_GET['tab']) && $_GET['tab'] == 'byorigin' || !isset($_GET['tab'])) : ?>
                                                <li data-id="byorigin" class="tab active">By origin & destination</li>
                                            <?php else : ?>
                                                <li data-id="byorigin" class="tab">By origin & destination</li>
                                            <?php endif; ?>
                                            <?php if (isset($_GET['tab']) && $_GET['tab'] == 'bytype') : ?>
                                                <li data-id="bytype" class="tab active">By type of plug</li>
                                            <?php else : ?>
                                                <li data-id="bytype" class="tab">By type of plug</li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <form action="<?php the_permalink(); ?>" method="get" class="adaptor-form">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="adaptor-contents-wrap">
                                            <?php if (isset($_GET['tab']) && $_GET['tab'] == 'byorigin' || !isset($_GET['tab'])) : ?>
                                                <div id="byorigin" class="tab-content origin-form active">
                                                <?php else : ?>
                                                    <div id="byorigin" class="tab-content origin-form">
                                                    <?php endif; ?>
                                                    <p class="origin-search-title"><?php echo __('Tell us a little more', 'bt') ?></p>
                                                    <div class="first-row">
                                                        <div class="checkboxes-wrap">
                                                            <div class="choose-options">
                                                                <p class="checkboxes-title"><?php echo __('What types of plugs you currently use for devices?', 'bt') ?></p>
                                                                <div class="checkbox-items">

                                                                    <div class="checkbox-item">
                                                                        <?php if (!empty($_GET['pins']) && $_GET['pins'] == 2) : ?>
                                                                            <input class="two-pin" type="radio" id="2pin" name="pins" value="2" checked>
                                                                        <?php else : ?>
                                                                            <input class="two-pin" type="radio" id="2pin" name="pins" value="2">
                                                                        <?php endif; ?>
                                                                        <label for="2pin"><?php _e('2 pin plug', 'bt') ?></label>
                                                                    </div>
                                                                    <div class="checkbox-item checkbox-item-pins">
                                                                        <?php if (!empty($_GET['pins']) && $_GET['pins'] == 3) : ?>
                                                                            <input class="three-pin" type="radio" id="3pin" name="pins" value="3" checked>
                                                                        <?php else : ?>
                                                                            <input class="three-pin" type="radio" id="3pin" name="pins" value="3">
                                                                        <?php endif; ?>
                                                                        <label for="3pin"><?php _e('3 pin plug', 'bt') ?></label>

                                                                    </div>
                                                                    
                                                                    <div class="item-tooltip">
                                                                        <?php _e('Please choose between <br>2 pin and 3 pin plugs', 'bt') ?>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="choose-options">
                                                                <p class="checkboxes-title"><?php echo __('Would you need a USB?', 'bt') ?></p>
                                                                <div class="checkbox-items">
                                                                    <div class="checkbox-item">
                                                                        <?php if (!empty($_GET['need_usb']) && $_GET['need_usb'] == 'true') : ?>
                                                                            <input type="radio" id="need_usb1" name="need_usb" value="true" checked>
                                                                        <?php else : ?>
                                                                            <input type="radio" id="need_usb1" name="need_usb" value="true">
                                                                        <?php endif; ?>
                                                                        <label for="need_usb1"><?php _e('Yes', 'bt') ?></label>
                                                                    </div>
                                                                    <div class="checkbox-item checkbox-item-usb">
                                                                        <?php if (!empty($_GET['need_usb']) && $_GET['need_usb'] == 'false') : ?>
                                                                            <input type="radio" id="need_usb2" name="need_usb" value="false" checked>
                                                                        <?php else : ?>
                                                                            <input type="radio" id="need_usb2" name="need_usb" value="false">
                                                                        <?php endif; ?>
                                                                        <label for="need_usb2"><?php _e('No', 'bt') ?></label>
                                                                    </div>

                                                                    <div class="item-tooltip">

                                                                        <?php _e('Please choose between<br>USB options', 'bt') ?>
                                                                    </div>
                                                                </div>

                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="second-row clearfix selects-wrap">

                                                        <div class="country-block">
                                                            <div class="from-select-wrap">
                                                                <label for="country_from"></label>
                                                                <select name="country_from" id="country_from">
                                                                    <option value="" placeholder>
                                                                        <p class="first"><?php echo __('Departing from / ', 'bt') ?></p>
                                                                        <p class="second"><?php echo __('pick a country', 'bt') ?></p>
                                                                    </option>
                                                                    <?php foreach ($countries_from as $country) { ?>
                                                                        <?php if ((!empty($_GET['country_from']) && $_GET['country_from'] == $country->slug) || ($customer_country == $country->name && empty($_GET['country_from']) && !empty($customer_country))) : ?>
                                                                            <option value="<?php echo $country->slug; ?>" selected><?php echo $country->name; ?></option>
                                                                        <?php else : ?>
                                                                            <option value="<?php echo $country->slug; ?>"><?php echo $country->name; ?></option>
                                                                        <?php endif; ?>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                            <div class="to-select-wrap">
                                                                <label for="country_to"><?php echo __('', 'bt') ?></label>
                                                                <select name="country_to" id="country_to">
                                                                    <option value="" placeholder>
                                                                        <p class="first"><?php echo __('Landing at / ', 'bt') ?></p>
                                                                        <p class="second"><?php echo __('pick a country', 'bt') ?></p>
                                                                    </option>
                                                                    <?php foreach ($countries_to as $country) { ?>
                                                                        <?php if (!empty($_GET['country_to']) && $_GET['country_to'] == $country->slug) : ?>
                                                                            <option value="<?php echo $country->slug; ?>" selected><?php echo $country->name; ?></option>
                                                                        <?php else : ?>
                                                                            <option value="<?php echo $country->slug; ?>"><?php echo $country->name; ?></option>
                                                                        <?php endif; ?>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>


                                                        </div>

                                                        <div class="submit-btn-wrap">
                                                            <button id="adaptor-submit-button" type="submit" class="b_tton accent"><?php echo __('Find', 'bt') ?></button>
                                                        </div>
                                                    </div>
                                                    </div>
                                                    <?php if (isset($_GET['tab']) && $_GET['tab'] == 'bytype') : ?>
                                                        <div id="bytype" class="tab-content active">
                                                        <?php else : ?>
                                                            <div id="bytype" class="tab-content">
                                                            <?php endif; ?>
                                                            <p class="origin-search-title title"><?php echo __('Search adaptor by type', 'bt') ?></p>
                                                            <p class="text-center paragraph line-height-15 font18px-to-em content-no-margin-top-bottom header-content"><?php echo __('Hover over the plugs illustrations to find which type you are using.', 'bt') ?></p>
                                                            <div class="adaptor-types-wrap">
                                                                <?php
                                                                $args = array(
                                                                    'post_type' => 'travel_adaptor',
                                                                    'posts_per_page' => -1,
                                                                    'order' => 'ASC'
                                                                );

                                                                $query = new WP_Query($args);

                                                                if ($query->have_posts()) { ?>

                                                                    <?php while ($query->have_posts()) {
                                                                        $query->the_post(); ?>
                                                                        <div class="adaptor-item">
                                                                            <div class="countries-list-wrap">
                                                                                <p class="list-title"><?php _e('LIST OF THE COUNTRIES', 'bt') ?></p>
                                                                                <ul>
                                                                                    <?php
                                                                                    $cur_terms = get_the_terms(get_the_ID(), 'country_from');
                                                                                    if (!empty($cur_terms)) :
                                                                                        foreach ($cur_terms as $cur_term) { ?>
                                                                                            <li data-slug="<?php echo $cur_term->slug; ?>" data-pin="<?php the_field('earthed'); ?>"><?php echo $cur_term->name; ?></li>
                                                                                    <?php
                                                                                        }
                                                                                    endif;
                                                                                    ?>
                                                                                </ul>
                                                                            </div>
                                                                            <div class="icon-wrap">
                                                                                <?php the_post_thumbnail(); ?>
                                                                            </div>
                                                                            <p class="name">
                                                                                <?php the_title(); ?>
                                                                            </p>
                                                                        </div>


                                                                    <?php
                                                                    }
                                                                    ?>
                                                                <?php

                                                                }

                                                                wp_reset_postdata();
                                                                ?>

                                                            </div>
                                                            </div>
                                                        </div>
                                                </div>
                                        </div>
                                        <input type="hidden" name="tab" value="byorigin">
                            </form>
                        </div>
                    </div>
                </section>
                <?php if ((isset($_GET['need_usb']) || isset($_GET['pins']) || !empty($_GET['country_from']) || !empty($_GET['country_to'])) && ($_GET['country_from'] !== $_GET['country_to'])) : ?>
                    <?php
                    $tax_query[] = array(
                        'taxonomy' => 'product_cat',
                        'field'    => 'slug',
                        'terms'    => 'connect'
                    );
                    if (isset($_GET['need_usb'])) {
                        if ($_GET['need_usb'] == 'true') {
                            $meta_query[] = array(
                                'key'       => 'have_usb',
                                'value'        => 1,
                                'type'        => 'NUMERIC',
                                'compare'   => '=='
                            );
                        } else {
                            $meta_query[] = array(
                                'key'       => 'have_usb',
                                'value'        => 1,
                                'type'        => 'NUMERIC',
                                'compare'   => '!='
                            );
                        }
                    }

                    if (isset($_GET['pins'])) {
                        if ($_GET['pins'] == 2) {
                            $meta_query[] = array(
                                'key'       => '2_pin_plug',
                                'value'        => 1,
                                'type'        => 'NUMERIC',
                                'compare'   => '=='
                            );
                        }
                        if ($_GET['pins'] == 3) {
                            $meta_query[] = array(
                                'relation' => 'OR',
                                array(
                                    'key'       => '2_pin_plug',
                                    'compare'   => 'NOT EXISTS'
                                ),
                                array(
                                    'key'       => '2_pin_plug',
                                    'value'        => 0,
                                    'type'        => 'NUMERIC',
                                    'compare'   => '=='
                                ),
                            );
                        }
                    }

                    if (!empty($_GET['country_from'])) {
                        $tax_query[] = array(
                            'taxonomy' => 'country_from',
                            'field'    => 'slug',
                            'terms'    => $_GET['country_from']
                        );
                    }

                    if (!empty($_GET['country_to'])) {
                        $tax_query[] = array(
                            'taxonomy' => 'country_to',
                            'field'    => 'slug',
                            'terms'    => $_GET['country_to']
                        );
                    }
                    $excluded_product_ids = get_field('excluded_products');


                    if ($excluded_product_ids && !empty($excluded_product_ids)) {
                        $params = array(
                            'posts_per_page' => -1,
                            'post_type' => array('product'),
                            'tax_query' => $tax_query,
                            'meta_query' => $meta_query,
                            'post__not_in' => $excluded_product_ids
                        );
                    } else {
                        $params = array(
                            'posts_per_page' => -1,
                            'post_type' => array('product'),
                            'tax_query' => $tax_query,
                            'meta_query' => $meta_query
                        );
                    }


                    $wc_query = new WP_Query($params);

                    $found_products = $wc_query->found_posts;


                    ?>
                    <section id="scroll-to" class="products-sort-bar">
                        <div class="respons-wraper">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="count-wrap clearfix">
                                            <?php if ($found_products > 0) : ?>
                                                <?php printf(_nx('There is <span>1 adaptor</span>', 'There are <span>%1$d adaptors</span>', $found_products, 'bt'), $found_products); ?> <?= _e('which will make your travel a ride', 'bt') ?>
                                            <?php else : ?>
                                                <?= _e('Sorry, we couldn’t find anything.', 'bt') ?>

                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <?php if ($wc_query->have_posts()) : ?>
                        <script>
                            (function($) {
                                $(document).ready(function() {
                                    setTimeout(function() {
                                        $('html,body').animate({
                                            scrollTop: $('#scroll-to').offset().top
                                        }, 800);
                                    }, 800);
                                });
                            })(jQuery);
                        </script>
                        <section class="adaptor-products-wrap">
                            <div class="respons-wraper">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php woocommerce_product_loop_start();
                                            $counter = 1;
                                            ?>
                                            <?php while ($wc_query->have_posts()) : $wc_query->the_post(); ?>

                                                <?php wc_get_template_part('content', 'product'); ?>
                                                <?php if ($counter % 4 == 0) : ?>
                                        </div>
                                        <div class="row">
                                        <?php endif; ?>
                                    <?php
                                                $counter++;
                                            endwhile; // End of the loop.
                                            wp_reset_postdata(); ?>
                                    <?php woocommerce_product_loop_end(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    <?php endif; ?>
                <?php endif; ?>
                <?php if (!empty($_GET['country_from']) && !empty($_GET['country_to']) && $_GET['country_from'] == $_GET['country_to']) : ?>
                    <section id="scroll-to" class="products-sort-bar">
                        <div class="respons-wraper">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="count-wrap clearfix">

                                            <?php _e('Are you staycationing?', 'bt') ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                <?php endif; ?>
            <?php
            endwhile; // End of the loop.
            ?>
            </main><!-- #main -->
</div><!-- #primary -->
<?php
get_footer();
