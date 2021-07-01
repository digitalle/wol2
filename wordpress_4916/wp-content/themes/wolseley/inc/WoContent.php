<?php

/**
 * Plugin Name: Wolseley Content *
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



class WoContent {


    public function __construct() {
        register_activation_hook(__FILE__, array($this, 'activate'));
	    add_action('init', array($this, 'wo_create_custom_post_types'));
        add_action('init', array($this, 'wo_create_taxonomies'));

    }

    public function activate() {
        $this->wo_create_taxonomies();
    }






    /*
     *  START: Create Content CPT
     *  ----------------------
     */

    public function wo_create_custom_post_types() {

        // START: Content Custom Post Type
        $labels_content = array(
            'name'                  => _x( 'content', 'post type general name','wolseley' ),
            'singular_name'         => _x( 'content', 'post type singular name','wolseley' ),
            'menu_name'             => _x( 'content', 'admin menu','wolseley' ),
            'name_admin_bar'        => _x( 'content', 'add new on admin bar','wolseley' ),
            'add_new'               => _x( 'Add New', 'content','wolseley' ),
            'add_new_item'          => __( 'Add New content','wolseley' ),
            'new_item'              => __( 'New content','wolseley' ),
            'edit_item'             => __( 'Edit content','wolseley' ),
            'view_item'             => __( 'View content','wolseley' ),
            'all_items'             => __( 'content','wolseley' ),
            'search_items'          => __( 'Search content','wolseley' ),
            'parent_item_colon'     => __( 'Parent content:','wolseley' ),
            'not_found'             => __( 'No content found.','wolseley' ),
            'not_found_in_trash'    => __( 'No content found in Trash.','wolseley' ),
        );

        $args_content = array(
            'labels'                => $labels_content,
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
                'custom-fields',
                'revisions',
                'page-attributes',
                'post-formats',
            ),
            'taxonomies'            => array('content_cats')
        );

        register_post_type('content', $args_content );
        // END: Content Custom Post Type
    }

	public function wo_create_taxonomies() {


		//  START: Content Taxonomy
		$labels_content_tax = array(
			'name'                  =>  'Content categories',
			'singular_name'         =>  'Content category (sing)',
			'search_items'          =>  'Search Content categories',
			'all_items'             =>  'All Content categories',
			'parent_item'           =>  'Parent Content category',
			'parent_item_colon'     =>  'Parent cat colon?',
			'edit_item'             =>  'Edit Content category',
			'update_item'           =>  'Update Content category',
			'add_new_item'          =>  'Add new Content category',
			'new_item_name'         =>  'New sub category name',
			'menu_name'             =>  'Content categories'
		);

		$args_content_tax = array(
			'hierarchical'          =>  true,
			'labels'                =>  $labels_content_tax,
			'show_ui'               =>  true,
			'show_admin_column'     =>  true,
			'query_var'             =>  true,
			'rewrite'               =>  array(
				'slug'              =>  '/content_cats',
				'hierarchical'      =>  true
			),
			'show_in_rest'          =>  true,
			'rest_base'             =>  'wo_content',
			'rest_controller_class' =>  'WP_REST_Terms_Controller',
		);

		register_taxonomy( 'content_cats', array('espot'), $args_content_tax);
		//  END: Content Taxonomy
	}
}

$content = new WoContent();