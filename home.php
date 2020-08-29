<?php get_header(); ?>

<main class="mycontainer">


<!-- <div class="myposthead">
    <h4>RECENT POSTS</h4>
</div> -->
<div class="mypostlist">
<?php if(have_posts()): while(have_posts()): 
the_post(); ?>


<article <?php post_class(); ?>>

<div class="post-img">
<?php if( has_post_thumbnail() ): ?>
<figure>
    <?php the_post_thumbnail(); ?>
</figure>
<?php endif; ?>
</div>



<div class="post-content">
<h1><?php the_title(); ?></h1>
<p><?php echo wp_trim_words( get_the_content(), 30, '...' ); ?></p>
<div class="readmore">
<a href="<?php the_permalink(); ?>">Read More</a>
</div>

</div>

</article>

<?php endwhile; endif; ?>
</div>

<?php the_posts_pagination( array(
	'prev_text' => '<span class="dashicons dashicons-arrow-left-alt2"></span>',
	'next_text' => '<span class="dashicons dashicons-arrow-right-alt2"></span>'
) ); ?>

</main>

<?php get_sidebar(); ?>

<?php get_footer(); ?>



