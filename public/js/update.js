$(document).ready(function(){ 
	$(".tabpass22").hide();
	$(".tabyoinfo22").hide();
	$(".tabprofile22").hide();
	$("._js_n1").css("background-color","#fff");
});

$("._js_n1").click(function(){
$(".tabprofile22").hide();
$(".tabpass22").hide();
$(".tabyoinfo22").hide();
$(".tabaccosett").show();
$("._js_n1").css("background-color","#fff");
$("._js_n2").css("background-color","#f1f1f1");
$("._js_n3").css("background-color","#f1f1f1");
$("._js_n4").css("background-color","#f1f1f1");
});

$("._js_n2").click(function(){
$(".tabprofile22").show();
$(".tabpass22").hide();
$(".tabyoinfo22").hide();
$(".tabaccosett").hide();
$("._js_n2").css("background-color","#fff");
$("._js_n1").css("background-color","#f1f1f1");
$("._js_n3").css("background-color","#f1f1f1");
$("._js_n4").css("background-color","#f1f1f1");
});

$("._js_n3").click(function(){
$(".tabprofile22").hide();
$(".tabpass22").show();
$(".tabyoinfo22").hide();
$(".tabaccosett").hide();
$("._js_n3").css("background-color","#fff");
$("._js_n2").css("background-color","#f1f1f1");
$("._js_n1").css("background-color","#f1f1f1");
$("._js_n4").css("background-color","#f1f1f1");
});

$("._js_n4").click(function(){
$(".tabprofile22").hide();
$(".tabpass22").hide();
$(".tabyoinfo22").show();
$(".tabaccosett").hide();
$("._js_n4").css("background-color","#fff");
$("._js_n2").css("background-color","#f1f1f1");
$("._js_n3").css("background-color","#f1f1f1");
$("._js_n1").css("background-color","#f1f1f1");
});


$(document).ready(function() {
	$(".addmailbox").hide();
});
$(".addmail").click(function(){
$(".addmailbox").fadeIn(700);
$("body").css("position","fixed");
$("body").css("left","0");
$("body").css("right","0");
$("body").css("top","0");
});

$(".closeaddmail").click(function(){
$(".addmailbox").fadeOut(700);
$("body").css("position","relative");
});

$(".CANCEL").click(function(){
$(".addmailbox").fadeOut(700);
$("body").css("position","relative");

});