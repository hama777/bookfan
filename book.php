<?php
$datafile = 'book.txt';
$pagefile = 'page.txt';
function h($s) {
    return htmlspecialchars($s,ENT_QUOTES, 'UTF-8');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' &&
    $_POST['formtype'] =='newbook') {
    
        $fp = fopen($pagefile ,"w");
        fwrite($fp, $_POST['totalpage'] );
        fclose($fp);
    }

if ($_SERVER['REQUEST_METHOD'] == 'POST' &&
    isset($_POST['ckdate']) &&
    isset($_POST['page'])) {
    
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
fclose($fppage);

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <STYLE TYPE="Text/css">
    h1 {
        font-size: 15px;
    }
    h2 {
        font-size: 13px;
    }
    table, td, th { 
        font-family: "Meiryo UI" ; 
        font-size: 13px; 
        border: 1px #1C79C6 solid;  
        border-collapse: collapse; 
        padding: 3px; 
    }
    th { background-color :#68c672; }
    tr:nth-child(2n+1)  { 
        background-color : #e8ffe2  
    }
    </style>
</head>
<body>
    <h1>BookFan</h1>
    <form action="" method="post">
        date: <input type="text" name="ckdate">
        page: <input type="text" name="page">
        <input type="submit" value="投稿">
    </form>
    <a href="newbook.php">新規</a><br>
    <a href="clear.php">データクリア</a><br>
    
    <h2>Status</h2>
    総ページ数
    <?php echo($totalpage) ; ?><br>
    <ul>
        <?php if (count($posts)) : ?>
            <?php $page = 0; ?>
            <table><tr><th>日付</th><th>ページ</th><th>増分</th><th>残り</th></tr>
            <?php foreach ($posts as $post) : ?>
                <?php $prev_page = $page; 
                list($ckdate, $page)=explode("\t",$post);?>
                <tr>
                <td><?php echo h($ckdate); ?></td><td><?php echo h($page); ?></td>
                <td><?php echo ($page - $prev_page) ; ?></td>
                <td><?php echo ($totalpage - $page) ; ?></td>
                </tr>
            <?php endforeach; ?>
            </table>
        <?php else : ?>
            <li>なし</li>
        <?php endif; ?>
    </ul>
</body>
</html>