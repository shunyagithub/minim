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


<div class="share">
<h6>SHARE</h6>

<ul class="socialBtn">
	

	<li><a class="twitter icon-twitter" href="//twitter.com/intent/tweet?text=<?php echo urlencode(the_title("","",0)); ?>&<?php echo urlencode(get_permalink()); ?>&url=<?php echo urlencode(get_permalink()); ?>" target="_blank" title="Twitterでシェアする"><span>Twitter</span></a></li>
	<li><a class="facebook icon-facebook" href="//www.facebook.com/sharer.php?u=<?php echo urlencode(get_permalink()); ?>&t=<?php echo urlencode(the_title("","",0)); ?>" target="_blank" title="facebookでシェアする"><span>Facebook</span></a></li>
	<li><a class="pocket icon-pocket" href="//getpocket.com/edit?url=<?php echo urlencode(get_permalink()); ?>" target="_blank" title="Pocketであとで読む"><span>Pocket</span></a></li>
	<li><a class="feedly icon-feedly" href="//cloud.feedly.com/#subscription%2Ffeed%2F<?php echo urlencode(bloginfo('rss2_url')); ?>" target="_blank" title="Feedlyで購読する"><span>Feedly</span></a></li>
	<!-- <li><a class="google icon-google-plus" href="https://plus.google.com/share?url=<?php echo urlencode(get_permalink()); ?>" target="_blank" title="Google+でシェアする"><span>Google+</span></a></li> -->
	<li><a class="hatena icon-hatena" href="//b.hatena.ne.jp/add?mode=confirm&url=<?php echo urlencode(get_permalink()); ?>&title=<?php echo urlencode(the_title("","",0)); ?>" target="_blank" data-hatena-bookmark-title="<?php the_permalink(); ?>" title="このエントリーをはてなブックマークに追加する"><span>はてブ</span></a></li>
	<li><a class="line icon-line" href="//timeline.line.me/social-plugin/share?url=<?php echo urlencode(get_permalink()); ?>" target="_blank" title="LINEでシェアする"><span>LINE</span></a></li>
	<li><a class="rss icon-rss" href="<?php echo urlencode(bloginfo('rss2_url')); ?>" target="_blank" title="RSSで購読する"><span>RSS</span></a></li>
</ul>
</div>


<section class="myprofile">
    <!-- <h2>ABOUT</h2> -->

        <div class="profile-img">
        <figure>
        <img src="<?php echo esc_url( get_theme_file_uri('profile.jpg' )); ?>" alt="">
        </figure>

        </div>
        
        <div class="profile-desc">
        <strong><?php the_author_meta('display_name'); ?>
        </strong>
		<p><?php the_author_meta('description'); ?></p>
		
		<div class="profile-sns-links">
			<ul>
				<li><a href="#" class="icon-twitter"></a></li>
				<li><a href="#" class="icon-facebook"></a></li>
				<li><a href="#" class="icon-instagram"></a></li>
				<li><a href="#" class="icon-line"></a></li>
			</ul>
		</div>
		</div>
		
		
        
</section>

<aside class="myrelated">
<h2>RELATED</h2>

<div class="myrelated-container">
<?php 
$myposts = get_posts( array(
	'posts_per_page' => '4',
	'post__not_in' => array( get_the_ID() ),
	'category__in' => wp_get_post_categories( get_the_ID() ),
	'orderby' => 'rand'
) );
?>
<?php if( $myposts ):
foreach($myposts as $post):
setup_postdata($post); ?>

<article>
<a href="<?php the_permalink(); ?>">
<?php if( has_post_thumbnail() ): ?>
<figure>
<?php the_post_thumbnail(); ?>
</figure>
<?php endif; ?>
<h4><?php the_title(); ?></h4>
</a>
</article>

<?php endforeach;
wp_reset_postdata();
endif; ?>
</div>
</aside>
</article>

<?php endwhile; endif; ?>



<?php get_sidebar(); ?>

<?php get_footer(); ?>



