<?php
echo( '<!doctype html><html><head><title>Bookshop - Übersicht</title><meta charset="UTF-8"><script src="../js/jquery-2.1.4.min.js"></script></head><body>' );
?>
 <form action="suche.php" method="post">
	  <label for="suche">Suche</label><br>
	  <input type="text" name="suche" id="suche">
	  <br>
	  <input type="submit" value="Submit" id="submit">	 
</form> 
<div id="main">
<?php
include_once("ergebnisse.php");
?>
</div>
<script type="text/javascript">
	
	function suche(suche)
	{
		$.ajax({
		  url: "ergebnisse.php",
		  method: "POST",
		  data: { suche: suche }
		})
		  .done(function( html ) {
				$( "#main" ).html( html );
		  });
	} 
	$('#suche').keyup(function(){		
		suche($('#suche').val());
	});

 </script>
<?php
echo '</body></html>';
?>
