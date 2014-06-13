<?php
/*---------------------------------
	Comments template
------------------------------------*/
?>

<?php if ( post_password_required() ) : ?>
				<p><?php _e( 'This post is password protected. Enter the password to view any comments.', 'wowway' ); ?></p>
<?php
		return;
	endif;
?>

	<div class="commentsList">
	
		<?php if ( have_comments() ) : ?>
		
			<h5 id="comments-title"><?php echo __('Comments ', 'wowway') , '(', get_comments_number(), ')'; ?></h5>

			<ul class="clearfix"><?php wp_list_comments( array( 'callback' => 'wowway_comment' ) ); ?></ul>

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
							<?php previous_comments_link( __( '&larr; Older Comments', 'wowway' ) ); ?>
							<?php next_comments_link( __( 'Newer Comments &rarr;', 'wowway' ) ); ?>
			<?php endif; // check for comment navigation ?>

		<?php else : 
			if ( ! comments_open() ) {
				?>Comments are closed.<?php
			} else {
				?><h5 id="comments-title">0 Comments</h5>
				Be the first to leave a reply! <?php
			}
		?>

		<?php endif; // end have_comments() ?>
		
	</div>

	<div class="commentsForm">

		<?php 
		
		 $defaults = array( 'fields' => apply_filters( 'comment_form_default_fields', array(
			'author' => '<input id="author" name="author" type="text" value="Name*" data-value="Name*." />',
			'email'  => '<input id="email" name="email" type="text" value="Email*" data-value="Email*" />',
			'url'    => '<input id="url" name="url" type="text" value="Website" data-value="Website" />' ) ),
			'comment_field' => '<textarea id="comment" name="comment" cols="83" rows="4" data-value="Message*">Message*</textarea>',
			'must_log_in' => '<p class="must-log-in">' .  sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
			'logged_in_as' => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
			'comment_notes_before' => '',
			'comment_notes_after' => '',
			'id_form' => 'commentform',
			'id_submit' => 'submit',
			'title_reply' => __( 'Leave a Comment', 'wowway' ),
			'title_reply_to' => __( 'Leave a Reply to %s', 'wowway' ),
			'cancel_reply_link' => __( 'Cancel reply', 'wowway' ),
			'label_submit' => __( 'Submit', 'wowway' ),
		); 
		
		comment_form($defaults); 
		
		?>
		
		<span class="asterix"><?php _e('* required', 'wowway'); ?></span>

	</div>