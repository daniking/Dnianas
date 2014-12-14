$(document).ready(function(){
	$(".tab_pubilc").hide();
	$(".1992sasa").show();
	$("#boxallweb").show();
	$("#close_tabpubilc").hide();
});
$('#open_tabpubilc').click(function(){

$(".tab_pubilc").show(); 
$(".tab_pubilc").css("left","0");
$("#boxallweb").css("position","fixed");
$("#boxallweb").css("left","256");
$("#open_tabpubilc").hide(); 
$("#close_tabpubilc").show();
return false;

});
$('#close_tabpubilc').click(function(){
$(".tab_pubilc").hide(); 
$(".tab_pubilc").css("left","0");
$("#boxallweb").css("position","absolute");
$("#boxallweb").css("left","0");
$("#open_tabpubilc").show(); 
$("#close_tabpubilc").hide();
return false;

});


$(document).ready(function(){
	$(".header_top").hide();
	
		$(function () {
		$(window).scroll(function () {
			if ($(this).scrollTop() > 30) {
				$('.header_top').slideDown(200);
				$('.header').hide();
			} else {
				$('.header_top').slideUp(200);
				$('.header').show();
			}
		});
		$('#backtoppage').click(function () {
			$('body,html').animate({
				scrollTop: 0
			}, 200);
			return false;
		});
	});

});
$('.search_pople').click(function(){
	$(".search_pople").css("width","80%");
	$(".findbooks_touch").hide()
	});
	$(".search_pople").mouseup(function()

{
return false
});
$(document).mouseup(function()
{
$(".search_pople").css("width","25%");
$(".findbooks_touch").show()
});
	