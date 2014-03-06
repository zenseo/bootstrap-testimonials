<?php

class BS_Testimonials {

    public $columns, $responsive; 

    public function __construct()
    {
        add_action( 'template_redirect', array($this, 'disable_single' ) );
        add_filter( 'get_avatar', array($this, 'change_avatar_class' ) );
        add_shortcode( 'testimonials', array($this, 'output' ) );        
    }
    
    public function disable_single() 
    {
        $queried_post_type = get_query_var('post_type');
        if ( is_single() && 'testimonial' ==  $queried_post_type ) {
            wp_redirect( home_url(), 301 );
            exit;
        }
    }

    public function change_avatar_class( $class ) 
    {   
        $columns = $this->columns;
        $responsive = $this->responsive;

        if ( $columns == 1 ) {
            $class = str_replace( "class='avatar", "class='img-circle $responsive pull-right" , $class );
        } elseif ( $columns > 1 && $columns <= 4 ) {
            $class = str_replace( "class='avatar", "class='img-circle $responsive center-block" , $class );
        }
        return $class;        
    }

    public function output( $atts ) {

        extract( shortcode_atts( array(
            'columns' => 1,
            'orderby' => 'name',
            'order' => 'ASC',
            'limit' => '-1',
            'include' => '',
            'size' => '150',            
            'responsive' => 'true'            
        ), $atts ) );
        
        $output = "";

        if ( $responsive == 'true' || $responsive == true ) {
            $responsive = 'img-responsive';    
        } else {
            $responsive = '';
        }

        $this->columns = $columns;
        $this->responsive = $responsive;

        if ( $include != '' ) {
        $include = explode( ',', $include );
            $args = array(
                'post_type' => 'testimonial',
                'posts_per_page' => $limit, 
                'post__in' => $include,
                'orderby' => 'post__in',
                'order' => $order
                );
        } else {
             $args = array(
                'post_type' => 'testimonial',
                'posts_per_page' => $limit,
                'orderby' => $orderby,
                'order' => $order       
                );
        }
        $testimonials = get_posts( $args );
        
        if ( !empty( $testimonials ) ) {            
            $count = 0;
            if ( $columns >= 2 && $columns <= 4 )
                $output .= "<div class='row bs-testimonials'>";

            foreach ( $testimonials as $testimonial ) {
                // Count
                $count++;

                // Link
                $link_open = "";
                $link_close = "";
                if ( get_post_meta( $testimonial->ID, 'bs_testimonial_url', true ) ) {
                    $link_open = "<a href='" . get_post_meta( $testimonial->ID, 'bs_testimonial_url', true ) . "' target='_blank'>";
                    $link_close = "</a>";
                }

                // Byline
                if ( get_post_meta( $testimonial->ID, 'bs_testimonial_byline', true ) )
                    $byline = ", " . get_post_meta( $testimonial->ID, 'bs_testimonial_byline', true );
                else
                    $byline = "";
                

                // Content
                $content = wpautop($testimonial->post_content);
                
                // Image
                if ( '' != get_the_post_thumbnail( $testimonial->ID ) ) {
                    if ( $columns == 1 ) 
                        $image = get_the_post_thumbnail( $testimonial->ID, $size, "class=img-circle $responsive pull-right");
                    else
                        $image = get_the_post_thumbnail( $testimonial->ID, $size, "class=img-circle $responsive center-block");
                } elseif ( '' != get_post_meta( $testimonial->ID, 'bs_testimonial_email', true ) ) {
                    $image = get_avatar( get_post_meta( $testimonial->ID, 'bs_testimonial_email', true ), $size );
                } else {
                    $image = "";
                }
                
                if ( $columns == 1 ) { 
                    $output .= "
                        <div class='row bs-testimonials'>                    
                            <figure class='col-sm-3'>
                                $image
                            </figure>
                            <blockquote class='col-sm-9'>
                                $content
                                <small>                                        
                                    " . $link_open . $testimonial->post_title . $link_close . $byline . "
                                </small>
                            </blockquote>
                        </div>";          
                } elseif ( $columns >= 2 && $columns <= 4 ) {         
                    $md_col_width = 12/$columns;
                    $output .= "
                        <div class='col-md-" . $md_col_width . " col-sm-6'>
                            <blockquote class='text-center'>
                                $content
                                <small>                                        
                                    " . $link_open . $testimonial->post_title . $link_close . $byline . "
                                </small>
                            </blockquote>
                            <figure>
                                $image
                            </figure>
                        </div>";
                    if ( $count == $columns ) $output .= "<div class='clearfix'></div>";                  
                } else {
                    $output .= "
                        <p class='bg-warning' style='padding: 20px;'>
                            Invalid number of columns set. Bootstrap Testimonials supports 1 to 4 columns.
                        </p>";
                };              
            }

        if ( $columns >= 2 && $columns <= 4 )
            $output .= "</div>";

        return $output;
        }
    }
}
 
$BS_Testimonials = new BS_Testimonials();