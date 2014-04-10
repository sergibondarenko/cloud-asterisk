


(function($){

$(document).ready(function() {
	var editor = new $.fn.dataTable.Editor( {
		"ajaxUrl": "php/table.musiconhold.php",
		"domTable": "#musiconhold",
		"fields": [
			{
				"label": "Name",
				"name": "name",
				"type": "text"
			},
			{
				"label": "Directory",
				"name": "directory",
				"type": "text"
			},
			{
				"label": "Application",
				"name": "application",
				"type": "text"
			},
			{
				"label": "Mode",
				"name": "mode",
				"type": "text"
			},
			{
				"label": "Digit",
				"name": "digit",
				"type": "text"
			},
			{
				"label": "Sort",
				"name": "sort",
				"type": "text"
			},
			{
				"label": "Format",
				"name": "format",
				"type": "text"
			}
		]
	} );

	$('#musiconhold').dataTable( {
		"sDom": "Tfrtip",
		"sAjaxSource": "php/table.musiconhold.php",
		"aoColumns": [
			{
				"mData": "name"
			},
			{
				"mData": "directory"
			},
			{
				"mData": "application"
			},
			{
				"mData": "mode"
			},
			{
				"mData": "digit"
			},
			{
				"mData": "sort"
			},
			{
				"mData": "format"
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

