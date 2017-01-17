function del_bl(id_div){$(id_div).detach()}
function show(file,app){$.ajax({url:'/lib/'+file+'.php',success:function(data) {$(''+app+'').append(data);$('#'+file).fadeTo(100,1)}})}
function send_comment(){if($('#name_comment').val()!=''&$('#text_comment').val()!=''&$('#mail_comment').val()!='') {$.post({url:'/lib/send_comment.php',data:{'name_comment':$('#name_comment').val(),'text_comment':$('#text_comment').val(),'mail_comment':$('#mail_comment').val(),},success:function(data) {$('body').append(data);$('#text_comment').val(''),$('#send_com').fadeTo(100,1);}});}else {$("#req").fadeTo(300,1);}}
function uvh(){$('body,html').scrollTop(0),$('.uverh').addClass('dspn')}
function open_search(id){$('#clser_'+id).slideToggle(300,function(){$('#arr_'+id).toggleClass("arrdown","arrup")})}
$(function() {
	$('#office').click(function(){
		if ($('#balans_menu').length>0){del_bl('#balans_menu')} else show('balans_menu','body');
		$('#office').toggleClass('of_a');
		$('.log_arr').toggleClass('log_arr2','log_arr');
	});
});
$(document).click(function(event) {
 	if ($('#balans_menu').length>0){del_bl('#balans_menu'),$('#office').removeClass('of_a'),$('.log_arr').toggleClass('log_arr2','log_arr')};
    if ($(event.target).closest('.dm-modal').length || $(event.target).closest('.menu').length) return;
	del_bl('.dm-overlay');
    event.stopPropagation();
});
function pay(attr){$.post({url:'/lib/pay.php',data:{attr:attr},success:function(data){$('body').append(data);$('#pay').fadeTo(100,1)}})}