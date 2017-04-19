<?php global $ilove; ?>
<?php if ( $ilove['footer_social_list'] ): ?>
	<div class="social-icons">
		<ul>
			<?php foreach ( $ilove['footer_social_list'] as $value ): ?>
				<li class="social-<?php echo esc_attr($value['title']); ?>">
					<a href="<?php echo esc_url($value['url']); ?>" target="_blank">
						<i class="fa <?php echo esc_attr($value['title']); ?> fa-lg"></i>
					</a>
				</li>
			<?php endforeach ?>
		</ul>
	</div>
<?php endif; ?>
