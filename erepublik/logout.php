<?php
include_once('bootstrap.php');

session_destroy();

header('Location: http://'.Config::get('domain'));
?>