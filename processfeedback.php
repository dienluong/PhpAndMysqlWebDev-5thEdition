<?php
/**
 * Created by PhpStorm.
 * User: dysonlu
 * Date: 2018-01-22
 * Time: 17:26
 */

$name = trim($_POST['yourName']) ?: NULL;
$email = trim($_POST['yourEmail']) ?: NULL;
$feedback = trim($_POST['yourFeedback']) ?: NULL;
$sent = FALSE;
if (isset($name, $email, $feedback)) {
    $fromHeader = "From: mamp@example.com";
    $toAddress = "dysonlu0@gmail.com";
    $emailSubject = "Feedback from $email";
    // remove \r\n for security reasons.
    $emailContent = str_replace("\r\n", "","Customer: \"$name\"\nEmail: \"$email\"\nComment: \"$feedback\"\n");
    if ($email) {
        $emailExploded = explode('@', $email);
        if ($emailExploded[1] === 'bigcustomer.com') {
            $emailSubject = "IMPORTANT: Feedback from $email";
        }
    }
    if (mail($toAddress, $emailSubject, $emailContent, $fromHeader)) {
        $sent = TRUE;
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Feedback Submit</title>
</head>
<body>
<?php
if ($sent) {
    echo "<h1>Feedback Submitted</h1>";
    echo "<p>Your feedback has been sent.</p>";
    echo nl2br(htmlentities($emailContent));
}
else {
    echo "<h1>Feedback Not Submitted</h1>";
    echo "<p>Cannot submit: fields cannot be left blank.";
}
?>
</body>
</html>
