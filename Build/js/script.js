$(window).on('mousemove', function(e) {
	var wh = $(window).width();
	var ht = $(window).height();
	var offsetX = 0.5 - e.pageX / wh;
	var offsetY = 0.5 - e.pageY / ht;

	$(".parallax").each(function(i, el) {
		var offset = parseInt($(el).data('offset'));
		var translate = "translate3d(" + Math.round(offsetX * offset) + "px," + Math.round(offsetY * offset) + "px, 0px)";

		$(el).css({
			'-webkit-transform': translate,
			'transform': translate,
			'moz-transform': translate
		});
	});
});