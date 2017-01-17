function show_sub(id) {
	$('#f_'+id+'_izm').change(function(){
		$('#f_'+id+'_butt').fadeTo(500, 1);
	});
}
$(function() {
	$('#country').change(function(){
		console.log($('#country').val);
		console.log($('#country'));
		if($('#country').val == 174) {
			$('#city').show();
		}
		else $('#city').hide();
	});
	$("#flinp").change(function(){
		$("#dop_reg").submit();
	});
});
