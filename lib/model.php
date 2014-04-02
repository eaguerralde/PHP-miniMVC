<?php
/**
 * Simple model class from which models extend 
 *
 * @author ague
 */
class Model {
    /**
     * array of data
     *
     * @var array 
     */
    protected $_data;

    /**
     * Constructor
     * Initializes internal _data array
     */
    function __construct() {
            $this->_data = array();
    }
    
    /**
     * Destructor
     * 
     */
    function __destruct() {
    }
}

?>
