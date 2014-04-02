<?php
/**
 * View class to handle views and layouts that will hold sites content
 *
 * @author ague
 */
class View {
    /**
     * this controller name
     *
     * @var string 
     */
    protected $_controller;
    
    /**
     * this action name
     *
     * @var string 
     */
    protected $_action;
    
    /**
     * this layout name
     *
     * @var string 
     */
    protected $_layout;
    
    /**
     * array of variables used by views and layouts that can be set from controllers
     *
     * @var array 
     */
    protected $_vars = array();
    
    /**
     * internal holder for helper class
     *
     * @var Helper 
     */
    protected $_helper;
    
    /**
     * array of header tags that will be placed at page header if layout needs them
     *
     * @var array 
     */
    protected $_header_tags = array();

    /**
     * Constructor
     * Initializes internal vars and helper class
     */
    function __construct($controller, $action) {
        $this->_controller = $controller;
        $this->_action = $action;
        $this->_helper = New Helper();
    }
    
    /**
     * Load var in internal vars array for later use
     *
     * @param string $name name of var
     * @param string $value value of var
     */
    function set($name, $value){
        $this->_vars[$name] = $value;
    }

    /**
     * Sets internal _layout var
     *
     * @param string $path filename of include
     */
    function setLayout($layout) {
        $this->_layout = $layout;
    }
    
    /**
     * Pushes a header tag into internal _header_tags array
     *
     * @param string $tag tag to include
     * @return bool
     */
    function setHeaderTag($tag){
        if(is_string($tag)){
            array_push($this->_header_tags, $tag);
            return true;
        }else{
            return false;
        }
    }
    
    /**
     * Returns a header tags as array or HTML
     *
     * @param bool $return_string whether to return string (true) or array (false)
     * @return array or string if $return_string = true
     */
    function getHeatherTags($return_string = true){
        if($return_string){
            $output = '';
            foreach($this->_header_tags as $tag){
                $output .= $tag . NL;
            }
            return $output;
        }else{
            return $this->_header_tags;
        }
    }
    
    
    /**
     * Renders layout and view
     *
     * @return void
     */
    function render(){
        $layout;
        $content_view = ''; //set this not to break when urls of unset views
        $view_file = ROOT . DS . 'app' . DS . 'views' . DS . $this->_controller . DS . $this->_action . '.php';
        
        if(file_exists(ROOT . DS . 'app' . DS . 'layouts' . DS . $this->_layout . '.php')){
            $layout = ROOT . DS . 'app' . DS . 'layouts' . DS . $this->_layout . '.php';
        }else{
            $layout = ROOT . DS . 'app' . DS . 'layouts' . DS . 'default.php';
        }
        
        extract($this->_vars);
        
        $page_title;
        if(isset($title)){
            $page_title = $title;
        }else{
            $page_title = '';
        }
        
        if(file_exists($view_file)){
            $content_view = $this->_helper->includeGetContents($view_file, $this->_vars);
        }
        
        $header_tags = $this->getHeatherTags();
        if(file_exists($layout)){
            include($layout);
        }else{
            echo 'layout file missing';
        }
    }
}

?>
