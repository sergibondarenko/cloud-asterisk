


(function($){

$(document).ready(function() {
	var editor = new $.fn.dataTable.Editor( {
		"ajaxUrl": "php/table.queues.php",
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
			},
			/*{
				"label": "Member Announce",
				"name": "announce",
				"type": "text"
			},*/
			{
				"label": "Announce_freq",
				"name": "announce_frequency",
				"type": "text"
			},
			{
				"label": "Context",
				"name": "context",
				"type": "text"
			},
			{
				"label": "Timeout",
				"name": "timeout",
				"type": "text"
			},
			{
				"label": "Maxlen",
				"name": "maxlen",
				"type": "text"
			}
		]
	} );

	$('#queues').dataTable( {
		"sDom": "Tfrtip",
		"sAjaxSource": "php/table.queues.php",
		"aoColumns": [
			{
				"mData": "name"
			},
			{
				"mData": "musiconhold"
			},
			/*{
				"mData": "announce"
			},*/
			{
				"mData": "announce_frequency"
			},
			{
				"mData": "context"
			},
			{
				"mData": "timeout"
			},
			{
				"mData": "maxlen"
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

