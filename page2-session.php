<?php
/**
 * Created by PhpStorm.
 * User: dysonlu
 * Date: 2018-05-20
 * Time: 12:07
 */

session_start();

echo '<h2>Page 2</h2>';
echo 'The content of $_SESSION[\'my_session_var\'] is '.$_SESSION['my_session_var'].'<br />';

unset($_SESSION['my_session_var']);
?>

<a href="page3-session.php">Next Page</a>
