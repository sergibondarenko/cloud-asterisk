#
# Table structure for table `sipfriends`
#

CREATE TABLE IF NOT EXISTS `sipfriends` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `name` varchar(40) NOT NULL,
      `ipaddr` varchar(15) DEFAULT NULL,
      `port` int(5) DEFAULT NULL,
      `regseconds` int(11) DEFAULT NULL,
      `defaultuser` varchar(20) DEFAULT NULL,
      `fullcontact` varchar(35) DEFAULT NULL,
      `regserver` varchar(20) DEFAULT NULL,
      `useragent` varchar(20) DEFAULT NULL,
      `lastms` int(11) DEFAULT NULL,
      `host` varchar(40) DEFAULT NULL,
      `type` enum('friend','user','peer') DEFAULT NULL,
      `context` varchar(40) DEFAULT NULL,
      `deny` varchar(40) DEFAULT NULL,
      `permit` varchar(40) DEFAULT NULL,
      `secret` varchar(40) DEFAULT NULL,
      `md5secret` varchar(40) DEFAULT NULL,
      `remotesecret` varchar(40) DEFAULT NULL,
      `transport` enum('udp','tcp','udp,tcp','tcp,udp') DEFAULT NULL,
      `dtmfmode` enum('rfc2833','info','shortinfo','inband','auto') DEFAULT NULL,
      `directmedia` enum('yes','no','nonat','update') DEFAULT NULL,
      `nat` enum('force_rport,comedia','no','force_rport','comedia','auto_force_rport','auto_comedia') DEFAULT NULL,
      `callgroup` varchar(40) DEFAULT NULL,
      `pickupgroup` varchar(40) DEFAULT NULL,
      `language` varchar(40) DEFAULT NULL,
      `disallow` varchar(40) DEFAULT NULL,
      `allow` varchar(40) DEFAULT NULL,
      `insecure` varchar(40) DEFAULT NULL,
      `trustrpid` enum('yes','no') DEFAULT NULL,
      `progressinband` enum('yes','no','never') DEFAULT NULL,
      `promiscredir` enum('yes','no') DEFAULT NULL,
      `useclientcode` enum('yes','no') DEFAULT NULL,
      `accountcode` varchar(40) DEFAULT NULL,
      `setvar` varchar(40) DEFAULT NULL,
      `callerid` varchar(40) DEFAULT NULL,
      `amaflags` varchar(40) DEFAULT NULL,
      `callcounter` enum('yes','no') DEFAULT NULL,
      `busylevel` int(11) DEFAULT NULL,
      `allowoverlap` enum('yes','no') DEFAULT NULL,
      `allowsubscribe` enum('yes','no') DEFAULT NULL,
      `videosupport` enum('yes','no') DEFAULT NULL,
      `maxcallbitrate` int(11) DEFAULT NULL,
      `rfc2833compensate` enum('yes','no') DEFAULT NULL,
      `mailbox` varchar(40) DEFAULT NULL,
      `session-timers` enum('accept','refuse','originate') DEFAULT NULL,
      `session-expires` int(11) DEFAULT NULL,
      `session-minse` int(11) DEFAULT NULL,
      `session-refresher` enum('uac','uas') DEFAULT NULL,
      `t38pt_usertpsource` varchar(40) DEFAULT NULL,
      `regexten` varchar(40) DEFAULT NULL,
      `fromdomain` varchar(40) DEFAULT NULL,
      `fromuser` varchar(40) DEFAULT NULL,
      `qualify` varchar(40) DEFAULT NULL,
      `defaultip` varchar(40) DEFAULT NULL,
      `rtptimeout` int(11) DEFAULT NULL,
      `rtpholdtimeout` int(11) DEFAULT NULL,
      `sendrpid` enum('yes','no') DEFAULT NULL,
      `outboundproxy` varchar(40) DEFAULT NULL,
      `callbackextension` varchar(40) DEFAULT NULL,
      `registertrying` enum('yes','no') DEFAULT NULL,
      `timert1` int(11) DEFAULT NULL,
      `timerb` int(11) DEFAULT NULL,
      `qualifyfreq` int(11) DEFAULT NULL,
      `constantssrc` enum('yes','no') DEFAULT NULL,
      `contactpermit` varchar(40) DEFAULT NULL,
      `contactdeny` varchar(40) DEFAULT NULL,
      `usereqphone` enum('yes','no') DEFAULT NULL,
      `textsupport` enum('yes','no') DEFAULT NULL,
      `faxdetect` enum('yes','no') DEFAULT NULL,
      `buggymwi` enum('yes','no') DEFAULT NULL,
      `auth` varchar(40) DEFAULT NULL,
      `fullname` varchar(40) DEFAULT NULL,
      `trunkname` varchar(40) DEFAULT NULL,
      `cid_number` varchar(40) DEFAULT NULL,
      `callingpres` enum('allowed_not_screened','allowed_passed_screen','allowed_failed_screen','allowed','prohib_not_screened','prohib_passed_screen','prohib_failed_screen','prohib') DEFAULT NULL,
      `mohinterpret` varchar(40) DEFAULT NULL,
      `mohsuggest` varchar(40) DEFAULT NULL,
      `parkinglot` varchar(40) DEFAULT NULL,
      `hasvoicemail` enum('yes','no') DEFAULT NULL,
      `subscribemwi` enum('yes','no') DEFAULT NULL,
      `vmexten` varchar(40) DEFAULT NULL,
      `autoframing` enum('yes','no') DEFAULT NULL,
      `rtpkeepalive` int(11) DEFAULT NULL,
      `call-limit` int(11) DEFAULT NULL,
      `g726nonstandard` enum('yes','no') DEFAULT NULL,
      `ignoresdpversion` enum('yes','no') DEFAULT NULL,
      `allowtransfer` enum('yes','no') DEFAULT NULL,
      `dynamic` enum('yes','no') DEFAULT NULL,
      PRIMARY KEY (`id`),
      UNIQUE KEY `name` (`name`),
      KEY `ipaddr` (`ipaddr`,`port`),
      KEY `host` (`host`,`port`)
) ENGINE=MyISAM;


CREATE TABLE IF NOT EXISTS `extensions` (
	`id` int(11) NOT NULL auto_increment,
	`context` varchar(20) NOT NULL default "",
	`exten` varchar(20) NOT NULL default "",
	`priority` tinyint(4) NOT NULL default "0",
	`app` varchar(20) NOT NULL default "",
	`appdata` varchar(128) NOT NULL default "",
	/*PRIMARY KEY  (`context`,`exten`,`priority`),
	KEY `id` (`id`)*/
	PRIMARY KEY  (`id`)
) ENGINE=MyISAM; 



CREATE TABLE IF NOT EXISTS `cdr` ( 
	`id` int(10) NOT NULL auto_increment,
        `calldate` datetime NOT NULL default '0000-00-00 00:00:00', 
        `clid` varchar(80) NOT NULL default '', 
        `src` varchar(80) NOT NULL default '', 
        `dst` varchar(80) NOT NULL default '', 
        `dcontext` varchar(80) NOT NULL default '', 
        `channel` varchar(80) NOT NULL default '', 
        `dstchannel` varchar(80) NOT NULL default '', 
        `lastapp` varchar(80) NOT NULL default '', 
        `lastdata` varchar(80) NOT NULL default '', 
        `duration` int(11) NOT NULL default '0', 
        `billsec` int(11) NOT NULL default '0', 
        `disposition` varchar(45) NOT NULL default '', 
        `amaflags` int(11) NOT NULL default '0', 
        `accountcode` varchar(20) NOT NULL default '', 
        `uniqueid` varchar(32) NOT NULL default '', 
        `userfield` varchar(255) NOT NULL default '',
	KEY `id` (`id`) 
) ENGINE=MyISAM;

CREATE TABLE IF NOT EXISTS `voicemails` ( 
	`id` int(11) NOT NULL auto_increment,
  	`customer_id` varchar(11) NOT NULL default '0',
  	`context` varchar(50) NOT NULL,
  	`mailbox` varchar(11) NOT NULL default '0',
  	`password` varchar(5) NOT NULL default '0',
  	`fullname` varchar(150) NOT NULL,
  	`email` varchar(50) NOT NULL,
  	`pager` varchar(50) NOT NULL,
  	`tz` varchar(10) NOT NULL default 'central',
  	`attach` varchar(4) NOT NULL default 'yes',
  	`saycid` varchar(4) NOT NULL default 'yes',
  	`dialout` varchar(10) NOT NULL,
  	`callback` varchar(10) NOT NULL,
  	`review` varchar(4) NOT NULL default 'no',
  	`operator` varchar(4) NOT NULL default 'no',
  	`envelope` varchar(4) NOT NULL default 'no',
  	`sayduration` varchar(4) NOT NULL default 'no',
  	`saydurationm` tinyint(4) NOT NULL default '1',
  	`sendvoicemail` varchar(4) NOT NULL default 'no',
  	`delete` varchar(4) NOT NULL default 'no',
  	`nextaftercmd` varchar(4) NOT NULL default 'yes',
  	`forcename` varchar(4) NOT NULL default 'no',
  	`forcegreetings` varchar(4) NOT NULL default 'no',
  	`hidefromdir` varchar(4) NOT NULL default 'yes',
  	`stamp` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
	KEY `id` (`id`) 
) ENGINE=MyISAM;


CREATE TABLE IF NOT EXISTS `queues` ( 
	`id` int(11) NOT NULL auto_increment,
  	`name` varchar(128) NOT NULL,
  	`musiconhold` varchar(128) default NULL,
  	`announce` varchar(128) default NULL,
  	`context` varchar(128) default NULL,
  	`timeout` int(11) default NULL,
  	`monitor_join` tinyint(1) default NULL,
  	`monitor_format` varchar(128) default NULL,
  	`queue_youarenext` varchar(128) default NULL,
  	`queue_thereare` varchar(128) default NULL,
  	`queue_callswaiting` varchar(128) default NULL,
  	`queue_holdtime` varchar(128) default NULL,
  	`queue_minutes` varchar(128) default NULL,
  	`queue_seconds` varchar(128) default NULL,
  	`queue_lessthan` varchar(128) default NULL,
  	`queue_thankyou` varchar(128) default NULL,
  	`queue_reporthold` varchar(128) default NULL,
  	`announce_frequency` int(11) default NULL,
  	`announce_round_seconds` int(11) default NULL,
  	`announce_holdtime` varchar(128) default NULL,
  	`retry` int(11) default NULL,
  	`wrapuptime` int(11) default NULL,
  	`maxlen` int(11) default NULL,
  	`servicelevel` int(11) default NULL,
  	`strategy` varchar(128) default NULL,
  	`joinempty` varchar(128) default NULL,
  	`leavewhenempty` varchar(128) default NULL,
  	`eventmemberstatus` tinyint(1) default NULL,
  	`eventwhencalled` tinyint(1) default NULL,
  	`reportholdtime` tinyint(1) default NULL,
  	`memberdelay` int(11) default NULL,
  	`weight` int(11) default NULL,
  	`timeoutrestart` tinyint(1) default NULL,
  	`periodic_announce` varchar(50) default NULL,
  	`periodic_announce_frequency` int(11) default NULL,
  	`ringinuse` tinyint(1) default NULL,
  	`setinterfacevar` tinyint(1) default NULL,
	PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `queue_members` ( 
	`id` int(11) NOT NULL auto_increment,
	`uniqueid` int(10) default NULL,
  	`membername` varchar(40) default NULL,
  	`queue_name` varchar(128) default NULL,
  	`interface` varchar(128) default NULL,
  	`penalty` int(11) default NULL,
  	`paused` int(11) default NULL,
	PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `meetme` ( 
	`id` int(11) NOT NULL auto_increment,
  	`confno` varchar(80) NOT NULL default '0',
  	`username` varchar(64) NOT NULL default '',
  	`domain` varchar(128) NOT NULL default '',
  	`pin` varchar(20) default NULL,
  	`adminpin` varchar(20) default NULL,
  	`members` int(11) NOT NULL default '0',
	PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `musiconhold` ( 
	`id` int(11) NOT NULL auto_increment,
  	`name` varchar(128) NOT NULL default '',
  	`directory` varchar(128) NOT NULL default '',
  	`application` varchar(128) NOT NULL default '',
  	`mode` varchar(20) NOT NULL default '',
  	`digit` int(20) default NULL,
  	`sort` varchar(20) NOT NULL default '',
  	`format` varchar(11) NOT NULL default '',
	PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `queue_log` ( 
	`id` int(11) NOT NULL auto_increment,
	`time` char(26) default NULL,
  	`callid` varchar(32) NOT NULL default '',
  	`queuename` varchar(32) NOT NULL default '',
  	`agent` varchar(32) NOT NULL default '',
  	`event` varchar(32) NOT NULL default '',
  	`data1` varchar(100) NOT NULL default '',
  	`data2` varchar(100) NOT NULL default '',
  	`data3` varchar(100) NOT NULL default '',
  	`data4` varchar(100) NOT NULL default '',
  	`data5` varchar(100) NOT NULL default '',
	PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*CREATE TABLE IF NOT EXISTS  `users` (
	`id` int(10) NOT NULL auto_increment,
	`username` varchar(20) default NULL,
	`password` varchar(20) default NULL,
	PRIMARY KEY  (`id`)
) ENGINE=MyISAM;*/

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `permissions` varchar(10) NOT NULL DEFAULT '',
  `homedir` varchar(1000) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `akey` varchar(255) NOT NULL DEFAULT '',
  `usage` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `akey` (`akey`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

DELETE FROM `users`;
INSERT INTO `users` (`id`, `username`, `password`, `permissions`, `homedir`, `email`, `akey`, `usage`) VALUES
	(1, 'admin', '04d1f7ae0e925eec6259332ea5c6e410', 'rwu', '', '', '', NULL),
	(2, 'fileadmin', '04d1f7ae0e925eec6259332ea5c6e410', 'rwu', '/var/spool/asterisk/', '', '', NULL);


/*CREATE TABLE IF NOT EXISTS  `callback` (
	`id` int(10) NOT NULL auto_increment,
	`phone` varchar(80) NOT NULL DEFAULT '',
	`pin` varchar(20) NOT NULL DEFAULT '3051',
	`callback` varchar(20) NOT NULL DEFAULT '0',
	`user` varchar(20) NOT NULL DEFAULT '',
	PRIMARY KEY  (`id`)
) ENGINE=MyISAM;*/
