<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://ays-pro.com/
 * @since      1.0.0
 *
 * @package    Gallery_Photo_Gallery
 * @subpackage Gallery_Photo_Gallery/includes
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Gallery_Photo_Gallery
 * @subpackage Gallery_Photo_Gallery/includes
 * @author     AYS Pro LLC <info@ays-pro.com>
 */
class Photo_Gallery_Data {    

    public static function ays_autoembed( $content ) {
        global $wp_embed;

        if ( is_null( $content ) ) {
            return $content;
        }

        $content = stripslashes( wpautop( $content ) );
        $content = $wp_embed->autoembed( $content );
        if ( strpos( $content, '[embed]' ) !== false ) {
            $content = $wp_embed->run_shortcode( $content );
        }
        $content = do_shortcode( $content );
        return $content;
    }
    
    public static function get_galleries(){
        global $wpdb;        
        $galleries_table = $wpdb->prefix . 'glp_gallery';
        $sql = "SELECT id,title
                FROM {$galleries_table}";

        $galleries = $wpdb->get_results( $sql , "ARRAY_A" );

        return $galleries;
    }

}
