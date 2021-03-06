<?php
	
require 'db.php';
require 'auth.php';

if ( ACCESS_CONTROL != 'public' )
	require_auth();

$id = isset($_POST['id']) ? $_POST['id'] : '';
$key = isset($_POST['key']) ? $_POST['key'] : '';
$value = isset($_POST['value']) ? $_POST['value'] : '';
$extra = isset($_POST['extra']) ? $_POST['extra'] : '';

$sql_key = mysqli_real_escape_string($db, $key);
$sql_value = mysqli_real_escape_string($db, $value);
$sql_extra = mysqli_real_escape_string($db, $extra);

$id = preg_replace('/[^0-9]/', '', $id);

if ( $id == '' )
{
	header('Location: index.php');
	exit;
}

if ( $key == '' || $value == '' )
{
	header("Location: view.php?id=$id");
	exit;
}

$q = "INSERT INTO properties (entity_id, `key`, value, extra) VALUES ($id, '$sql_key', '$sql_value', '$sql_extra')";

mysqli_query($db, $q) or die(mysql_error());

header("Location: view.php?id=$id");
