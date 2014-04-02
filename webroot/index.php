<?php
/**
 * index.php
 * 
 * All requests go through here. Config files, and libraies loaded.  Root of site
 * and directory separatos constants are also set here. A couple of functions 
 * used to generate random data for our sites listing are kept here for review
 * 
 * @author Eduardo Aguerralde
 */

// need these two definitions here for the includes below to work
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__)));

$url = $_SERVER['QUERY_STRING'];

include_once ROOT . DS . 'app' . DS . 'config.php';
include_once ROOT . DS . 'lib' . DS . 'helper.php';
include_once ROOT . DS . 'lib' . DS . 'common.php';
            


// Escripts to generate random data for extra data fields
function buildDummyXml(){
    $xml_data = simplexml_load_file(XML_DATA_FILE);

    foreach($xml_data as $element){
        $element->addChild('alexa', $element->id);
        $element->addChild('avg_cpm',round(GetRandomValue(0.1,3),2));
        $element->addChild('impressions', GetRandomValue(0,32767));
    }
    $xml_data->asXML(XML_DATA_FILE);

}
function GetRandomValue($min, $max)
{
    $range = $max-$min;
    $num = $min + $range * mt_rand(0, 32767)/32767;

    $num = round($num, 4);

    return ((float) $num);
}
//    buildDummyXml();