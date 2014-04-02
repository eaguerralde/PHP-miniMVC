<?php
/**
 * Sites listing model. Builds and array from an xml file based on this structure:
 * 
 *<site>
 *    <id>470</id>
 *    <name>lemonde.fr</name>
 *    <alexa>470</alexa>
 *    <avg_cpm>1.14</avg_cpm>
 *    <impressions>25745</impressions>
 *</site>
 * 
 * @author Eduardo Aguerralde
 */


class Site extends Model{
    /**
     * Constructor
     * Loads data array into internal var _data
     */
    function __construct() {
        $this->_data = $this->buildArray();
    }
    

    /**
     * Builds array of sites from an XML file set in config as XML_DATA_FILE
     * 
     * @return array
     */
    function buildArray(){
        $data_array = array();
        $xml_data = simplexml_load_file(XML_DATA_FILE);
        
        foreach($xml_data as $element){
            array_push($data_array,array('id'=>(int)$element->id,
//                                         'name'=> substr((string)$element->name, 0, strpos((string)$element->name, '.')),
                                         'name'=>(string)$element->name,
                                         'Alexa'=>(int)$element->alexa,
                                         'avg cpm'=>(float)$element->avg_cpm,
                                         'impressions'=>(int)$element->impressions,));
        }
        
        
        return $data_array;
    }
    
    /**
     * Returns data array, all rows
     * 
     * @return array
     */
    function getDataArray(){
        return $this->_data;
    }
    
    /**
     * Returns a portion of data array based on $start and $length
     * 
     * @param int $start index of arra from where to start
     * @param int $length number of items for the returned array
     * @return array
     */
    function getDataPagingArray($start, $length){
        return array_slice($this->_data, $start, $length, true);
    }
    
    
    /**
     * Sortes inner data
     * 
     * @param int $column index of column to order by
     * @param int $order whether ascending (asc) or descending (desc)
     * @return bool on order success
     */
    function sortDataArray($column, $order){
        $data = $this->_data;
        //check column exist
        if(is_array($data[0])){
            if(count($data[0]) > $column -1){
                // Obtain a list of columns
                $all_columns = array_keys($data[0]);
                $sort_column_name = $all_columns[$column];
                $sort_colum = array();
                foreach ($data as $key => $row) {
                    $sort_colum[$key]  = $row[$sort_column_name];
                }

                //set order option constant name
                if($order == 'asc'){
                    $order = SORT_ASC;
                }else{
                    
                    $order = SORT_DESC;
                }
                // Sort the data with volume descending, edition ascending
                // Add $data as the last parameter, to sort by the common key
                array_multisort($sort_colum, $order, $data); 
                $this->_data = $data;
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
        
        
    }
}

?>
