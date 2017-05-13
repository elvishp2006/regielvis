<?php
	/**
	* sidebar.php
	* The main post loop in Ilove
	* @author PlutonThemes
	* @package Ilove
	* @since 1.0.0
	*/
?>
<?php if ( is_active_sidebar( 'primary' ) ) : ?>
	<div class="col-md-4 sidebar">
		<?php dynamic_sidebar( 'Primary Sidebar' ); ?>
	</div>
<?php endif;