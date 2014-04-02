<?php
/**
 * index.php
 * 
 * @author Eduardo Aguerralde
 */
// This may be in a separate config folder with other config files but will
// live here for simplicity

define('NL', "\r\n"); //new line for windows server
//define('NL', "\n"); //new line for *nix server
if(!defined('DS'))define('DS',"/");//directory sep�rator
define('ROOT_PATH', '');//installation URL, ie http://yourdomain.com/miniMvc/
define('FILES_ROOT_PATH', $_SERVER["DOCUMENT_ROOT"] . DS . 'miniMVC/');//installation physical path 
define('DEF_CONTROLLER', 'sites');//default controller when accessing the site
define('DEF_ACTION', 'view');//default action for all controllers
define('DATA_ITEMS_SHOWN', 20);//data table rows to display
define('XML_DATA_FILE', FILES_ROOT_PATH . 'data' . DS . 'top_200.xml');//Data XML file phsical path
