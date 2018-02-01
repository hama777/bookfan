<?php
static $filename;

if ($_POST['type'] == 1  ) {
    $filename = "bookinfo1.txt" ;
}
if ($_POST['type'] == 2  ) {
    $filename = "bookinfo2.txt" ;
}
if ($_POST['type'] == 3  ) {
    $filename = "bookinfo3.txt" ;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' ) {
        $fp = fopen($filename ,"w");
        fwrite($fp, $_POST['totalpage']."\n" );
        fwrite($fp, $_POST['bookname']."\n" );
        fclose($fp);
        if ($_POST['totalpage'] != ""  ) {
            echo '<meta http-equiv="refresh" content="0;URL=book.php">' ;
        }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
</head>
<body>
    <form action="" method="post">
        書名 : <input type="text" name="bookname"><br>
        ページ数: <input type="text" name="totalpage"><br>
          <input type="hidden" name="type" value=<?php echo $_POST['type']; ?>>
        <input type="submit" value="ok">
    </form>
</body>
</html>
