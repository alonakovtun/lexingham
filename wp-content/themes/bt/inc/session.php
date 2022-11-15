<?php

if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly
}

class SessionManager {

  static protected function preventHijacking () {

    if ( !isset( $_SESSION['ip_address'] ) || !isset( $_SESSION['user_agent'] ) ) {
      return false;
    }

    if ( $_SESSION['ip_address'] != $_SERVER['REMOTE_ADDR'] ) {
      return false;
    }

    if( $_SESSION['user_agent'] != $_SERVER['HTTP_USER_AGENT'] ) {
      return false;
    }

    return true;

  }

  static protected function validateSession () {

    if ( isset( $_SESSION['obsolete'] ) && !isset( $_SESSION['expires'] ) ) {
      return false;
    }

    if( isset( $_SESSION['expires'] ) && $_SESSION['expires'] < time() ) {
      return false;
    }

    return true;

  }

  static function regenerateSession () {

    if ( isset($_SESSION['obsolete'] ) || $_SESSION['obsolete'] == true ) {
      return;
    }

    $_SESSION['obsolete'] = true;
    $_SESSION['expires'] = time() + 10;

    session_regenerate_id( false );

    $newSession = session_id();
    session_write_close();

    session_id( $newSession );
    session_start();

    unset( $_SESSION['obsolete'] );
    unset( $_SESSION['expires'] );

  }

  static function sessionStart ( $name, $limit = 0, $path = '/', $domain = null, $secure = null ) {

    session_name( $name . '_session' );
    $domain = isset( $domain ) ? $domain : $_SERVER['SERVER_NAME'];
    $https = isset( $secure ) ? $secure : $_SERVER['HTTPS'];
    session_set_cookie_params( $limit, $path, $domain, $secure, true );
    session_start();

    if ( self::validateSession() ) {

      if ( !self::preventHijacking() ) {

        $_SESSION = [];
        $_SESSION['ip_address'] = $_SERVER['REMOTE_ADDR'];
        $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
        
        self::regenerateSession();

      } elseif ( rand( 1, 100 ) <= 5 ) {
        
        self::regenerateSession();
        
      }

    } else {
      
      $_SESSION = [];
      session_destroy();
      session_start();
      
    }

  }

}

/** session start example **/
/*
function bt_session_start() {
  SessionManager::sessionStart( 'bt' );
}
add_action( 'init', 'bt_session_start', 1 );

function bt_end_session() {
  session_destroy ();
}
add_action( 'wp_logout','bt_end_session' );
add_action( 'wp_login','bt_end_session' );
add_action( 'end_session_action','bt_end_session' );
*/