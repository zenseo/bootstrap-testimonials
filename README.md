Bootstrap Testimonials
======================
* Contributors: lsdev, iaincoughtrie
* Donate link: http://lsdev.biz
* Tags: testimonials, widget, shortcode, template-tag, feedback, customers
* Tested up to: 3.8.1
* License: GPLv2 or later
* License URI: http://www.gnu.org/licenses/gpl-2.0.html

Creates a testimonials post type, and allows you to display testimonials on your site using a shortcode, template tag or widget. Use either Gravatar or featured image for each testimonial. Designed to be used with the Bootstrap framework.

## Post Type and Fields:

On activation, the Bootstrap Testimonials plugin creates a Testimonials post type on your site. 

### Testimonials Post Type fields

- Post Title: Client's name
- Post Body: Client's testimonial
- Featured Image: Client's photograph or image
- Gravatar Email Address: Client's email address. If a featured image has not been set, this field will be used to display the client's Gravatar if one is available.
- Byline: Client's byline, generally used to display their position in the company.
- URL: Link to client's website.

## Shortcode:

Insert the shortcode `[testimonials]` into any page to display all testimonials.

### Optional shortcode parameters:

- columns
 - set the number of columns to display
 - options: 1, 2, 3, 4
 - default: 1
 - eg: `[testimonials columns=4]`

- orderby
 - choose how the testimonails should be ordered
 - options: none, ID, name, date, rand (or any of the orderby options accepted by WP_Query - http://codex.wordpress.org/Class_Reference/WP_Query)
 - default: name
 - eg: `[testimonials orderby=rand]`

- order
 - whether to display testimonials in ascending or descending order (based on the orderby parameter)
 - options: ASC, DESC
 - default: ASC
 - eg: `[testimonials order='DESC']`

- limit
 - set the maximum number of testimonials to be returned
 - eg: `[testimonials limit=4]`

- include
 - specify which testimonials to include by entering a comma seperated list of IDs. (This overrides the order and limit parameters; testimonials will display in the order in which the IDs are entered)
 - eg: `[testimonials include='7, 38, 19']`

- size
 - set the featured image or Gravatar size to display on each testimonial. Accepts numbers only, exclude the 'px'.
 - default: 150
 - eg: `[testimonials size=200]`

- responsive
 - choose whether the images should resize according to the size of the viewport (enabled by default)
 - default: true
 - eg: `[testimonials responsive=false]`

## Function Call:

The testimonials function can be called directly in your theme templates. It accepts an array of the same parameters used in the shortcode.

eg:
```
<?php
	if ( class_exists( 'BS_Testimonials' ) ) {
        $BS_Testimonials = new BS_Testimonials();
        echo $BS_Testimonials->output( array(                                        
                        'size' => 150,
                        'responsive' => false,
                        'columns' => 3,
                        'limit' => 6
                        )
        );
    };
?>
```