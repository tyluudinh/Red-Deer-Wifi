<?php
if (!in_array($_SERVER['REMOTE_ADDR'], ['127.0.0.1', '192.168.1.176'])) {
    die('You are not permission');
}
?>