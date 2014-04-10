


(function($){

$(document).ready(function() {
	var editor = new $.fn.dataTable.Editor( {
		"ajaxUrl": "php/table.extensions.php",
		"domTable": "#routing",
		"fields": [
			{
				"label": "Comments",
				"name": "comments",
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
					},
					{
						"label": "ivr",
						"value": "ivr"
					}
				]
			},
			{
				"label": "Extension",
				"name": "exten",
				"type": "text"
			},
			{
				"label": "Priority",
				"name": "priority",
				"type": "text"
			},
			/*{
				"label": "App",
				"name": "app",
				"type": "text"
			},*/
			{
				"label": "App",
				"name": "app",
				"type": "select",
				"ipOpts": [
					{
						"label": "AddQueueMember",
						"value": "AddQueueMember"
					},
					{
						"label": "AgentLogin",
						"value": "AgentLogin"
					},
					{
						"label": "AgentMonitorOutgoing",
						"value": "AgentMonitorOutgoing"
					},
					{
						"label": "Answer",
						"value": "Answer"
					},
					{
						"label": "Authenticate",
						"value": "Authenticate"
					},
					{
						"label": "BackGround",
						"value": "BackGround"
					},
					{
						"label": "BackgroundDetect",
						"value": "BackgroundDetect"
					},
					{
						"label": "Busy",
						"value": "Busy"
					},
					{
						"label": "ChangeMonitor",
						"value": "ChangeMonitor"
					},
					{
						"label": "ChanIsAvail",
						"value": "ChanIsAvail"
					},
					{
						"label": "ChannelRedirect",
						"value": "ChannelRedirect"
					},
					{
						"label": "ChanSpy",
						"value": "ChanSpy"
					},
					{
						"label": "ConfBridge",
						"value": "ConfBridge"
					},
					{
						"label": "Congestion",
						"value": "Congestion"
					},
					{
						"label": "Dial",
						"value": "Dial"
					},
					{
						"label": "Dictate",
						"value": "Dictate"
					},
					{
						"label": "Directory",
						"value": "Directory"
					},
					{
						"label": "DISA",
						"value": "DISA"
					},
					{
						"label": "Echo",
						"value": "Echo"
					},
					{
						"label": "ExtenSpy",
						"value": "ExtenSpy"
					},
					{
						"label": "Festival",
						"value": "Festival"
					},
					{
						"label": "FollowMe",
						"value": "FollowMe"
					},
					{
						"label": "Gosub",
						"value": "Gosub"
					},
					{
						"label": "GosubIf",
						"value": "GosubIf"
					},
					{
						"label": "Goto",
						"value": "Goto"
					},
					{
						"label": "GotoIf",
						"value": "GotoIf"
					},
					{
						"label": "GotoIfTime",
						"value": "GotoIfTime"
					},
					{
						"label": "Hangup",
						"value": "Hangup"
					},
					{
						"label": "JabberJoin",
						"value": "JabberJoin"
					},
					{
						"label": "JabberLeave",
						"value": "JabberLeave"
					},
					{
						"label": "JabberSend",
						"value": "JabberSend"
					},
					{
						"label": "JabberSendGroup",
						"value": "JabberSendGroup"
					},
					{
						"label": "JabberStatus",
						"value": "JabberStatus"
					},
					{
						"label": "Macro",
						"value": "Macro"
					},
					{
						"label": "MacroExclusive",
						"value": "MacroExclusive"
					},
					{
						"label": "MacroExit",
						"value": "MacroExit"
					},
					{
						"label": "MacroIf",
						"value": "MacroIf"
					},
					{
						"label": "MixMonitor",
						"value": "MixMonitor"
					},
					{
						"label": "Monitor",
						"value": "Monitor"
					},
					{
						"label": "MusicOnHold",
						"value": "MusicOnHold"
					},
					{
						"label": "NoOp",
						"value": "NoOp"
					},
					{
						"label": "Page",
						"value": "Page"
					},
					{
						"label": "Park",
						"value": "Park"
					},
					{
						"label": "ParkAndAnnounce",
						"value": "ParkAndAnnounce"
					},
					{
						"label": "ParkedCall",
						"value": "ParkedCall"
					},
					{
						"label": "PauseMonitor",
						"value": "PauseMonitor"
					},
					{
						"label": "PauseQueueMember",
						"value": "PauseQueueMember"
					},
					{
						"label": "Pickup",
						"value": "Pickup"
					},
					{
						"label": "Playback",
						"value": "Playback"
					},
					{
						"label": "Queue",
						"value": "Queue"
					},
					{
						"label": "QueueLog",
						"value": "QueueLog"
					},
					{
						"label": "Record",
						"value": "Record"
					},
					{
						"label": "RemoveQueueMember",
						"value": "RemoveQueueMember"
					},
					{
						"label": "Set",
						"value": "Set"
					},
					{
						"label": "SetMusicOnHold",
						"value": "SetMusicOnHold"
					},
					{
						"label": "StartMusicOnHold",
						"value": "StartMusicOnHold"
					},
					{
						"label": "StopMixMonitor",
						"value": "StopMixMonitor"
					},
					{
						"label": "StopMonitor",
						"value": "StopMonitor"
					},
					{
						"label": "Transfer",
						"value": "Transfer"
					},
					{
						"label": "VoiceMail",
						"value": "VoiceMail"
					},
					{
						"label": "Wait",
						"value": "Wait"
					},
					{
						"label": "WaitExten",
						"value": "WaitExten"
					}
				]
			},
			{
				"label": "Appdata",
				"name": "appdata",
				"type": "text"
			}
		]
	} );

	$('#routing').dataTable( {
		"iDisplayLength": 50,
		"sDom": "Tfrtip",
		"sAjaxSource": "php/table.extensions.php",
		"aoColumns": [
			{
				"mData": "comments"
			},
			{
				"mData": "context"
			},
			{
				"mData": "exten"
			},
			{
				"mData": "priority"
			},
			{
				"mData": "app"
			},
			{
				"sWidth": "60%",
				"mData": "appdata"
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

