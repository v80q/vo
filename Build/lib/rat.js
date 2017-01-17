function show_ac(login_p){$.post({url:'/lib/page_acc.php',data:{login_p:login_p},success:function(data){$('body').append(data);$('#page_acc').fadeTo(100,1)}})}
function show_ot(selector,id){$.post({url:'/lib/page_otv.php',data:{selector:selector,id:id},success:function(data){$('body').append(data);$('#page_otv').fadeTo(100,1)}})}
$(window).scroll(function(){
	if($(this).scrollTop()>300&$(document).width()>999){if($('.uverh').is(":hidden")){$('.uverh').removeClass('dspn')}}
});
function rat(file) {
	ident=$('#muy').html();
	if(file=='user_up' || file=='vopr_up'){selector=window.up};
	if(file=='user_down' || file=='vopr_down'){selector=window.down};
	$.post({
		url: '/lib/rating/'+file+'.php',
		data: {
			'selector':selector,
			'ident':ident
		},
		success: function(data) {
			if(file=='user_up' || file=='vopr_up'){
				$('#up').detach();
				$('#up_cont').prepend(data);				
				up+=5;
			};
			if(file=='user_down' || file=='vopr_down'){
				$('#down').detach();
				$('#down_cont').append(data);				
				down+=5;
			};	
		}
	});
}