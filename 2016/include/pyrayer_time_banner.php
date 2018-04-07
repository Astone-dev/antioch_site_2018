<?php 
  $youbi = date('D'); //曜日"Sun", "Mon", ... の値が入る
  $hour = intval(date('G')); //時刻0～24を数値に変換した値
  
  //火曜12時以降～木曜12時までの間 祈りの時間 バナーを表示
  switch ($youbi){
  	case "Tue":
  		if ( $hour >=12 ){show_prayer_html();}
  		break;
  	case "Wed":
  		show_prayer_html();
  		break;
  	case "Thu":
  		if ( $hour < 12 ){show_prayer_html();}
  		break;
  	default: //火曜～木曜以外は表示させない
		;
  }
  
  function show_prayer_html(){
  	 echo '<div class="column-inner"><span>NEW</span><a href="http://tokyo.antioch.jp/prayer-time/" target="_blank"><img src="/2016/images/top/1604prayertime.jpg"></a>
  	 <p class="block-date">毎週火曜日22:00〜23:00生中継</p>
  	 <p class="block-title"><a href="http://tokyo.antioch.jp/prayer-time/" target="_blank">祈りの時間<br>プレイヤータイム 祈りによる恵みを受けるために<br></a></p></div>';
  }
  
  /* 以下を表示させる
   <div class="column-inner">
   <span>NEW</span>
   <a href="http://tokyo.antioch.jp/prayer-time/" target="_blank"><img src="/2016/images/top/1604prayertime.jpg"></a>
   <p class="block-date">毎週火曜日22:00〜23:00生中継</p>
   <p class="block-title"><a href="http://tokyo.antioch.jp/prayer-time/" target="_blank">祈りの時間<br>プレイヤータイム 祈りによる恵みを受けるために<br>
</a></p>
   </div>
  */

?>
