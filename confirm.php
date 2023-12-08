<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/confirm.css">
</head>
<body>
    <div class="box-wrapper">
        <div class="back">
            <section class="container">
                <div class="circlet">
                    <a href="top.html" style="text-decoration: none;">
                    <div class="circle-2">
                        <p class="circle">いろいろ<br>どうぶつ</p>
                    </div>
                    </a>
                </div>
                <div class="wave">
                </div>
            </section>
            <section class="container">
                <div class="question">

                </div>
                <div class="wave">
                </div>
            </section>
        </div>
    </div>
    <div class="comment">
      <p class="thanks">ありがとう！</p>
    </div>
    <div class="center">
    <div class="answer">
      <?php
      //入力値に不正なデータがないかなどをチェックする関数
      function checkInput($var){
        if(is_array($var)){
          //$var が配列の場合、checkInput()関数をそれぞれの要素について呼び出す
          return array_map('checkInput', $var);
        }else{
          //NULLバイト攻撃対策
          if(preg_match('/\0/', $var)){  
            die('不正な入力（NULLバイト）です。');
          }
          //文字エンコードのチェック
          if(!mb_check_encoding($var, 'UTF-8')){ 
            die('不正な文字エンコードです。');
          }
          //数値かどうかのチェック 
          if(!ctype_digit($var)) {  
            die('不正な入力です。');
          }
          return (int)$var;
        }
      }
      
      //POSTされたデータをチェック
      $_POST = checkInput($_POST);
      
      $error = 0;  //変数の初期化
      
      //性別の入力の検証
      if(isset($_POST['gender'])) {
        $gender = $_POST['gender'];
        if($gender == 1) {
          $gendername = '男性';
        }elseif($gender == 2) {
          $gendername = '女性';
        }else{
          $error = 1;  //入力エラー（値が 1 または 2 以外）
        }
      }else{
        $error = 1;  //入力エラー（値が未定義）
      }
      
      //年齢の入力の検証
      if(isset($_POST['age'])) {
        $age = $_POST['age'];
        if($age < 1 || $age > 8 ) {
          $error = 1;  //入力エラー（値が1-8以外）
        }
      }else{
        $error = 1;  //入力エラー（値が未定義）
      }
      
      //趣味の入力の検証
      if(isset($_POST['kind'])) {
        $kind = $_POST['kind'];
        if(is_array($kind)) {
          foreach($kind as $value) {
            if($value < 0 || $value > 7) {
              $error = 1;  //入力エラー（値が0-7以外）
            }
          }
        }else{
          $error = 1;  //入力エラー（値が配列ではない）
        }
      }else{
        $error = 1;  //入力エラー（値が未定義）
      }
      
      //エラーがない場合の処理（結果の表示）

        echo '<dl class="soft">';
        echo '<dt>性別：</dt><dd>' . $gendername . '</dd>';  
        
        //年齢の値で分岐
        if($age != 8) {
          echo '<dt>年齢：</dt><dd>' . $age . '0代</dd>';
        }else{
          echo '<dt>年齢：</dt><dd>80代以上</dd>';
        }
        
        //foreach で配列の数だけ繰り返し処理
        echo '<dt>趣味：</dt>';
        echo '<dd>';
        foreach($kind as $value) {
          switch($value) {
            case 0:
              echo '犬<br>';
              break;
            case 1:
              echo '猫<br>';
              break;
            case 2:
              echo 'フェレット<br>';
              break;
            case 3:
              echo '鳥<br>';
              break;
            case 4:
              echo '爬虫類<br>';
              break;
            case 5:
              echo '魚類<br>';
              break;
            case 6:
              echo '昆虫類<br>';
              break;
            case 7:
              echo 'その他<br>';
              break;
          }
        }
        echo '</dd></dl>';
        
        $filename = 'data/data.csv';

        // 趣味の配列をカンマ区切りの文字列に変換
        $hobbiesString = implode(', ', $kind);
        $data = [$gendername, $age, $hobbiesString];
        
        // ファイルが存在しない、または空である場合のみ、ヘッダーを書き込む
        if (!file_exists($filename) || filesize($filename) == 0) {
            $headers = ['Gender', 'Age', 'Hobbies'];
            $fp = fopen($filename, 'w'); // 書き込みモードを 'w' に設定
            fputcsv($fp, $headers);
            fclose($fp);
        }
        
        // データの追記
        $fp = fopen($filename, 'a'); // 追記モード 'a' でファイルを開く
        fputcsv($fp, $data);
        fclose($fp);
      
      ?>
    </div>
    </div>
    <div class="kurukuru">
      <div class="blockk">
      <a href="result.php">
        <svg class="circleText" viewBox="0 0 100 100">
          <path id="circle" class="circleText__circle" d="M 0 50 A 50 50 0 1 1 0 51 z"/>
          <text class="circleText__text">
            <textPath xlink:href="#circle">
              ！集計結果ページへ！ ！集計結果ページへ！ 
            </textPath>
          </text>
        </svg>
        </a>
      </div>
    </div>
</body>
</html>
