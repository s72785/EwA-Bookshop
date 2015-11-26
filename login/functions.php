<?php

	function pwd_hash_old( $pwd ) {	//hier kann hash-algo später ggf. ersetzt werden
		return md5( $pwd );
	}
	
	function pwd_hash_new( $pwd, $salt ) {
		return password_hash( $pwd . $salt, PASSWORD_BCRYPT, ['cost' => 8 ] );
	}
	
	/* boolean compare of pwd and hash wth optional salt, needed for migration */
	function hashcmp( $pwd, $hash, $salt = '' ) {
		$update = false;
		/* conditional old or new hash method to migrate */
		if( substr( $hash, 0, 1 ) == '$' ) {
			return password_verify( $pwd . $salt, $hash );
		} else {
			$cmp = pwd_hash_old( $pwd );
			$update = true;
		}
		/* compare hashes and return boolean */
		if ( substr($cmp,0,strlen($hash)) == $hash ) {
			/* here migrate and update old hash with new */
			if( $update == true || strlen($cmp) > strlen($hash) ) {
				$abfrage="UPDATE User SET Userpwmd5 = '" . pwd_hash_new( $pwd, $salt ) . "' WHERE Userpwmd5 = '" . $hash . "';";
				$ergebnis = mysql_query( $abfrage );
			}
			return true;
		} else {
			return false;
		}
	}

?>