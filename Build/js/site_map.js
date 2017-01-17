function open_search(id) {
	var clsers = $('#clser_'+id+'_s');
		ar = $('#a_'+id+'_r');
		console.log(id);
		console.log(clsers);
		console.log(ar);
	if (clsers.is(":visible")) $('#clser_'+id+'_s').slideUp(500, function(){
		ar.removeClass("arrdown").addClass("arrup");
	});
	else clsers.slideDown(500, function(){
		ar.removeClass("arrup").addClass("arrdown");
	});
}