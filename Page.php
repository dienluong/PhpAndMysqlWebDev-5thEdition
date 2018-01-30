<?php
/**
 * Created by PhpStorm.
 * User: dluong
 * Date: 1/29/2018
 * Time: 3:30 PM
 */

class Page
{
    public $content;
    public $title = 'TLA Consulting Pty Ltd';
    public $keywords = 'consulting, freelance, consultants';
    public $buttons = ['Home' => 'home.php', 'Contact' => 'contact.php', 'Services' => 'services.php', 'Site Map' => 'map.php'];

    public function __set($name, $value) {
        $this->$name = $value;
    }

    public function display() {
        echo "<html>\n<head>\n";
        $this -> DisplayTitle();
        $this -> DisplayKeywords();
        $this -> DisplayStyles();
        echo "</head>\n<body>\n";
        $this -> DisplayHeader();
        $this -> DisplayMenu($this->buttons);
        echo $this->content;
        $this -> DisplayFooter();
        echo "</body>\n</html>\n";
    }
}
