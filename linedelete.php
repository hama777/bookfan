<?php

if ($_POST['type'] == 1  ) {
    $datafile = "book.txt" ;
}
if ($_POST['type'] == 2  ) {
    $datafile = "book2.txt" ;
}
if ($_POST['type'] == 3  ) {
    $datafile = "book3.txt" ;
}

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
echo '<meta http-equiv="refresh" content="0;URL=book.php">' ;

?>

