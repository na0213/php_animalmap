<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/user.css">
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
    <div class="qa">
        <div class="qa1"></div>

        <div class="qa2">
            <form action="confirm.php" method="post">
                <div id="contents_wrap">
                    <div id="formWrap">
                    <div class="form_inner">
                        <table class="formTable">
                        <tr>
                            <th>性　別</th>
                            <td><input type="radio" name="gender" id="male" value="1"> 男　
                            <input type="radio" name="gender" id="female"  value="2"> 女 </td>
                        </tr>

                        <tr>
                            <th>年　齢</th>
                            <td>
                                <select name="age" id="age">
                                <option value="0" selected>-選択-</option>
                                <?php
                                for($num = 1; $num <= 7; $num++) {
                                echo '<option value="' . $num . '">' . $num . '0代</option>' . "\n";
                                }
                                ?>
                                <option value="8">80代以上</option>
                                </select> <span class="form_require">※必須</span>
                            </td>
                        </tr>
                        <tr>
                            <th>ペットの種類</th>
                            <td>
                            <?php
                                $kind = array(0 => "犬",
                                            1 => "猫",
                                            2 => "フェレット",
                                            3 => "鳥",
                                            4 => "爬虫類",
                                            5 => "魚類",
                                            6 => "昆虫類",
                                            7 => "その他");
                                $ids = array('dog', 'cat', 'ferret', 'bird', 'reptiles', 'fish', 'insect', 'other');
                                foreach($kind as $key => $value) {
                                echo '<label for="' . $ids[$key] .'"><input type="checkbox" name="kind[]" value="' 
                                .$key . '" id="' . $ids[$key] . '">' . $value . '</label>' . "\n";
                                }
                            ?>
                            </td>
                        </tr>

                        </table>
                        <p align="center">
                        <input type="submit" value="　 送信 　" />
                        </p>
                    </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="qa3"></div>
    </div>
    <div class="move">
        <a href="result.php" class="btn_11">結果をみる！</a>
    </div>
    <!-- jquery が先！必須！必ず！ -->
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
  <!-- jqueryを先に読み込んでから作成したものを読み込む -->
  <!-- <script src="js/main.js"></script> -->
</body>
</html>