<?php
/**
 * Created by PhpStorm.
 * User: dysonlu
 * Date: 2018-05-21
 * Time: 14:34
 */
$list_extensions = get_loaded_extensions();
echo "<ol>\n";
foreach ($list_extensions as $ext) {
    echo "<li>$ext</li>\n";
    $list_funcs = get_extension_funcs($ext);
    echo "<ul>\n";
    foreach ($list_funcs as $func) {
        echo "<li>$func</li>\n";
    }
    echo "</ul>\n";
}
echo "</ol>\n";
