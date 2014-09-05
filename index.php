<?php

/* Dossier by Steven Frank <stevenf@panic.com> */

require 'head.php';
require 'db.php';
require 'auth.php';

echo "<header><a href=\"index.php\">Dossier</a>";

if ( ACCESS_CONTROL == 'private' )
{
	if ( has_auth() )
	{
		echo " : <a href=\"logout.php\">Log out</a>";
	}
	else
	{
		echo "</header>";
		readfile('templates/login.html');
		exit;
	}
}
else if ( ACCESS_CONTROL == 'read-only' )
{
	echo "</header>";
	readfile('templates/login.html');	
}

echo "</header>";
echo "<h1>Index</h1>";

$result = mysqli_query($db, "SELECT * FROM entities ORDER BY name") or die(mysqli_error($db));

echo "<table>";

while ( $row = mysqli_fetch_assoc($result) )
{
	echo "<tr><td>";
	echo "<a href=\"view.php?id={$row['id']}\">";
	echo "{$row['name']}";
	echo "</a>";
	echo "</td></tr>\n";
}

echo "</table>";

if ( ACCESS_CONTROL == 'public' 
		|| (ACCESS_CONTROL == 'read-only' && has_auth()) 
		|| (ACCESS_CONTROL == 'private' && has_auth()) )
{	
	echo "<h2>Add entity</h2>";
	echo "<form method=\"post\" action=\"addent.php\">";
	echo "<input type=\"text\" name=\"name\">";
	echo "<input type=\"submit\" value=\"Add Entity\">";
	echo "</form>";
}

require 'foot.php';
