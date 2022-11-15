<?php

if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly
}

if ( !function_exists( '_dd' ) ) {

  function _dd ( $value, $display_option = false, $die = false ) {

    echo '<div id="php-debugger" style="background-color:rgba(0,0,0,0.75);position:fixed;top:0;right:0;bottom:0;left:0;z-index:999;">';
    echo '<pre dir="ltr" style="background-color:#fff;border-radius:10px;padding:30px;position:fixed;top:50%;left:50%;transform:translate(-50%,-50%);z-index:1000;height:80%;width:800px;overflow-y:auto;">';

    if ( !strtolower( $display_option ) ) {
      print_r( $value );
    } else if ( strtolower( $display_option ) === 'dump' ) {
      var_dump( $value );
    } else if ( strtolower( $display_option ) === 'export' ) {
      var_export( $value );
    }

    echo '</pre></div>';

    echo '<script>';
    echo   'jQuery(function(){';
    echo     'jQuery(\'#php-debugger\').click(function(){';
    echo       'jQuery(this).hide();';
    echo     '});';
	echo     'jQuery(\'#php-debugger pre\').click(function(e){';
	echo       'e.stopPropagation();';
	echo     '});';
    echo   '});';
    echo '</script>';

    if ( $die ) {
      die;
    }

  }

}

if ( !function_exists( '_bdd' ) ) {

	function _bdd ( $value, $die = false ) {

		echo '<div dir="ltr">';
		echo   '<pre>';
		print_r( $value );
		echo   '</pre>';
		echo '</div>';

		if ( $die ) {
			die;
		}

	}

}

if ( !function_exists( 'bs_cols' ) ) {

  function bs_cols ( $lg = '', $md = '', $sm = '', $xs = '' ) {

    $boostrap_cols_classes = '';

    if ( !empty( $lg ) ) {
      $boostrap_cols_classes .= ' col-lg-' . $lg;
    }

    if ( !empty( $md ) ) {
      $boostrap_cols_classes .= ' col-md-' . $md;
    }

    if ( !empty( $sm ) ) {
      $boostrap_cols_classes .= ' col-sm-' . $sm;
    }

    if ( !empty( $xs ) ) {
      $boostrap_cols_classes .= ' col-xs-' . $xs;
    }

    echo $boostrap_cols_classes;

  }

}

if ( !function_exists( 'bt_word_limit' ) ) {

	function bt_word_limit ( $string, $limit, $echo = false, $delimiter = ' ' ) {

		$string_parts = explode( $delimiter, $string );
		$string_parts_count = count( $string_parts );
		$string = '';

		for ( $start = 0; $start < $limit; $start++ ) {
			if ( $string_parts_count === $start ) break;
			$string .= $string_parts[ $start ] . ' ';
		}

		$string = trim( $string );
		
		if ( $echo ) {
			echo $string;
			return;
		}
		
		return $string;

	}

}


if ( !function_exists( 'bt_the_content' ) ) {

  function bt_the_content () {

    if ( have_posts() ) {
      while ( have_posts() ) {
        the_post();
        the_content();
      }
    }

  }

}

if ( !function_exists( 'bt_sort_object_by_key' ) ) {

  function bt_sort_object_by_key( $key, $order = 'desc' ) {
    return function( $a, $b ) use ( $key, $order ) {
      if ( $order == 'desc' ) {
        list( $a, $b ) = array( $b, $a );
      }
      if ( is_numeric( $a->$key ) ) {
        return $a->$key - $b->$key;
      } else {
        return strnatcasecmp( $a->$key, $b->$key );
      }
    };
  }

}
// use the function below to sort
//usort( $sorted_categories, vs_sort_object_by_key( 'order' ) );

function bt_breadcrumbs () {
	
	if ( is_page() ) {
		return get_page_breadcrumbs();
	} elseif ( is_product_category() ) {
		return get_shop_category_breadcrumbs();
	} elseif ( is_product() ) {
		return get_product_breadcrumbs();
	}
	
}

function get_product_breadcrumbs () {

	$product_id = get_the_ID();
	$category = get_the_terms( $product_id, 'product_cat' )[0];

	$breadcrumbs_html = get_shop_category_breadcrumbs( $category, false );

	$breadcrumbs_html .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">';
	$breadcrumbs_html .=   '<a href="' . get_permalink( $product_id ) . '" itemprop="item">';
	$breadcrumbs_html .=     '<span itemprop="name">' . ucwords( strtolower( get_the_title() ) ) . '</span>';
	$breadcrumbs_html .=     '<meta itemprop="position" content="' . ( get_shop_category_depth( $category->parent ) + 1 ) . '" />';
	$breadcrumbs_html .=   '</a>';
	$breadcrumbs_html .= '</li>';

	$breadcrumbs_html .= '</ul>';

	return $breadcrumbs_html;

}

function get_shop_category_breadcrumbs ( $category = false, $close = true ) {

	$breadcrumbs_html_s = '<ul itemscope itemtype="http://schema.org/BreadcrumbList">';

	$breadcrumbs_html_s .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">';
	$breadcrumbs_html_s .=   '<a href="' . BPATH . '" itemprop="item">';
	$breadcrumbs_html_s .=     '<span itemprop="name">' . BREADCRUMBS_HOME_PAGE_NAME . '</span>';
	$breadcrumbs_html_s .=     '<meta itemprop="position" content="1" />';
	$breadcrumbs_html_s .=   '</a>';
	$breadcrumbs_html_s .= '</li>';

	if ( !$category ) {
		$category = get_queried_object();
	}

	$breadcrumbs_html .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">';
	$breadcrumbs_html .=   '<a href="' . get_term_link( $category ) . '" itemprop="item">';
	$breadcrumbs_html .=     '<span itemprop="name">' . ucwords( strtolower( $category->name ) ) . '</span>';
	$breadcrumbs_html .=     '<meta itemprop="position" content="' . get_shop_category_depth( $category->parent ) . '" />';
	$breadcrumbs_html .=   '</a>';
	$breadcrumbs_html .= '</li>';

	$breadcrumbs_html = $breadcrumbs_html_s . get_shop_parent_categories_breadcrumbs( $category->parent ) . $breadcrumbs_html;

	if ( $close ) {
		$breadcrumbs_html .= '</ul>';
	}

	return $breadcrumbs_html;

}

function get_shop_category_depth ( $category_id, $depth = 1 ) {

	if ( $category_id != 0 ) {
		$parent_category = get_term( $category_id, 'product_cat' );

		$depth++;
		return get_shop_category_depth( $parent_category->parent, $depth );
	} else {
		$depth++;
		return $depth;
	}

}

function get_shop_parent_categories_breadcrumbs ( $category_id, $html = '' ) {

	if ( $category_id != 0 ) {
		$parent_category = get_term( $category_id, 'product_cat' );

		$breadcrumbs_html  = '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">';
		$breadcrumbs_html .=   '<a href="' . get_term_link( $parent_category ) . '" itemprop="item">';
		$breadcrumbs_html .=     '<span itemprop="name">' . ucwords( strtolower( $parent_category->name ) ) . '</span>';
		$breadcrumbs_html .=     '<meta itemprop="position" content="' . get_shop_category_depth( $parent_category->parent ) . '" />';
		$breadcrumbs_html .=   '</a>';
		$breadcrumbs_html .= '</li>';

		$html = $breadcrumbs_html . $html;

		return get_shop_parent_categories_breadcrumbs( $parent_category->parent, $html );

	} else {
		$parent_category = get_term( $category_id, 'product_cat' );

		$breadcrumbs_html  = '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">';
		$breadcrumbs_html .=   '<a href="' . BPATH . '/shop" itemprop="item">';
		$breadcrumbs_html .=     '<span itemprop="name">Shop</span>';
		$breadcrumbs_html .=     '<meta itemprop="position" content="2" />';
		$breadcrumbs_html .=   '</a>';
		$breadcrumbs_html .= '</li>';

		//$html = $breadcrumbs_html . $html;

		return $html;

	}

}

function get_page_depth ( $page_id, $depth = 1 ) {

	if ( $page_id != 0 ) {
		$parent_page = get_post( $page_id );
		$depth++;
		return get_page_depth( $parent_page->post_parent, $depth );
	} else {
		$depth++;
		return $depth;
	}

}

function get_page_breadcrumbs () {
	
	$breadcrumbs_html = '<ul itemscope itemtype="http://schema.org/BreadcrumbList">';

	$breadcrumbs_html .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">';
	$breadcrumbs_html .=   '<a href="' . BPATH . '" itemprop="item">';
	$breadcrumbs_html .=     '<span itemprop="name">' . BREADCRUMBS_HOME_PAGE_NAME . '</span>';
	$breadcrumbs_html .=     '<meta itemprop="position" content="1" />';
	$breadcrumbs_html .=   '</a>';
	$breadcrumbs_html .= '</li>';
	$breadcrumbs_html .= get_page_parent_breadcrumbs( get_the_ID() );
	$breadcrumbs_html .= '</ul>';
	
	return $breadcrumbs_html;
	
}

function get_page_parent_breadcrumbs ( $page_id, $html = '' ) {

	if ( $page_id != 0 ) {
		$parent_page = get_post( $page_id );

		$breadcrumbs_html  = '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">';
		$breadcrumbs_html .=   '<a href="' . urldecode( get_permalink( $parent_page ) ) . '" itemprop="item">';
		$breadcrumbs_html .=     '<span itemprop="name">' . ucwords( strtolower( $parent_page->post_title ) ) . '</span>';
		$breadcrumbs_html .=     '<meta itemprop="position" content="' . get_page_depth( $parent_page->post_parent ) . '" />';
		$breadcrumbs_html .=   '</a>';
		$breadcrumbs_html .= '</li>';

		$html = $breadcrumbs_html . $html;

		return get_page_parent_breadcrumbs( $parent_page->post_parent, $html );

	} else {
		return $html;
	}

}

if ( !function_exists( 'bt_get_the_post_thumbnail_alt' ) ) {
	function bt_get_the_post_thumbnail_alt ( $post_id ) {
		return get_post_meta( get_post_thumbnail_id( $post_id ), '_wp_attachment_image_alt', true );	
	}
}

if ( !function_exists( 'bt_the_post_thumbnail_alt' ) ) {
	function bt_the_post_thumbnail_alt ( $post_id ) {
		echo get_post_meta( get_post_thumbnail_id( $post_id ), '_wp_attachment_image_alt', true );	
	}
}