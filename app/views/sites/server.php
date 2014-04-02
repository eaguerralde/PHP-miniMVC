<?php
/**
 * Sites Server view
 * 
 * @author Eduardo Aguerralde
 */
?>
<h1>Server handling</h1>
<p>This demo works by loading data through ajax and handling user interaction 
    on the server side. Data loads once the page is ready and then the user can
navigate the list, hover items and un/select them. Clicking on "Next" button will clear 
the table and load only selected items from the server as the same time as button text changes to
"Back". Clicking on this will reload the list through Ajax again.</p>

<?php echo $content ?>


<aside>
    <h3>Instructions</h3>
    <p>Navigate and select or unselect rows from this listing by clicking anywhere on each one.</p>
    <p>When ready click <span class="button">See selection</span> button below these lines to see only selected items.</p>
    <p>You can go back by clicking on <span class="button">Back</span> button that will be displayed below and your selection will be kept.</p>
    <p>Rows can be ordered by column only.</p>
    
    <input type="submit" name="next" id="next" value="See selection" />
</aside>


<script type="text/javascript">
    var data_table_sites;
    var data_table_sites_select = null;
    var selected_data = [];
    $(document).ready(function() {
        $.ajaxSetup({
           cache: false
         });
         
         
        $('#dataTable tr').live({
            mouseenter: function(){
                $(this).addClass( 'row_highlighted' );
            },
            mouseleave: function(){
               $(this).removeClass('row_highlighted'); 
            }   
        } );

        //selection of rows
        $('#dataTable tr').live('click', function() {
            //initialize selected items table
            initSelectTable();
            
            var aData = data_table_sites.fnGetData( this );
//            var iId = aData[0];
			
			// .row_selected class indicates row was selected
            if (/*$(this).hasClass('row_selected') &&*/ !isDataSelected(aData, selected_data) == true )
            {
                    selected_data[selected_data.length++] = aData;
            }
            else
            {
                    selected_data = jQuery.grep(selected_data, function(value) {
                            return value != aData;
                    } );
            }

            $(this).toggleClass('row_selected');
        } );

        //Swap full/selection tables on button click
        $('#next').click(function(){
            if(this.value == 'See selection'){
                //initialize selected items table
                initSelectTable();
                
                //load selection items
//                var data = getSelectedData(data_table_sites);
                data_table_sites_select.fnClearTable();
                data_table_sites_select.fnAddData(selected_data);
                
                //swap tables and button text
                $('#dataTable_wrapper').css('display','none');
                $('#dataTable_select_wrapper').css('display','block');

                this.value = 'Back';
            }else if(this.value == 'Back'){
                //swap tables and button text
                $('#dataTable_select_wrapper').css('display','none');
                $('#dataTable_wrapper').css('display','block');
                this.value = 'See selection';
            }
        });
        
        function getSelectedData( data_table_obj ){
            var selected_rows = [];
            var table_rows = data_table_obj.fnGetNodes();

            for (var i = 0; i < table_rows.length; i++){
                    if ( $(table_rows[i]).hasClass('row_selected') )
                    {   
                        selected_rows.push(data_table_obj.fnGetData(i));
                    }
            }
            return selected_rows;
        };
        
        function isDataSelected(table_data, items_data_array){
            for(var item in items_data_array){
                    if(items_data_array[item][0] === table_data[0])
                    {
                        return true;
                    }
			}
			return false;
        }; 
        
        //initialize selected items table if not done yet
        function initSelectTable(){
            if(!data_table_sites_select){
                    data_table_sites_select = data_table_sites.clone();
                    data_table_sites_select.attr('id','dataTable_select');
                    $('#dataTable_wrapper').before(data_table_sites_select);
                    data_table_sites_select.dataTable( {
                        "iDisplayLength": 20, 
                        "bProcessing": true
                    } );
                    $('#dataTable_select_wrapper').css('display','none');
			}
        };

        //DataTable initialization
        var data_table_sites = $('#dataTable').dataTable( {
            "iDisplayLength":   <?php echo DATA_ITEMS_SHOWN ?>,
            "bProcessing":      true,
            "bServerSide":      true, 
            "sAjaxSource":      '<?php echo ROOT_PATH ?>sites/json',
            "sDom":             'lrtip',
            "fnRowCallback":    function( nRow, aData, iDisplayIndex ) {
//                var compare = data_table_sites.fnGetData( nRow );
//                for each(item in selected_data){
////                    if ( jQuery.inArray(aData, selected_data) != -1 )
////                    var comp_item = item.toString;
////                    var comp_item = item.toString;
//                    if(item.toString() === aData.toString())
//                    {
//                        $(nRow).addClass('row_selected');
//                    }
//                }
                if(isDataSelected(aData, selected_data)){
                    $(nRow).addClass('row_selected');
                }
                return nRow;
            },
            "fnServerParams": function ( aoData ) {
              aoData.push( { "name": "serverSide", "value": true } );
            }
        } );
    } ); //document ready
</script>