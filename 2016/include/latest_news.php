<?php

// <div class="column-inner">
//   <a href="http://astone-blog.jp/photonews/">
//     <img class="top-rightarea--thumb" src="images/top/bt_photonews.jpg">
//     <h3 class="top-rightarea--title">最新写真ニュース</h3>
//     <p class="top-rightarea--detail">感謝と賛美とリバイバルキャンプの聖会案内について<br>2016年03年29日</p>
//   </a>
// </div>

$READ_LIST=4;
$count=0;

$rss = simplexml_load_file('/home/hf-antioch/photonews-feed/feed');
echo '';

foreach($rss->channel->item as $item){
    $title = mb_strimwidth (htmlspecialchars($item->title), 0, 50, "...", "utf-8");
	$link = htmlspecialchars($item->link);
	$date = date('Y年n月j日', strtotime(htmlspecialchars($item->pubDate)));
	
	preg_match('/<img.*>/i', $item->children('content', true)->encoded, $img_tag);
	
	preg_match('/(http|https).*?(\.gif|\.png|\.jpg|\.jpeg$|\.bmp|\.GIF|\.PNG|\.JPG|\.JPEG$|\.BMP)/i', $img_tag[0], $img_url);
	
        $count++;
        if ($count > $READ_LIST ) { break; }
?>
<h3 class="top-rightarea--title">最新写真ニュース</h3>
<div class="column-inner">
<a href="<?php echo $link; ?>" target="_blank">
  <!-- <img class="top-rightarea--thumb" src="images/top/bt_photonews.jpg"> -->
  <p class="top-rightarea--detail"><?php echo $title; ?><br><img <?php echo 'src="'.$img_url[0].'"'; ?> height="115px" /></p>
</a>
</div>

<?php }  echo ''; ?>
