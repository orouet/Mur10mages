// initialise plugins
jQuery(window).load(function() {
	jQuery(function(){
		jQuery('.masonry-container').masonry({
			itemSelector: '.work-masonry-thumb',
			columnWidth: 200
		});
	});
});