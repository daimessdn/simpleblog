<?php

require_once("../../config/index.config.php");

require_once("../../includes/dashboard/nav.includes.php");

?>

<?php
session_unset();
session_destroy();

header("location:../../index.php");
?>