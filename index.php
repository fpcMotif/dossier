<?php

/* Dossier by Steven Frank <stevenf@panic.com> */

require 'head.php';
require 'db.php';

echo "<header>Dossier</header>";

require 'auth.php';

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
	echo " <span class=\"id\">[{$row['id']}]</span>";
	echo "</li>";
}

echo "</ul>";

echo "<form method=\"post\" action=\"addent.php\">";
echo "<input type=\"text\" name=\"name\">";
echo "<input type=\"submit\" value=\"Add Entity\">";
echo "</form>";

require 'foot.php';
