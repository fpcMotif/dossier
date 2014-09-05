<?php

function has_auth()
{
	global $db;
	
	$session_token = isset($_SESSION['session_token']) ? $_SESSION['session_token'] : '';
	$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
	
	$q = "SELECT * FROM users WHERE session_token = '" . mysqli_real_escape_string($db, $session_token) . "'";
	$result = mysqli_query($db, $q) or die(mysqli_error($db));
	
	if ( $result )
	{
		$row = mysqli_fetch_assoc($result);
		
		return ($row['username'] == $username);
	}
	else 
	{
		return false;
	}
}


function require_auth()
{
	if ( !has_auth() )	
	{
		echo 'authentication required';
		exit;
	}
}