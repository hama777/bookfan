<?php
static $filename;

if ($_POST['type'] == 1  ) {
    $datafile = "book.txt" ;
}
if ($_POST['type'] == 2  ) {
    $datafile = "book2.txt" ;
}
if ($_POST['type'] == 3  ) {
    $datafile = "book3.txt" ;
}

$fp = fopen($datafile ,"w");
fclose($fp);
echo '<meta http-equiv="refresh" content="0;URL=book.php">' ;

?>

