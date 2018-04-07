<?php
    
	/* $show_str の文字列の内容を、$start_date ～ $end_date の期間だけ、表示させる関数
	// 以下呼び出し方例
    $show_str = '<div class="column-inner">
        <span class="label-1">ブログ</span>
        <span>NEW</span>
        <a href="http://antiochblog.jp/info/jerusalem2017/180224iwatsuki/" target="_blank"><img src="/2016/images/top/1705jerumisato.jpg"></a>
        <p class="block-date">ブログ：2018年2月24日</p>
        <p class="block-title"><a href="http://antiochblog.jp/info/jerusalem2017/180223iwatsuki/" target="_blank">エルサレム-test1<br>さいたま市岩槻デイケアでゴスペルコンサート
        </a></p>
        </div>';
    show_div($show_str, '2018/02/24 00:00', '2018/02/25 00:00');
    $s2= '<div class="column-inner">
        <span class="label-1">ブログ</span>
        <span>NEW</span>
        <a href="http://astone.tv/events/2hakuba1802za/" target="_blank"><img src="/2016/images/top/1802sunerugoinimukatezenkoku.jpg"></a>
        <p class="block-date">ブログ：2018年2月19日～24日</p>
        <p class="block-title"><a href="http://astone.tv/events/2hakuba1802za/" target="_blank">test2- 白馬スネルゴイキャンプに向かって<br>全国各教会<br>日程：2018年2月28日(水)～3月2日(金)</a></p>
        </div>';
    show_div($s2, '2018/02/24 1:00', '2018/2/25');
    */

    // $show_str の文字列の内容を、$start_date ～ $end_date の期間だけ、表示させる関数
    // $start_date、$end_date は、"2018/02/05 23:05"() の形式で指定する
    // 参照: http://isket.jp/%E3%83%97%E3%83%AD%E3%82%B0%E3%83%A9%E3%83%9F%E3%83%B3%E3%82%B0/php%E6%97%A5%E4%BB%98%E3%82%84%E6%99%82%E5%88%BB%E3%82%92%E6%AF%94%E8%BC%83%E3%81%99%E3%82%8B%E6%96%B9%E6%B3%95/   
    function show_div($show_str, $start_date, $end_date){
        // 今日の日付を取得
        $dt = new DateTime();
        $dt->setTimeZone(new DateTimeZone('Asia/Tokyo'));
        $today = $dt->format('Y/m/d H:i');

        print (", start: ".strtotime($start_date));
        print (", today: ".strtotime($today));
        print (", end: ".strtotime($end_date));
 
        // 日付を比較し、対象期間内なら文字列表示
        if (strtotime($today) >= strtotime($start_date) && strtotime($today) <= strtotime($end_date)) {
            echo $show_str;
        }
    }

?>

