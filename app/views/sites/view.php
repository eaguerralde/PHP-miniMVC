<?php
/**
 * Sites View view
 * 
 * @author Eduardo Aguerralde
 */
?>
<h1>Project description</h1>
<p>Web application based on the following requirements:</p>
<ul>
    <li>Build a script that emulates a DB by defining a large (thousands records) PHP 
array. This array must contain a list of websites. Those websites must have 
different properties (url, adzone, alexa, impressions, avg cpm, ...).</li>
    <li>Build a mini MVC using this PHP array as data.</li>
    <li>Build a rendering page displaying this list of websites. Max 20 items per page.</li> 
</ul>
<p>No post, only ajax. Paging mechanism. Filters on every column (must take into 
account the items of the other pages). Use CSS in order to have a correct design. 
Each row can be selected by a click on it. Next button listing selected items.</p>

<p>You can use external libraries. Explain why you have selected them.
If you don't have sufficient information, take assumptions.</p>
<h2>Mini MVC</h2>
<p>This site is build on a custom mini MVC framework/pattern. It works by rewriting 
_httacess rules that make all requests to be processed through a single webroot/index.php 
file. Here an app/config.php file is loaded with some configuration constants like 
paths, max/min values... etc. It also loads a Helper class with some reused functions
and finally a lib/common.php file that acts as a router for requests by building 
controller and view objects from the URL (controller/view) while models are initiated 
inside controllers. Also different templates can be set for a view that can act as 
a simple master-page or to produce different file types (json, xml...)</p>

<p>MVC itself work when a page is requested and processed by lib/common.php so that 
a controller class instance is created. This one will try to load a model of the 
same type that will serve all data. It will also try to load a view and a template
to display the page in different layouts. If any of controller, model or view requested
doesn't exist a redirection to an error controller is performed displaying an error message.</p>
<p>For styling an HTML5 boilerplate template (
<a href="http://html5boilerplate.com/" target="_blank">http://html5boilerplate.com/</a>) 
has been used as starting point styling the Data tables acordingly and also a 
font file has been used for page titles. </p>
<h2>Ajax data table</h2>
<p>For this part of the site an already available Jquery plugin data table has been used. 
This one is called DataTable and further information can be 
fount at <a href="http://datatables.net" target="_blank">http://datatables.net</a>. 
This plugin has been chosen among others for its speed, robustness and mainly because 
provides all functionality requested. Its been used by big well known companies and 
reviews were just great.</p>
<p>As I did not use this sofware before I did 2 data table pages using different ways of displaying
information. Firstly a page with a single ajax call to the database retrieving all data
and the processing the table entirely on the client side. Once I was happy with the usage 
of the plugin a second version was done where processing of data (paging, sorting) is done on the server, sent through
ajax to the client side where selection of items is handled. This last is handled 
with 2 sets of data and 2 data tables that hide/show as requested.</p>
