<?php

require 'db.php';
require 'bcrypt.php';

$username = $_POST['username'] ? $_POST['username'] : '';
$password = $_POST['password'] ? $_POST['password'] : '';

if ( $username != '' && $password != '' )
{
	$password_hash = bcrypt_hash($password);
	
	$result = mysqli_query($db, "SELECT password_hash FROM users WHERE username = '" . mysqli_real_escape_string($db, $username) . "'");
	
	if ( $result )
	{
		$row = mysqli_fetch_assoc($result);
		
		if ( bcrypt_check($password, $row['password_hash']) )
		{
			$session_token = bcrypt_hash(session_id());
			
			mysqli_query($db, "UPDATE users SET session_token = '" . mysqli_real_escape_string($db, $session_token) . "' WHERE username = '" . mysqli_real_escape_string($db, $username) . "'") or die(mysqli_error($db));
			
			$_SESSION['session_token'] = $session_token;
			$_SESSION['username'] = $username;
			
			header('Location: index.php');
			exit;
		}
		else
		{
			header('Location: index.php');
			exit;
		}
	}
	else
	{
		header('Location: index.php');
		exit;
	}
}

