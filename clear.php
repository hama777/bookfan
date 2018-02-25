<?php
static $filename;

if ($_POST['type'] == 1  ) {
    $datafile = "book.txt" ;
    $infofile = "bookinfo1.txt" ;
}
if ($_POST['type'] == 2  ) {
    $datafile = "book2.txt" ;
    $infofile = "bookinfo2.txt" ;
}
if ($_POST['type'] == 3  ) {
    $datafile = "book3.txt" ;
    $infofile = "bookinfo3.txt" ;
}

$fp = fopen($datafile ,"w");
fclose($fp);
$fp = fopen($infofile ,"w");
fclose($fp);

echo '<meta http-equiv="refresh" content="0;URL=book.php">' ;

?>

