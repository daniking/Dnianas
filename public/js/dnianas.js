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
$('#clicksows').dblclick(function(){ 
	$("body").css("position","fixed");
	$("body").css("left","0");
	$("body").css("right","0");
	$("body").css("top","0");
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
$('#clicksows').click(function(){ 
	$('.hover_profile').slideDown(400);
	$(".hover_profile").show();
});
$(".hover_profile").mouseup(function()

{
	return false
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