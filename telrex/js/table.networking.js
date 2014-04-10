/*var editor; // use a global for the submit and return data rendering
 
$(document).ready(function() {
    // Create the form
    editor = new $.fn.dataTable.Editor( {
        "ajaxUrl": "php/table.networking.php",
        "domTable": "#networking",
        "fields": [
			{
				"label": "IP addr",
				"name": "ip_addr",
				"type": "text"
			},
			{
				"label": "Subnet mask",
				"name": "mask",
				"type": "text"
			},
                        {
				"label": "Default Gateway",
				"name": "dfgw",
				"type": "text"
			},
			{
				"label": "DNS",
				"name": "dns",
				"type": "text"
			}
        ]
    } );
 
    // New record
    $('a.editor_create').on('click', function (e) {
        e.preventDefault();
 
        editor.create(
            'Create new record',
            { "label": "Add", "fn": function () { editor.submit() } }
        );
    } );
 
    // Edit record
    $('#networking').on('click', 'a.editor_edit', function (e) {
        e.preventDefault();
 
        editor.edit(
            $(this).parents('tr')[0],
            'Edit record',
            { "label": "Update", "fn": function () { editor.submit() } }
        );
    } );
 
    // Delete a record (without asking a user for confirmation)
    $('#networking').on('click', 'a.editor_remove', function (e) {
        e.preventDefault();
 
        editor.remove( $(this).parents('tr')[0], '123', false, false );
        editor.submit();
    } );
 
    // DataTables init
    $('#networking').dataTable( {
        "sDom": "Tfrtip",
        "sAjaxSource": "php/table.networking.php",
        "aoColumns": [
                        {
				"mData": "ip_addr"
			},
			{
				"mData": "mask"
			},
                        {
				"mData": "dfgw"
			},
			{
				"mData": "dns"
			},
            {
                "mData": null,
                "sClass": "center",
                "sDefaultContent": '<a href="" class="editor_edit">Edit</a> / <a href="" class="editor_remove">Delete</a>'
            }
        ]
    } );
} );*/

(function($){

$(document).ready(function() {
	editor = new $.fn.dataTable.Editor( {
		"ajaxUrl": "php/table.networking.php",
		"domTable": "#networking",
		"fields": [
			{
				"label": "IP addr",
				"name": "ip_addr",
                                "default": "192.168.1.155",
				"type": "text"
			},
			{
				"label": "Subnet mask",
				"name": "mask",
                                "default": "255.255.255.0",
				"type": "text"
			},
                        {
				"label": "Default Gateway",
				"name": "dfgw",
                                "default": "192.168.1.1",
				"type": "text"
			},
			{
				"label": "DNS",
				"name": "dns",
                                "default": "8.8.8.8",
				"type": "text"
			}
		]
	} );
        

        
        
// DataTables init
	$('#networking').dataTable( {
		"sDom": "Tfrtip",
		"sAjaxSource": "php/table.networking.php",
		"aoColumns": [
			{
				"mData": "ip_addr"
			},
			{
				"mData": "mask"
			},
                        {
				"mData": "dfgw"
			},
			{
				"mData": "dns"
			}
		],
		"oTableTools": {
			"sRowSelect": "multi",
			"aButtons": [
				/*{ "sExtends": "editor_create", "editor": editor },*/
				{ "sExtends": "editor_edit",   "editor": editor }
				/*{ "sExtends": "editor_remove", "editor": editor }*/
			]
		}
	} );
} );

}(jQuery));

