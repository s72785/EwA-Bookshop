<?php
mysql_connect("localhost", "G05", "xxx") or
    die("Keine Verbindung möglich: " . mysql_error());
mysql_select_db("g05");

$result = mysql_query("SELECT bu.id as id, barcode, titel, au.name as autor FROM buecher as bu join autor as au On au.id=bu.autorid");

if($result === FALSE) { 
    die(mysql_error()); // TODO: better error handling
}

echo "<table border=\"1\">";
while ($row = mysql_fetch_array($result)) {
    echo "<tr>";
    echo "<td>".$row['barcode']."</td>";
    echo "<td><h2><a href=\"details.php?id=".$row['id']."\">".$row['titel']."</a></h2></td>";
    echo "<td>".$row['autor']."</td>";
    echo "</tr>";
}
echo "</table>";  


mysql_free_result($result);
?>
