<?php

require 'db.php';

if ( isset($_SESSION['username']) && isset($_SESSION['session_token']) )
{
	mysqli_query($db, "UPDATE users SET session_token = '' WHERE username = '" . mysqli_real_escape_string($db, $_SESSION['username']) . "' AND session_token = '" . mysqli_real_escape_string($db, $_SESSION['session_token']) . "'") or die(mysql_error($db));
}
	
$_SESSION['username'] = '';
$_SESSION['session_token'] = '';

session_destroy();

header('Location: index.php');
exit;
