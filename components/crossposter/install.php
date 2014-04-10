<?php
    function info_component_crossposter(){
        $_component['title']        = 'Кросспостинг';
        $_component['description']  = 'Позволяет пользователям кросспостить в ЖЖ';
        $_component['link']         = 'crossposter';
        $_component['author']       = 'Сергей Игоревич (NeoChapay)';
        $_component['internal']     = '0';
        $_component['version']      = '0.2';

        return $_component;
    }

    function install_component_crossposter()
    {

        $inCore = cmsCore::getInstance();
        $inDB   = cmsDatabase::getInstance();
        $inConf = cmsConfig::getInstance();

        include($_SERVER['DOCUMENT_ROOT'].'/includes/dbimport.inc.php');
        dbRunSQL($_SERVER['DOCUMENT_ROOT'].'/components/crossposter/install.sql', $inConf->db_prefix);

        if ($inCore->isComponentInstalled('billing'))
        {
	  dbRunSQL($_SERVER['DOCUMENT_ROOT'].'/components/crossposter/billing.sql', $inConf->db_prefix);
        }

        return true;

    }

    function upgrade_component_crossposter()
    {

        $inCore = cmsCore::getInstance();
        $inDB   = cmsDatabase::getInstance();
        $inConf = cmsConfig::getInstance();

        include($_SERVER['DOCUMENT_ROOT'].'/includes/dbimport.inc.php');
        dbRunSQL($_SERVER['DOCUMENT_ROOT'].'/components/crossposter/update.sql', $inConf->db_prefix);

        return true;
    }

?>