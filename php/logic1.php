<table>
<?php

$zeilen = 13;
for( $i=0; $i<$zeilen; $i++ ) {
	echo '<tr style="background-color:'.( ($i%2) ? 'grey' : '' ) . '"><td>'.$i.'</td><td>Produkt' . $i . '</td></tr>';
}

?>
</table>
