<?php
/**
 * Created by PhpStorm.
 * User: dysonlu
 * Date: 2018-05-20
 * Time: 11:59
 */

session_start();

$_SESSION['my_session_var'] = "Hello world!";

echo '<h2>Page 1</h2>';
echo 'The content of $_SESSION[\'my_session_var\'] is '.$_SESSION['my_session_var'].'<br />';
?>

<a href="page2-session.php">Next Page</a>

