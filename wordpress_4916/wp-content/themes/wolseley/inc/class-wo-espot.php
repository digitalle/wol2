<?php

/**
 * Plugin Name: Wolseley eSpot *
 * Description: Registers taxonomies & CPTs.
 *
 * @package     wolseley
 * @class       WO-Post-Types
 * @version     1.0
 * @package     Wolseley/CustomPostTypes
 * @category    Class
 * @author      Rupert Hurley -Digitalle -
 * Author URI:  http://digitalle.com
 * Text domain: wolseley
 * Domain path: /lang
 */



class Espot {


    public function __construct() {
        register_activation_hook(__FILE__, array($this, 'activate'));
        add_action('init', array($this, 'wo_create_taxonomies'));
        add_action('init', array($this, 'wo_create_custom_post_types'));
    }

    public function activate() {
        $this->wo_create_taxonomies();
    }

    public function wo_create_taxonomies() {


        //  START: espot Taxonomy
        $labels_espot_tax = array(
            'name'                  =>  'eSpot categories',
            'singular_name'         =>  'eSpot category (sing)',
            'search_items'          =>  'Search eSpot categories',
            'all_items'             =>  'All eSpot categories',
            'parent_item'           =>  'Parent eSpot category',
            'parent_item_colon'     =>  'Parent cat colon?',
            'edit_item'             =>  'Edit eSpot category',
            'update_item'           =>  'Update eSpot category',
            'add_new_item'          =>  'Add new eSpot category',
            'new_item_name'         =>  'New sub category name',
            'menu_name'             =>  'eSpot categories'
        );

        $args_espot_tax = array(
            'hierarchical'          =>  true,
            'labels'                =>  $labels_espot_tax,
            'show_ui'               =>  true,
            'show_admin_column'     =>  true,
            'query_var'             =>  true,
            'rewrite'               =>  array(
                'slug'              =>  '/espot_cats',
                'hierarchical'      =>  true
            ),
            'show_in_rest'          =>  true,
            'rest_base'             =>  'espot',
            'rest_controller_class' =>  'WP_REST_Terms_Controller',
        );

        register_taxonomy( 'espot_cats', array('espot'), $args_espot_tax);
        //  END: espot Taxonomy
    }




    /*
     *  START: Create espot CPT
     *  ----------------------
     */

    public function wo_create_custom_post_types() {

        // START: espot Custom Post Type
        $labels_espot = array(
            'name'                  => _x( 'espot', 'post type general name','wolseley' ),
            'singular_name'         => _x( 'espot', 'post type singular name','wolseley' ),
            'menu_name'             => _x( 'espots', 'admin menu','wolseley' ),
            'name_admin_bar'        => _x( 'espot', 'add new on admin bar','wolseley' ),
            'add_new'               => _x( 'Add New', 'espot','wolseley' ),
            'add_new_item'          => __( 'Add New espot','wolseley' ),
            'new_item'              => __( 'New espot','wolseley' ),
            'edit_item'             => __( 'Edit espot','wolseley' ),
            'view_item'             => __( 'View espot','wolseley' ),
            'all_items'             => __( 'espots','wolseley' ),
            'search_items'          => __( 'Search espots','wolseley' ),
            'parent_item_colon'     => __( 'Parent espots:','wolseley' ),
            'not_found'             => __( 'No espots found.','wolseley' ),
            'not_found_in_trash'    => __( 'No espots found in Trash.','wolseley' ),
        );

        $args_espot = array(
            'labels'                => $labels_espot,
            'description'           => __( 'Description.','wolseley' ),
            'public'                => true,
            'publicly_queryable'    => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'query_var'             => true,
            //'rewrite'               => array( 'slug' => 'espot' ),
            'capability_type'       => 'page',
            'has_archive'           => true,
            'hierarchical'          => true,
            'menu_position'         => 5,
            'menu_icon'             => 'dashicons-id-alt',
            'show_in_rest'          => true,
            'rest_base'             => 'espots',
            'rest_controller_class' => 'WP_REST_Posts_Controller',
            'supports'              => array(
                'title',
                'editor',
                'author',
                'thumbnail',
                'excerpt',
                'trackbacks',
                'custom-fields',
                'comments',
                'revisions',
                'page-attributes',
                'post-formats',
            ),
            'taxonomies'            => array('espot_cats')
        );

        register_post_type('espot', $args_espot );
        // END: espot Custom Post Type
    }
}

$espot = new Espot();