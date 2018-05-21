<?php
/**
 * Created by PhpStorm.
 * User: dysonlu
 * Date: 2018-05-20
 * Time: 12:21
 */

echo '<h2>Page 3</h2>';
echo 'The content of $_SESSION[\'my_session_var\'] is '.$_SESSION['my_session_var'].'<br />';

session_destroy();
