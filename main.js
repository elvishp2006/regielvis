(function($) {
	var site = {
		init: function() {
			smoothScroll.init({
				offset: 80,
			});

			$( '.gallery' ).lightGallery();

			this.setCountdown();
		},
		setCountdown: function() {
			$( '#countdown' ).countdown( '2017/06/17 20:00', function(event) {
				$( this ).text( event.strftime( '%D dias %H:%M:%S' ) );
			}) ;
		}
	};

	site.init();
})(jQuery);
