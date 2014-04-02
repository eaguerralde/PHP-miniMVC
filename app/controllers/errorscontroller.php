<?php
/**
 * Simple error display controller
 * 
 * @author Eduardo Aguerralde
 */

class ErrorsController extends Controller{
    /**
     * Helper class holder
     *
     * @var string 
     */
    public $helper;
    
    /**
     * Constructor
     * Loads parent constructor and initializes helper holder
     */
    function  __construct($model, $controller, $action){
        parent::__construct($model, $controller, $action);
        
        $this->helper = New Helper();
    }
    
    /**
     * view
     * 
     * * @param string $msg
     * <p>error message to be displayed</p>
     */
    function view($msg){
        $content = 'There has bee some error';
        if(isset($_GET['msg'])){
            $content = $_GET['msg'];
        }
        $this->set('content', urldecode($msg));
        $this->set('title', 'Error');
    }
}
