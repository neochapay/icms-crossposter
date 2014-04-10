CREATE TABLE IF NOT EXISTS `cms_crosspost` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `type` varchar(16) NOT NULL,
  `login` varchar(16) NOT NULL,
  `pass` varchar(64) NOT NULL,
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `cms_crosspost_post` (
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;