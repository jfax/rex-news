-- News Addon
--
-- @author Jens Fuchs - fuchs@d-mind.de
-- @package redaxo4
-- @version $Id:$


CREATE TABLE `%TABLE_PREFIX%336_news` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `clang` int(2) NOT NULL default '0',
  `online_date` date default NULL,
  `archive_date` date default NULL,  
  `offline_date` date NOT NULL,
  `createdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,  
  `name` varchar(255) NOT NULL,
  `teaser` text NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `subheadline` text NOT NULL,
  `article` text NOT NULL,
  `author` int(2) NOT NULL default '0',
  `image` varchar(255) NOT NULL,
  `image_descr` varchar(255) NOT NULL,
  `image_header` varchar(512) NOT NULL,
  `thumb` varchar(255) NOT NULL,
  `filelist` text NOT NULL,
  `category` varchar(255) NOT NULL default '0',
  `flag` int(1) NOT NULL default '0',
  `archive` int(1) NOT NULL default '0',
  `status` int(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2;


INSERT INTO `%TABLE_PREFIX%336_news` (`id`, `clang`, `online_date`, `archive_date`, `offline_date`, `createdate`, `name`, `teaser`, `subheadline`, `article`, `author`, `image`, `image_descr`, `image_header`, `thumb`, `filelist`, `category`, `flag`, `archive`, `status`) 
VALUES(45, 0, '2012-06-04', '2015-08-04', '2020-10-04', NOW(), 'Cras scelerisque tempor enim.', 'Integer pretium pede ut purus gravida pharetra. Morbi condimentum massa. Sed vel massa sit amet nisl euismod cursus.', 'Integer pretium pede ut purus gravida pharetra. Morbi condimentum massa. Sed vel massa sit amet nisl euismod cursus.', 'Cras scelerisque tempor enim. Integer pretium pede ut purus gravida pharetra. Morbi condimentum massa. Sed vel massa sit amet nisl euismod cursus. Pellentesque libero tellus, tempor quis, placerat in, eleifend quis, tellus. Sed urna. \r\n\r\nAenean pretium est vitae purus. Nullam feugiat, odio ut viverra imperdiet, dolor metus gravida erat, ac aliquet eros turpis vel libero. Vestibulum eget purus. Phasellus feugiat mauris nec risus. Praesent nunc. Cras facilisis venenatis mi.', 1, '', '', '', '', '', '||2||', 0, 0, 1);

CREATE TABLE `%TABLE_PREFIX%336_news_cats` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  `extras` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1;

-- 
-- Daten f�r Tabelle `prefix_164_news_cats`
-- 

INSERT INTO `%TABLE_PREFIX%336_news_cats` VALUES (1, 'Kategorie 1', '');
INSERT INTO `%TABLE_PREFIX%336_news_cats` VALUES (2, 'Kategorie 2', '');
