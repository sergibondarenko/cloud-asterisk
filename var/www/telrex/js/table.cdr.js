
(function($){

$(document).ready(function() {
	var editor = new $.fn.dataTable.Editor( {
		"ajaxUrl": "php/table.cdr.php",
		"domTable": "#cdr",
		"fields": [
			{
				"label": "Calldate",
				"name": "calldate",
				"type": "text"
			},
			{
				"label": "Clid",
				"name": "clid",
				"type": "text"
			},
			{
				"label": "Src",
				"name": "src",
				"type": "text"
			},
			{
				"label": "Dst",
				"name": "dst",
				"type": "text"
			},
			{
				"label": "Dcontext",
				"name": "dcontext",
				"type": "text"
			},
			{
				"label": "Channel",
				"name": "channel",
				"type": "text"
			},
			{
				"label": "Dstchannel",
				"name": "dstchannel",
				"type": "text"
			},
			{
				"label": "Lastapp",
				"name": "lastapp",
				"type": "text"
			},
			{
				"label": "Lastdata",
				"name": "lastdata",
				"type": "text"
			},
			{
				"label": "Duration",
				"name": "duration",
				"type": "text"
			},
			{
				"label": "Billsec",
				"name": "billsec",
				"type": "text"
			},
			{
				"label": "Disposition",
				"name": "disposition",
				"type": "text"
			}/*,
			{
				"label": "Amaflags",
				"name": "amaflags",
				"type": "text"
			},
			{
				"label": "Accountcode",
				"name": "accountcode",
				"type": "text"
			},
			{
				"label": "Uniqueid",
				"name": "uniqueid",
				"type": "text"
			},
			{
				"label": "Userfield",
				"name": "userfield",
				"type": "text"
			}*/
		]
	} );

	$('#cdr').dataTable( {
		"iDisplayLength": 100,
		"sDom": "Tfrtip",
		"sAjaxSource": "php/table.cdr.php",
		"aoColumns": [
			{
				"mData": "calldate"
			},
			{
				"mData": "clid"
			},
			{
				"mData": "src"
			},
			{
				"mData": "dst"
			},
			{
				"mData": "dcontext"
			},
			{
				"mData": "channel"
			},
			{
				"mData": "dstchannel"
			},
			{
				"mData": "lastapp"
			},
			{
				"mData": "lastdata"
			},
			{
				"mData": "duration"
			},
			{
				"mData": "billsec"
			},
			{
				"mData": "disposition"
			}/*,
			{
				"mData": "amaflags"
			},
			{
				"mData": "accountcode"
			},
			{
				"mData": "uniqueid"
			},
			{
				"mData": "userfield"
			}*/

		],
		"oTableTools": {
			/*"sRowSelect": "multi",
			"aButtons": [
				{ "sExtends": "editor_create", "editor": editor },
				{ "sExtends": "editor_edit",   "editor": editor },
				{ "sExtends": "editor_remove", "editor": editor }
			]*/
		}
	} );
} );

}(jQuery));



/*
(function($){

$(document).ready(function() {
	var editor = new $.fn.dataTable.Editor( {
		"ajaxUrl": "php/table.cdr.php",
		"domTable": "#cdr",
		"fields": [
			{
				"label": "calldate",
				"name": "calldate",
				"type": "text"
			},
			{
				"label": "clid",
				"name": "clid",
				"type": "text"
			},
			{
				"label": "src",
				"name": "src",
				"type": "text"
			},
			{
				"label": "dst",
				"name": "dst",
				"type": "text"
			},
			{
				"label": "dcontext",
				"name": "dcontext",
				"type": "text"
			},
			{
				"label": "channel",
				"name": "channel",
				"type": "text"
			},
			{
				"label": "dstchannel",
				"name": "dstchannel",
				"type": "text"
			},
			{
				"label": "lastapp",
				"name": "lastapp",
				"type": "text"
			},
			{
				"label": "lastdata",
				"name": "lastdata",
				"type": "text"
			},
			{
				"label": "duration",
				"name": "duration",
				"type": "text"
			},
			{
				"label": "billsec",
				"name": "billsec",
				"type": "text"
			},
			{
				"label": "disposition",
				"name": "disposition",
				"type": "text"
			},
			{
				"label": "amaflags",
				"name": "amaflags",
				"type": "text"
			},
			{
				"label": "accountcode",
				"name": "accountcode",
				"type": "text"
			},
			{
				"label": "uniqueid",
				"name": "uniqueid",
				"type": "text"
			},
			{
				"label": "userfield",
				"name": "userfield",
				"type": "text"
			}
		]
	} );

	$('#cdr').dataTable( {
		"sDom": "Tfrtip",
        //        "sDom": 'T<"clear">lfrtip',
                //"bJQueryUI": true,
		//"sPaginationType": "full_numbers",
		"sAjaxSource": "php/table.cdr.php",
		"aoColumns": [
			{
				"mData": "calldate"
			},
			{
				"mData": "clid"
			},
			{
				"mData": "src"
			},
			{
				"mData": "dst"
			},
			{
				"mData": "dcontext"
			},
			{
				"mData": "channel"
			},
			{
				"mData": "dstchannel"
			},
			{
				"mData": "lastapp"
			},
			{
				"mData": "lastdata"
			},
			{
				"mData": "duration"
			},
			{
				"mData": "billsec"
			},
			{
				"mData": "disposition"
			},
			{
				"mData": "amaflags"
			},
			{
				"mData": "accountcode"
			},
			{
				"mData": "uniqueid"
			},
			{
				"mData": "userfield"
			}
		],
		"oTableTools": {
			
			/*"sRowSelect": "multi",
			"aButtons": [
				{ "sExtends": "editor_create", "editor": editor },
				{ "sExtends": "editor_edit",   "editor": editor },
				{ "sExtends": "editor_remove", "editor": editor }
			]*/
                        /*"sSwfPath": "extras/TableTools/media/swf/copy_csv_xls_pdf.swf",
                        "aButtons": [
				"copy",
				"csv",
				{
                                    "sExtends": "xls",
                                    "sFileName": "*.xls"
                                //"bFooter": false
                                },
				{
					"sExtends": "pdf",
					"sPdfOrientation": "landscape",
					"sPdfMessage": "CDR"
				},
                                "print"
				
			]*/
                        /*"aButtons": [ "copy",
                            {
                                "sExtends": "xls",
                                "sFileName": "*.xls",
                                "bFooter": false
                            },
                            {
                                "sExtends": "pdf",
                                "sFileName": "TableTools.csv"
                            }
                        ]*/
                      /*  "aButtons": [
				"print",
                                "copy",
				"csv",
				"xls",
				{
					"sExtends": "pdf",
					"sPdfOrientation": "landscape",
					"sPdfMessage": "Your custom message would go here."
				}
				
			]*/
                       /* "aButtons": [
				"copy", "csv", "xls", "pdf",
				{
					"sExtends":    "collection",
					"sButtonText": "Save",
					"aButtons":    [ "csv", "xls", "pdf" ]
				}
			]*/
			/*"sRowSelect": "multi",
			"aButtons": [
				{ "sExtends": "editor_create", "editor": editor },
				{ "sExtends": "editor_edit",   "editor": editor },
				{ "sExtends": "editor_remove", "editor": editor }
			]*/
/*		}
	} );
} );

}(jQuery));*/
