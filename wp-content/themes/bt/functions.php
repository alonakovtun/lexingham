<?php

if ( ! defined( 'ABSPATH' ) ) {
 exit; // Exit if accessed directly
}

define( 'THEME_DIR', WP_CONTENT_DIR . '/themes/bt/' );

/** theme constants **/
require THEME_DIR . 'inc/constants.php';

/** general theme helper functions **/
require THEME_DIR . 'inc/helper.php';

/** theme category related hooks **/
require THEME_DIR . 'inc/category.php';

/** php headers **/
require THEME_DIR . 'inc/headers.php';

/** theme menu and widgets register **/
require THEME_DIR . 'inc/register.php';

/** remove theme and core wordpress features ( removing hooks that can cause security risks ) **/
require THEME_DIR . 'inc/remove-features.php';

/** loading theme styles and scripts **/
require THEME_DIR . 'inc/enqueue.php';

/** adding support to core wordpress features **/
require THEME_DIR . 'inc/support.php';

/** disabling theme and plugin updates **/
require THEME_DIR . 'inc/updates.php';

/** adding noFollow and title to links in wysiwyg **/
require THEME_DIR . 'inc/wysiwyg.php';

/** adding schema to page **/
require THEME_DIR . 'inc/schema.php';

/** adding ajax support **/
require THEME_DIR . 'inc/ajax.php';

/** adding curl ( REST ) support **/
require THEME_DIR . 'inc/curl.php';

/** adding session support **/
require THEME_DIR . 'inc/session.php';

/** woocommerce related hooks, filters and functions **/
require THEME_DIR . 'inc/woocommerce.php';


if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}

function bt_scripts()
{
    wp_enqueue_style('bt-style', get_stylesheet_uri(), array(), _S_VERSION);

    wp_enqueue_style('bt-main-style', get_template_directory_uri() . '/assets/css/main.min.css', array(), _S_VERSION);

    wp_register_script('bt-scripts', get_template_directory_uri() . '/assets/js/main.min.js', array(), _S_VERSION, true);
   
    wp_enqueue_script('bt-scripts');
}
add_action('wp_enqueue_scripts', 'bt_scripts');


function create_weron_stc_custom_post_types() {
	
	register_post_type( 'travel_adaptor',
		array(
			'labels' => array(
			'name'                => __( 'Travel Adaptors', 'bt' ),
			'singular_name'       => __( 'Travel Adaptor', 'bt' ),
			'menu_name'           => __( 'Travel Adaptors', 'bt' ),
			'all_items'           => __( 'All Adaptors', 'bt' ),
			'view_item'           => __( 'View', 'bt' ),
			'add_new_item'        => __( 'Add new item', 'bt' ),
			'add_new'             => __( 'Add new', 'bt' ),
			'edit_item'           => __( 'Edit', 'bt' ),
			'update_item'         => __( 'Update', 'bt' ),
			'search_items'        => __( 'Search items', 'bt' ),
			'not_found'           => __( 'Not found', 'bt' ),
			'not_found_in_trash'  => __( 'Not found in trach', 'bt' ),
			),
			'supports'            => array( 'title', 'thumbnail' ),
			'taxonomies'          => array( 'country_from' ),
			'public'              => true,
			'menu_position'       => 4,
			'menu_icon'           => 'dashicons-networking',
		)
	);

	
  	


  	register_taxonomy( 'country_from',
		array(
			'product',
			'travel_adaptor'
		),
		array(
			'labels'                     => array(
				'name'                       => __( 'Country From', 'Taxonomy General Name', 'bt' ),
				'singular_name'              => __( 'Country From', 'Taxonomy Singular Name', 'bt' ),
				'menu_name'                  => __( 'Countries From', 'bt' ),
				'all_items'                  => __( 'All Countries', 'bt' ),
				'parent_item'                => __( 'Parent item', 'bt' ),
				'parent_item_colon'          => __( 'Parent item:', 'bt' ),
				'new_item_name'              => __( 'New Country', 'bt' ),
				'add_new_item'               => __( 'Add new item', 'bt' ),
				'edit_item'                  => __( 'Edit', 'bt' ),
				'update_item'                => __( 'Update', 'bt' ),
				'search_items'               => __( 'Search', 'bt' ),
				'add_or_remove_items'        => __( 'Add or remove location', 'bt' ),
				'choose_from_most_used'      => __( 'Search', 'bt' ),
				'not_found'                  => __( 'Not found', 'bt' ),
			),
			'hierarchical'               => false,
			'public'                     => true,
		)
  	);

  	register_taxonomy( 'country_to',
		array(
			'product'
		),
		array(
			'labels'                     => array(
				'name'                       => __( 'Country To', 'Taxonomy General Name', 'bt' ),
				'singular_name'              => __( 'Country To', 'Taxonomy Singular Name', 'bt' ),
				'menu_name'                  => __( 'Countries To', 'bt' ),
				'all_items'                  => __( 'All Countries', 'bt' ),
				'parent_item'                => __( 'Parent item', 'bt' ),
				'parent_item_colon'          => __( 'Parent item:', 'bt' ),
				'new_item_name'              => __( 'New Country', 'bt' ),
				'add_new_item'               => __( 'Add new item', 'bt' ),
				'edit_item'                  => __( 'Edit', 'bt' ),
				'update_item'                => __( 'Update', 'bt' ),
				'search_items'               => __( 'Search', 'bt' ),
				'add_or_remove_items'        => __( 'Add or remove location', 'bt' ),
				'choose_from_most_used'      => __( 'Search', 'bt' ),
				'not_found'                  => __( 'Not found', 'bt' ),
			),
			'hierarchical'               => false,
			'public'                     => true,
		)
  	);


};
add_action( 'init', 'create_weron_stc_custom_post_types' );


// Filter by country adaptor query modification
add_action( 'woocommerce_product_query', 'custom_pre_get_posts_query' );
function custom_pre_get_posts_query( $q ) {

	if ( ! $q->is_main_query() ) return;
	if ( ! $q->is_post_type_archive() ) return;
	
    if ( ! is_admin() ) {

		if(!empty($_GET['country_from'])){
		    $q->set( 'country_from', $_GET['country_from'] );
		}

		if(!empty($_GET['country_to'])){
		    $q->set( 'country_to', $_GET['country_to'] );
		}

    }
    

}

add_filter( 'woocommerce_product_query_meta_query', 'custom_pre_get_posts_query_meta', 10, 2 );
function custom_pre_get_posts_query_meta( $meta_query, $query ) {
    if( is_admin() ) return $meta_query;

    if(isset($_GET['need_usb']) && $_GET['need_usb'] == true){
		$meta_query[] = array(
			'key'       => 'have_usb',
			'value'		=> 1,
			'type'		=> 'NUMERIC',
			'compare'   => '=='
		);
	}

	if(isset($_GET['2pin']) && $_GET['2pin'] == true){
		$meta_query[] = array(
			'key'       => '2_pin_plug',
			'value'		=> 1,
			'type'		=> 'NUMERIC',
			'compare'   => '=='
		);
	}elseif(isset($_GET['3pin']) && $_GET['3pin'] == true){
		$meta_query[] = array(
			'relation' => 'OR',
			array(
				'key'       => '2_pin_plug',
				'compare'   => 'NOT EXISTS'
			),
			array(
				'key'       => '2_pin_plug',
				'value'		=> 0,
				'type'		=> 'NUMERIC',
				'compare'   => '=='
			),
		);
	}
	
	
	
    return $meta_query;
};

// ==== Widget For a Mega menu featured product ==== //
// Register and load the widget
function travel_blue_load_widget() {
    register_widget( 'adaptors_select_widget' );
}
add_action( 'widgets_init', 'travel_blue_load_widget' );
 
// Creating the widget 
class adaptors_select_widget extends WP_Widget {
 
	function __construct() {
	parent::__construct(
	 
	// Base ID of your widget
	'adaptors_select_widget', 
	 
	// Widget name will appear in UI
	__('Adaptors select', 'bt'), 
	 
	// Widget description
	array( 'description' => __( 'Adaptors select for Mega menu', 'bt' ), ) 
	);
	}
	

	// Creating widget front-end

	public function widget( $args, $instance ) {

		$cat_id = 51;
		$cat_link = get_term_link( $cat_id, 'product_cat' );

		$title = apply_filters( 'widget_title', $instance['title'] );

		echo $args['before_widget'];
		if ( ! empty( $title ) )
		echo $args['before_title'] . $title . $args['after_title'];
		$countries_from = get_terms( array(
		    'taxonomy' => 'country_from',
		    'hide_empty' => false,
		) );
		$countries_to = get_terms( array(
		    'taxonomy' => 'country_to',
		    'hide_empty' => false,
		) );
		?>
		<div class="adaptor-form-wrap">
			<p class="title"><?php echo __( 'Find the right adaptor', 'bt' ) ?></p>
			<p class="subtitle"><?php echo __( 'Not sure about your choice? We’re here to help.', 'bt' ) ?></p>
			<form action="<?php echo $cat_link; ?>" method="get">
				<div class="first-row clearfix">
					<div class="from-select-wrap">
						<label for="country_from"><?php echo __( 'FROM WHERE?', 'bt' ) ?></label>
						<select name="country_from" id="country_from">
							<option value="">Pick a country</option>
						<?php foreach($countries_from as $country){ ?>
							<?php if(!empty($_GET['country_from']) && $_GET['country_from'] == $country->slug): ?>
								<option value="<?php echo $country->slug; ?>" selected><?php echo $country->name; ?></option>
		    				<?php else: ?>
								<option value="<?php echo $country->slug; ?>"><?php echo $country->name; ?></option>
							<?php endif; ?>
						<?php } ?>
						</select>
					</div>
					<div class="to-select-wrap">
						<label for="country_to"><?php echo __( 'LANDING WHERE?', 'bt' ) ?></label>
						<select name="country_to" id="country_to">
							<option value="">Pick a country</option>
						<?php foreach($countries_to as $country){ ?>
							<?php if(!empty($_GET['country_to']) && $_GET['country_to'] == $country->slug): ?>
								<option value="<?php echo $country->slug; ?>" selected><?php echo $country->name; ?></option>
		    				<?php else: ?>
								<option value="<?php echo $country->slug; ?>"><?php echo $country->name; ?></option>
							<?php endif; ?>
						<?php } ?>
						</select>
					</div>
					<div class="submit-btn-wrap">
						<button type="submit" class="b_tton accent"><?php echo __( 'Find', 'bt' ) ?></button>
					</div>
				</div>
				<div class="second-row">
					<div class="checkboxes-wrap">
						<div class="checkbox-item">
							<?php if(!empty($_GET['need_usb']) && $_GET['need_usb'] == true): ?>
								<input type="checkbox" id="need_usb" name="need_usb" checked>
							<?php else: ?>
								<input type="checkbox" id="need_usb" name="need_usb">
							<?php endif; ?>
							<label for="need_usb">I need USB</label>
						</div>
						<div class="checkbox-item">
							<?php if(!empty($_GET['2pin']) && $_GET['2pin'] == true): ?>
								<input type="checkbox" id="2pin" name="2pin" checked>
							<?php else: ?>
								<input type="checkbox" id="2pin" name="2pin">
							<?php endif; ?>
							<label for="2pin">2 pin plug</label>
						</div>
						<div class="checkbox-item">
							<?php if(!empty($_GET['3pin']) && $_GET['3pin'] == true): ?>
								<input type="checkbox" id="3pin" name="3pin" checked>
							<?php else: ?>
								<input type="checkbox" id="3pin" name="3pin">
							<?php endif; ?>
							<label for="3pin">3 pin plug</label>
						</div>
					</div>
					
				</div>
			</form>
		</div>
		<div class="type-select-wrap">
			<p class="title"><?php echo __( 'Adaptor types guide', 'bt' ) ?></p>
			<p class="subtitle"><?php echo __( 'Hover over the plugs illustrations to find which type you are using.', 'bt' ) ?></p>
			<div class="adaptor-types-wrap">
				<?php
					$args = array(
						'post_type' => 'travel_adaptor',
						'posts_per_page' => -1,
						'order' => 'ASC'
					);

					$query = new WP_Query( $args );

					if ( $query->have_posts() ) {
						while ( $query->have_posts() ) {
							$query->the_post(); ?>
						<div class="adaptor-item">
							<div class="countries-list-wrap">
								<p class="list-title">LIST OF THE COUNTRIES</p>
								<ul>
									<?php
									$cur_terms = get_the_terms( get_the_ID(), 'country_from' );
									if(!empty($cur_terms)):
									foreach( $cur_terms as $cur_term ){ ?>
										<li data-slug="<?php echo $cur_term->slug; ?>"><?php echo $cur_term->name; ?></li>
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

		<?php

		echo $args['after_widget'];
	}
	         
	// Widget Backend 
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'New title', 'bt' );
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
	<?php 
	}
	     
	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
	$instance = array();
	$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
	return $instance;
	}
} // Class adaptors_select_widget ends here
