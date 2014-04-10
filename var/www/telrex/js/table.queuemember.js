


(function($){

$(document).ready(function() {
	var editor = new $.fn.dataTable.Editor( {
		"ajaxUrl": "php/table.queuemember.php",
		"domTable": "#queuemember",
		"fields": [
			{
				"label": "Uniqueid",
				"name": "uniqueid",
				"type": "text"
			},
			{
				"label": "Membername",
				"name": "membername",
				"type": "text"
			},
			{
				"label": "Queue_name",
				"name": "queue_name",
				"type": "text"
			},
			{
				"label": "Interface",
				"name": "interface",
				"type": "text"
			},
			{
				"label": "Penalty",
				"name": "penalty",
				"type": "text"
			},
			{
				"label": "Paused",
				"name": "paused",
				"type": "text"
			}
		]
	} );

	$('#queuemember').dataTable( {
		"sDom": "Tfrtip",
		"sAjaxSource": "php/table.queuemember.php",
		"aoColumns": [
			{
				"mData": "uniqueid"
			},
			{
				"mData": "membername"
			},
			{
				"mData": "queue_name"
			},
			{
				"mData": "interface"
			},
			{
				"mData": "penalty"
			},
			{
				"mData": "paused"
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

