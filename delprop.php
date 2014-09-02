<?php

require 'db.php';
require 'auth.php';

if ( ACCESS_CONTROL != 'public' )
	require_auth();

$entity_id = isset($_REQUEST['entity_id']) ? $_REQUEST['entity_id'] : '';
$prop_id = isset($_REQUEST['prop_id']) ? $_REQUEST['prop_id'] : '';

$prop_id = preg_replace('/[^0-9]/', '', $prop_id);

if ( $prop_id == '' )
{
	header('Location: index.php');
	exit;
}

mysqli_query($db, "DELETE FROM properties WHERE id = $prop_id");

header("Location: view.php?id=$entity_id");