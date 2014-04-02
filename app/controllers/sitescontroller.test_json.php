<?php
/**
 * Sites listing controller. Creates content for a given layout.
 * 
 * @author Eduardo Aguerralde
 */

class SitesController extends Controller{
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
     * view action
     * 
     */
    function view(){
        $this->set('title', 'Home');
    }
    
    /**
     * server action
     * 
     */
    function server(){
        $this->set('title', 'Server handling');
        $this->set('content', $this->helper->htmlDataTable($this->Site->getDataArray(), true));
        $this->_view->setHeaderTag($this->helper->htmlScriptInclude('js/jquery.dataTables.js'));
        $this->_view->setHeaderTag($this->helper->htmlScriptInclude('js/jquery.dataTables.fnReloadAjax.js'));
    }
    
    /**
     * client action
     * 
     */
    function client(){
        $this->set('title', 'Client hanlding');
        $this->set('content', $this->helper->htmlDataTable($this->Site->getDataArray(), true));
        $this->_view->setHeaderTag($this->helper->htmlScriptInclude('js/jquery.dataTables.js'));
        $this->_view->setHeaderTag($this->helper->htmlScriptInclude('js/jquery.dataTables.fnReloadAjax.js'));
    }
    
    /**
     * Json action. Outputs to the browser a formated json file using json layout
     * 
     */
    function json(){
        $this->setLayout('json');
        
        // get, evluate and set GET variables based on querystring:        
        //
        //bRegex=false
        //bRegex_0=false
        //bRegex_1=false
        //bRegex_2=false
        //bRegex_3=false
        //bRegex_4=false
        //bSearchable_0=true
        //bSearchable_1=true
        //bSearchable_2=true
        //bSearchable_3=true
        //bSearchable_4=true
        //bSortable_0=true
        //bSortable_1=true
        //bSortable_2=true
        //bSortable_3=true
        //bSortable_4=true
        //iColumns=5
        //iDisplayLength=20
        //iDisplayStart=0
        //iSortCol_0=1 ->Column to sort
        //iSortingCols=1
        //mDataProp_0=0
        //mDataProp_1=1
        //mDataProp_2=2
        //mDataProp_3=3
        //mDataProp_4=4
        //sColumns=
        //sEcho=3
        //sSearch=
        //sSearch_0=
        //sSearch_1=
        //sSearch_2=
        //sSearch_3=
        //sSearch_4=
        //sSortDir_0=desc -> Sort direction
        //serverSide=true
        
        $iTotalRecords = 0;
        $iDisplayStart = 0;
        $iDisplayLength = DATA_ITEMS_SHOWN;
        $sEcho = 1;
        $serverSide = false;
        $iSortCol_0 = 0;
        $sSortDir_0 = 'asc';
        if(isset($_GET['iDisplayStart'])){
            $iDisplayStart = intval($_GET['iDisplayStart']);
        }
        
        if(isset($_GET['iDisplayLength'])){
            $iDisplayLength = intval($_GET['iDisplayLength']);
        }
        
        if(isset($_GET['sEcho'])){
            $sEcho = intval($_GET['sEcho']);
        }
        
        if(isset($_GET['iTotalRecords'])){
            $sEcho = intval($_GET['iTotalRecords']);
        }
        
        if(isset($_GET['serverSide'])){
           $serverSide =  (bool)$_GET['serverSide'];
        }
        
        if(isset($_GET['iSortCol_0'])){
           $iSortCol_0 = intval($_GET['iSortCol_0']);
        }
        
        if(isset($_GET['sSortDir_0'])){
            if($_GET['sSortDir_0'] !== 'desc'){
                $sSortDir_0 = 'asc';
            }else{
                $sSortDir_0 = 'desc';
            }
        }
        
        $this->Site->sortDataArray($iSortCol_0, $sSortDir_0);
        
        
        //prepare asociative array json object needed for DataTables ajax
        $data_array = array();
        if($serverSide){
            $data_array = $this->Site->getDataPagingArray($iDisplayStart, $iDisplayLength); 
        }else{
            $data_array = $this->Site->getDataArray(); 
        }
        
        $iTotalRecords = count($this->Site->getDataArray());
        
        // clear field names from data to get correct json_encode as it always 
        // outputs objects for asociative arrays and we need a 2D array
        $aaData = array();
        foreach($data_array as $data_row){
            $aaDataRow = array();
            foreach($data_row as $field){
              $aaDataRow[] = $field;  
            }
            $aaData[] = $aaDataRow;
        }
//        $records_send = $serverSide ? $iDisplayLength-1 : 237;
//        for($x = 0; $x <= $records_send; $x++){
//            $aaDataRow = array();
//            
//            foreach($data_array[$x] as $field){
//              $aaDataRow[] = $field;  
//            }           
//            $aaData[] = $aaDataRow;
//        }
//        $temp = array_chunk($aaData, 200, true);
//        $result;
//        foreach ($temp as $value) {
//          $result[] =  json_encode($value);
//        }
        
        $output = array(
//            "memory" => memory_get_peak_usage(true) . '#'.memory_get_peak_usage().'#'.memory_get_usage(),
		"sEcho" => $sEcho, // whether output or not
                "iDisplayLength" => $iDisplayLength, // displayed records 
		"iTotalRecords" => $iTotalRecords, //total records unfiltered
                //filtered records to be displayed. Should be equal to iTotalRecords 
                //or it'll display "(of x filtered records)"
		"iTotalDisplayRecords" => $iTotalRecords, 
                "aaData" => $aaData,
	);
        ini_set('memory_limit', '128M');
        $this->set('content', json_encode($output));
    }
}
