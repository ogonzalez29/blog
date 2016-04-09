<?php
/**
 * The default template for displaying content
 * Used for both single and index/archive/search.
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        
        <header class="heading">
		<?php
			if ( is_single() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
			endif;
		?>
        </header>
   
	<?php if ( is_search() ) : /* how post is shown in search results */?>
        <div class="postcontent summary">
			<?php the_excerpt(); ?>
        </div>
    <?php else: /* everywhere else */?> 
        <div class="postcontent">   
        
			<?php the_content(__( '<div class="more">Read More &rarr;</div>', 'simplifiedblog' ));?> 
		<?php			
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'simplifiedblog' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span class="page-numbers">',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'simplifiedblog' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );	
		?>   
    </div> 
	<?php endif; ?>
           
	<?php if(! get_theme_mod('simplifiedblog_show_meta') == 1): /*the general meta switch*/
					get_template_part( 'postline_meta');
	endif; ?>

</article>