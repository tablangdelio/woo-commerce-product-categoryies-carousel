<?php
function custom_carousel_cat() {

   wp_enqueue_script( '3-4-1jquery',  get_stylesheet_directory_uri() . '/assets/js/3.4.1-jquery.min.js', array(), '3.4.1', true );
   wp_enqueue_style( 'owl-style-min', get_stylesheet_directory_uri() . '/assets/css/owl.carousel.min.css' );
   wp_enqueue_style( 'owl-style-def', get_stylesheet_directory_uri() . '/assets/css/owl.theme.default.css' );
   wp_enqueue_style( 'cat-yallgoom-carousel', get_stylesheet_directory_uri() . '/assets/css/cat.carousel.css');
   wp_enqueue_script( 'owl-carousel', get_stylesheet_directory_uri() . '/assets/js/owl.carousel.min.js', array( 'jquery' ), '2.4.1', true );
   wp_enqueue_script( 'myscript', get_stylesheet_directory_uri() . '/assets/js/script.js', array(  ), '1.0.0', true );

   $product_include = array(103, 26, 577, 47, 121);
   $woo_cat_args = array(
      'taxonomy'     => 'product_cat',
      'orderby'      => 'name',
      'hide_empty'   => 0,
      'include' => $product_include
   );

   $woo_categories = get_categories( $woo_cat_args );

   echo '<div class="owl-carousel owl-theme" id="customCarouselCategory" >';
    foreach($woo_categories as $prod_cat) :
            $cat_thumb_id = get_woocommerce_term_meta( $prod_cat->term_id, 'thumbnail_id', true );
            $shop_catalog_img = wp_get_attachment_image_src( $cat_thumb_id, 'shop_catalog' );
            $term_link = get_term_link( $prod_cat, 'product_cat' );
            $term_name = $prod_cat->cat_name;
            ?>
        <div class="item category-carousel-image">
            <a class="carousel-link" href="<?php echo $term_link; ?>" target="_blank">
                <?php if(gettype($shop_catalog_img) === "array"): ?>
                    <div class="carousel-image">
                        <img  width="180px" height="180px" src="<?php echo $shop_catalog_img[0]; ?>" alt="<?php echo $term_name;?>" />
                    </div>
                <?php  endif; ?>
                <p class="carousel-text"> <?php echo $term_name; ?></p>
            </a>
        </div>
        <?php endforeach; wp_reset_query(); 
    echo '</div>';
}

add_shortcode("yallagoomCarouselCategory", "custom_carousel_cat");

