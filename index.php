<?php get_header(); ?>

<?php if(have_posts()): while(have_posts()): 
the_post(); ?>

<article <?php post_class( 'mycontainer' ); ?>>


<div class="myposthead">

<?php
$categories = get_the_category();
foreach( $categories as $category ){
	// 親カテゴリーIDを取得
	$parent = $category->parent;
	// 親カテゴリーIDがない場合
	if( !$parent ){
		echo '<div class="post-categories"><a href="' . get_category_link( $category->term_id ) . '">' . $category->name . '</a></div>';
		break;
	}
}
?>
<h1><?php the_title(); ?></h1>



<time datetime="<?php echo
esc_attr( get_the_date (DATE_W3C) ); ?>" >
<?php echo esc_html( get_the_date('F j, Y') ); ?>
</time>

</div>


<?php the_content(); ?>

</article>

<?php endwhile; endif; ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>



