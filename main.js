(function($) {
	var site = {
		init: function() {
			smoothScroll.init({
				offset: 80,
			});

			$( '.gallery' ).lightGallery();

			this.setCountdown();
			this.handleRSVP();
		},
		setCountdown: function() {
			$( '#countdown' ).countdown( '2017/06/17 20:00', function(event) {
				$( this ).text( event.strftime( '%D dias %H:%M:%S' ) );
			}) ;
		},
		handleRSVP: function() {
			$('#rsvp').submit(function(event) {
				event.preventDefault();

				var formData = {
					'name': $( '#name' ).val(),
					'quantity': $( '#quantity' ).val()
				};

				firebase.database().ref('/RSVP').push( formData );

				$( '#name' ).val('');
				$( '#quantity' ).val('');
			})
		}
	};

	site.init();
})(jQuery);
