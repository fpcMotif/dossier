<?php

/* Dossier by Steven Frank <stevenf@panic.com> */

require 'head.php';
require 'db.php';

echo "<h1><a href=\"index.php\">Dossier</a></h1>\n";

$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';
$sql_id = mysqli_real_escape_string($db, $id);

$k = isset($_REQUEST['k']) ? $_REQUEST['k'] : '';
$sql_k = mysqli_real_escape_string($db, $k);

$v = isset($_REQUEST['v']) ? $_REQUEST['v'] : '';
$sql_v = mysqli_real_escape_string($db, $v);

if ( $id == '' && $k != '' && v != '' )
{
	// K&V lookup
	
	echo "<h2>"; 
	echo htmlentities("$k: $v");
	echo "</h2>";
	
	$result = mysqli_query($db, "SELECT * FROM entities AS e LEFT JOIN properties AS p ON e.id = p.entity_id WHERE p.`key` = '$sql_k' AND p.`value` = '$sql_v' ORDER BY name");

	echo "<table>";
	
	while ( $row = mysqli_fetch_assoc($result) )
	{
		echo "<tr>";
		echo "<td>";
		echo "<a href=\"view.php?id=";
		echo rawurlencode($row['entity_id']);
		echo "\">";
		echo htmlentities($row['name']);
		echo "</a>";
		echo " <span class=\"id\">[{$row['entity_id']}]</span>";
		if ( $row['extra'] != '' )
			echo "<br>" . htmlentities($row['extra']);
		echo "</td>";
		echo "</tr>\n";
	}

	echo "</table>";

	$sql_name = mysqli_real_escape_string($db, $v);
	
	$result = mysqli_query($db, "SELECT * FROM entities WHERE name = '$sql_name' ORDER BY name");

	echo "<table>";
	
	while ( $row = mysqli_fetch_assoc($result) )
	{
		echo "<tr>";
		echo "<td>";
		echo "<a href=\"view.php?id=";
		echo rawurlencode($row['id']);
		echo "\">";
		echo htmlentities($row['name']);
		echo "</a>";
		echo " <span class=\"id\">[{$row['id']}]</span>";
		if ( $row['extra'] != '' )
			echo "<br>" . htmlentities($row['extra']);
		echo "</td>";
		echo "</tr>\n";
	}

	echo "</table>";
}
else 
{
	// id lookup
	
	$result = mysqli_query($db, "SELECT * FROM entities WHERE id = $sql_id") or die(mysqli_error($db));
	
	$row = mysqli_fetch_assoc($result);

	echo "<h1>"; 
	echo htmlentities($row['name']);
	echo " <span class=\"id\">[{$row['id']}]</span>";
	echo "</h1>";

	$sql_value = mysqli_real_escape_string($db, $row['name']);
		
	$result = mysqli_query($db, "SELECT * FROM properties WHERE entity_id = $sql_id ORDER BY `key`") or die(mysqli_error($db));
	
	echo "<table>";
	
	while ( $row = mysqli_fetch_assoc($result) )
	{
		echo "<tr>";
		echo "<td class=\"key\">";
		echo htmlentities($row['key']) . ": ";
		echo "</td>";
		echo "<td>";
		echo "<a href=\"view.php?k=";
		echo rawurlencode($row['key']);
		echo "&v=";
		echo rawurlencode($row['value']);
		echo "\">";
		echo htmlentities($row['value']);
		echo "</a>";
		if ( $row['extra'] != '' )
			echo "<br>" . htmlentities($row['extra']);
		echo "</td>";
		echo "</tr>\n";
	}
	
	echo "</table>";
	
	echo "<p>";

	$result = mysqli_query($db, "SELECT * FROM entities AS e LEFT JOIN properties AS p ON e.id = p.entity_id WHERE p.value='$sql_value'");
	
	echo "<table>";
	
	while ( $row = mysqli_fetch_assoc($result) )
	{
		echo "<tr>";
		echo "<td>";
		echo "<a href=\"view.php?id=";
		echo rawurlencode($row['entity_id']);
		echo "\">";
		echo htmlentities($row['name']);
		echo "</a>";
		echo " <span class=\"id\">[{$row['entity_id']}]</span>";
		echo "</td>";
		echo "</tr>\n";
	}
	
	echo "</table>";

}	

require 'foot.php';
