CREATE TABLE `locations` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `fname` varchar(60) default NULL,
  `lname` varchar(60) default NULL,
  `twitter` varchar(60) default NULL,
  `city` varchar(60) default NULL,
  `state` varchar(60) default NULL,
  `lat` double default NULL,
  `long` double default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;