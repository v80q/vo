function like_add(vopr_id){$.post('add_like.php',{vopr_id:vopr_id},function(data){if(data='success'){like_get(vopr_id)}})}
function like_get(vopr_id){$.post('get_like.php',{vopr_id:vopr_id},function(data){$('#like_'+vopr_id+'_id').text(data);$('#l_'+vopr_id+'_i').css({'fill':'rgb(222,81,74)'})})}
function jalo_add(vopr_id){$.post('add_jalob.php',{vopr_id:vopr_id},function(data){if(data='success'){jalo_get(vopr_id)}})}
function jalo_get(vopr_id){$.post('get_jalob.php',{vopr_id:vopr_id},function(data){$('#jalo_'+vopr_id+'_id').text(data);$('#j_'+vopr_id+'_i').css({'fill':'rgb(222,81,74)'})})}
function count_v(){rty=$('#rty');rty.hide().stop();$.post({url:'load_count_v.php',data:{'id':$('.nomer').val(),'log_user':$('.log_user').val(),'name_r':$('.name_r:checked').val(),'name_c':$('#name_c').val(),'sText':$('.sText').val(),'minPrice':$('.minPrice').val(),'maxPrice':$('.maxPrice').val(),'myv':$('#myv').text()},success:function(data) {rty.text(data);}});rty.fadeTo(300,1);}
function load_v(){netvoprosov=$('#netvoprosov').length;vopr_block=$('.vopr_block');nomer=$('.nomer').val();loadImg=$("#loadImg");if(!netvoprosov&!nomer) {$.post({url:'load_vopr.php',data:{'add':window.add,'log_user':$('.log_user').val(),'name_r':$('.name_r:checked').val(),'id':nomer,'name_c':$('#name_c').val(),'sText':$('.sText').val(),'minPrice':$('.minPrice').val(),'maxPrice':$('.maxPrice').val(),'myv':$('#myv').text()},beforeSend:function() {loadImg.fadeTo(300,1);load=true;},success:function(data) {loadImg.detach();vopr_block.append(data);$('.vopros:hidden').each(function(i) {$(this).delay((i++) * 50).fadeTo(100,1);});load=false;add += 10;}});}}
function show_ac(login_p){$.post({url:'page_acc.php',data:{login_p:login_p},success:function(data){$('body').append(data);$('#page_acc').fadeTo(100,1)}})}
function show_ot(selector,id){$.post({url:'page_otv.php',data:{selector:selector,id:id},success:function(data){$('body').append(data);$('#page_otv').fadeTo(100,1)}})}
function send_comment(){if($('#name_comment').val()!=''&$('#text_comment').val()!=''&$('#mail_comment').val()!='') {$.post({url:'send_comment.php',data:{'name_comment':$('#name_comment').val(),'text_comment':$('#text_comment').val(),'mail_comment':$('#mail_comment').val(),},success:function(data) {$('body').append(data);$('#text_comment').val(''),$('#send_com').fadeTo(100,1);}});}else {$("#req").fadeTo(300,1);}}
function open_vopr(vopr_id){$('#close_'+vopr_id).slideToggle(300),pdskFade(vopr_id)}
function show_error(id){$.post({url:'promo02.php',data:{id:id},success:function(data){$('body').append(data);$('#promo02').fadeTo(100,1)}})}
function sh_rat(num){$.post({url:'page_rat.php',data:{num:num},success:function(data){$('body').append(data);$('#sh_rat').fadeTo(100,1)}})}
$(function() {
	add=0;
	ld=false;
	load=false;
	if($(document).width()>999){
		$('.show_at_start').fadeTo(100,1);
		count_v();
		$('#search_form').find('.for_cound').change(function(){if($(this).val()!=''){$(this).addClass('arrred')}count_v()});			
	}
	load_v();
});
$(window).scroll(function(){
	if($(this).scrollTop()>300&$(document).width()>999){if($('.uverh').is(":hidden")){$('.uverh').removeClass('dspn')}}
	if ($(this).scrollTop()+$(window).height()>=$(document).height()-400&!load){load_v()}
	if ($(this).scrollTop()>=$("#perbl").outerHeight(true)+250&$(document).width()>999) {if(ld==false){$('#perbl').hide(),$('.ser').addClass('fix'),show('all_vser2','.fix'),ld=true}}
	else if(ld==true){$('#perbl').show(),$('.ser').removeClass('fix'),$('#ser_2').detach(),ld=false;}
});
function pdskFade(vopr_id) {
	if(!$('#close_'+vopr_id).children('#'+vopr_id+'_otv1').length>0 && $('#skazka_'+vopr_id).children('.mn').length>0) {
		$('#skazka_'+vopr_id).children('.mn').detach();
	}
	else $.post({url:'action/sk.php',success:function(data){$('#skazka_'+vopr_id).append(data),$('#skazka_'+vopr_id).children('.mn').fadeTo(500,1)}})
}
function otv_get(vopr_id,otv_id){
	pdsk=0;
	$('#block_'+vopr_id).children(".otvop").removeAttr("onclick");
	i_o=$('#'+vopr_id+'_otv'+otv_id);
	z=$('.zifra');
	r=$('.rating');
	$.post({
		url:"prov_otv.php",
		data:{otv_id:otv_id,vopr_id:vopr_id,pdsk:pdsk},
		dataType:"json",
		success:function(data){
			if(data.res_otv==1){i_o.removeClass('otvop').addClass('p_otvop'),$('#price_'+vopr_id).effect("transfer",{ to:".zifra" },1000),z.text(data.balans_ochk),r.text(data.rating_log),$('#'+vopr_id).delay(1000).fadeTo(700,.8)}
			if(data.res_otv==0){i_o.removeClass('otvop').addClass('n_otvop'),z.effect("transfer",{ to:'#pay_'+vopr_id},1000),z.text(data.balans_ochk),r.text(data.rating_log),$('#'+vopr_id).delay(1000).fadeTo(700,.8),$('#'+vopr_id+'_otv'+data.pr_otv).addClass('p_otvop')}	
			if(data.res_otv==1 || data.res_otv==0) {
				$('#v'+vopr_id+'_o1').text(data.var1),$('#v'+vopr_id+'_o2').text(data.var2),$('#v'+vopr_id+'_o3').text(data.var3),$('#v'+vopr_id+'_o4').text(data.var4),$('.varpoz').fadeTo(500,1),del_bl('#new_o');
				if(data.balans_ochk<0) {
					show('obnul_but','#page-menu');
				} else $('#obnul_but').detach();
			}
			if(data.res_otv==2){$('#'+vopr_id).fadeTo(700,.6),show('ect_o','body')}
			if(data.res_otv==3){show('ect_o2','body')}
			else false}});
	totop();		
}
function totop(){$.post({url:'action/totop.php',dataType:"json",success:function(data){
   $.each(data, function() {
		$.each(this, function(n,v) {
			if(!$('#tt'+n).children('#'+v.id).length>0) {
				$('#tt'+n).children('.ava_tt').detach();
				$('#tt'+n).append('<img id="'+v.id+'" onclick="show_ac(&apos;'+v.login+'&apos;)" class="help ava_tt dspn" title="Участник '+v.login+', на данный момент, имеет '+v.ochk+' очков. Кликните для детальной информации" src="/images/account/'+v.image+'">');
				$('#'+v.id).slideDown(300);
			}
		});
	});	

}})}
/* Вконтакте */
function isMember(user_id){VK.Api.call('groups.isMember',{group_id:92432572,user_id:user_id},function(data){if(data.response==1){$('#isMember').is(function(){$(this).removeClass('is_n').addClass('is_mok')});$('#check_prav').is(function(){$(this).addClass('dspn')})}})}
