<?php
require 'header.php';
?>
<h1>Bob's Auto Parts</h1>
<h2>Order Results</h2>
<?php
define('TIREPRICE', 100);
define('OILPRICE', 10);
define('SPARKPRICE', 4);
define('TAXRATE', 0.1);

$documentRoot = $_SERVER['DOCUMENT_ROOT'];
$tireqty = (int) $_POST['tireqty'] ?: 0;
$oilqty = (int) $_POST['oilqty'] ?: 0;
$sparkqty = (int) $_POST['sparkqty'] ?: 0;
$totalqty = $oilqty + $sparkqty + $tireqty;
$subtotal = $oilqty*OILPRICE + $tireqty*TIREPRICE + $sparkqty*SPARKPRICE;
$grandtotal = $subtotal * (1 + TAXRATE);
$address = $_POST['address'];
$date = date("H:i, jS F Y");

function handlingWarning($errno, $errstr) {
    if ($errno === E_WARNING) {
        echo "WARNING: $errstr.";
        return true;
    }
    else {
        return false;
    }
}

if (!$totalqty) {
    echo '<p style="color: red">';
    echo 'No quantity specified.<br />';
    echo '</p>';
}
else {
    $discount = 0;
    if ($tireqty >= 100) {
        $discount = 15;
    }
    elseif ($tireqty >= 50) {
        $discount = 10;
    }
    elseif ($tireqty >= 10) {
        $discount = 5;
    }

    echo '<p>You ordered:</p>';
    echo htmlspecialchars($tireqty) . ' tire(s) ($' . TIREPRICE . ' each)<br />';
    echo htmlspecialchars($oilqty) . ' bottle(s) of oil ($' . OILPRICE . ' each)<br />';
    echo htmlspecialchars($sparkqty) . ' spark plug(s) ($' . SPARKPRICE . ' each)<br />';
    echo '<p>Total items: ' . $totalqty . '</p>';
    echo '<p>Subtotal: $' . number_format($subtotal, 2) . '</p>';

    $taxRate = TAXRATE * 100;
    echo "<p>Total (plus $taxRate% tax): $" . number_format($grandtotal, 2) . '</p>';

    if ($discount) {
        echo "Congrats! You qualified for a $discount% cash-back!";
    }

    set_error_handler("handlingWarning");
    $fp = fopen("$documentRoot/BobStoreOrderArchive/orders.txt", "ab");
    if (!$fp) {
        echo '<p><strong>Unable to open file. Order could not be processed.</strong></p>';
        exit;
    }

    flock($fp, LOCK_EX);
    $outputString = "$date\ttires: $tireqty\toil: $oilqty\tspark plugs: $sparkqty\ttotal: $grandtotal\taddress: $address\n";
    fwrite($fp, $outputString, strlen($outputString));
    flock($fp, LOCK_UN);
    fclose($fp);

    echo "<p>Order processed at " . $date . "</p>";
}
?>
<?php
require 'footer.php';
?>
