<?php
if (isset($_GET['range'])) {
    file_put_contents("/var/www/html/range.txt", intval($_GET['range']));
}