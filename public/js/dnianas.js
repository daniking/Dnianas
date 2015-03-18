$(function(){
	$('.normal').autosize();
});
$(document).ready(function(){
	$("._192prosss").hide();
	$('.comment-input').autosize();
});
$('#clicksows').dblclick(function(){ 
	$("._192prosss").fadeIn(600, function() {
		$("._192prosss").show();
		$(".hover_profile").hide();
	});
});
$('#clicksows').hover(function(){ 

});


$(document).mouseup(function()
{
	$("._192prosss").hide();
	$("._192prosss").fadeOut(600, function() {
		$("body").css("position","relative");
		$("body").css("left","0");
		$("body").css("right","0");
		$("body").css("top","0");
	});
});
$(".profile_show_imagesclick").mouseup(function()
{
	return false
});

$(document).ready(function(){
	$("#titlelicomresh").hide();
});

$(document).ready(function(){
	$(".hover_profile").hide();
});

// Gordra ha.
$('#clicksows').click(function(){ 
	showProfile = $(this);
	showProfile.siblings().slideDown(400);
	showProfile.siblings().show();
});

$(document).mouseup(function()
{
	$(".hover_profile").hide();
});

$(document).ready(function(){
	$(".logout_123").hide();
});
$("#logout").click(function(){
	$(".logout_123").show();
	$("#box_logout").fadeIn(600);
});

$(".ui_buttonbtn_1").click(function(){
	$(".logout_123").hide();
	$("#box_logout").fadeIn(600);
	
});

$('.ui_buttonbtn_2').click(function(event) {
	window.location = "logout";
});