<?
	session_start();
	require_once "function.php";
	require_once "counters.php";
	if(!$_SESSION['num_podsk']) {
		$_SESSION['num_podsk'] = 1;
	} 
?>
<script>
$(function() {
	var sp = <?=$_SESSION['num_podsk']?>;
	show_podskaz(sp);
});
function not() {
	$.post({url:'/lib/podskazka_obr.php',data:{'nepokaz':1},success:function(data){}});		
}
function show_podskaz(sp) {
	setTimeout(function() {
		$.post({url:'/lib/podskazka_obr.php',data:{id_pod:sp},success:function(data){$('body').append(data);$('#p_'+sp).fadeTo(200,.9)}})
		$('.podskazka').hover(function(){
			$(this).fadeTo(200,1);
		});
	}, 5000);
}
function next(sp) {
	del_bl('#p_'+sp);
	$.post({url:'/lib/podskazka_obr.php',data:{'next':sp},success: function(data){}});
	if(sp<5) {show_podskaz(sp + 1)}
}
</script>