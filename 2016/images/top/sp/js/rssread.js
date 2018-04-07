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
        //console.log("imgCheck", imgCheck);

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
        date = entryYear + "/" + entryMonth + "/" + entryDay;

        // DOMの生成
        htmlstr += '<aside class="news__article">';
          htmlstr += '<a href="' + entry.link + ' "target="_brank">';
            if (imgCheck){
              htmlstr += '<div class="news__article-img" style="background-image:url('+ imgCheck[0] +');"></div>';
            } else {
              htmlstr += '<div class="news__article-img" style="background-image:url();"></div>';
            }
            htmlstr += '<div>';
              htmlstr += '<p class="news__article-day">'+ date +'</p>';
              htmlstr += '<p class="news__article-title">'+ entry.title +'</p>';
            htmlstr += '</div>';
          htmlstr += '</a>'
        htmlstr += '</aside>';
      }

      // DOMの挿入
      container.innerHTML = htmlstr;

      // 読み込んだニュースをカルーセル化
      $('#js_news_mod').slick({
        speed: 700,
        arrows: false,
        autoplay: true,
        autoplaySpeed: 6000,
        dots: true
      });

    }else{
       alert(result.error.code + ":" + result.error.message);
    }
  }

}
google.setOnLoadCallback(initialize);
