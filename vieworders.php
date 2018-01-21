<?php
/**
 * Created by PhpStorm.
 * User: dysonlu
 * Date: 2018-01-20
 * Time: 23:51
 */

$documentRoot = $_SERVER['DOCUMENT_ROOT'];

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bob&#39;s Auto Parts: Order Viewer</title>
</head>
<body>
<?php
    $filename = "$documentRoot/BobStoreOrderArchive/orders.txt";
    $fp = fopen($filename, 'rb');
    flock($fp, LOCK_SH);    // lock for reading

    if(!$fp) {
        echo "<p><strong>No order stored.</strong></p>";
        exit;
    }

    while (!feof($fp)) {
        $order = fgets($fp);
        echo htmlspecialchars($order).'<br/>';
    }

    // Method #2
    rewind($fp);
    echo "Method #2<br/>";
    echo nl2br(fread($fp, filesize($filename)));

    flock($fp, LOCK_UN);     // release lock
    fclose($fp);
?>
</body>
</html>
