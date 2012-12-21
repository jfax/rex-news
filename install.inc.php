<?php
/**
 * News Addon 
 * @author fuchs@d-mind.de Jens Fuchs
 * @package redaxo4
 * @version $Id: config.inc.php,v 1.0 2008/02/14 19:22:38 
 */


$config_file  = $REX['INCLUDE_PATH'] .'/addons/news/conf/conf.php';
$template_dir = $REX['INCLUDE_PATH'] .'/addons/news/view/templates_c';

if(($state = rex_is_writable($config_file)) !== true) {
    $REX['ADDON']['installmsg']['news'] = 'Das Konfigurationsfile <strong>'.$config_file.'</strong> ist nicht beschreibbar';
    $REX['ADDON']['install']['news'] = 0;
}
if(($state = rex_is_writable($template_dir)) !== true) {
    $REX['ADDON']['installmsg']['news'] = 'Das Verzeichnis <strong>redaxo/include/addons/news/view/templates_c/</strong> ist nicht beschreibbar';
    $REX['ADDON']['install']['news'] = 0;
}
if (intval(PHP_VERSION) < 5) {
    $REX['ADDON']['installmsg']['news'] = 'Dieses Addon ben&ouml;tigt PHP 5!';
    $REX['ADDON']['install']['news'] = 0;
}
else
{
    $REX['ADDON']['install']['news'] = 1;
}