<?php
$datafile = 'book.txt';
$pagefile = 'page.txt';
function h($s) {
    return htmlspecialchars($s,ENT_QUOTES, 'UTF-8');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' &&
    $_POST['formtype'] =='newbook') {
        $fp = fopen($pagefile ,"w");
        fwrite($fp, $_POST['totalpage']."\n" );
        fwrite($fp, $_POST['bookname']."\n" );
        fclose($fp);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' &&
    isset($_POST['ckdate']) &&
    trim($_POST['page']) != 0  ) {
    
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
$posts = file($datafile, FILE_IGNORE_NEW_LINES);
$fppage = fopen($pagefile, 'r');
$totalpage =  fgets($fppage);
$bookname =  fgets($fppage);
fclose($fppage);

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
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

    </style>
</head>
<body  onload="init()">
    <h1>BookFan 1.1</h1>
    <ul class="menu">
        <li><a href="newbook.php">新規</a><br></li>
        <li><a href="linedelete.php">1行削除</a></li>
        <li><a href="clear.php">全クリア</a></li>
    </ul>
    <br>
    <form action="" method="post">
        date: <input type="text" name="ckdate" size="5">
        page: <input type="text" name="page" size="5">
        <input type="submit" value="投稿">
    </form>

    <h2>Status</h2>
    <?php echo($bookname) ; ?>
     / 総ページ数 
    <?php echo($totalpage) ; ?><br>
    <ul>
        <?php if (count($posts)) : ?>
            <?php $page = 0; ?>
            <table><tr><th>日付</th><th>ページ</th><th>増分</th><th>残り</th><th>進捗</th></tr>
            <?php foreach ($posts as $post) : ?>
                <?php $prev_page = $page; 
                list($ckdate, $page)=explode("\t",$post);?>
                <tr>
                <td><?php echo h($ckdate); ?></td><td><?php echo h($page); ?></td>
                <td><?php echo ($page - $prev_page) ; ?></td>
                <td><?php echo ($totalpage - $page) ; ?></td>
                <?php $rate =  (int)($page * 100 / $totalpage) ; ?>
                <td><?php echo $rate ; ?></td>
                </tr>
            <?php endforeach; ?>
            </table>
        <?php else : ?>
            <li>なし</li>
        <?php endif; ?>
    </ul>
<canvas id="first" width="500" height="500"></canvas>
<script>
var canvas = document.getElementById('first');
var ctx    = canvas.getContext('2d');
function init(){
//        var datalen = document.getElementById("datalen").value;
    var datalen =  <?php echo json_encode($rate); ?>; 
    //    alert(datalen);
    datalen=datalen*2;
    var grad  = ctx.createLinearGradient(20,0,200,0);
    grad.addColorStop(0,'green');
    grad.addColorStop(1,'yellow');
	ctx.rect(20, 20, 200, 20);  // x,y,幅,高さ
	ctx.lineWidth = 1;
	ctx.stroke();	
//	ctx.fillStyle = "blue";
	ctx.fillStyle = grad;
	ctx.fillRect(20, 20, datalen, 20);  // x,y,幅,高さ
}
</script>
</body>
</html>
