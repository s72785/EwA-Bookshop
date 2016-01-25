<?php
ob_start();
session_start();
?>
<!doctype html>
<html manifest="cache.appcache" lang="de-de">
<head>
	<title>Spielwiese der Grp&nbsp;5</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="css/style.css">
	<link rel=icon href="img/favicon.ico" sizes="32x32 48x48" type="image/vnd.microsoft.icon">
<!-- external link that has been used to obtain the free webfont
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
-->
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link type="text/plain" rel="author" href="http://ivm108.informatik.htw-dresden.de/ewa/g05/humans.txt">
	<link type="text/plain" rel="license" href="http://ivm108.informatik.htw-dresden.de/ewa/g05/photos.txt">
	<!--link type="text/plain" rel="robots" href="http://ivm108.informatik.htw-dresden.de/ewa/g05/robots.txt"-->
	<meta name="robots" content="index,follow">
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" /> 
</head><body>

<header class="boxshadow">
	<h1>
		<a href="http://ivm108.informatik.htw-dresden.de/ewa/g05/" rel="bookmark"><span class="fa-book fa ilblk"></span></a>
		„Buchgeschäft der Gruppe&nbsp;05“
	</h1>
</header>

<div id="wrapper">

<nav class="boxshadow">
	<h2>Inhalte</h2>
	<ul>
		<li><a href="?show=shop">Buchshop</a></li><!-- shop/ -->
		<li><a href="<?php
		if ( ( isset($_GET['show']) &&$_GET['show']!='login') || !isset($_SESSION['userid']) || empty($_SESSION['userid']) ) {
			echo( 'http://ivm108.informatik.htw-dresden.de/ewa/g05/?show=login">Login</a></li>'
				.'<li><a href="http://ivm108.informatik.htw-dresden.de/ewa/g05/?show=eintragen">Registrieren'
			);
		} else {
			echo( 'http://ivm108.informatik.htw-dresden.de/ewa/g05/?show=logout">Logout' );
		}
		?></a></li>
		<li><a href="?show=admin">Verwaltung</a></li><!-- ./shop/admin/ -->
		<li class="hover toggleblock">
			<input id="exercises-cb" name="exercises-cb" type="checkbox" aria-hidden="true" class="unsichtbar">
			<label for="exercises-cb">&Uuml;bungen</label>
			<ul class="toggleitem">
				<li><a href="http://iasp2.informatik.htw-dresden.de/wiedem/fileadmin/Lehre/ewa/ub12/U1_tcpipftp_vw.pdf" title="Netzwerküberwachung und -analyse">1</a>
				- <a href="http://ivm108.informatik.htw-dresden.de/ewa/g05/" title="Lösung zu Übung 1">Lsg: 1</a>
				</li>
				<li><a href="http://iasp2.informatik.htw-dresden.de/wiedem/fileadmin/Lehre/ewa/ewa12/UB_FTP_HTTP_SERVER_vu.pdf" title="Installation FTP-/HTTP-Server">2</a>
				- <a href="http://ivm108.informatik.htw-dresden.de/ewa/g05/" title="Lösung zu Übung 2">Lsg: 2</a>
				</li>
				<li><a href="http://iasp2.informatik.htw-dresden.de/wiedem/fileadmin/Lehre/ewa/ub/ewa_U3_HTML_vx1.pdf" title="Übung zu HTML & CSS">3</a>
				- <a href="http://ivm108.informatik.htw-dresden.de/ewa/g05/" title="Lösung zu Übung 3">Lsg: 3</a>
				</li>
				<li><a href="http://iasp2.informatik.htw-dresden.de/wiedem/fileadmin/Lehre/ewa/U4_XML_vs.pdf" title="Übung zu XML">4</a>
				- <a href="http://ivm108.informatik.htw-dresden.de/ewa/g05/" title="Lösung zu Übung 4">Lsg: 4</a>
				</li>
				<li><a href="http://iasp2.informatik.htw-dresden.de/wiedem/fileadmin/Lehre/ewa/ewa_v50_webappseinf_vp1.pdf" title="Entw. von Webapplikationen">5</a>
				- <a href="http://ivm108.informatik.htw-dresden.de/ewa/g05/" title="Lösung zu Übung 5">Lsg: 5</a>
				</li>
				<li><a href="http://iasp2.informatik.htw-dresden.de/wiedem/fileadmin/Lehre/ewa/U5_php_vp1ok.pdf" title="Grundlagen der PHP-Programmierung">6</a>
				- <a href="http://ivm108.informatik.htw-dresden.de/ewa/g05/" title="Lösung zu Übung 6">Lsg: 6</a>
				</li>
				<li><a href="http://iasp2.informatik.htw-dresden.de/wiedem/fileadmin/Lehre/ewa/ub/u6_DBmitPHP_vx.pdf" title="DB-Programmierung mit PHP">7</a>
				- <a href="http://ivm108.informatik.htw-dresden.de/ewa/g05/" title="Lösung zu Übung 7">Lsg: 7</a>
				</li>
				<li><a href="http://iasp2.informatik.htw-dresden.de/wiedem/fileadmin/Lehre/ewa/ub/u7_PHPSessions_vx.pdf" title="PHP-Session-Management">8</a>
				- <a href="http://ivm108.informatik.htw-dresden.de/ewa/g05/" title="Lösung zu Übung 8">Lsg: 8</a>
				</li>
				<li><a href="http://iasp2.informatik.htw-dresden.de/wiedem/fileadmin/Lehre/ewa/ub/U8_javascript_vx.pdf" title="Übung zu JavaScript">9</a>
				- <a href="http://ivm108.informatik.htw-dresden.de/ewa/g05/" title="Lösung zu Übung 9">Lsg: 9</a>
				</li>
				<li><a href="http://iasp2.informatik.htw-dresden.de/wiedem/fileadmin/Lehre/ewa/ub/U9b_JQuery_vx.pdf" title="Übung zu JQuery">10</a>
				- <a href="http://ivm108.informatik.htw-dresden.de/ewa/g05/" title="Lösung zu Übung 10">Lsg: 10</a>
				</li>
				<li><a href="http://iasp2.informatik.htw-dresden.de/wiedem/fileadmin/Lehre/ewa/ub12/u13_webservices_vu.pdf" title="Übung zu Web Services">11</a>
				- <a href="http://ivm108.informatik.htw-dresden.de/ewa/g05/ws/" title="Lösung zu Übung 11">Lsg: 11</a>
				</li>
				<li><a href="http://iasp2.informatik.htw-dresden.de/wiedem/fileadmin/Lehre/ewa/ub12/U14_services_vt6.pdf" title="Übung zu SOA (mit Hinweis (neu))">12</a>
				- <a href="http://ivm108.informatik.htw-dresden.de/ewa/g05/" title="Lösung zu Übung 12">Lsg: 12</a>
				</li>
				<li><a href="http://iasp2.informatik.htw-dresden.de/wiedem/fileadmin/Lehre/ewa/ub12/U12_typo3_vt.pdf" title="Übung zu CMS am Beispiel von TYPO3">13</a>
				- <a href="http://ivm108.informatik.htw-dresden.de/ewa/g05/" title="Lösung zu Übung 13">Lsg: 13</a>
				</li>
				<li><a href="http://iasp2.informatik.htw-dresden.de/wiedem/fileadmin/Lehre/ewa/ewa12/ewa2012_PR_Usability-Barrierefreiheit.pdf" title="Praktikum Usability und Barrierefreiheit">14</a>
				- <a href="http://ivm108.informatik.htw-dresden.de/ewa/g05/" title="Lösung zu Übung 14">Lsg: 14</a>
				</li>
			</ul>
		</li><!-- html secial character demo -->
		<li><a href="http://ivm108.informatik.htw-dresden.de/ewa/g05/g05js.htm" target="_blank">JS-Demo</a></li>
		<li class="hover toggleblock">
			<input id="abnahme-cb" name="abnahme-cb" type="checkbox" aria-hidden="true" class="unsichtbar">
			<label for="abnahme-cb">Abnahme</label>
			<ul class="toggleitem">
				<li><a href="http://ivm108.informatik.htw-dresden.de/ewa/g05/daten/checkliste-v1.pdf" title="Website Buchgeschäft">1</a>
				- <a href="http://ivm108.informatik.htw-dresden.de/ewa/g05/index.php" title="Lösung zu Aufgabe 1">Startseite</a>
 				</li>
				<li><a href="http://ivm108.informatik.htw-dresden.de/ewa/g05/daten/checkliste-v1.pdf" title="Servergrundinstallation">2</a>
				- <a href="http://ivm108.informatik.htw-dresden.de/ewa/g05/conf" title="Lösung zu Aufgabe 2b">conf</a> - <a href="http://ivm108.informatik.htw-dresden.de/ewa/g05/admin/" title="Lösung zu Aufgabe 2c">admin</a>
				- <a href="http://ivm108.informatik.htw-dresden.de/ewa/g05/datenadm/datendemo.txt" title="Lösung zu Aufgabe 2d">datendemo.txt</a>
 				</li>
				<li><a href="http://ivm108.informatik.htw-dresden.de/ewa/g05/daten/checkliste-v1.pdf" title="XML-Aufgabe">3</a>
 				- <a href="http://ivm108.informatik.htw-dresden.de/ewa/g05/xml/book.xml" title="Lösung zu XML-Aufgabe">XML inkl. DTD</a> - <a href="http://ivm108.informatik.htw-dresden.de/ewa/g05/xml/xml.php" title="Alternativ-Lösung zu XML-Aufgabe">XML Reader</a>
 				</li>
				<li><a href="http://ivm108.informatik.htw-dresden.de/ewa/g05/daten/checkliste-v1.pdf" title="PHP–Aufgaben">4</a>
 				- <a href="http://ivm108.informatik.htw-dresden.de/ewa/g05/shop/suche.php" title="Lösung zu Aufgabe 4a">Suche</a> - <a href="http://ivm108.informatik.htw-dresden.de/ewa/g05/login/eintragen.html" title="Lösung zu Aufgabe 4b">Registrierung</a>
 				</li>
				<li><a href="http://ivm108.informatik.htw-dresden.de/ewa/g05/daten/checkliste-v1.pdf" title="Javascript und RIA">5</a>
				- <a href="http://ivm108.informatik.htw-dresden.de/ewa/g05/" title="Lösung zu Aufgabe 5a">Bestelldaten</a> - <a href="http://ivm108.informatik.htw-dresden.de/ewa/g05/" title="Lösung zu Aufgabe 5b">Kataloglistenanzeige</a>
 				</li>
				<li><a href="http://ivm108.informatik.htw-dresden.de/ewa/g05/daten/checkliste-v1.pdf" title="Webservice">6</a>
				- <a href="http://ivm108.informatik.htw-dresden.de/ewa/g05/ws/" title="Lösung zu Aufgabe 6a">KK-Test</a> - <a href="http://ivm108.informatik.htw-dresden.de/ewa/g05/ws/client.php" title="Lösung zu Aufgabe 6b">KK-Check</a> - <a href="http://ivm108.informatik.htw-dresden.de/ewa/g05/ws/client2.php" title="Lösung zu Aufgabe 6c">BLZ-Datenermittlung</a>
 				</li>
				<li><a href="http://ivm108.informatik.htw-dresden.de/ewa/g05/daten/checkliste-v1.pdf" title="SOA">7</a>
				- <a href="http://ivm108.informatik.htw-dresden.de/ewa/g05/" title="Lösung zu Aufgabe 7a">Fehlende Bücher</a> - <a href="http://ivm108.informatik.htw-dresden.de/ewa/g05/" title="Lösung zu Aufgabe 7b">Versandabwicklung</a>
 				</li>
				<li><a href="http://ivm108.informatik.htw-dresden.de/ewa/g05/daten/checkliste-v1.pdf" title="Wordpress">8</a>
				- <a href="http://ivm108.informatik.htw-dresden.de/ewa/g05/wordpress/" title="Lösung zu Aufgabe 8">Wordpress Installation</a>
 				</li>
			</ul>
			</li><!-- html secial character demo -->
		<li><a href="?show=about">EwA G05</a></li><!-- about/index.html -->
	</ul>
</nav>

<section class="boxshadow">
<?php

if ( isset( $_GET['show'] ) && !empty( $_GET['show'] ) ) {

	$caller='index.php';
	switch( $_GET['show'] ){
		case 'shop':
			include_once('shop/suche.php');
/*			echo('
<iframe src="shop/suche.php" name="suche" id="suchframe" style="display: block; width: 100%;height:100%;border:0;overflow:hidden;">  
	<p>Ihr Browser kann leider keine eingebetteten Frames anzeigen: Sie können die eingebettete Seite über den folgenden Verweis aufrufen: <a href="http://wiki.selfhtml.org/wiki/Startseite">SELFHTML</a> </p>
</iframe>	
			');/**/
		break;
		case 'details':
			//print_r();
			include_once('shop/details.php'/*.'?id='.$_GET['id']/**/);
		break;
		case 'ergebnisse':
			include_once('shop/'.$_GET['show'].'.php');
		break;
		case 'about':
			include_once('about/g05.php');
		break;
		case 'login':
		case 'eintragen':
			include_once('login/'.$_GET['show'].'.php');
		break;
		case 'admin':
			header('location: /ewa/g05/admin/');
		break;
		default:
			header($_SERVER['SERVER_PROTOCOL'].' 404 Not Found');
			if( !isset($_GET['show']) || !empty($_GET['show']) ) {
				echo( '<h2><span id="HTTP_STATUS_CODE">404</span> - Content not found: '.$_GET['show'].'</h2>' );
			}
			echo( '<p>Inhalt nicht verfügbar.</p>' );
	}

} else {
?>
<h2>Demo f. Entw. Web-Applikationen</h2>

Auch interessant: <a href="http://idlewords.com/talks/website_obesity.htm">Performantere Seiten, wo gibt es das?</a>

<figure id="wiedemann-foto-figure" class="boxshadow">
	<picture title="Foto von Prof. Dr.-Ing. Thomas Wiedemann">
		<source media="(min-width: 64em)" srcset="img/high-res.jpg" type="image/jpeg">
		<source media="(min-width: 37.5em)" srcset="img/med-res.jpg" type="image/jpeg">
		<source srcset="img/low-res.jpg" type="image/jpeg">
		<img src="img/med-res.jpg"  srcset="img/high-res.jpg" alt="für alte Browser"><!-- fallback -->
	</picture>
	<figcaption>
		Unser Prof
		<a href="http://www.htw-dresden.de/en/faculty-of-informaticsmathematics/personal/professuren/prof-dr-thomas-wiedemann.html" class="hflip ilblk">&copy;</a>
	</figcaption>
</figure>

<!--content-->
<div>
Hier wollen wir mal ausprobieren was im Modul Entwicklung von Webapplikationen schönes vermittelt wird.
</div>
<div>
Es wäre ja gelacht, wenn das nicht geht...
</div>
<div>
...dauert eben manchmal nur bis man es auch versteht.
</div>
<h3>Wir haben noch ein wenig mehr gemacht</h3>
<div>
	<ol>
	<li>Webfonts (um zu zeigen das man das nicht immer will)</li>
	<li>performanteres inline-img (SVG) im CSS statt Webfonts</li>
	<li>Picture/Source-Umgebung (Bild-Quelle abhängig von Bildschirm)</li>
	<li>Hashing skalierbar mit Runden und austauschbarem Algorythmus</li>
	<li>Kompatibilität: CSS statt JavaScript für Ein-/Ausblendefunktionen</li>
	<li>Barrierefreiheit mit ARIA (Screenreader-Kompatibilität)</li>
	<li><a href="./photos.txt">photos.txt</a>, <a href="./humans.txt">humans.txt</a> (statt nur robots.txt), <a href="about/jslicenses.html">jslicense</a> vorbereitet.</li>
	<li>HTML5 validiert beim W3C ohne Warnung und Fehler</li>
	<li>Verwendung von header(), z.B. HTTP Status Code 404 für nicht erreichbare Inhalte</li>
	<li>Verbesserungspotential d. Apache-Config entdeckt: Server-Variablen für URL-Bestandteile verfügbar machen</li>
	</ol>
</div>
<?php
}
?>
</section>

<aside class="boxshadow">


<!--</aside>


<aside class="boxshadow">-->
<h2>Am Rande</h2>
<!--	<small>iFrame-Demo</small><br>
	<small style="margin-left: 1em;"><a href="login/login.php" target="loginframe">Login</a></small>
	<small style="margin-left: 1em;"><a href="login/eintragen.php" target="loginframe">Registrieren</a></small>
	<iframe src="login/login.html" name="loginframe" id="loginframe"> 
		 <p>Ihr Browser kann leider keine eingebetteten Frames anzeigen: Sie können die eingebettete Seite über den folgenden Verweis aufrufen: <a href="http://wiki.selfhtml.org/wiki/Startseite">SELFHTML</a> </p>
	</iframe>	-->
<h3>Quellen</h3>
<p>
	In Anlehnung an u.a.
	<a href="http://wiki.selfhtml.org/extensions/Selfhtml/example.php/Beispiel:CSS3_Flexbox-5.html" rel="help">SelfHTML</a>,
	<a href="https://fortawesome.github.io/Font-Awesome/" rel="help">Font-Awesome</a>,
	<a href="http://html5hub.com/html5-picture-element/" rel="help">HTML5Hub</a>,
	<a href="http://html5-webdesign.de/figure.html" rel="help">HTML5&#8209;Webdesign</a>,
	<a href="https://devdocs.io" rel="help">MDN&nbsp;devdocs</a>
	.
</p>
</aside>


</div><!-- /wrapper -->

<footer class="boxshadow">

<ul>
	<!-- grp05 -->
	<li><a href="?show=about#v"  rel="author" title="vladimir">vladimir</a></li>
	<li><a href="?show=about#w" rel="author" title="wolf" class="wolf-face"></a></li>
	<li><a href="?show=about#p"  rel="author" title="patu">patu</a></li>
	<!-- contact & copyleft -->
	<li class="toggleblock">
		<input type="checkbox" id="contact-cb" name="contact-cb" class="unsichtbar">
		<label class="ib-label" for="contact-cb">Kontakt</label>
		<label for="contact-cb" class="toggleitem centerblock">&nbsp;</label>
		<div class="centeritem toggleitem">
			<h3>Kontakt</h3>
			<p>Wir sind während des Semesters nach Stundenplan des Kurses im Rechner-Labor anzutreffen. Anschließend versucht es einfach nur noch über das Repo.</p>
			<p>
				HTW Dresden<br>
				IW, WiSe 2015/2016, Kurs EwA, Gruppe&nbsp;05<br>
				Labor Z&nbsp;355
			</p>
			<div class="close"><label class="ib-label" for="contact-cb">Schließen</label></div>
		</div>
	</li>
	<li><a href="https://creativecommons.org/licenses/by/3.0/" title="Copyleft" rel="license">CC-BY&nbsp;3.0</a></li>
	<li><a href="http://wave.webaim.org/report#http://ivm108.informatik.htw-dresden.de/ewa/g05/">UX-Test</a></li>
	<li><?php
?><a href="https://validator.w3.org/nu/?useragent=Validator.nu%2FLV+http%3A%2F%2Fvalidator.w3.org%2Fservices&doc=<?php
	$url='http'.(( isset( $_SERVER["HTTPS"] ) && strtolower( $_SERVER["HTTPS"] ) == "on" )?'s':'')
		.'://'.$_SERVER['HTTP_HOST']
		.(($_SERVER["PHP_SELF"]=='/ewa/g05/index.php')?'/ewa/g05/':$_SERVER["PHP_SELF"]) ;
	echo( urlencode( $url ) );
	?>" target="_blank">Validate</a></li>
	<!--li><a href="about/jslicenses.html" rel="jslicense">JS&nbsp;Lizenzen</a></li--><!-- documenting licenses when using javascript -->
</ul>

</footer>

</body></html>
<!-- pu js at end to have dom loaded for modifications
	<script src="" type="text/javascript"></script>
-->
<?php
ob_end_flush();
?>
