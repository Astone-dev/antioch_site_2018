<?php

// path は、自ファイルの呼び出し元からみた相対パスのため注意

# 過去の取得タイムスタンプを確認して、45分経過している場合は、再取得

$articles_nums = 4; # 読み込む記事の数マイナス 1

$rss_do_get = TRUE; # RSSを読み込むか判定フラグ
$tmp_img_dir = "/tmp_img_dir";

$rss_saved_file = "../../tmp_img_dir/rss_loaded.inc";

for ($i = 0; $i <= $articles_nums; $i++) {
    $timestamp_file = "../../tmp_img_dir/timestamp_file_".$i;
    # ※  "../images/tmp_img_dir"; ディレクトリ以下をアクセス権 775 とし、グループをapacheに変更すること
    // path は、自ファイルの呼び出し元からみた相対パスのため注意

    // RSSを読み込むか判定
    if (file_exists($timestamp_file)) {
        // $tmp_img_file のファイル更新が"45分= 45*60"以内なら、$wget_flagをFALSEにして、wget 実行しない
        $tmp_time = strtotime("now") - filemtime($timestamp_file);
        if( $tmp_time < 45*60 && $tmp_time >= 0) {
        // if( $tmp_time < 30 && $tmp_time >= 0) {
            $rss_do_get = FALSE;
            break;
        }
    }
}

# RSS ファイルを読み込む必要なければ、incファイルからファイル読み込み
if ($rss_do_get == FALSE){
    $rss_contents = file_get_contents($rss_saved_file);
    if ($rss_contents){
        echo $rss_contents;
        return; # 読み取り成功時は、ここで抜ける
    }
    # ファイル読み込み失敗した場合は、RSS読み込み処理実施
}

# RSS読み込み処理は、HTML出力と同時にファイル出力を行う
$out_str ='<div id="js_news_mod" class="news__wrap">';
echo $out_str;
file_put_contents($rss_saved_file, "TEST OO ".$out_str);

error_reporting(E_ERROR);
require_once 'lib/magpierss/rss_fetch.inc';
define('MAGPIE_OUTPUT_ENCODING', 'UTF-8');
$url = 'http://astone-blog.jp/photonews/feed';
$rss = fetch_rss($url);
$i = 0;
foreach ($rss->items as $item ) {
    $title = htmlspecialchars($item['title']);
    $title = mb_substr($title, 0, 44, 'utf-8');
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
    
    $timestamp_file = "../../tmp_img_dir/timestamp_file_".$i;
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
        
    // echo "TEST obata";
    // echo $img;
    // passthru("wget -nv -N -O ".$tmp_img_dir." ".$img."  > /dev/null 2>&1", $ret);
    passthru("wget -nv -N -P ../..".$tmp_img_dir." ".$img."  > /dev/null 2>&1", $ret);
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

    $out_str = '<aside class="news__article"><a href="'. $link .' " target="_brank"><div class="news__article-img" style="background-image:url(\''. $img . '\');"></div><div><p class="news__article-day">'.date("Y/n/j", strtotime( $item['pubdate'] )).'</p><p class="news__article-title">'. $title .'</p></div></a></aside>';

    echo $out_str;
    file_put_contents($rss_saved_file, $out_str, FILE_APPEND);

    $i++;
    if ($i > $articles_nums ){break;}
}
echo '</div>';
file_put_contents($rss_saved_file,'</div>', FILE_APPEND);

?>
