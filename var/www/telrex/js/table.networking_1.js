


(function($){

$(document).ready(function() {
	var editor = new $.fn.dataTable.Editor( {
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
				{ "sExtends": "editor_create", "editor": editor },
				{ "sExtends": "editor_edit",   "editor": editor },
				{ "sExtends": "editor_remove", "editor": editor }
			]
		}
	} );
} );

}(jQuery));

