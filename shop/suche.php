<?php
if(strpos($_SERVER["PHP_SELF"], 'suche.php')) {
	echo( '<!doctype html><html><head><title>Bookshop - Übersicht</title><meta charset="UTF-8">
	<script src="../js/jquery-2.1.4.min.js"></script></head><body>' );
}
echo('<form action="'.((!isset($caller)||!in_array($caller,$callers))?'suche.php':'?show=shop').'" method="post">
	  <label for="suche">Suche</label><br>
	  <input type="text" name="sucheingabe" id="sucheingabe">
	  <br>
	  <input type="submit" value="Submit" id="submit">
</form> 
<div id="main">');
//echo( (strpos($_SERVER["PHP_SELF"], 'suche.php'))?'j':'n' );
/*
function getLink($needle, $included=false) {
	$arr=explode('/', $_SERVER["PHP_SELF"]);
	print_r($arr);
	$arr[(count($arr)-1)]='ergebnisse.php';
	if($included)
		$ergebnisse='ergebnisse.php';
	else
		$ergebnisse=implode('/',$arr);//todo: pfad zusammenfummeln damit einbindung passt
	return $ergebnisse;
}*/

function getLink($suche, $shop,$ergebnis) {
	return ((strpos($_SERVER["PHP_SELF"], $suche))?$ergebnis:$shop.$ergebnis);
}

//~ print_r($caller);
$ergebnisse = ((!isset($caller)||!in_array($caller,$callers))?'ergebnisse.php':'shop/ergebnisse.php');
include_once($ergebnisse);
$ergebnisse = ((!isset($caller)||!in_array($caller,$callers))?'ergebnisse.php':'?show=ergebnisse');
?>
</div>
<small>basiert auf <a href="<?php echo($ergebnisse); ?>">ergebnisse</a></small>
<script type="text/javascript">
	
	function suche(suche)
	{
		$.ajax({
		  url: "<?php echo( ( ( !isset($caller) || !in_array($caller, $callers ) )?'':'shop/') ); ?>ergebnisse.php",
		  method: "POST",
		  data: { suche: suche }
		})
		  .done(function( html ) {
				$( "#main" ).html( html );
		  });
	} 
	$('#sucheingabe').keyup(function(){		
		suche($('#sucheingabe').val());
	});

	function testStr( tString, type )
	{
		switch (type) {
			case "plz":
				return !(tString.match(/^[0-9]{5}$/))? false:true;   
			break;
			case "blz":
				return !(tString.match(/^[0-9]{8}$/))? false:true;   
			break;
			case "pos":
				return !(tString.match(/^[0-9]{8}$/))? false:true;   
			break;
			default:
				return !(tString.match(/([a-z0-9.,;:öäüß _-])/gi))? false:true;
		}
	}

	$(".anzahl").keyup(function(){
		var k="pos";
		$e=$("#"+k);
		$bg="#f00";
		if ( testStr( $e.val(), k ) ) {
			$bg="#0f0";
		}
		$e.css("background-color", $bg)
	});
//~ $(".anzahl").each(function(elm){
	//~ if ( this.value < 0 ) {
		//~ 
	//~ }
	//~ console.log( this.value + " - " this.css("background") );
//~ });
	//~ $(".anzahl").each(function(e){
		//~ this.keyup(function(){
			//~ $bg="#f00";
			//~ if ( testStr( this.val(), "pos" ) ) {
				//~ $bg="#0f0";
			//~ }
			//~ this.css("background-color", $bg)
		//~ });
	//~ });
 </script>
<?php
if(strpos($_SERVER["PHP_SELF"], 'suche.php'))
	echo '</body></html>';
?>
