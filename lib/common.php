<?php
/**
 * Simple hook functions to handle requests and wrongly formated URLs errors
 * 
 * @author Eduardo Aguerralde
 */

/**
 * Call hook that hadles all requests
 * 
 */
function callHook(){
    global $url;
    $urlArray = array();
    $urlArray = explode("/",$url);

    //fix for urls starting with /
    if($urlArray[0] == ''){
        array_shift($urlArray);   
    }
    
    $controller = DEF_CONTROLLER;
    if(isset($urlArray[0]) && $urlArray[0] != ''){
        $controller = $urlArray[0];
    }
    array_shift($urlArray);

    $action = DEF_ACTION;
    if(isset($urlArray[0]) && $urlArray[0] != ''){
        //fix for urls with querystring
        $format = strpos($urlArray[0], '&');
        if($format){
            $action = substr($urlArray[0], 0, $format);
        }else{
            $action = $urlArray[0];
        }
    }
    array_shift($urlArray);
    
    $params = $urlArray;

    $controllerName = $controller;
    $controller = ucwords($controller);
    $model = rtrim($controller, 's');
    $controller .= 'Controller';
    
    if(class_exists($controller)){
        $dispatch = new $controller($model,$controllerName,$action);
        
        if ((int)method_exists($controller, $action)) {
                call_user_func_array(array($dispatch,$action),$params);
        } else {
                loadErrorHandling(array('msg' => $controller . '-' . $action . ' method does not exist.'));
        }
    }else{
        loadErrorHandling(array('msg' => 'controller class not found.'));
    }
    
}

/**
 * Handles class and method load errors
 * 
 * * @param array $error
 * <p>Array with error params. Only set msg for the moment</p>
 */
function loadErrorHandling($error){
    $redirect = ROOT_PATH . 'errors/view/' . urlencode($error['msg']);
    $_GET['msg'] = $error['msg'];
    header("Location: $redirect");
}



/**
 * Autoload or magic load function that is called when a call to a constructor fails.
 * Will try to find it in default locations.
 * 
 * * @param string $className
 * <p>Class name that failed</p>
 */
function __autoload($className) {
    if (file_exists(ROOT . DS . 'lib' . DS . strtolower($className) . '.php')) {
        require_once(ROOT . DS . 'lib' . DS . strtolower($className) . '.php');
    } else if (file_exists(ROOT . DS . 'app' . DS . 'controllers' . DS . strtolower($className) . '.php')) {
        require_once(ROOT . DS . 'app' . DS . 'controllers' . DS . strtolower($className) . '.php');
    } else if (file_exists(ROOT . DS . 'app' . DS . 'models' . DS . strtolower($className) . '.php')) {
        require_once(ROOT . DS . 'app' . DS . 'models' . DS . strtolower($className) . '.php');
    } else {
        loadErrorHandling(array('msg' => 'No ' . $className . ' found'));
    }
}

/**
 * Call to callHook to deal with requests
 */
callHook();
