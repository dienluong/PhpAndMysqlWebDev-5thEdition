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
        $this -> displayTitle();
        $this -> displayKeywords();
        $this -> displayStyles();
        echo "</head>\n<body>\n";
        $this -> displayHeader();
        $this -> displayMenu($this->buttons);
        echo $this->content;
        $this -> displayFooter();
        echo "</body>\n</html>\n";
    }

    public function isURLCurrentPage($url) {
        return (strpos($_SERVER['PHP_SELF'], $url) === FALSE ?: TRUE);
    }

    public function displayTitle() {
        echo "<title>$this->title</title>";
    }

    public function displayKeywords() {
        echo "<meta name='keywords' content='$this->keywords'/>"
    }

    public function displayStyles() {
        ?>
        <link rel="stylesheet" href="styles.css">
        <?php
    }

    public function displayMenu($buttons) {
        echo '<nav>';
        foreach ($buttons as $name => $url) {
            $this->displayButton($name, $url, !$this->isURLCurrentPage($url));
        }
        echo '</nav>\n';
    }

    public function displayButton($name, $url, $active=TRUE) {
        if ($active) {
            ?>
            <div class="menuitem">
                <a href="<?=$url?>">
                    <img src="s-logo.gif" alt="" height="20" width="20" />
                    <span class="menutext"><?=$name?></span>
                </a>
            </div>
            <?php
        }
        else {
            ?>
            <div class="menuitem">
                <img src="side-logo.gif">
                <span class="menutext"><?=$name?></span>
            </div>
            <?php
        }
    }

    public function displayHeader() {
        ?>
        <!-- page header -->
        <header>
            <img src="logo.gif" alt="TLA logo" height="70" width="70" />
            <h1>TLA Consulting</h1>
        </header>
        <?php
    }

    public function displayFooter() {
        ?>
        <!-- page footer -->
        <footer>
            <p>&copy; TLA Consulting Pty Ltd.<br />
                Please see our
                <a href="legal.php">legal information page</a>.</p>
        </footer>
        <?php
    }
}
