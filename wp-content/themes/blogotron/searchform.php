<?php
/**
 * The template for Search Form.
 *
 * @subpackage Blogotron
 * @since Blogotron 1.4
 */
?>
	<form role="search" method="get" class="searchform" action="<?php echo home_url( '/' ); ?>">
		<div class="searchform-content">
			<input type="text" value="Enter search keyword" name="s" id="s" class="custom-search" />
			<input type="submit" value="<?php _e( 'Search', 'blogotron' )?>" />
		</div><!-- .searchform-content -->
	</form>