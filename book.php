<?php
function h($s) {
    return htmlspecialchars($s,ENT_QUOTES, 'UTF-8');
}

static $datafile ="";
static  $infofile ="";

if ($_SERVER['REQUEST_METHOD'] == 'POST' &&
    $_POST['formtype'] =='newbook') {
        $fp = fopen($infofile ,"w");
        fwrite($fp, $_POST['totalpage']."\n" );
        fwrite($fp, $_POST['bookname']."\n" );
        fclose($fp);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' &&
    isset($_POST['ckdate']) &&
    trim($_POST['page']) != 0  ) {
    if ($_POST['type'] == 1 ) {

        $infofile = 'bookinfo1.txt';
        $datafile = 'book.txt' ;
    }
    if ($_POST['type'] == 2 ) {

        $infofile = 'bookinfo2.txt';
        $datafile = 'book2.txt' ;
    }
    if ($_POST['type'] == 3 ) {
        $infofile = 'bookinfo3.txt';
        $datafile = 'book3.txt' ;
    }
    
    $ckdate = trim($_POST['ckdate']);
    $page = trim($_POST['page']);

    if ($ckdate == "") {
        $ckdate = date('m/d');
    } else {
        $ckdate = date('m/d',strtotime($ckdate));
    }
    $newData = $ckdate . "\t" . $page  . "\n";
    $fp = fopen($datafile, 'a');
    fwrite($fp,$newData );
    fclose($fp);
}

$datafile = 'book.txt';
if (file_exists($datafile)){ 
    $posts1 = file($datafile, FILE_IGNORE_NEW_LINES);
} else {
    touch($datfile);
}
$datafile = 'book2.txt';
if (file_exists($datafile)){ 
    $posts2 = file($datafile, FILE_IGNORE_NEW_LINES);
} else {
    touch($datfile);
}
$datafile = 'book3.txt';
if (file_exists($datafile)){ 
    $posts3 = file($datafile, FILE_IGNORE_NEW_LINES);
} else {
    touch($datfile);
}



$infofile = 'bookinfo1.txt' ;
if (file_exists($infofile)){ 
    $fppage = fopen($infofile, 'r');
    $totalpage1 =  fgets($fppage);
    
    $bookname1 =  fgets($fppage);
fclose($fppage);
} else {
    touch($infofile);
}

$infofile = 'bookinfo2.txt' ;
if (file_exists($infofile)){ 
    $fppage = fopen($infofile, 'r');
    $totalpage2 =  fgets($fppage);
    $bookname2 =  fgets($fppage);
fclose($fppage);
} else {
    touch($infofile);
}

$infofile = 'bookinfo3.txt' ;
if (file_exists($infofile)){ 
    $fppage = fopen($infofile, 'r');
    $totalpage3 =  fgets($fppage);
    $bookname3 =  fgets($fppage);
fclose($fppage);
} else {
    touch($infofile);
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <link rel="icon" href="./favicon.ico">
    <STYLE TYPE="Text/css">
    h1 { font-size: 15px; }
    h2 { font-size: 13px; }
    table, td, th { 
        font-family: "Meiryo UI" ; 
        font-size: 13px; 
        border: 1px #1C79C6 solid;  
        border-collapse: collapse; 
        padding: 3px; 
    }
    th { background-color :#68c672; }
    td { text-align: right ;}
    tr:nth-child(2n+1)  { 
        background-color : #e8ffe2  
    }
    ul.menu {
        list-style: none;
        padding: 0;
        margin: 0;
        font-size: 0;
      }
    ul.menu li {
        display: inline-block;
      }
    ul.menu li a  {
        font-size: 14px;
        display: inline-block;
        width: 80px;
        height: 18px;
        border-radius: 10px;
        line-height: 18px;
        text-align: center;
        text-decoration: none;
        padding: 7px;
        color: #333;
    }

    .btn {
        float: left;
        font-size: 12px;
        display: inline-block;
        width: 80px;
        height: 30px;
        border-radius: 10px;
        line-height: 18px;
        text-align: center;
        text-decoration: none;
        padding: 4px;
        background : #26dd96;
        margin: 0px 4px;
    }

    .postbtn {
        font-size: 12px;
        display: inline-block;
        width: 50px;
        height: 30px;
        border-radius: 10px;
        line-height: 18px;
        text-align: center;
        text-decoration: none;
        padding: 3px;
        background : #b2b2dd;
    }

    ul.menu li:nth-child(even) a  {
        background: -webkit-gradient(linear, center top, center bottom, from(#96e8a5), to(#00cc63));
    }
    ul.menu li:nth-child(even):hover a  {
        background: #ceedc9;
    }

    ul.menu li:nth-child(odd) a  {
        background: -webkit-gradient(linear, center top, center bottom, from(#e2edbc), to(#bfed3f));
    }
    ul.menu li:nth-child(odd):hover a  {
        background: #d6efe2;
    }

    .box {
	    float: left;
        width : 300px;
        height : 600px;
        border-radius: 10px;
        border: 1px #1C79C6 solid;  
        padding: 20px 10px ; 
        margin: 1px;
    }

    .boxContainer {
	    overflow: hidden;
    }

    #one{
        background: #ccfcff;
        /*display : none;*/
    }
    #two{
        background: #ffffd8;
    }
    #three{
        background: #fce2ff;
    }

    /* clearfix */
    .boxContainer:before,
    .boxContainer:after {
        content: "";
        display: table;
    }
 
    .boxContainer:after {
        clear: both;
    }
 
    /* For IE 6/7 (trigger hasLayout) */
    .boxContainer {
        zoom: 1;
    }

    </style>
</head>
<body  onload="init()">
    <h1>BookFan 2</h1>
    <div class="boxContainer">
        <div id="one"  class="box">
            <form action="newbook.php" method="post">
                <input type="hidden" name="type" value="1">
                <input class="btn"  type="submit" value="新規">
            </form>
            <form action="linedelete.php" method="post">
                <input type="hidden" name="type" value="1">
                <input class="btn"  type="submit" value="1行削除">
            </form>
            <form action="clear.php" method="post">
                <input type="hidden" name="type" value="1">
                <input class="btn"  type="submit" value="全クリア">
            </form>
            <br><br>
            <form action="" method="post">
                date: <input type="text" name="ckdate" size="5">
                page: <input type="text" name="page" size="5">
                <input type="hidden" name="type" value="1">
                <input class="postbtn" type="submit" value="OK">
            </form>

            <h2>Status</h2>
            <?php echo($bookname1) ; ?>
             / 総ページ数 
            <?php echo($totalpage1) ; ?><br>
            <ul>
                <?php if (count($posts1)) : ?>
                    <?php $page = 0; ?>
                    <table><tr><th>日付</th><th>ページ</th><th>増分</th><th>残り</th><th>進捗</th></tr>
                    <?php foreach ($posts1 as $post) : ?>
                        <?php $prev_page = $page; 
                        list($ckdate, $page)=explode("\t",$post);?>
                        <tr>
                        <td><?php echo h($ckdate); ?></td><td><?php echo h($page); ?></td>
                        <td><?php echo ($page - $prev_page) ; ?></td>
                        <td><?php echo ($totalpage1 - $page) ; ?></td>
                        <?php $rate1 =  (int)($page * 100 / $totalpage1) ; ?>
                        <td><?php echo $rate1 ; ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </table>
                <?php else : ?>
                    <li>なし</li>
                <?php endif; ?>
            </ul>
            <canvas id="first" width="500" height="500"></canvas>
        </div>
        
        <div id="two"  class="box">
            <form action="newbook.php" method="post">
                <input type="hidden" name="type" value="2">
                <input class="btn" type="submit" value="新規">
            </form>
            <form action="linedelete.php" method="post">
                <input type="hidden" name="type" value="2">
                <input class="btn" type="submit" value="1行削除">
            </form>
            <form action="clear.php" method="post">
                <input type="hidden" name="type" value="2">
                <input class="btn" type="submit" value="全クリア">
            </form>

            <br><br>
            <form action="" method="post">
                date: <input type="text" name="ckdate" size="5">
                page: <input type="text" name="page" size="5">
                <input type="hidden" name="type" value="2">
                <input class="postbtn" type="submit" value="OK">
            </form>

            <h2>Status</h2>
            <?php echo($bookname2) ; ?>
             / 総ページ数 
            <?php echo($totalpage2) ; ?><br>
            <ul>
                <?php if (count($posts2)) : ?>
                    <?php $page = 0; ?>
                    <table><tr><th>日付</th><th>ページ</th><th>増分</th><th>残り</th><th>進捗</th></tr>
                    <?php foreach ($posts2 as $post) : ?>
                        <?php $prev_page = $page; 
                        list($ckdate, $page)=explode("\t",$post);?>
                        <tr>
                        <td><?php echo h($ckdate); ?></td><td><?php echo h($page); ?></td>
                        <td><?php echo ($page - $prev_page) ; ?></td>
                        <td><?php echo ($totalpage2 - $page) ; ?></td>
                        <?php $rate2 =  (int)($page * 100 / $totalpage2) ; ?>
                        <td><?php echo $rate2 ; ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </table>
                <?php else : ?>
                    <li>なし</li>
                <?php endif; ?>
            </ul>
            <canvas id="second" width="500" height="500"></canvas>
        </div>

        <div id="three"  class="box">
            <form action="newbook.php" method="post">
                <input type="hidden" name="type" value="3">
                <input class="btn" type="submit" value="新規">
            </form>
            <form action="linedelete.php" method="post">
                <input type="hidden" name="type" value="3">
                <input class="btn" type="submit" value="1行削除">
            </form>
            <form action="clear.php" method="post">
                <input type="hidden" name="type" value="3">
                <input class="btn" type="submit" value="全クリア">
            </form>

            <br><br>
            <form action="" method="post">
                date: <input type="text" name="ckdate" size="5">
                page: <input type="text" name="page" size="5">
                <input type="hidden" name="type" value="3">
                <input class="postbtn" type="submit" value="OK">
            </form>

            <h2>Status</h2>
            <?php echo($bookname3) ; ?>
             / 総ページ数 
            <?php echo($totalpage3) ; ?><br>
            <ul>
                <?php if (count($posts3)) : ?>
                    <?php $page = 0; ?>
                    <table><tr><th>日付</th><th>ページ</th><th>増分</th><th>残り</th><th>進捗</th></tr>
                    <?php foreach ($posts3 as $post) : ?>
                        <?php $prev_page = $page; 
                        list($ckdate, $page)=explode("\t",$post);?>
                        <tr>
                        <td><?php echo h($ckdate); ?></td><td><?php echo h($page); ?></td>
                        <td><?php echo ($page - $prev_page) ; ?></td>
                        <td><?php echo ($totalpage3 - $page) ; ?></td>
                        <?php $rate3 =  (int)($page * 100 / $totalpage3) ; ?>
                        <td><?php echo $rate3 ; ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </table>
                <?php else : ?>
                    <li>なし</li>
                <?php endif; ?>
            </ul>
            <canvas id="third" width="500" height="500"></canvas>
        </div>

<script>
var canvas = document.getElementById('first');
var ctx    = canvas.getContext('2d');

var canvas2 = document.getElementById('second');
var ctx2    = canvas2.getContext('2d');

var canvas3 = document.getElementById('third');
var ctx3    = canvas3.getContext('2d');

function init(){
//        var datalen = document.getElementById("datalen").value;
    var datalen1 =  <?php echo json_encode($rate1); ?>; 
    var datalen2 =  <?php echo json_encode($rate2); ?>; 
    var datalen3 =  <?php echo json_encode($rate3); ?>; 
    //    alert(datalen);
    datalen1=datalen1*2;
    datalen2=datalen2*2;
    datalen3=datalen3*2;
    var grad  = ctx.createLinearGradient(20,0,200,0);
    grad.addColorStop(0,'green');
    grad.addColorStop(1,'yellow');
	ctx.rect(20, 20, 200, 20);  // x,y,幅,高さ
	ctx.lineWidth = 1;
	ctx.stroke();	
	ctx.fillStyle = grad;
	ctx.fillRect(20, 20, datalen1, 20);  // x,y,幅,高さ

    var grad  = ctx2.createLinearGradient(20,0,200,0);
    grad.addColorStop(0,'green');
    grad.addColorStop(1,'yellow');
	ctx2.rect(20, 20, 200, 20);  // x,y,幅,高さ
	ctx2.lineWidth = 1;
	ctx2.stroke();	
	ctx2.fillStyle = grad;
	ctx2.fillRect(20, 20, datalen2, 20);  // x,y,幅,高さ
    
    var grad  = ctx3.createLinearGradient(20,0,200,0);
    grad.addColorStop(0,'green');
    grad.addColorStop(1,'yellow');
	ctx3.rect(20, 20, 200, 20);  // x,y,幅,高さ
	ctx3.lineWidth = 1;
	ctx3.stroke();	
	ctx3.fillStyle = grad;
	ctx3.fillRect(20, 20, datalen3, 20);  // x,y,幅,高さ
    
    
    
}
</script>
</body>
</html>
