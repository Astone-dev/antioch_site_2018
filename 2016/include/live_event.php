<?php 
  $youbi = date('D'); //曜日"Sun", "Mon", ... の値が入る
  $hour = intval(date('G')); //時刻0～24を数値に変換した値
  
  //日曜6時以降～日曜21時までの間, 水曜18時-20時の間 生中継バナー表示
  switch ($youbi){
  	case "Sun":
  		if ( $hour >=6 && $hour <=20 ){show_banner_broadcast();}
  		break;
  	case "Wed":
//緊急で非表示対応	case "Wed_tmp_20180228":  //緊急で非表示対応
  		if ( $hour >=18 && $hour <= 20 ){show_banner_broadcast_wed();}
  		break;
  	case "Sat": 
  		if ( $hour >=18 && $hour < 20 ){
	  		if ( intval(date("Ymd")) == intval(date("Ymd", strtotime('second sat of this month')))) {
  				show_banner_broadcast_healing();
  			}else if(intval(date("Ymd")) == intval(date("Ymd", strtotime('third sat of this month')))){
  				show_banner_broadcast_rvnight();
  			}else if(intval(date("Ymd")) == intval(date("Ymd", strtotime('fourth sat of this month')))){
  				show_banner_broadcast_gospel();
  			}
  		}
  		break;
  	default: //日曜, 水曜, 土曜以外は表示させない
		;
  }
  
  
  function show_banner_broadcast(){
  	 echo '<div class="event-1"><div class="event-text">';
  	 echo '<p class="event-span">礼拝生中継をご覧ください</p><a href="/online"><p class="event-btn">生中継はこちら</p></a>';
  	 echo '</div></div>';
  }
  function show_banner_broadcast_wed(){
  	 echo '<div class="event-1"><div class="event-text2">';
  	 echo '<p class="event-span">水曜祈祷会生中継をご覧ください</p><a href="/online"><p class="event-btn">生中継はこちら</p></a>';
  	 echo '</div></div>';
  }

  function show_banner_broadcast_healing(){
  	 echo '<div class="event-1"><div class="event-text2">';
  	 echo '<p class="event-span">いやしの集い生中継をご覧ください</p><a href="https://www.youtube.com/channel/UCOV9zn7vX4O98uRzWlODMew/live" target="_blank"><p class="event-btn">生中継はこちら</p></a>';
  	 echo '</div></div>';
  }

    function show_banner_broadcast_rvnight(){
  	 echo '<div class="event-1"><div class="event-text2">';
  	 echo '<p class="event-span">REVIVAL NIGHT生中継をご覧ください</p><a href="https://www.youtube.com/channel/UCOV9zn7vX4O98uRzWlODMew/live" target="_blank"><p class="event-btn">生中継はこちら</p></a>';
  	 echo '</div></div>';
  }
  
  function show_banner_broadcast_gospel(){
  	 echo '<div class="event-1"><div class="event-text2">';
  	 echo '<p class="event-span">ゴスペルの集い生中継をご覧ください</p><a href="https://www.youtube.com/channel/UCOV9zn7vX4O98uRzWlODMew/live" target="_blank"><p class="event-btn">生中継はこちら</p></a>';
  	 echo '</div></div>';
  }  
  
/*  // 特別イベント用
  function show_banner_broadcast_sp(){
  	 echo '<div class="event-1"><div class="event-text">';
  	 echo '<p class="event-span">吉祥寺J.GOSPEL FES 生中継 5月4日(水)10:40〜16:30</p><a href="http://www.ustream.tv/channel/L3wYA34Eusm" target="_blank" onclick="javascript: pageTracker._trackPageview(\'J.GOSPEL FES 生中継\');"><p class="event-btn">生中継はこちら</p></a>';
  	 echo '</div></div>';
  }

 以下のテキストが上記で指定した日時に出力される
  <div class="event-1">
    <div class="event-text">
      <p class="event-span">礼拝生中継をご覧ください</p>
      <p class="event-btn">生中継はこちら</p>
    </div>
  </div>
*/
?> 
