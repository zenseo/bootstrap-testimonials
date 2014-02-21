<?php

class BS_Testimonials_Admin {

	public function __construct()
	{
	    add_action( 'init', array( $this, 'post_type_setup' ) );
	    add_action( 'init', array( $this, 'metabox_init' ) );
	    add_filter( 'cmb_meta_boxes', array( $this, 'field_setup' ) );    
	}

	public function post_type_setup() 
	{
		$labels = array(
		    'name'               => 'Testimonials',
		    'singular_name'      => 'Testimonial',
		    'add_new'            => 'Add New',
		    'add_new_item'       => 'Add New Testimonial',
		    'edit_item'          => 'Edit Testimonial',
		    'new_item'           => 'New Testimonial',
		    'all_items'          => 'All Testimonials',
		    'view_item'          => 'View Testimonial',
		    'search_items'       => 'Search Testimonials',
		    'not_found'          => 'No testimonials found',
		    'not_found_in_trash' => 'No testimonials found in Trash',
		    'parent_item_colon'  => '',
		    'menu_name'          => 'Testimonials'
		);

		$args = array(
		    'labels'             => $labels,
		    'public'             => true,
		    'publicly_queryable' => true,
		    'show_ui'            => true,
		    'show_in_menu'       => true,
		    'query_var'          => true,
		    'rewrite'            => array( 'slug' => 'testimonial' ),
		    'capability_type'    => 'post',
		    'has_archive'        => false,
		    'hierarchical'       => false,
		    'menu_position'      => null,
		    'supports'           => array( 'title', 'editor', 'thumbnail' )
		);

		register_post_type( 'testimonial', $args );
	}

	public function metabox_init()
	{
		if ( ! class_exists('cmb_Meta_Box')) {
		    include plugin_dir_path( __FILE__ ) . '/metabox/init.php';
		}
	}

	public function field_setup( $meta_boxes ) 
	{
	    $prefix = 'bs_'; // Prefix for all fields
	    $meta_boxes[ 'testimonial_metabox' ] = array(
	        'id' => 'testimonial_metabox',
	        'title' => 'Testimonial Info',
	        'pages' => array( 'testimonial' ), // post type
	        'context' => 'normal',
	        'priority' => 'high',
	        'show_names' => true, // Show field names on the left
	        'fields' => array(
	            array(
	                'name' => 'Gravatar Email Address',
	                'desc' => 'Enter the email address of this client to use a gravatar image',
	                'id' => $prefix . 'testimonial_email',
	                'type' => 'text_email'
	            ),
	            array(
	                'name' => 'Byline',
	                'desc' => 'eg. CEO of ABC Enterprises',
	                'id' => $prefix . 'testimonial_byline',
	                'type' => 'text'
	            ),
	            array(
	                'name' => 'URL',
	                'desc' => "Link to this client's website",
	                'id' => $prefix . 'testimonial_url',
	                'type' => 'text_url'
	            ),
	        ),
	    );

	    return $meta_boxes;
	}
}

$BS_Testimonials_Admin = new BS_Testimonials_Admin();