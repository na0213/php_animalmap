<!DOCTYPE html>
<html>
<head>
    <title>アンケート結果</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1"></script>
    <link rel="stylesheet" type="text/css" href="css/result.css">
</head>
<body>
<div class="box-wrapper">
  <div class="back">
    <section class="container">
        <div class="circlet">
            <a href="top.html" style="text-decoration: none;">
            <div class="circle-2">
                <p class="circle1">いろいろ<br>どうぶつ</p>
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

<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
// CSVファイルの指定
$filename = 'data/data.csv';

// ファイルを開く
if (!file_exists($filename) || !($fp = fopen($filename, 'r'))) {
    exit('ファイルがないか異常があります。');
}

// 集計用の配列を準備
$genderCount = ['男性' => 0, '女性' => 0];
$ageCount = array_fill(1, 8, 0);  // 1から8までのキーを持つ配列
$kindCount = [];  // 趣味の集計用

// 趣味の名前のマッピング
$kindNames = array(
  0 => "犬",
  1 => "猫",
  2 => "フェレット",
  3 => "鳥",
  4 => "爬虫類",
  5 => "魚類",
  6 => "昆虫類",
  7 => "その他"
);

// ファイルの読み込みと集計
fgetcsv($fp); // ヘッダー行を読み飛ばす
while ($row = fgetcsv($fp)) {
    // 性別の集計
    if (isset($genderCount[$row[0]])) {
        $genderCount[$row[0]]++;
    }

    // 年齢の集計
    $age = (int) $row[1];
    if ($age >= 1 && $age <= 8) {
        $ageCount[$age]++;
    }

    // 趣味の集計
    $kinds = explode(', ', $row[2]);
    foreach ($kinds as $kind) {
        if (!isset($kindCount[$kind])) {
            $kindCount[$kind] = 0;
        }
        $kindCount[$kind]++;
    }
}
fclose($fp);

// 集計結果の表示
?>
<div class="center">
<div class="answer">
    <table class="table">
      <tr>
        <th class="gender-table">性別</th>
        <td class="gender-table">男性：<?php echo $genderCount['男性']; ?>人</td>
        <td class="gender-table">女性：<?php echo $genderCount['女性']; ?>人</td>
      </tr>
      <tr>
        <th>年齢</th>
        <td>
          <?php
          for ($i = 1; $i <= 8; $i++) {
              echo ($i == 8 ? "80代以上" : $i . "0代") . "<br>";
          }
          ?>
        </td>
        <td>
          <?php
          for ($i = 1; $i <= 8; $i++) {
              echo $ageCount[$i] . "人<br>";
          }
          ?>
        </td>
      </tr>
      <tr>
        <th>ペット</th>
        <td>
          <?php
            foreach ($kindCount as $kind => $count) {
              $kindName = isset($kindNames[$kind]) ? $kindNames[$kind] : "未定義";
              echo htmlspecialchars($kindName) . "<br>";
            }
          ?>
        </td>
        <td>
          <?php
            foreach ($kindCount as $kind => $count) {
              $kindName = isset($kindNames[$kind]) ? $kindNames[$kind] : "未定義";
              echo $count . "人<br>";
            }
          ?>
        </td>
      </tr>
    </table>
  </div>
</div>
<div class="chart-canvas">
  <canvas id="pet-chart" width="500" height="500"></canvas>
</div>

<script>
let kindNames = <?php echo json_encode($kindNames); ?>;
let kindCounts = <?php echo json_encode($kindCount); ?>;
</script>
<!-- jquery が先！必須！必ず！ -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- jqueryを先に読み込んでから作成したものを読み込む -->
<script src="js/main.js"></script>
</body>
</html>