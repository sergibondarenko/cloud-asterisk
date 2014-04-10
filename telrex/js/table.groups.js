


(function($){

$(document).ready(function() {
	var editor = new $.fn.dataTable.Editor( {
		"ajaxUrl": "php/table.groups.php",
		"domTable": "#groups",
		"fields": [
                        {
				"label": "type",
				"name": "1",
				"type": "select",
				"ipOpts": [
					{
						"label": "1",
						"value": "1"
					},
					{
						"label": "2",
						"value": "2"
					},
				]
			},
			{
				"label": "hunt pilot num",
				"name": "2",
				"type": "text"
			},
			{
				"label": "1st num",
				"name": "3",
				"type": "text"
			},
			{
				"label": "delay",
				"name": "4",
				"type": "text"
			},
			{
				"label": "2nd num",
				"name": "5",
				"type": "text"
			},
			{
				"label": "delay",
				"name": "6",
				"type": "text"
			},
			{
				"label": "3rd num",
				"name": "7",
				"type": "text"
			},
			{
				"label": "delay",
				"name": "8",
				"type": "text"
			},
			{
				"label": "4th num",
				"name": "9",
				"type": "text"
			},
			{
				"label": "delay",
				"name": "10",
				"type": "text"
			},
			{
				"label": "5th num",
				"name": "11",
				"type": "text"
			},
			{
				"label": "delay",
				"name": "12",
				"type": "text"
			},
			{
				"label": "6th num",
				"name": "13",
				"type": "text"
			},
			{
				"label": "delay",
				"name": "14",
				"type": "text"
			},
			{
				"label": "7th num",
				"name": "15",
				"type": "text"
			},
			{
				"label": "delay",
				"name": "16",
				"type": "text"
			}
		]
	} );

	$('#groups').dataTable( {
		"sDom": "Tfrtip",
		"sAjaxSource": "php/table.groups.php",
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
			},
			{
				"mData": "5"
			},
			{
				"mData": "6"
			},
			{
				"mData": "7"
			},
			{
				"mData": "8"
			},
			{
				"mData": "9"
			},
			{
				"mData": "10"
			},
			{
				"mData": "11"
			},
			{
				"mData": "12"
			},
			{
				"mData": "13"
			},
			{
				"mData": "14"
			},
			{
				"mData": "15"
			},
			{
				"mData": "16"
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

