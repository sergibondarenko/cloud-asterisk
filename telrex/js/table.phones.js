
(function($){

$(document).ready(function() {
	var editor = new $.fn.dataTable.Editor( {
		"ajaxUrl": "php/table.phones.php",
		"domTable": "#phones",
		"fields": [
			{
				"label": "Name",
				"name": "name",
				"type": "text"
			},
			/*{
				"label": "Auth",
				"name": "auth",
				"type": "text"
			},*/
			{
				"label": "Defaultuser",
				"name": "defaultuser",
				"type": "text"
			},
			{
				"label": "Callerid",
				"name": "callerid",
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
					}
				]
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
						"label": "force_rport,comedia",
						"value": "force_rport,comedia"
					},
					{
						"label": "no",
						"value": "no"
					},
					{
						"label": "force_rport",
						"value": "force_rport"
					},
					{
						"label": "comedia",
						"value": "comedia"
					},
					{
						"label": "auto_force_rport",
						"value": "auto_force_rport"
					},
					{
						"label": "auto_comedia",
						"value": "auto_comedia"
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
			},
			{
				"label": "VMail",
				"name": "hasvoicemail",
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
			}
		]
	} );

	$('#phones').dataTable( {
		"iDisplayLength": 25,
		"sDom": "Tfrtip",
		"sAjaxSource": "php/table.phones.php",
		"aoColumns": [
			{
				"mData": "name"
			},
			/*{
				"mData": "auth"
			},*/
			{
				"mData": "defaultuser"
			},
			{
				"mData": "callerid"
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
			},
			{
				"mData": "hasvoicemail"
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
