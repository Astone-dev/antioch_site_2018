// JavaScript Document

var TOKYOANTIOCH = {
	testfunc: function(){
		console.log("testfunc1");
	},
	testfunc2: function(){
		console.log("testfunc2");
	},

	topNewsSlideStart: function() {
		$('.bxslider').bxSlider({
			mode: 'fade',
			auto: true,
			speed: 700,
			pause: 5000,
			captions: false,
			pager: false,
			controls: false
		});
	}

}


var ua = navigator.userAgent;
if( ua.indexOf('iPhone') > 0 || ua.indexOf('iPod') > 0 || (ua.indexOf('Android') > 0 && ua.indexOf('Mobile') > 0) ) {
	document.getElementById("mov").style.display="block";
	document.getElementById("movie_img").style.display="block";

/*document.write('<link rel="stylesheet" href="sp.css">');CSSを切り替える場合。*/
/*location.href = '/sp/';ディレクトリを振り分ける場合。*/
}

/*
var user="";
if ((navigator.userAgent.indexOf('iPhone') > 0 && navigator.userAgent.indexOf( 'iPad') == -1) || navigator.userAgent.indexOf('iPod') > 0 || navigator.userAgent.indexOf('Android') > 0) {
	document.getElementById("mov").style.display="block";
	document.getElementById("movie_img").style.display="block";
	
//	$("video").attr('class', 'mov_none');

} *//*else {
    func2();
    user="pc";

}

if ((navigator.userAgent.indexOf('iPhone') > 0 && navigator.userAgent.indexOf('iPad') == -1) || navigator.userAgent.indexOf('iPod') > 0 || navigator.userAgent.indexOf('Android') > 0) {
}
*/