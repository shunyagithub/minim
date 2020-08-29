<?php get_header(); ?>

<main class="mycontainer">

<?php if (have_posts()): ?>
<?php
  if (isset($_GET['s']) && empty($_GET['s'])) {
    echo '検索キーワード未入力'; // 検索キーワードが未入力の場合のテキストを指定
  } else {
    echo '<p class="search-res">'.'“'.$_GET['s'] .'”の検索結果：'.$wp_query->found_posts .'件'.'</p>'; // 検索キーワードと該当件数を表示
  }
?>
<div class="mypostlist">
<?php while(have_posts()): the_post(); ?>


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

<?php endwhile; ?>
<?php else: ?>
<p class="search-res">検索されたキーワードにマッチする記事はありませんでした</p>

<?php endif; ?>
</div>

<?php the_posts_pagination( array(
	'prev_text' => '<span class="dashicons dashicons-arrow-left-alt2"></span>',
	'next_text' => '<span class="dashicons dashicons-arrow-right-alt2"></span>'
) ); ?>


</main>

<?php get_sidebar(); ?>

<?php get_footer(); ?>