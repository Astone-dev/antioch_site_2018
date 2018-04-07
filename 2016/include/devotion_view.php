<?php 
  
  devotion_show();
  
  function devotion_show(){
    $dv_filepath = $_SERVER['DOCUMENT_ROOT']. "/2016/include/devotion_data.js"; //デボーション表ファイルパスを指定
  
  
    $today_d = date('m-d-Y');  //今日の日付を"02-25-2017"の形式で取得
    // echo $today_d;
    
    //デボーション表ファイルを改行区切りの配列で読み込み
    $dv_line = @file($dv_filepath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    
    // echo "\nTEST ------- <br>\n";
    
    foreach($dv_line as $line){
      // echo $line."<br>";
      
      //配列内に今日の日付を含んでいる場合
      if( strpos($line, $today_d) !== false ){
        // <span> と </span> の間の文字列を抽出 し、$retArr[2]に入る
        if( preg_match("/(.*)<span>(.*?)<\/span>/is", $line, $retArr) ){
          // print_r($retArr);
          echo $retArr[2];
        }
        break;
      }    
    }
  }

?>
