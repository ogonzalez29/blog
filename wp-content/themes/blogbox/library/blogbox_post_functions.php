<?php
/**
 * Posts functions file
 * 
 * This file contains functions for posts including meta 
 * 
 * @package		blogBox WordPress Theme
 * @copyright	Copyright (c) 2013, Kevin Archibald
 * @license		http://www.gnu.org/licenses/quick-guide-gplv3.html  GNU Public License
 * @author		Kevin Archibald <www.kevinsspace.ca/contact/>
 */
?>
<?php

/**
 * This function checks the post format type and calls the appropriate function
 * @link http://codex.wordpress.org/Post_Formats
 */
if( !function_exists( 'blogbox_post_format' ) ) {
	 function blogbox_post_format(){
		if ( has_post_format( 'aside' ) ) {
			get_template_part('postformat','aside');
		} elseif ( has_post_format( 'audio' )) {
			get_template_part('postformat','audio');
		} elseif ( has_post_format( 'chat' )) {
			get_template_part('postformat','chat');
		} elseif ( has_post_format( 'gallery' )) {
			get_template_part('postformat','gallery');
		} elseif ( has_post_format( 'image' )) {
			get_template_part('postformat','image');
		} elseif ( has_post_format( 'link' )) {
			get_template_part('postformat','link');
		} elseif ( has_post_format( 'quote' )) {
			get_template_part('postformat','quote');
		} elseif ( has_post_format( 'status' )) {
			get_template_part('postformat','status');
		} elseif ( has_post_format( 'video' )) {
			get_template_part('postformat','video');
		} else {
			get_template_part('postformat','standard');
		}
	}
}

/* ======================================================================================
 * Chat Functions
 * ====================================================================================== */

/* Filter the content of chat posts. */
add_filter( 'the_content', 'blogbox_chat_content' );

/* Auto-add paragraphs to the chat text. */
add_filter( 'blogbox_format_chat_text', 'wpautop' );

/**
 * This function filters the post content when viewing a post with the "chat" post format.  It formats the 
 * content with structured HTML markup to make it easy for theme developers to style chat posts.  The 
 * advantage of this solution is that it allows for more than two speakers (like most solutions).  You can 
 * have 100s of speakers in your chat post, each with their own, unique classes for styling.
 *
 * @author David Chandra
 * @link http://www.turtlepod.org
 * @author Justin Tadlock
 * @link http://justintadlock.com
 * @copyright Copyright (c) 2012
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @link http://justintadlock.com/archives/2012/08/21/post-formats-chat
 *
 * @global array $_post_format_chat_ids An array of IDs for the chat rows based on the author.
 * @param string $content The content of the post.
 * @return string $chat_output The formatted content of the post.
 */
if( !function_exists( 'blogbox_chat_content' ) ) {
	function blogbox_chat_content( $content ) {
		global $_post_format_chat_ids;
		
		//password protected fix
		if( post_password_required() ) return $content;
		
		/* If this is not a 'chat' post, return the content. */
		if ( !has_post_format( 'chat' ) )
			return $content;
	
		/* Set the global variable of speaker IDs to a new, empty array for this chat. */
		$_post_format_chat_ids = array();
	
		/* Allow the separator (separator for speaker/text) to be filtered. */
		$separator = apply_filters( 'blogbox_format_chat_separator', ':' );
	
		/* Open the chat transcript div and give it a unique ID based on the post ID. */
		$chat_output = "\n\t\t\t" . '<div id="chat-transcript-' . esc_attr( get_the_ID() ) . '" class="chat-transcript">';
	
		/* Split the content to get individual chat rows. */
		$chat_rows = preg_split( "/(\r?\n)+|(<br\s*\/?>\s*)+/", $content );
	
		/* Loop through each row and format the output. */
		foreach ( $chat_rows as $chat_row ) {
	
			/* If a speaker is found, create a new chat row with speaker and text. */
			if ( strpos( $chat_row, $separator ) ) {
	
				/* Split the chat row into author/text. */
				$chat_row_split = explode( $separator, trim( $chat_row ), 2 );
	
				/* Get the chat author and strip tags. */
				$chat_author = strip_tags( trim( $chat_row_split[0] ) );
	
				/* Get the chat text. */
				$chat_text = trim( $chat_row_split[1] );
	
				/* Get the chat row ID (based on chat author) to give a specific class to each row for styling. */
				$speaker_id = blogbox_chat_row_id( $chat_author );
	
				/* Open the chat row. */
				$chat_output .= "\n\t\t\t\t" . '<div class="chat-row ' . sanitize_html_class( "chat-speaker-{$speaker_id}" ) . '">';
	
				/* Add the chat row author. */
				$chat_output .= "\n\t\t\t\t\t" . '<div class="chat-author ' . sanitize_html_class( strtolower( "chat-author-{$chat_author}" ) ) . ' vcard"><cite class="fn">' . apply_filters( 'my_post_format_chat_author', $chat_author, $speaker_id ) . '</cite>' . $separator . '</div>';
	
				/* Add the chat row text. */
				$chat_output .= "\n\t\t\t\t\t" . '<div class="chat-text">' . str_replace( array( "\r", "\n", "\t" ), '', apply_filters( 'my_post_format_chat_text', $chat_text, $chat_author, $speaker_id ) ) . '</div>';
	
				/* Close the chat row. */
				$chat_output .= "\n\t\t\t\t" . '</div><!-- .chat-row -->';
			}
	
			/**
			 * If no author is found, assume this is a separate paragraph of text that belongs to the
			 * previous speaker and label it as such, but let's still create a new row.
			 */
			else {
	
				/* Make sure we have text. */
				if ( !empty( $chat_row ) ) {
	
					/* Open the chat row. */
					$chat_output .= "\n\t\t\t\t" . '<div class="chat-row ' . sanitize_html_class( "chat-speaker-{$speaker_id}" ) . '">';
	
					/* Don't add a chat row author.  The label for the previous row should suffice. */
	
					/* Add the chat row text. */
					$chat_output .= "\n\t\t\t\t\t" . '<div class="chat-text">' . str_replace( array( "\r", "\n", "\t" ), '', apply_filters( 'my_post_format_chat_text', $chat_row, $chat_author, $speaker_id ) ) . '</div>';
	
					/* Close the chat row. */
					$chat_output .= "\n\t\t\t</div><!-- .chat-row -->";
				}
			}
		}
	
		/* Close the chat transcript div. */
		$chat_output .= "\n\t\t\t</div><!-- .chat-transcript -->\n";
	
		/* Return the chat content and apply filters for developers. */
		return apply_filters( 'blogbox_format_chat_content', $chat_output );
	}
}

/**
 * This function returns an ID based on the provided chat author name.  It keeps these IDs in a global 
 * array and makes sure we have a unique set of IDs.  The purpose of this function is to provide an "ID"
 * that will be used in an HTML class for individual chat rows so they can be styled.  So, speaker "John" 
 * will always have the same class each time he speaks.  And, speaker "Mary" will have a different class 
 * from "John" but will have the same class each time she speaks.
 *
 * @author David Chandra
 * @link http://www.turtlepod.org
 * @author Justin Tadlock
 * @link http://justintadlock.com
 * @copyright Copyright (c) 2012
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @link http://justintadlock.com/archives/2012/08/21/post-formats-chat
 *
 * @global array $_post_format_chat_ids An array of IDs for the chat rows based on the author.
 * @param string $chat_author Author of the current chat row.
 * @return int The ID for the chat row based on the author.
 */
if( !function_exists( 'blogbox_chat_row_id' ) ) {
	function blogbox_chat_row_id( $chat_author ) {
		global $_post_format_chat_ids;
	
		/* Let's sanitize the chat author to avoid craziness and differences like "John" and "john". */
		$chat_author = strtolower( strip_tags( $chat_author ) );
	
		/* Add the chat author to the array. */
		$_post_format_chat_ids[] = $chat_author;
	
		/* Make sure the array only holds unique values. */
		$_post_format_chat_ids = array_unique( $_post_format_chat_ids );
	
		/* Return the array key for the chat author and add "1" to avoid an ID of "0". */
		return absint( array_search( $chat_author, $_post_format_chat_ids ) ) + 1;
	}
}

/**
 * This function was taken from http://codex.wordpress.org/Using_Gravatars
 * It checks the gravatar site for a valid gravatar for the email supplied and 
 * returns a boolean true or false
 */
if (!function_exists ('blogbox_validate_gravatar')){
	function blogbox_validate_gravatar($email) {
		// Craft a potential url and test its headers
		$hash = md5(strtolower(trim($email)));
		$uri = 'http://www.gravatar.com/avatar/' . $hash . '?d=404';
		$headers = @get_headers($uri);
		if (!preg_match("|200|", $headers[0])) {
			$has_valid_avatar = FALSE;
		} else {
			$has_valid_avatar = TRUE;
		}
		return $has_valid_avatar;
	}
}

/**
 * This function is called by the post format functions and supplies the meta 
 * for the top section of the post.
 */
if (!function_exists ('blogbox_post_metatop')){
	function blogbox_post_metatop() {
		
		global $blogbox_options;
		$exclude_timestamp = $blogbox_options['bB_exclude_timestamp'];
		$exclude_author = $blogbox_options['bB_exclude_author'];

		//return if no meta
		if( true == $exclude_timestamp && true == $exclude_author ) {
			return;
		} 
		
		echo '<div class="postmeta">';
		
		if( true != $exclude_timestamp  ) { ?>
			<span class="timestamp"><i class="fa fa-clock-o" title="Timestamp"></i>&nbsp;<?php the_time(get_option('date_format')); ?></span>
		<?php }
		
		if( true != $exclude_author ) { ?>
			 <span class="author"><i class="fa fa-user" title="Author"></i>&nbsp;<?php the_author_posts_link(); ?></span>
		<?php }
		
		echo '</div>';

	}
}

/**
 * This function is called by all the post formats to add the meta bottom strip
 */
if (!function_exists ('blogbox_post_metabottom')){
	function blogbox_post_metabottom($bB_post_format) {
		global $blogbox_options;
		$exclude_category = $blogbox_options['bB_exclude_category'];
		$exclude_tags = $blogbox_options['bB_exclude_tags'];
		
		echo '<div class="postmetabottom">';
		
		if( $bB_post_format == 'status' || $bB_post_format == 'aside' ) {
			edit_post_link(esc_html__('Edit','blogbox'),'<span class="edit"><i class="fa fa-edit" title="Edit"></i>&nbsp;','</span>');
		} else { ?>
			
			<span class="pagelist"><?php $page_text = '<i class="fa fa-copy" title="Pages"></i>&nbsp;'; wp_link_pages('before='.$page_text.':&after='); ?></span>
			
			<?php if( true != $exclude_category ) { 
				if( has_category() == true ) { ?><span class="categories"><i class="fa fa-bookmark" title="Categories"></i>&nbsp;<?php the_category(', '); ?></span><?php }
			}
			
			if( true != $exclude_tags ) {
				if( has_tag() == true ) { ?><span class="taglist"><i class="fa fa-tags" title="Tags"></i>&nbsp;<?php the_tags('') ?></span><?php }
			}
			
			if( get_the_title() == "" ) echo '<span class="no-title"><a href="'.get_permalink().'" rel="bookmark" title="Untitled Link" ><i class="fa fa-warning-sign"></i>'.esc_html__("Single Page Link","blogbox").'</a></span>';
			
			edit_post_link(esc_html__('Edit','blogbox'),'<span class="edit"><i class="fa fa-edit" title="Edit"></i>&nbsp;','</span>');
		}
		echo '</div>';
		
	}
}