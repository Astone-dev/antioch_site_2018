<?php

// path は、自ファイルの呼び出し元からみた相対パスのため注意

echo '<div id="js_news_mod" class="news__wrap">';

error_reporting(E_ERROR);
require_once 'lib/magpierss/rss_fetch.inc';
define('MAGPIE_OUTPUT_ENCODING', 'UTF-8');
$url = 'http://astone-blog.jp/photonews/feed';
$rss = fetch_rss($url);
$i = 0;
foreach ($rss->items as $item ) {
    $title = htmlspecialchars($item['title']);
    $title = mb_substr($title, 0, 36, 'utf-8');
    $description = htmlspecialchars($item['description']);
    $description = mb_substr($description, 0, 150, 'utf-8');
    $link = htmlspecialchars($item['link']);

    /* obata-test ********************************/
    // echo "<pre>";
    // print_r($item);
    // print($title);
    // print($item[atom_content]);
    // echo "</pre>";
    /* obata-test ********************************/

    // $item[content:encoded] の中からimgタグを抽出
    $img = "";
    if(preg_match("/src=[\"|\'](.*?)(jpe?g)[\"|\'|\?]/i", $item[content][encoded], $match)){
        // $img = '<img src="'.$match[1].'.jpg" />';
        $img = htmlspecialchars($match[1]) .'jpg';
    } else if (preg_match("/src=[\"|\'](.*?)(png)[\"|\'|\?]/i", $item[content][encoded], $match)) {
        $img = htmlspecialchars($match[1]) .'png';
    }else if(preg_match("/src=[\"|\'](.*?)(gif)[\"|\'|\?]/i", $item[content][encoded], $match)){
        $img = htmlspecialchars($match[1]) .'gif';
    }else{
        // 画像が無い時の処理
    }

    // -----------------------------------------------
    $tmp_img_dir = "../images/tmp_img_dir";
    $timestamp_file = "../images/tmp_img_dir/timestamp_file_".$i;
    # ※  "../images/tmp_img_dir"; ディレクトリ以下をアクセス権 775 とし、グループをapacheに変更すること
    // path は、自ファイルの呼び出し元からみた相対パスのため注意

    $wget_flag =TRUE;
    // wget 実行するか判定
    /* ファイルへ保存させてする処理は、ひとまずなし
    if (file_exists($timestamp_file)) {
        // $tmp_img_file のファイル更新が"45分= 45*60"以内なら、$wget_flagをFALSEにして、wget 実行しない
        $tmp_time = strtotime("now") - filemtime($timestamp_file);
        if( $tmp_time < 45*60 && $tmp_time >= 0) {
        // if( $tmp_time < 30 && $tmp_time >= 0) {
            $wget_flag = FALSE;
        }
    }
    */
    // echo "TEST obata 0";

    //php でwget によるデータ取得
    // wget の参照 http://itpro.nikkeibp.co.jp/article/COLUMN/20060228/230995/?rt=nocnt
    if ($wget_flag ===TRUE) {
        
        // echo "TEST obata";
        // echo $img;
        // passthru("wget -nv -N -O ".$tmp_img_dir." ".$img."  > /dev/null 2>&1", $ret);
        passthru("wget -nv -N -P ".$tmp_img_dir." ".$img."  > /dev/null 2>&1", $ret);
        // echo $ret; //wget エラー時は $ret に0以外の値が入る

        if ($ret == 0){
            // ファイルパスの指定
            //参照: https://mail.google.com/mail/u/0/?tab=wm#sent/163f451258e92c0c
            $img = strrchr( $img, "/" );// /postname.html
            $img = substr( $img, 1 );// postname.html

            $img = $tmp_img_dir."/".$img;
            // echo $img;

            touch($timestamp_file);
        }
    }

  echo '<aside class="news__article">';
  echo '<a href="'. $link .' " target="_brank">';

  echo '<div class="news__article-img" style="background-image:url(\''. $img . '\');">';
  echo '</div>';
  echo '<div>';
  echo '<p class="news__article-day">'.date("Y/n/j", strtotime( $item['pubdate'] )).'</p>';
  echo '<p class="news__article-title">'. $title .'</p>';
  echo '</div>';
  echo '</a>';
  echo '</aside>';

  $i++;
  if ($i > 4){break;}
} 
echo '</div>';

?>
