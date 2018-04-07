// JavaScript Document
var TokyoAntioch = TokyoAntioch || {};

// ---------------------------------------------
// TokyoAntioch.tabClick()
// メニュー
// ---------------------------------------------
TokyoAntioch.menuOn = function() {
	$(".modal__menu").height($("#content").height());
	$(".modal__content").css("margin-top", $(window).scrollTop() + 16);
	$(".modal__menu").fadeIn(200, function() {
		$(".modal__content").fadeIn(500);
	});
	console.log($("#content").height());
}

TokyoAntioch.menuOff = function() {
	$(".modal__content").fadeOut(300);
	$(".modal__menu").fadeOut(300);
}

// ---------------------------------------------
// TokyoAntioch.tabClick()
// タブクリック時のコンテンツ切り替え処理
// 汎用的に作ってありますが、DOM構造とclass名、ID名の付け方には注意
// ---------------------------------------------
TokyoAntioch.tabClick = function(obj) {
	if(!(obj.hasClass('tab__btn--on'))){
		// tab__btn__wrapの切り替え
		$('.tab__btn--on').removeClass("tab__btn--on");
		obj.addClass('tab__btn--on')
		// tab__contentの表示切り替え
		var target = obj.attr("id").replace(/js_tab--/g,"");
		$('.tab__content__wrap').children().hide();
		$('#js_tab__content--'+ target).show();
	}
}

// ---------------------------------------------
// TokyoAntioch.floatMenu()
// タブクリック時のコンテンツ切り替え処理
// 汎用的に作ってありますが、DOM構造とclass名、ID名の付け方には注意
// ---------------------------------------------
// TokyoAntioch.floatMenu
TokyoAntioch.floatMenu = function(obj) {
	if($(window).scrollTop() >= window.menuBoxTop){
        window.menuBox.addClass("fixed");
        $("#js_topNav").css("margin-bottom","53px");
        // $("body").css("margin-top","53px");
    }else{
        window.menuBox.removeClass("fixed");
        // $("body").css("margin-top","0px");
        $("#js_topNav").css("margin-bottom","0px");
    }
}


// ロード後処理
$(document).ready(function(){
	// タブ
	$("#js_tab .tab__btn__wrap div").on("click",function(){
		TokyoAntioch.tabClick($(this));
	});
	// フロートメニュー
	$(function(){
    window.menuBox = $("#js_floatMenu");
    window.menuBoxTop = menuBox.offset().top;
    $(window).scroll(TokyoAntioch.floatMenu);
    $('body').bind('touchmove', TokyoAntioch.floatMenu);
	});

});
