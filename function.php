<?php
add_action( 'wp_footer', 'script_enqueue_styles' );
function script_enqueue_styles() {   

    wp_register_style( 'owl.carousel.min', get_stylesheet_directory_uri() . '/assets/css/owl.carousel.min.css');
    wp_enqueue_style( 'owl.carousel.min' );
    wp_register_style( 'owl.theme.default.min', get_stylesheet_directory_uri() . '/assets/css/owl.theme.default.min.css');
    wp_enqueue_style( 'owl.theme.default.min' );

    wp_register_script( 'custom.js', get_stylesheet_directory_uri() . '/assets/js/custom.js', array('jquery'), rand(), 'all' );
    wp_enqueue_script( 'custom.js' );
    wp_register_script( 'owl.carousel.js', get_stylesheet_directory_uri() . '/assets/js/owl.carousel.js', array('jquery'), rand(), 'all' );
    wp_enqueue_script( 'owl.carousel.js' );
    wp_register_style( 'new-custom-css',get_stylesheet_directory_uri() . '/custom_css.css',array(), rand(111,9999), 'all' );
    wp_enqueue_style( 'new-custom-css');

    wp_register_style( 'new-animation-css','https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css',array(), rand(111,9999), 'all' );
    wp_enqueue_style( 'new-animation-css');

}


function video_full_width_slider() {
  $args = array( 'post_type' => 'videos', 'posts_per_page' => -1, 'order' => 'ASC');                     
  $the_query = new WP_Query( $args );
  $html = '';
  $k=0;
  if ( $the_query->have_posts() ) :
    $html.='<div id="upperBox"><div class="owl-carousel owl-theme" id="videos-full-slider">';
    while ( $the_query->have_posts() ) : $the_query->the_post();

        $styling=get_field('link_group',get_the_ID());
        $before_group=get_field('before_title_group',get_the_ID());
        $highlight_group=get_field('highlight_title_group',get_the_ID());
            $banner_video = get_field('banner_video');
            $video_link = $styling['link_url'];
            $link_text = $styling['link_text'];
            $link_font = $styling['link_font'];
            $link_color = $styling['link_color'];
            $link_font_family = $styling['link_font_family'];
            $before_title = $before_group['before_title'];
            $title_font = $before_group['title_font_size'];
            $title_color = $before_group['title_color'];
            $title_font_family = $before_group['title_font_family'];
            $highlight_title = $highlight_group['highlight_title'];
            $highlight_color = $highlight_group['title_color'];
            $highlight_font = $highlight_group['highlight_font_family'];
            $after_title = get_field('after_title');

            if($banner_video){
        $html.='<div class="item"><div class="content-wrapper overlay" styel=""><div class="video"><video autoplay="" playsinline="" muted=""  id="mejs_24643874793623088_html5" preload="none" src="'.$banner_video.'" style="margin: 0px;><source type="video/mp4" src="'.$banner_video.'"></video></div><div class="main-content fadeInUp"><div class="content-box"><div class="title">
      <h1 style="font-size:'.$title_font.'px;color:'.$title_color.';font-family:'.$title_font_family.';">'.$before_title.' <span style="color:'.$highlight_color.';font-family:'.$highlight_font.';">'.$highlight_title.'</span> '.$after_title.'</h1></div><div class="more"><a href="'.$video_link.'" class="view-more" style="font-size:'.$link_font.'px;color:'.$link_color.';font-family:'.$link_font_family.';">'.$link_text.'</a></div></div></div></div></div>';
            $k++;
        }
    endwhile;
    wp_reset_postdata();
    $html.='</div></div>';
  endif;
  return $html;
  wp_reset_postdata();
}

add_shortcode('video_full_width_slider', 'video_full_width_slider');