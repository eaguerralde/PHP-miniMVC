$(document).ready(function() {
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
        if ($(this).hasClass('row_selected')){
            $(this).removeClass('row_selected');
        }else{
            $(this).addClass('row_selected');
        }
    } );

    //processiong of selected rows
    $('#next').click(function(){
        if(this.value == 'Next'){
            var rows = getSelectedRows(data_table_sites);
            var data = new Array();

            for(row in rows){
                data.push(data_table_sites.fnGetData(row));
            }

            data_table_sites.fnClearTable();
            data_table_sites.fnAddData(data);

            this.value = 'Back';
        }else if(this.value == 'Back'){
            data_table_sites.fnClearTable();
            data_table_sites.fnReloadAjax();
            this.value = 'Next';
        }
    });
    function getSelectedRows( data_table_obj ){
        var selected_rows = new Array();
        var table_rows = data_table_obj.fnGetNodes();

        for (var i = 0; i < table_rows.length; i++){
                if ( $(table_rows[i]).hasClass('row_selected') )
                {
                        selected_rows.push( table_rows[i] );
                }
        }
        return selected_rows;
    }

    //DataTable initialization
    var data_table_sites = $('#dataTable').dataTable( {
        "iDisplayLength": 20, 
        "bProcessing": true,
        "sAjaxSource": '<?php echo ROOT_PATH ?>sites/json'
    } );
} );