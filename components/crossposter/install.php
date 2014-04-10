<?php
  function info_component_crossposter()
  {
    $_component['title']        = 'Кросспостинг';
    $_component['description']  = 'Позволяет пользователям кросспостить в ЖЖ';
    $_component['link']         = 'crossposter';
    $_component['author']       = 'Сергей Игоревич (NeoChapay)';
    $_component['internal']     = '0';
    $_component['version']      = '0.3';
    
    return $_component;
  }

  function install_component_crossposter()
  {
    $inDB = cmsDatabase::getInstance();
    
    $sql = "CREATE TABLE IF NOT EXISTS `cms_crosspost` (
	    `id` int(11) NOT NULL AUTO_INCREMENT,
	    `user_id` int(11) NOT NULL,
	    `type` varchar(16) NOT NULL,
	    `login` varchar(16) NOT NULL,
	    `pass` varchar(64) NOT NULL,
	    KEY `id` (`id`)
	    ) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
    $inDB->query($sql);
    
    $sql = "CREATE TABLE IF NOT EXISTS `cms_crosspost_post` (
	    `post_id` int(11) NOT NULL
	    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
    $inDB->query($sql);
    
    return true;
  }

  function upgrade_component_crossposter()
  {
    return true;
  }
?>