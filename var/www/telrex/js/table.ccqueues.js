


(function($){

$(document).ready(function() {
	var editor = new $.fn.dataTable.Editor( {
		"ajaxUrl": "php/table.ccqueues.php",
		"domTable": "#queues",
		"fields": [
			{
				"label": "Name",
				"name": "name",
				"type": "text"
			},
			{
				"label": "Musiconhold",
				"name": "musiconhold",
				"type": "text"
			}
		]
	} );

	$('#queues').dataTable( {
		"iDisplayLength": 20,
		"sDom": "Tfrtip",
		"sAjaxSource": "php/table.ccqueues.php",
		"aoColumns": [
			{
				"mData": "name"
			},
			{
				"mData": "musiconhold"
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

