<?php
	
session_start('dossier');
	
error_reporting(E_ALL);

$db = mysqli_connect("localhost", "dossier-sample", "dossier-sample");
mysqli_select_db($db, "dossier99");

