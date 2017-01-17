$(function($) {
	$('#akz').fadeTo(500,.7);	
	$(function($){
		$.supersized({
			slide_interval:1000,
			transition:1,
			transition_speed:1500,
			vertical_center:1,
			horizontal_center:1,
			fit_always:1,
			image_protect:1,
			slide_links:'blank',
			slides:[
				{image:'images/back33.png'},
				{image:'images/back3.png'},
				{image:'images/back44.png'},
				{image:'images/back4.png'},
				{image:'images/back11.png'},
				{image:'images/back1.png'},
				{image:'images/back22.png'},
				{image:'images/back2.png'}
			]
		});
	});
});
function show(file,app){$.ajax({url:'lib/'+file+'.php',success:function(data) {$(''+app+'').append(data);$('#'+file).fadeTo(100,1)}})}
function del_bl(id_div){$(id_div).detach()}
$(document).click(function(event) {
 	if ($('#balans_menu').length>0){del_bl('#balans_menu'),$('#office').removeClass('of_a'),$('.log_arr').toggleClass('log_arr2','log_arr')};
    if ($(event.target).closest('.dm-modal').length || $(event.target).closest('.menu').length) return;
	del_bl('.dm-overlay');
    event.stopPropagation();
});
function show_error(id){$.post({url:'lib/promo02.php',data:{id:id},success:function(data){$('body').append(data);$('#promo02').fadeTo(100,1)}})}