<?php

/* Dossier by Steven Frank <stevenf@panic.com> */

require 'head.php';
require 'db.php';
require 'auth.php';

echo "<header><a href=\"index.php\">Dossier</a></header>\n";

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

$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';
$sql_id = mysqli_real_escape_string($db, $id);

$k = isset($_REQUEST['k']) ? $_REQUEST['k'] : '';
$sql_k = mysqli_real_escape_string($db, $k);

$v = isset($_REQUEST['v']) ? $_REQUEST['v'] : '';
$sql_v = mysqli_real_escape_string($db, $v);

if ( $id == '' && $k != '' && $v != '' )
{
	// K&V lookup
	
	echo "<h1>"; 
	echo htmlentities("Records where $k=$v");
	echo "</h1>";
	
	$result = mysqli_query($db, "SELECT * FROM entities AS e LEFT JOIN properties AS p ON e.id = p.entity_id WHERE p.`key` = '$sql_k' AND p.`value` = '$sql_v' ORDER BY name");

	echo "<ul>";
	
	while ( $row = mysqli_fetch_assoc($result) )
	{
		echo "<li>";
		
		echo "<a href=\"view.php?id=";
		echo rawurlencode($row['entity_id']);
		echo "\">";
		echo htmlentities($row['name']);
		echo "</a>";
				
		if ( $row['extra'] != '' )
			echo "<br><span class=\"extra\">" . htmlentities($row['extra']) . "</span>";

		echo "</li>";
	}

	echo "</ul>";
	
	$sql_name = mysqli_real_escape_string($db, $v);
	
	$result = mysqli_query($db, "SELECT * FROM entities WHERE name = '$sql_name' ORDER BY name");
	
	$row_count = 0;
	
	while ( ($row = mysqli_fetch_assoc($result)) != null )
	{
		if ( $row_count == 0 )
		{
			echo "<p><hr>";
			echo "<h2>Exact match:</h2>";
			echo "<ul>";
		}
		
		++$row_count;
		
		echo "<li>";
		echo "<a href=\"view.php?id=";
		echo rawurlencode($row['id']);
		echo "\">";
		echo htmlentities($row['name']);
		echo "</a>";
		echo "</li>\n";
	}
	
	if ( $row_count > 0 )
	{
		echo "</ul>";
	}
}
else if ( $id == '' && $k != '' && $v == '' )
{
	// Key-only lookup

	echo "<h1>"; 
	echo htmlentities("Records with key '$k'");
	echo "</h1>";

	$result = mysqli_query($db, "SELECT * FROM entities AS e LEFT JOIN properties AS p ON e.id = p.entity_id WHERE p.`key` = '$sql_k' ORDER BY e.name");

	echo "<ul>";
	
	while ( ($row = mysqli_fetch_assoc($result)) != null )
	{
		echo "<li>";
		
		echo "<a href=\"view.php?id=";
		echo rawurlencode($row['entity_id']);
		echo "\">";
		echo htmlentities($row['name']);
		echo "</a>";
				
		echo ": {$row['value']}";
		
		if ( $row['extra'] != '' )
			echo "<br><span class=\"extra\">" . htmlentities($row['extra']) . "</span>";

		echo "</li>";
	}

	echo "</ul>";
}
else 
{
	// id lookup
	
	$result = mysqli_query($db, "SELECT * FROM entities WHERE id = $sql_id") or die(mysqli_error($db));
	
	$row = mysqli_fetch_assoc($result);

	echo "<h1>"; 
	echo htmlentities($row['name']);
	echo "</h1>";

	$sql_value = mysqli_real_escape_string($db, $row['name']);
		
	$result = mysqli_query($db, "SELECT * FROM properties WHERE entity_id = $sql_id ORDER BY `key`") or die(mysqli_error($db));
	
	$prop_count = 0;
	
	while ( ($row = mysqli_fetch_assoc($result)) != null )
	{
		if ( $prop_count == 0 )
		{
			echo "<table>";	
		}
		
		++$prop_count;
		
		echo "<tr>";
		echo "<td class=\"key\">";
		echo "<a href=\"view.php?k=";
		echo htmlentities($row['key']);
		echo "\">{$row['key']}</a>";
		echo ": ";
		echo "</td>";
		echo "<td>";
		echo "<a href=\"view.php?k=";
		echo rawurlencode($row['key']);
		echo "&v=";
		echo rawurlencode($row['value']);
		echo "\">";
		echo htmlentities($row['value']);
		echo "</a>";
		
		if ( ACCESS_CONTROL == 'public' 
				|| (ACCESS_CONTROL == 'read-only' && has_auth()) 
				|| (ACCESS_CONTROL == 'private' && has_auth()) )
		{	
			echo "&nbsp;&nbsp;<a class=\"delete_link\" href=\"delprop.php?prop_id={$row['id']}&entity_id={$row['entity_id']}\">[x]</a>";
		}
		
		if ( $row['extra'] != '' )
			echo "<br><span class=\"extra\">" . htmlentities($row['extra']) . "</span>";
			
		echo "</td>";
		echo "</tr>\n";
	}
	
	if ( $prop_count > 0 )
	{
		echo "</table>";
	}
	else
	{
		echo "No properties found.";
	}
	
	if ( ACCESS_CONTROL == 'public' 
			|| (ACCESS_CONTROL == 'read-only' && has_auth()) 
			|| (ACCESS_CONTROL == 'private' && has_auth()) )
	{	
		echo "<p>";
		echo "<form method=\"post\" action=\"addprop.php\">";
		echo "<input type=\"hidden\" name=\"id\" value=\"$id\">";
		echo "Key: <input type=\"text\" name=\"key\">";
		echo "Value: <input type=\"text\" name=\"value\">";
		echo "<br>Extra: <input type=\"text\" name=\"extra\">";
		echo "<input type=\"submit\" value=\"Add Property\">";
		echo "</form>";
	}
	
	$related_count = 0;	

	$result = mysqli_query($db, "SELECT * FROM entities AS e LEFT JOIN properties AS p ON e.id = p.entity_id WHERE p.value='$sql_value'");
			
	while ( ($row = mysqli_fetch_assoc($result)) != null )
	{
		if ( $related_count == 0 )
		{
			echo "<p><hr>";
			echo "<h2>Related records:</h2>";
			echo "<ul>";
		}
		
		++$related_count;
		
		echo "<li>";
		echo "<a href=\"view.php?id=";
		echo rawurlencode($row['entity_id']);
		echo "\">";
		echo htmlentities($row['name']);
		echo "</a>";
		echo "</li>\n";
	}
	
	if ( $related_count > 0 )
	{
		echo "</ul>";
	}

	if ( ACCESS_CONTROL == 'public' 
			|| (ACCESS_CONTROL == 'read-only' && has_auth()) 
			|| (ACCESS_CONTROL == 'private' && has_auth()) )
	{	
		echo "<p><hr>";
		echo "<form method=\"post\" action=\"addent.php\">";
		echo "<input type=\"text\" name=\"name\">";
		echo "<input type=\"submit\" value=\"Add Entity\">";
		echo "</form>";
	}
}	

require 'foot.php';
