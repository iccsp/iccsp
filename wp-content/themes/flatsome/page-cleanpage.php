<?php
/**
 * Template Name: Clean Page
 * This template will only display the content you entered in the page editor
 */
?>
 
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body>
<div class="site-branding" style="margin: 63px; margin-bottom: 40px">
						<?php if ( get_header_image() ) : ?>
							<a class="header-image" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
								<!-- <img src="<?php //header_image(); ?>" width="<?php //echo esc_attr( get_custom_header()->width ); ?>" height="<?php //echo esc_attr( get_custom_header()->height ); ?>" alt=""> -->
								<img src="https://veekli.com/wp-content/uploads/2017/06/veekli_logo.png" width="240px" height="75px" alt="">
							</a>
						<?php endif; // End header image check. ?>
						<div class="site-titles">
							<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><div class="site-description"><?php bloginfo( 'description' ); ?></div></a>
						</div>
					</div><!-- .site-branding -->
<?php
    while ( have_posts() ) : the_post();   
        the_content();
    endwhile;
?>
<?php wp_footer(); ?>
</body>
</html>