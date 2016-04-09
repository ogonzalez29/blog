<?php get_header(); 
if(get_theme_mod('postlayout') == 'left'):
  $simplifiedblog_sidebar_style = 'style="padding-left: 2%;"';
  $simplifiedblog_content_style = 'style="float: right;"';
elseif(get_theme_mod('postlayout') == 'full_width'):
  $simplifiedblog_sidebar_style = 'style="display: none;"';
  $simplifiedblog_content_style = 'style="width: 100%;"';
else:
  $simplifiedblog_sidebar_style = 'style="float:right;"';
  $simplifiedblog_content_style = 'style="float:left;"';
endif; ?>

<div id="column">
<div id="bloglist" <?php echo $simplifiedblog_content_style; ?>>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        
        <header class="heading">
				<h1 class="page-title"><?php _e( 'Not Found', 'simplifiedblog' ); ?></h1>
		</header>
        
		<div class="postcontent">
				<p><?php _e( 'It looks like nothing was found over here. Maybe try searching?', 'simplifiedblog' ); ?></p>
				<?php get_search_form(); ?>
        </div>

</article>


</div><!--bloglist end-->

<div id="sidewrap" <?php echo $simplifiedblog_sidebar_style; ?>>
<?php get_sidebar(); ?>
</div>

</div><!-- column end -->

<?php get_footer(); ?>