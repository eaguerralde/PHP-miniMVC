<?php
/**
 * Json template for the site
 * 
 * @author Eduardo Aguerralde
 */

	header("Pragma: no-cache");
	header("Cache-Control: no-store, no-cache, max-age=0, must-revalidate");
	header('Content-Type: text/x-json');
	header("X-JSON: " . $content);

	echo $content;
?>