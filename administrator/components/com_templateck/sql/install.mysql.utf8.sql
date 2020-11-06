DROP TABLE IF EXISTS `#__templateck_templates`;

CREATE TABLE IF NOT EXISTS `#__templateck_templates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `joomlaversion` text NOT NULL,
  `name` text NOT NULL,
  `ordering` int(11) NOT NULL,
  `published` int(11) NOT NULL DEFAULT '1',
  `creationdate` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `authoremail` varchar(255) NOT NULL,
  `authorurl` varchar(255) NOT NULL,
  `copyright` varchar(255) NOT NULL,
  `license` varchar(255) NOT NULL,
  `version` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `htmlcode` longtext NOT NULL,
  `theme` text NOT NULL,
  `cssparams` text NOT NULL,
  `options` text NOT NULL,
  `htmlcode_responsive` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


INSERT INTO `#__templateck_templates` (`id`, `joomlaversion`, `name`, `ordering`, `published`, `creationdate`, `author`, `authoremail`, `authorurl`, `copyright`, `license`, `version`, `description`, `htmlcode`, `theme`, `cssparams`, `options`, `htmlcode_responsive`) VALUES
(1, 'j3', 'templatecreator_blank', 0, 1, '08/03/13', 'Cedric KEIFLIN', '', 'http://www.joomlack.fr', 'Cedric KEIFLIN', 'GNU/GPL', '1.0.0', 'Demo template for Template Creator CK v3', '', '', '', '', '');


CREATE TABLE IF NOT EXISTS `#__templateck_fonts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `styles` text NOT NULL,
  `fontfamilies` text NOT NULL,
  `published` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;