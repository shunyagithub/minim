<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width">

<?php if( is_single() ): ?>
<meta property="og:site_name" content="<?php bloginfo( 'name' ); ?>">
<meta property="og:locale" content="ja_JP">
<meta property="og:type" content="article">
<meta property="og:title" content="<?php the_title(); ?>">
<meta property="og:url" content="<?php the_permalink(); ?>">
<meta property="og:description" content="<?php echo esc_attr( wp_strip_all_tags( get_the_excerpt() ) ); ?>">

<?php if( has_post_thumbnail() ): ?>
<?php $myimg = get_post_thumbnail_id(); ?>
<meta property="og:image" content="<?php echo esc_url( wp_get_attachment_url( $myimg ) ); ?>">
<meta property="og:image:width" content="<?php echo esc_attr( wp_get_attachment_metadata( $myimg )['width'] ); ?>">
<meta property="og:image:height" content="<?php echo esc_attr( wp_get_attachment_metadata( $myimg )['height'] ); ?>">
<?php endif; ?>

<meta name="twitter:card" content="summary_large_image">
<!-- ↓facebook app id を入力 -->
<meta property="fb:app_id" content="XXXXXXXXXXXXXX"> 
<?php endif; ?>


<?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>



<header class="myhead">
<div class="header-container">

<!-- スマートフォンの場合 -->

<?php if ( is_mobile() ) : ?>

		<div class="nav-logo">
		<a href="<?php echo esc_url( home_url('/') ); ?>" >
    	<?php bloginfo( 'name' ); ?>
		</a>
		</div>

	<div class="sp-nav-container">
    <div id="nav-drawer">
      <input id="nav-input" type="checkbox" class="nav-unshown">
      <label id="nav-open" for="nav-input"><span></span></label>
      <label class="nav-unshown" id="nav-close" for="nav-input"></label>
      <div id="nav-content">

	  <?php get_search_form(); ?>


	  
	  <?php if( has_nav_menu('primary')): ?>
	<nav class="mynav">
	<?php wp_nav_menu( array(
		'theme_location' => 'primary',
	)); ?>

	</nav>
	<?php endif; ?>
	

	</div>
	</div>
	
	</div>

<?php else: ?>


		
		<div class="nav-logo">
		<a href="<?php echo esc_url( home_url('/') ); ?>" >
    	<?php bloginfo( 'name' ); ?>
		</a>
		</div>
        

		<?php if( has_nav_menu('primary')): ?>
		<nav class="mynav">
		<?php wp_nav_menu( array(
			'theme_location' => 'primary',
		)); ?>
		</nav>
		<?php endif; ?>
	
	


		<?php get_search_form(); ?>


	

  <?php endif; ?>


  </div>



    

    
</header>