<?php

/* Dossier by Steven Frank <stevenf@panic.com> */

require 'head.php';
require 'db.php';

echo "<h1>Dossier</h1>";

$result = mysqli_query($db, "SELECT * FROM entities ORDER BY name") or die(mysqli_error($db));

echo "<table>";

while ( $row = mysqli_fetch_assoc($result) )
{
	echo "<tr>";
	echo "<td>";
	echo "<a href=\"view.php?id={$row['id']}\">";
	echo "{$row['name']}";
	echo "</a>";
	echo " <span class=\"id\">[{$row['id']}]</span>";
	echo "</td>";
	echo "</tr>";
}

echo "</table>";

require 'foot.php';
