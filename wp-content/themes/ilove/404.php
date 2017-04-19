<?php
	/**
	* 404.php
	* The main post loop in Ilove
	* @author PlutonThemes
	* @package Ilove
	* @since 1.0.0
	*/
	get_header();
?>

	<section>
	    <div class="container">
	    	<div class="row">
	        	<div class="col-md-12">
	            	<div class="error-page">
	                	<span class="icon icolove-broken-heart"></span>
	                    <h2><?php echo esc_html__('404', 'ilove'); ?></h2>
	                    <h4><?php echo esc_html__('This Page is not listed as a love page', 'ilove'); ?><br><?php echo esc_html__('please go back to the home page and start over', 'ilove'); ?></h4>
	                    <div class="btn-normal">
	                    	<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo esc_html__('Back Home', 'ilove'); ?></a>
	                	</div>
	            	</div>
	            </div>                
	    	</div>
	    </div>
	</section>

<?php get_footer();