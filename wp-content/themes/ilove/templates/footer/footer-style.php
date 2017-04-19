<?php global $ilove; ?>
<?php if ( $ilove['footer_twitter']==1 ): ?>
	<?php get_template_part( 'templates/footer/footer', 'twitter' ); ?>
<?php endif; ?>

<div class="container-fluid dark footer2">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<!--<img src="images/logo-grey.png" alt="logo"> -->
				<p><?php echo $ilove['footer_copyright']; ?></p>

				<?php if ( $ilove['footer_social'] == 1 ): ?>
					<?php get_template_part( 'templates/footer/footer', 'socials' ); ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
