<?php
	
require 'db.php';
require 'auth.php';

if ( ACCESS_CONTROL != 'public' )
	require_auth();

$name = isset($_POST['name']) ? $_POST['name'] : '';

if ( $name == '' )
{
	header('Location: index.php');
	exit;
}

$q = "INSERT INTO entities (name) VALUES ('" . mysqli_real_escape_string($db, $name) . "')";

mysqli_query($db, $q) or die(mysql_error());

$insert_id = mysqli_insert_id($db);

header("Location: view.php?id=$insert_id");
