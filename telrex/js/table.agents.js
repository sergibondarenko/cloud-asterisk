


(function($){

$(document).ready(function() {
	var editor = new $.fn.dataTable.Editor( {
		"ajaxUrl": "php/table.agents.php",
		"domTable": "#agents",
		"fields": [
			{
				"label": "queue",
				"name": "1",
				"type": "text"
			},
			{
				"label": "agent num",
				"name": "2",
				"type": "text"
			},
			{
				"label": "passwd",
				"name": "3",
				"type": "text"
			},
			{
				"label": "agent name",
				"name": "4",
				"type": "text"
			}
		]
	} );

	$('#agents').dataTable( {
		"sDom": "Tfrtip",
		"sAjaxSource": "php/table.agents.php",
		"aoColumns": [
			{
				"mData": "1"
			},
			{
				"mData": "2"
			},
			{
				"mData": "3"
			},
			{
				"mData": "4"
			}
		],
		"oTableTools": {
			"sRowSelect": "multi",
			"aButtons": [
				{ "sExtends": "editor_create", "editor": editor },
				{ "sExtends": "editor_edit",   "editor": editor },
				{ "sExtends": "editor_remove", "editor": editor }
			]
		}
	} );
} );

}(jQuery));

