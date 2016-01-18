<html>
	<head><title>XML Transformation mit PHP-Objekt</title>
	<style>
		.one{
			background-color: grey;
			}
		.two{
			background-color: yellow;
			}
	</style>
	</head>
<?php
$xml = simplexml_load_file("book.xml");
echo('<table>');
foreach ($xml->buch as $buch) {
	echo '<tr><th><srong>'.$buch->titel.'</srong></th></tr>'
	.'<tr class="one"><td>Barcode</td><td>'.$buch->barcode.'</td></tr>'
	.'<tr class="two"><td>Autor</td><td>'.$buch->autor.'</td><td>AID</td><td>'.$buch->autorid.'</td></tr>'
	.'<tr class="one"><td>Verlag</td><td>'.$buch->verlag.'</td><td>VID</td><td>'.$buch->verlagid.'</td></tr>'
	.'<tr class="two"><td>Preis (N)</td><td>'.$buch->netto.'</td><td>USt</td><td>'.$buch->mws.'</td></tr>'
	.'<tr class="one"><td>Lager</td><td>'.$buch->lager.'</td><td>Gewicht</td><td>'.$buch->gewicht.'</td></tr>'
	.'<tr class="two"><td>Beschreibung</td><td>'.$buch->beschreibung.'</td><td>Analog</td><td>'.$buch->analog.'</td></tr>';
}
echo('</table>');
?>
</html>