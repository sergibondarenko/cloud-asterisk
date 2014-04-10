
(function($){

$(document).ready(function() {
	var editor = new $.fn.dataTable.Editor( {
		"ajaxUrl": "php/table.trunks.php",
		"domTable": "#trunks",
		"fields": [
			/*{
				"label": "Id",
				"name": "id",
				"type": "text"
			},*/
			{
				"label": "Name",
				"name": "name",
				"type": "text"
			},
			{
				"label": "Auth",
				"name": "auth",
				"type": "text"
			},
			{
				"label": "Fromdomain",
				"name": "fromdomain",
				"type": "text"
			},
			{
				"label": "Type",
				"name": "type",
				"type": "select",
				"ipOpts": [
					{
						"label": "user",
						"value": "user"
					},
					{
						"label": "peer",
						"value": "peer"
					},
					{
						"label": "friend",
						"value": "friend"
					}
				]
			},
			{
				"label": "Context",
				"name": "context",
				"type": "text"
			},
			{
				"label": "Host",
				"name": "host",
				"type": "text"
			},
			{
				"label": "Secret",
				"name": "secret",
				"type": "text"
			},
			{
				"label": "Qualify",
				"name": "qualify",
				"type": "select",
				"ipOpts": [
					{
						"label": "yes",
						"value": "yes"
					},
					{
						"label": "no",
						"value": "no"
					}
				]
			},
			{
				"label": "Nat",
				"name": "nat",
				"type": "select",
				"ipOpts": [
					{
						"label": "yes",
						"value": "yes"
					},
					{
						"label": "no",
						"value": "no"
					},
					{
						"label": "never",
						"value": "never"
					},
					{
						"label": "route",
						"value": "route"
					}
				]
			},
			{
				"label": "Directmedia",
				"name": "directmedia",
				"type": "select",
				"ipOpts": [
					{
						"label": "yes",
						"value": "yes"
					},
					{
						"label": "no",
						"value": "no"
					},
					{
						"label": "nonat",
						"value": "nonat"
					},
					{
						"label": "update",
						"value": "update"
					}
				]
			},
			{
				"label": "Dtmfmode",
				"name": "dtmfmode",
				"type": "select",
				"ipOpts": [
					{
						"label": "auto",
						"value": "auto"
					},
					{
						"label": "rfc2833",
						"value": "rfc2833"
					},
					{
						"label": "info",
						"value": "info"
					},
					{
						"label": "shortinfo",
						"value": "shortinfo"
					},
					{
						"label": "inband",
						"value": "inband"
					}
				]
			}
			
			
		]
	} );

	$('#trunks').dataTable( {
		"sDom": "Tfrtip",
		"sAjaxSource": "php/table.trunks.php",
		"aoColumns": [
			/*{
				"mData": "id"
			},*/
			{
				"mData": "name"
			},
			{
				"mData": "auth"
			},
			{
				"mData": "fromdomain"
			},
			{
				"mData": "type"
			},
			{
				"mData": "context"
			},
			{
				"mData": "host"
			},
			{
				"mData": "secret"
			},
			{
				"mData": "qualify"
			},
			{
				"mData": "nat"
			},
			{
				"mData": "directmedia"
			},
			{
				"mData": "dtmfmode"
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
