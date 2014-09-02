<?php

/* Dossier by Steven Frank <stevenf@panic.com> */

require 'head.php';
require 'db.php';
require 'auth.php';

echo "<header>Dossier</header>";

if ( ACCESS_CONTROL == 'private' )
{
	if ( has_auth() )
	{
		echo "<a href=\"logout.php\">Log out</a>";
		echo "<p><hr>";
	}
	else
	{
		readfile('templates/login.html');
		exit;
	}
}
else if ( ACCESS_CONTROL == 'read-only' )
{
	readfile('templates/login.html');	
}

echo "<h1>Index</h1>";

echo "<h2>Entities</h2>";

$result = mysqli_query($db, "SELECT * FROM entities ORDER BY name") or die(mysqli_error($db));

echo "<ul>";

while ( $row = mysqli_fetch_assoc($result) )
{
	echo "<li>";
	echo "<a href=\"view.php?id={$row['id']}\">";
	echo "{$row['name']}";
	echo "</a>";
//	echo " <span class=\"id\">[{$row['id']}]</span>";
	echo "</li>";
}

echo "</ul>";

if ( ACCESS_CONTROL == 'public' 
	|| (ACCESS_CONTROL == 'read-only' && has_auth()) 
	|| (ACCESS_CONTROL == 'private' && has_auth()) )
{	
	echo "<form method=\"post\" action=\"addent.php\">";
	echo "<input type=\"text\" name=\"name\">";
	echo "<input type=\"submit\" value=\"Add Entity\">";
	echo "</form>";
}

require 'foot.php';
