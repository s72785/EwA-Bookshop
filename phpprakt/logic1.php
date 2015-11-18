<?php

echo( '<table border="1"><tr>' );

for ( $i=1; $i<11; $i++ ) {
	echo "<td>$i</td>";
	if( $i % 5 == 0 ) {
		echo( '</tr><tr>' );
	}
}
echo( '</tr></table>' );

?>