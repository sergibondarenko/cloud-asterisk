


(function($){

$(document).ready(function() {
	var editor = new $.fn.dataTable.Editor( {
		"ajaxUrl": "php/table.extensions.php",
		"domTable": "#routing",
		"fields": [
			{
				"label": "Comments",
				"name": "comments",
				"type": "text"
			},
			{
				"label": "Context",
				"name": "context",
				"type": "select",
				"ipOpts": [
					{
						"label": "default",
						"value": "default"
					},
					{
						"label": "user-office",
						"value": "user-office"
					},
					{
						"label": "user-international",
						"value": "user-inter"
					},
					{
						"label": "office",
						"value": "office"
					},
					{
						"label": "international",
						"value": "international"
					},
					{
						"label": "ivr",
						"value": "ivr"
					}
				]
			},
			{
				"label": "Extension",
				"name": "exten",
				"type": "text"
			},
			{
				"label": "Priority",
				"name": "priority",
				"type": "text"
			},
			{
				"label": "App",
				"name": "app",
				"type": "text"
			},
			{
				"label": "Appdata",
				"name": "appdata",
				"type": "text"
			}
		]
	} );

	$('#routing').dataTable( {
		"iDisplayLength": 50,
		"sDom": "Tfrtip",
		"sAjaxSource": "php/table.extensions.php",
		"aoColumns": [
			{
				"mData": "comments"
			},
			{
				"mData": "context"
			},
			{
				"mData": "exten"
			},
			{
				"mData": "priority"
			},
			{
				"mData": "app"
			},
			{
				"sWidth": "60%",
				"mData": "appdata"
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

