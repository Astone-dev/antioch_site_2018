<?php 
  
  devotion_show();
  
  function devotion_show(){
    $dv_filepath = $_SERVER['DOCUMENT_ROOT']. "/2016/include/devotion_data.js"; //�f�{�[�V�����\�t�@�C���p�X���w��
  
  
    $today_d = date('m-d-Y');  //�����̓��t��"02-25-2017"�̌`���Ŏ擾
    // echo $today_d;
    
    //�f�{�[�V�����\�t�@�C�������s��؂�̔z��œǂݍ���
    $dv_line = @file($dv_filepath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    
    // echo "\nTEST ------- <br>\n";
    
    foreach($dv_line as $line){
      // echo $line."<br>";
      
      //�z����ɍ����̓��t���܂�ł���ꍇ
      if( strpos($line, $today_d) !== false ){
        // <span> �� </span> �̊Ԃ̕�����𒊏o ���A$retArr[2]�ɓ���
        if( preg_match("/(.*)<span>(.*?)<\/span>/is", $line, $retArr) ){
          // print_r($retArr);
          echo $retArr[2];
        }
        break;
      }    
    }
  }

?>
