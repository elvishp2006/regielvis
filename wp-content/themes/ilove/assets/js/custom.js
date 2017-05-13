jQuery(document).ready(function($) {
	"use strict";

	/*------------------------------ Page Scrolling ----------------------*/
    $('.page-scroll a').bind('click', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top
        }, 1500, 'easeInOutExpo');
        event.preventDefault();
    });

	/*------------------------------ Tooltips ----------------------*/
	if ( $('.tooltips').length ) {
		$('.tooltips').tooltip();
	}

	/*------------------------------ Bootstrap Carousel ----------------------*/
	$('.myCarousel').each(function(){
		$(this).carousel({
			interval: 18000, //changes the speed
			pause: "false"
		})
	});

	//Bootstrap Carousel Progressbar
	$('.progressbar').each(function(){
		$(this).progressbar({
			value: 1
		});
		$(".progressbar > .ui-progressbar-value").animate({
			width: "100%"
		}, 18000);
	});

	$('.myCarousel').each(function(){
		$(this).bind('slid.bs.carousel', function (e) {
			$(".progressbar > .ui-progressbar-value").finish();
			$(".progressbar > .ui-progressbar-value").animate({
				width: "0%"
			}, 0);
			$(".progressbar > .ui-progressbar-value").animate({
				width: "100%"
			}, 18000);
		});
	});

	/*------------------------------ Masonry Blog -----------------*/
	$('.blogs').each(function(){
		var $container = $(this);
		// initialize
		$container.masonry({
			itemSelector: '.blog'
		});
		// initialize Masonry after all images have loaded
		$container.imagesLoaded( function() {
			$container.masonry();
		});
	});

	/*------------------------------ OWL Carousel -----------------*/
	$('.owl-family').each(function(){
		$(this).owlCarousel({
			items : 2,
			lazyLoad : true
		});
	});

	if ( $(".owl-moments").length ) {
		$(".owl-moments").owlCarousel({
			items : 4,
			pagination : false,
			autoPlay : true,
			lazyLoad : true
		});
	}

	if ( $(".owl-common").length ) {
		$(".owl-common").owlCarousel({
			items : 3,
			lazyLoad : true
		});
	}

	if ( $(".owl-blog-post-gallery").length ) {
		$(".owl-blog-post-gallery").owlCarousel({
			singleItem:true,
			autoPlay : true,
			lazyLoad : true
		});
	}

	/*------------------------------ Sticky Navigation -----------------*/
	if ( $(".topbar-nav").length ) {
		$(".topbar-nav").sticky({topSpacing:0});
	}

	/*------------------------------ Magnific POP -----------------*/
	$('.popup-vimeo').each(function(){
		$(this).magnificPopup({
			type: 'iframe'
		});
	});

	$('.popup-image').each(function(){
		$(this).magnificPopup({
			type: 'image',
			removalDelay: 500, //delay removal by X to allow out-animation
			callbacks: {
				beforeOpen: function() {
					// just a hack that adds mfp-anim class to markup
					this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
					this.st.mainClass = this.st.el.attr('data-effect');
				}
			},
			closeOnContentClick: true,
			midClick: true // allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source.
		});
	});

	/*------------------------------ Waypoint Counting -----------------*/
	$('.counts').each(function(){
		$(this).countTo();
	});

	/*------------------------------ WOW Script ----------------------*/
	new WOW().init();

	$('.footer-tweet ul').each(function(){
		$(this).owlCarousel({singleItem : true,});
	});

	/*------------------------------ Count Up ----------------------*/
	if ( $('#time1').length ) {
		setInterval(function() {
			var timespan = countdown(new Date( Ilove.wedding_date1 ), new Date());
			var div = document.getElementById('time1');
			div.innerHTML = "<div><span>Years</span>" + timespan.years + "</div>" + "<div><span>Months</span>" + timespan.months + "</div>" + "<div><span>Days</span>" + timespan.days + "</div>" + "<div><span>Hours</span>" + timespan.hours + "</div>" + "<div><span>Minutes</span>" + timespan.minutes + "</div>" + "<div><span>Seconds</span>" + timespan.seconds + "</div>"
		}, 1000);
	}
	if ( $('#time2').length ) {
		setInterval(function() {
			var timespan = countdown(new Date( Ilove.wedding_date2 ), new Date());
			var div = document.getElementById('time2');
			div.innerHTML = "</div>" + "<div><span>Months</span>" + timespan.months + "</div>" + "<div><span>Days</span>" + timespan.days + "</div>" + "<div><span>Hours</span>" + timespan.hours + "</div>" + "<div><span>Minutes</span>" + timespan.minutes + "</div>" + "<div><span>Seconds</span>" + timespan.seconds + "</div>"
		}, 1000);
	}

	/*------------------------------ Tooltips ----------------------*/
	if ( $('.tooltips').length ) {
		$.widget.bridge('uitooltip', $.ui.tooltip);
	}

	/*------------------------------ Preloader ----------------------*/
	$(window).load(function() {
		$('.spinner').fadeOut();
		$('#preloader').delay(350).fadeOut('slow');
		$('body').delay(350).css({'overflow':'visible'});
	});

	/*------------------------------ Collapse the navbar on scroll ----------------------*/
	$(window).scroll(function() {
		if ($(".navbar").offset().top > 50) {
			$(".navbar-fixed-top").addClass("top-nav-collapse");
		} else {
			$(".navbar-fixed-top").removeClass("top-nav-collapse");
		}
	});

});