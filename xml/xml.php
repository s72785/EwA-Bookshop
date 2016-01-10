<?php
$xml = simplexml_load_file("book.xml");

foreach ($xml->buch as $buch) {
	echo $buch->titel.' : '.$buch->barcode.' : '.$buch->autor.' : '.$buch->autorid.' : '.$buch->verlag.' : '.$buch->verlagid.'
	 : '.$buch->netto.' : '.$buch->mws.' : '.$buch->lager.' : '.$buch->autorid.' : '.$buch->gewicht.' : '.$buch->beschreibung.'
	  : '.$buch->analog.'<br />';
}
?>
