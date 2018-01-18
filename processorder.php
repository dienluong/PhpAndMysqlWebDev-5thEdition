<!DOCTYPE html>
<html>
<head>
    <title>Bob's Auto Parts - Order Results</title>
</head>
<body>
<h1>Bob's Auto Parts</h1>
<h2>Order Results</h2>
<?php
define('TIREPRICE', 100);
define('OILPRICE', 10);
define('SPARKPRICE', 4);
define('TAXRATE', 0.1);

$tireqty = $_POST['tireqty'] ?: 0;
$oilqty = $_POST['oilqty'] ?: 0;
$sparkqty = $_POST['sparkqty'] ?: 0;
$totalqty = $oilqty + $sparkqty + $tireqty;
$subtotal = $oilqty*OILPRICE + $tireqty*TIREPRICE + $sparkqty*SPARKPRICE;
$grandtotal = $subtotal * (1 + TAXRATE);
$address = $_POST['address'];

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

    $fp = fopen("../BobStoreOrderArchive/orders.txt", "x");
    if (!$fp) {
        echo 'Unable to open file.<br/>';
    }

    echo "<p>Order processed at " . date("H:i, jS F Y") . "</p>";
}
?>
</body>
</html>
