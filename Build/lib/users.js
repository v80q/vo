function load_u(){fhg = $('.fhg');loadImg = $("#loadImg");$.post({url:'load_users.php',data:{'addusers' : window.add,'sName' : $('#sName').val(),'ochk_min' : $('#ochk_min').val(),'ochk_max' : $('#ochk_max').val(),'sLogin' : $('#sLogin').val(),'pol' : $('.polusers:checked').val(),},beforeSend: function() {$("#loadImg").show();load = true;},success: function(data){$("#loadImg").hide();fhg.append(data);$('.ramka:hidden').each(function(i){$(this).delay((i++) * 50).fadeTo(300, 1)});load=false;add+=60;}})}
function count_u(){vfhg = $('.fhg');rty = $('#rty');load = $("#load");rty.hide().stop();$.post({url: 'load_count_u.php',data:{'sName':$('#sName').val(),'ochk_min':$('#ochk_min').val(),'ochk_max':$('#ochk_max').val(),'sLogin':$('#sLogin').val(),'pol':$('.polusers:checked').val()},beforeSend:function(){$("#load").show(),load=true},success:function(data){$("#load").hide(),rty.fadeTo(500, 1),rty.text(data),load = false}})}
function show_ac(login_p){$.post({url:'page_acc.php',data:{login_p:login_p},success:function(data) {$('body').append(data);$('#page_acc').fadeTo(100,1)}})}
function show_ot(selector,id){$.post({url:'page_otv.php',data:{selector:selector,id:id},success:function(data){$('body').append(data);$('#page_otv').fadeTo(100,1)}})}
$(function() {
	add = 0;
	load = false;
	w_width = $(document).width();
	if($(document).width()>999){
		$('.show_at_start').fadeTo(100,1);
		$('#search_form').find('.for_cound').change(function(){if($(this).val()!=''){$(this).addClass('arrred')}count_u()});	
	}
	load_u();
	count_u();
});	
$(window).scroll(function() {
	if($(this).scrollTop()>300&$(document).width()>999){if($('.uverh').is(":hidden")){$('.uverh').removeClass('dspn')}}
	if($(this).scrollTop()+$(window).height()>=$(document).height()-200&!load){load_u()}
});