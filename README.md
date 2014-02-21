=== Bootstrap Testimonials ===
Contributors: lsdev, iaincoughtrie
Donate link: http://lsdev.biz
Tags: testimonials, widget, shortcode, template-tag, feedback, customers
Tested up to: 3.8.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Creates a testimonials post type, and allows you to display testimonials on your side using a shortcode, template tag or widget. Use either Gravatar or featured images. Designed to be used within the Bootstrap framework.

== Usage ==

Shortcode:
----------
Insert the shortcode [testimonials] into any post or page to display all testimonials.

Optional shortcode parameters:
------------------------------
- include: include specific testimonials by ID. 
	eg [testimonials include="3, 5, 12"]

- size: set the size in pixels of the gravatar or featured image that displays on each testimonial. 
	eg [testimonials size=200]

- responsive: choose whether the image size should adjust according to the viewport size.
	eg [testimonials responsive=true]

- limit: set a limit on the number of testimonials that are returned (not necessary if already using the 'include' parameter).
	eg [testimonials limit=5]

- columns: choose 1 to 4 column layout.
	eg [testimonials columns=2]


Template tag:
-------------
Echo the template tag bst_testimonials('') within any page template to display all testimonials as follows:
<?php if ( function_exists( 'bs_testimonials' ) ) echo bst_testimonials(''); ?>

Optional template tag parameters:
---------------------------------
The template tag accepts an array of the same parameters used in the shortcode.
	eg  <?php if ( class_exists( 'BS_Testimonials' ) ) {
            $BS_Testimonials = new BS_Testimonials();
            echo $BS_Testimonials->output(array(                                        
                                'size' => 150,
                                'responsive' => false,
                                'columns' => 3,
                                'limit' => 6
                                )
                            );                 
        } ?>