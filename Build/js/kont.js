function show(file,app){$.ajax({url:'/lib/'+file+'.php',success:function(data) {$(''+app+'').append(data);$('#'+file).fadeTo(100,1)}})}
function send_comment(){if($('#name_comment').val()!=''&$('#text_comment').val()!=''&$('#mail_comment').val()!='') {$.post({url:'/lib/send_comment.php',data:{'name_comment':$('#name_comment').val(),'text_comment':$('#text_comment').val(),'mail_comment':$('#mail_comment').val(),},success:function(data) {$('body').append(data);$('#text_comment').val(''),$('#send_com').fadeTo(100,1);}});}else {$("#req").fadeTo(300,1);}}
function del_bl(id_div){$(id_div).detach()}
$(function(){
	if($(document).width()>999) {
		w_width = $(document).width();
		if($(document).width()>999){
			$('.show_at_start').fadeTo(100,1);	
		}
}});