
(function($){

$(document).ready(function() {
	var editor = new $.fn.dataTable.Editor( {
		"ajaxUrl": "php/table.voicemails.php",
		"domTable": "#voicemails",
		"fields": [
			{
				"label": "Customer_id",
				"name": "customer_id",
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
					}
				]
			},
			{
				"label": "VMailbox",
				"name": "mailbox",
				"type": "text"
			},
			{
				"label": "Password",
				"name": "password",
				"type": "text"
			},
			{
				"label": "Fullname",
				"name": "fullname",
				"type": "text"
			},
			{
				"label": "Email",
				"name": "email",
				"type": "text"
			}
		]
	} );

	$('#voicemails').dataTable( {
		"iDisplayLength": 25,
		"sDom": "Tfrtip",
		"sAjaxSource": "php/table.voicemails.php",
		"aoColumns": [
			{
				"mData": "customer_id"
			},
			{
				"mData": "context"
			},
			{
				"mData": "mailbox"
			},
			{
				"mData": "password"
			},
			{
				"mData": "fullname"
			},
			{
				"mData": "email"
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
