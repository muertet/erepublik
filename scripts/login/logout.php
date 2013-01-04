<?php
include_once("../../includes/config.php");

setcookie ("chk", "", time() - 3600);
setcookie ("chk2", "", time() - 3600);
session_destroy();

header('Location: /');

?>