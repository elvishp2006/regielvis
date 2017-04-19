<?php
	/**
	* comments.php
	* The main post loop in Ilove
	* @author PlutonThemes
	* @package Ilove
	* @since 1.0.0
	*/
	$fields =  array(
		'author' => '<div class="col-md-4"><input type="text" placeholder="Your Name" class="form-control" name="author"></div>',
		'email'  => '<div class="col-md-4"><input type="text" placeholder="Email" class="form-control" name="email"></div>',
		'url'  => '<div class="col-md-4"><input type="text" placeholder="website" class="form-control" name="url"></div>',
	);

	$custom_comment_form = array(
		'fields' => apply_filters( 'comment_form_default_fields', $fields ),
		'comment_field' => '<div class="col-md-12"><textarea rows="10" placeholder="Message..." class="form-control" name="comment"></textarea></div>',
		'logged_in_as' => '<p class="logged-in-as col-md-12 col-sm-12">' . sprintf( wp_kses_post(__( 'Logged in as <a href="%1$s">%2$s</a> <a href="%3$s">Log out?</a>','ilove' )), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink() ) ) ) . '</p>',
		'cancel_reply_link' => esc_html__( 'Cancel' , 'ilove' ),
		'comment_notes_before' => '<h2 class="tilte-comment">LEAVE YOUR COMMENT HERE</h2>',
		'comment_notes_after' => '',
		'title_reply' => '',
		'label_submit' => esc_html__( 'Post Comment' , 'ilove' ),
	);
?>

	<div class="comment" id="comments">
		<h2>Comments <span><?php comments_number( esc_html__('(0)','ilove'), esc_html__('(1)','ilove'), esc_html__('(%)','ilove') ); ?></span></h2>
		<?php
			if( have_comments() ){
			  	wp_list_comments('type=comment&callback=ilove_comment');
			}
			paginate_comments_links();
		?>
	</div>

	<div class="cmt-form">

		<div class="row">
			  <!-- Add comment Form field -->
			  <?php comment_form($custom_comment_form); ?>
		</div>
	</div>

	<?php wp_enqueue_script('jquery.validate'); ?>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			$("#comments").validate({
				rules: {
					name: "required",// simple rule, converted to {required:true}
					email: {// compound rule
						required: true,
						email: true
					},
					url: {
						url: true
					},
					comment: {
						required: true
					}
				},
				messages: {
					comment: "Please enter a comment."
				}
			});
		});
	</script>