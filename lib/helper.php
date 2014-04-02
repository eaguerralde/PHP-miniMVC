<?php
/**
 * Simple class with some helper functions used in various places
 *
 * @author ague
 */
class Helper {
    /**
     * include a file and return it's output
     *
     * @param string $path filename of include
     * @return string
     */
    function includeGetContents($path, $vars){
        extract($vars);
        ob_start();
        include($path);
        return ob_get_clean();
    }
    
    /**
     * Returns a formated html link given url and title
     *
     * @param string $url filename of include
     * @param string $title text to display on link
     * @return string
     */
    function htmlLink($url, $title){
        return '<a href="' . ROOT_PATH . $url . '">' . $title . '</a>';
    }
    
    /**
     * Returns a formated html script include tag given url
     *
     * @param string $url filename of include
     * @return string
     */
    function htmlScriptInclude($url){
        return '<script type="text/javascript" language="javascript" src="' . ROOT_PATH . $url . '"></script>';
    }
    
    /**
     * Returns a formated css include given url and media type
     *
     * @param string $url filename of include
     * @param string $media [optional] stylesheet media type
     * @return string
     */
    function htmlCssInclude($url, $media = 'screen'){
        return '<link rel="stylesheet" href="' . ROOT_PATH . $url . '" type="text/css" media="' . $media . '" />';
    }

    /**
     * Returns a formated table given url. Output is ready for use with DataTables
     * Jquery plugin found in http://datatables.net
     *
     * @param array $dataArray 2D array of data
     * @return string
     */
    function htmlDataTable($dataArray, $headerOnly = false){
        $dataTable = '';
        if(is_array($dataArray)){
            $dataTable = '<table id="dataTable">';
            $dataTable .= '<thead>';
            $dataTable .= '<tr>';
            foreach ($dataArray[0] as $siteField => $value){
                $dataTable .= '<th>' . $siteField . '</th>';
            }
            $dataTable .= '</tr>';
            $dataTable .= '</thead>';
            $dataTable .= '<tbody>';
            if(!$headerOnly){
                foreach($dataArray as $site){
                    $dataTable .= '<tr>';
                    foreach($site as $field => $value){
                        $dataTable .= '<td>' . $value . '</td>';
                    }
                    $dataTable .= '</tr>';
                }
            }
            $dataTable .= '</tbody>';
            $dataTable .= '</table>';
        }
        return $dataTable;
    }
}

?>
