// JavaScript Document
var TokyoAntioch = TokyoAntioch || {};

var mygallery=new simpleGallery({
	wrapperid: "simplegallery1", //ID of main gallery container,
	dimensions: ["100%", "auto"], //width/height of gallery in pixels. Should reflect dimensions of the images exactly
	imagearray: [
				/* [?摜URL?A?????N??RL?A_new] */
				["/2016/images/top/slide/1612ad_jerusalem.jpg","",""],
				//["/images/gallery/praise.jpg","/features/praise/index.html",""],
				//["/images/gallery/healing.jpg","/features/healing/index.html",""],
				//["/images/gallery/gift.jpg","/features/blessing/index.html",""],
				//["/images/gallery/mission.jpg","/features/mission/index.html",""],
				//["/images/gallery/women.jpg","/features/women/index.html",""],
				//["/images/gallery/ophanage.jpg","/features/orphanage/index.html",""],
				//["/images/gallery/israel.jpg","/features/israel/index.html",""],
				//["/images/gallery/media.jpg","/features/media/index.html",""],
				//["/images/gallery/revival.jpg","/features/revival/",""],
				//["/images/gallery/socialservice.jpg","",""]
	],
	autoplay: [false, 4000, 10], //[auto_play_boolean, delay_btw_slide_millisec, cycles_before_stopping_int]
	persist: false, //remember last viewed slide and recall within same session?
	fadeduration: 1000, //transition duration (milliseconds)
	oninit:function(){ //event that fires when gallery has initialized/ ready to run
		//Keyword "this": references current gallery instance (ie: try this.navigate("play/pause"))
	},
	onslide:function(curslide, i){ //event that fires after each slide is shown
		//Keyword "this": references current gallery instance
		//curslide: returns DOM reference to current slide's DIV (ie: try alert(curslide.innerHTML)
		//i: integer reflecting current image within collection being shown (0=1st image, 1=2nd etc)
	}
})

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
