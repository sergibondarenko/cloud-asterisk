


(function($){

$(document).ready(function() {
	var editor = new $.fn.dataTable.Editor( {
		"ajaxUrl": "php/table.input.php",
		"domTable": "#input",
		"fields": [
			{
				"label": "Type",
				"name": "1",
				"type": "select",
				"ipOpts": [
					{
						"label": "day",
						"value": "day"
					},
					{
						"label": "night",
						"value": "night"
					},
					{
						"label": "holiday",
						"value": "holiday"
					},
				]
			},
                        {
				"label": "Incomming Num",
				"name": "2",
				"type": "text"
			},
			{
				"label": "Sound",
				"name": "3",
				"type": "text"
			},
			{
				"label": "Button",
				"name": "4",
				"type": "text"
			},
			{
				"label": "Queue/ext",
				"name": "5",
				"type": "text"
			},
			{
				"label": "Button",
				"name": "6",
				"type": "text"
			},
			{
				"label": "Queue/ext",
				"name": "7",
				"type": "text"
			},
			{
				"label": "Button",
				"name": "8",
				"type": "text"
			},
			{
				"label": "Queue/ext",
				"name": "9",
				"type": "text"
			},
			{
				"label": "Button",
				"name": "10",
				"type": "text"
			},
			{
				"label": "Queue/ext",
				"name": "11",
				"type": "text"
			},
			{
				"label": "Button",
				"name": "12",
				"type": "text"
			},
			{
				"label": "Queue/ext",
				"name": "13",
				"type": "text"
			}
			
		]
	} );

	$('#input').dataTable( {
		"sDom": "Tfrtip",
		"sAjaxSource": "php/table.input.php",
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

