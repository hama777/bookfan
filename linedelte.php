<?php
$datafile = 'book.txt';
$tmpfile = 'booktmp.txt';
$fpdata = fopen($datafile, 'r');
$fptmp  = fopen($tmpfile, 'w');
$saveline="";
while ($line = fgets($fpdata)) {
    if ( $saveline != "" ) {
        fwrite($fptmp,$saveline );
    }
    $saveline=$line;
}
fclose($fpdata);
fclose($fptmp);
rename($tmpfile , $datafile);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
</head>
<body>
完了
<a href="book.php">戻る</a><br>
</body>
</html>
