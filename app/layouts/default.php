<?php
/**
 * Default template for the site
 * 
 * @author Eduardo Aguerralde
 */
?>
<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title>Mini MVC - Ajax Table: <?echo $page_title ?></title>
    <meta name="description" content="Mini MVC">
    <meta name="author" content="aguerralde.com">
    <meta name="viewport" content="width=device-width">
    
    <?php echo $this->_helper->htmlCssInclude('css/reset.css'); ?>
    <?php echo $this->_helper->htmlCssInclude('css/style.css'); ?>
    
    <?php echo $this->_helper->htmlScriptInclude('js/modernizr-2.5.3-respond-1.1.0.min.js'); ?>
    <?php echo $this->_helper->htmlScriptInclude('js/jquery.js'); ?>
    
    <?php echo $header_tags; ?>	
</head>
<body>
<!--[if lt IE 7]><p class=chromeframe>Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p><![endif]-->

    <div id="header-container">
        <header class="wrapper clearfix">
            <h1 id="title">Mini MVC - Ajax Table: <em><?echo $page_title ?></em> </h1>
            <nav>
                <ul>
                        <li><?php echo $this->_helper->htmlLink('','Home'); ?></li>
                        <li><?php echo $this->_helper->htmlLink('sites/client','Client'); ?></li>
                        <li><?php echo $this->_helper->htmlLink('sites/server','Server'); ?></li>
                </ul>
            </nav>
        </header>
    </div>
    <div id="main-container">
        <div id="main" class="wrapper clearfix">
            
            
            <?php echo $content_view ?>

        </div> <!-- #main -->
    </div> <!-- #main-container -->

    <div id="footer-container">
        <footer class="wrapper">
            <h3>aguerralde.com</h3>
        </footer>
    </div>

</body>
</html>