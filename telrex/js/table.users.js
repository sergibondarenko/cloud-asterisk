


(function($){

$(document).ready(function() {
	var editor = new $.fn.dataTable.Editor( {
		"ajaxUrl": "php/table.users.php",
		"domTable": "#users",
		"fields": [
			{
				"label": "Username",
				"name": "username",
				"type": "text"
			},
			{
				"label": "Password",
				"name": "password",
				"type": "text"
			}/*,
			{
				"label": "Permissions",
				"name": "permissions",
				"type": "text"
			},
			{
				"label": "Homedir",
				"name": "homedir",
				"type": "text"
			}*/
		]
	} );

	$('#users').dataTable( {
		"sDom": "Tfrtip",
		"sAjaxSource": "php/table.users.php",
		"aoColumns": [
			{
				"mData": "username"
			},
			{
				"mData": "password"
			}/*,
			{
				"mData": "permissions"
			},
			{
				"mData": "homedir"
			}*/
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

