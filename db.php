<?php

require 'config.php';

session_start('dossier');
	
error_reporting(E_ALL);

$db = mysqli_connect("localhost", "dossier", "dossier") or die(mysql_error());
mysqli_select_db($db, "dossier") or die(mysql_error());

