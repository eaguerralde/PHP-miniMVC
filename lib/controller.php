<?php
/**
 * Controller class from where models and views are loaded. When all processing 
 * of models and views is done destructor calls view->_render() to output the page
 * 
 * @author Eduardo Aguerralde
 */

class Controller {
    /**
     * Model name for this controller
     *
     * @var string 
     */
    protected $_model;
    
    /**
     * This controller name
     *
     * @var string 
     */
    protected $_controller;
    
    /**
     * This controller action name
     *
     * @var string 
     */
    protected $_action;
    
    /**
     * This controller view class
     *
     * @var View 
     */
    protected $_view;

    /**
     * Constructor
     * Sets internal vars and loads model and view for this controller
     */
    function __construct($model, $controller, $action) {
        $this->_controller = $controller;
        $this->_action = $action;
        $this->_model = $model;

        $this->$model = new $model;
        $this->_view = new View($controller, $action);
    }

    /**
     * Set vars for later use in views and templates
     * 
     * * @param string $name
     * <p>Name of var</p>
     * * @param string $value
     * <p>Value of var</p>
     */
    function set($name,$value) {
        $this->_view->set($name,$value);
    }

    /**
     * Sets layout used by its view
     * 
     * * @param string $layout
     * <p>Name of layout to use</p>
     */
    function setLayout($layout) {
        $this->_view->setLayout($layout);
    }

    /**
     * Destructor. Renders view so that page is outputed to the client
     * 
     */
    function __destruct() {
        $this->_view->render();
    }

}