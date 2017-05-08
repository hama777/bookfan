<?php
$datafile = 'book.txt';
$pagefile = 'page.txt';

$fp = fopen($datafile ,"w");
fclose($fp);


?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
</head>
<body>
クリア完了
<a href="book.php">戻る</a><br>
</body>
</html>

