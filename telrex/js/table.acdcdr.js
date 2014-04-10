
(function($){

$(document).ready(function() {
	var editor = new $.fn.dataTable.Editor( {
		"ajaxUrl": "php/table.acdcdr.php",
		"domTable": "#acdcdr",
		"fields": [
			{
				"label": "Time",
				"name": "time",
				"type": "text"
			},
			{
				"label": "Callid",
				"name": "callid",
				"type": "text"
			},
			{
				"label": "Queuename",
				"name": "queuename",
				"type": "text"
			},
			{
				"label": "Agent",
				"name": "agent",
				"type": "text"
			},
			{
				"label": "Event",
				"name": "event",
				"type": "text"
			},
			{
				"label": "Data1",
				"name": "data1",
				"type": "text"
			},
			{
				"label": "Data2",
				"name": "data2",
				"type": "text"
			},
			{
				"label": "Data3",
				"name": "data3",
				"type": "text"
			},
			{
				"label": "Data4",
				"name": "data4",
				"type": "text"
			},
			{
				"label": "Data5",
				"name": "data5",
				"type": "text"
			},
			/*{
				"label": "Billsec",
				"name": "billsec",
				"type": "text"
			},
			{
				"label": "Disposition",
				"name": "disposition",
				"type": "text"
			},
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

	$('#acdcdr').dataTable( {
		"iDisplayLength": 100,
		"sDom": "Tfrtip",
		"sAjaxSource": "php/table.acdcdr.php",
		"aoColumns": [
			{
				"mData": "time"
			},
			{
				"mData": "callid"
			},
			{
				"mData": "queuename"
			},
			{
				"mData": "agent"
			},
			{
				"mData": "event"
			},
			{
				"mData": "data1"
			},
			{
				"mData": "data2"
			},
			{
				"mData": "data3"
			},
			{
				"mData": "data4"
			},
			{
				"mData": "data5"
			}/*,
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
		"ajaxUrl": "php/table.acdcdr.php",
		"domTable": "#acdcdr",
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

	$('#acdcdr').dataTable( {
		"sDom": "Tfrtip",
        //        "sDom": 'T<"clear">lfrtip',
                //"bJQueryUI": true,
		//"sPaginationType": "full_numbers",
		"sAjaxSource": "php/table.acdcdr.php",
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
					"sPdfMessage": "acdcdr"
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
