<?php
define( 'INCLUDE_DIR', dirname( __FILE__ ) . '\TrueAdvisory\\' );

$rules = array( 
   // 'picture'   => "/picture/(?'text'[^/]+)/(?'id'\d+)",    // '/picture/some-text/51'
   // 'album'     => "/album/(?'album'[\w\-]+)",              // '/album/album-slug'
   // 'category'  => "/category/(?'category'[\w\-]+)",        // '/category/category-slug'
   // 'page'      => "/page/(?'page'about|contact)",          // '/page/about', '/page/contact'
   // 'post'      => "/(?'post'[\w\-]+)",                     // '/post-slug'
    'signin'      => "\signin",
    'signup'      => "\signup",
    'site'      => "\\",                                      // '/'
    'classes'   => "\classes", 
    'course'    => "\course\\(?'id'\d+)", 
    'discussions'    => "\discuss\\(?'id'\d+)",
    'tutors'    => "\\tutors\\(?'id'\d+)"
);

$uri = rtrim( dirname($_SERVER["SCRIPT_NAME"]), '\\' );
$uri = '\\' . trim( str_replace( $uri, '', $_SERVER['REQUEST_URI'] ), '\\' );
$uri = urldecode( $uri );

foreach ( $rules as $action => $rule ) {
    if ( preg_match( '~^'.$rule.'$~i', $uri, $params ) ) 
    {
        /* now you know the action and parameters so you can 
         * include appropriate template file ( or proceed in some other way )
         */
        include(  INCLUDE_DIR . $action );

        // exit to avoid the 404 message 
        exit();
    }
}

// nothing is found so handle the 404 error
include( INCLUDE_DIR . 'error.html' );
?>