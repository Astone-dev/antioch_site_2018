// JavaScript Document
google.load("feeds", "1");

function initialize() {
	//var feedurl = "http://tokyoantiochspotnews.blogspot.com/rss.xml?alt=rss"	//緊急用
	var feedurl = "http://astone-blog.jp/photonews/feed";		//本番用
	//var feedurl = "http://astone.tv/mission/feed/rss/";
  var feed = new google.feeds.Feed(feedurl);
  feed.setNumEntries(4);
  feed.load(dispfeed);

  function dispfeed(result){
    if (!result.error){
      var container = document.getElementById("js_news_mod"),
        htmlstr = "",
        entry,
        imgCheck,
        entryDate,
        entryYear,
        entryMonth,
        entryDay,
        date;

      for (var i = 0; i < result.feed.entries.length; i++) {
        entry = result.feed.entries[i];

        //　imageの取得
        imgCheck = entry.content.match(/(http:)[\S]+((\.jpg)|(\.JPG)|(\.jpeg)|(\.JPEG)|(\.gif)|(\.GIF)|(\.png)|(\.PNG))/);
        // console.log("imgCheck", imgCheck);

        //　日付の取得
        entryDate = new Date(entry.publishedDate);
        entryYear = entryDate.getYear();
        if (entryYear < 2000){
          entryYear += 1900;
        }
        entryMonth = entryDate.getMonth() + 1;
        if (entryMonth < 10) {
          entryMonth = "0" + entryMonth;
        }
        entryDay = entryDate.getDate();
        if (entryDay < 10) {
          entryDay = "0" + entryDay;
        }
        date = entryYear + "年" + entryMonth + "月" + entryDay +"日";

				// <div class="column-inner">
				//   <a href="http://astone-blog.jp/photonews/">
				//     <img class="top-rightarea--thumb" src="images/top/bt_photonews.jpg">
				//     <h3 class="top-rightarea--title">最新写真ニュース</h3>
				//     <p class="top-rightarea--detail">感謝と賛美とリバイバルキャンプの聖会案内について<br>2016年03年29日</p>
				//   </a>
				// </div>

        // DOMの生成
        htmlstr += '<div class="column-inner">';
          htmlstr += '<a href="' + entry.link + ' "target="_brank">';
            if (imgCheck){
              htmlstr += '<img class="top-rightarea--thumb" src="'+ imgCheck[0] +'" width="200px" height="115px">';
            } else {
              htmlstr += '<img class="top-rightarea--thumb" src="images/top/bt_photonews.jpg">';
            }
              htmlstr += '<h3 class="top-rightarea--title">最新写真ニュース</h3>';
              htmlstr += '<p class="top-rightarea--detail">'+ entry.title +'<br>'+ date +'</p>';
          htmlstr += '</a>'
        htmlstr += '</div>';
      }

      // DOMの挿入
      container.innerHTML = htmlstr;

			//スライドショー実行
			TOKYOANTIOCH.topNewsSlideStart();

    }else{
       alert(result.error.code + ":" + result.error.message);
    }
  }

}
google.setOnLoadCallback(initialize);
