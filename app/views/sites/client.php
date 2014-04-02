<?php
/**
 * Sites Client view
 * 
 * @author Eduardo Aguerralde
 */
?>
<h1>Client handling</h1>
<p>This demo works by loading data through ajax and manipulating user interaction 
    on the client side. Data loads once the page is ready and then the user can
navigate the list, hover items and un/select them. Clicking on "Next" button will clear 
the table and load only selected items as the same time as button text changes to
"Back". Clicking on this will reload the list through Ajax again.</p>

<?php echo $content ?>



<aside>
    <h3>Instructions</h3>
    <p>Navigate and select or unselect rows from this listing by clicking anywhere on each one.</p>
    <p>When ready click <span class="button">See selection</span> button below these lines to see only selected items.</p>
    <p>You can go back by clicking on <span class="button">Back</span> button that will be displayed below and your selection will be kept.</p>
    <p>Rows can be ordered by column and filtered using the search box.</p>
    
    <input type="submit" name="next" id="next" value="See selection" />
</aside>


<script type="text/javascript" language="javascript" charset="utf-8">
    var data_table_sites;
    var data_table_sites_select = null;
    $(document).ready(function() {
        $.ajaxSetup({
           cache: false
         });

        // EVENTS
        //Highlight of rows on mouse hover
        $('.dataTable tr').live({
            mouseenter: function(){
                $(this).addClass( 'row_highlighted' );
            },
            mouseleave: function(){
               $(this).removeClass('row_highlighted'); 
            }   
        } );

        //selection of rows on click
        $('#dataTable tr').live('click', function() {
            if ($(this).hasClass('row_selected')){
                $(this).removeClass('row_selected');
            }else{
                $(this).addClass('row_selected');
            }
        } );

        //Swap full/selection tables on button click
        $('#next').click(function(){
            if(this.value == 'See selection'){
                //initialize selected items table
                  initSelectTable();
                
                //load selection items
                var data = getSelectedData(data_table_sites);
                data_table_sites_select.fnClearTable();
                data_table_sites_select.fnAddData(data);
                
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
        
        // FUNCTIONS
        //processiong of selected rows
        function getSelectedData( data_table_obj ){
            var selected_rows = new Array();
            var table_rows = data_table_obj.fnGetNodes();

            for (var i = 0; i < table_rows.length; i++){
                    if ( $(table_rows[i]).hasClass('row_selected') )
                    {   
                        selected_rows.push(data_table_obj.fnGetData(i));
                    }
            }
            return selected_rows;
        }
        
        //initialize selected items table if not done yet
        function initSelectTable(){
            if(!data_table_sites_select){
                    data_table_sites_select = data_table_sites.clone();
                    data_table_sites_select.attr('id','dataTable_select');
                    $('#dataTable_wrapper').before(data_table_sites_select);
                    data_table_sites_select .dataTable( {
                        "iDisplayLength": 5, 
                        "bProcessing": true
                    } );
                }
        }

        //DataTable INITIALIZATION
        data_table_sites = $('#dataTable').dataTable( {
            "iDisplayLength": <?php echo DATA_ITEMS_SHOWN ?>, 
            "bProcessing": true,
            "sAjaxSource": '<?php echo ROOT_PATH ?>sites/json'
        } );
    } );
</script>