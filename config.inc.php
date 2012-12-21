<?php
/**
 * News Addon 
 * Allgemeine Konfiguration
 * Hier ist i. d. R. nicht zu verändern
 * 
 * @author Jens Fuchs <fuchs at d-mind.de>
 * @project Redaxo-News-Addon
 * @date 05.11.2012
  */

$mypage = 'news'; 

if (!defined('TBL_NEWS')) 
    define('TBL_NEWS', $REX['TABLE_PREFIX'] . '336_news');
if (!defined('TBL_NEWS_CATS')) 
    define('TBL_NEWS_CATS', $REX['TABLE_PREFIX'] . '336_news_cats');
if (!defined('REX_LANG')) 
    define('REX_LANG', $REX['LANG']);
if (!defined('MY_PAGE')) 
    define('MY_PAGE', $mypage);
if (!defined('REX_INCLUDE_PATH')) 
    define('REX_INCLUDE_PATH', $REX['INCLUDE_PATH']);

$REX['ADDON']['page'][$mypage] = $mypage;
$REX['ADDON']['rxid'][$mypage] = "336";
$REX['ADDON']['name'][$mypage] = "News/Presse";
$REX['ADDON']['perm'][$mypage] = 'news[]';
$REX['ADDON']['version'][$mypage] = "2.0 RC1";
$REX['ADDON']['author'][$mypage] = "Jens Fuchs";

$REX['PERM'][] = 'news[]';

if ($REX['REDAXO']) {
    $jsLink  = '<script type="text/javascript" src="'.$REX['HTDOCS_PATH'].'files/addons/'.$mypage.'/js/jquery.tablesorter.min.js"></script>'."\n";
    $jsLink .= '<script type="text/javascript" src="'.$REX['HTDOCS_PATH'].'files/addons/'.$mypage.'/js/jquery.textareaCounter.plugin.js"></script>'."\n";
    $jsLink .= '<script type="text/javascript" src="'.$REX['HTDOCS_PATH'].'files/addons/'.$mypage.'/js/backend.js"></script>'."\n";
    if (rex_request('func'))
    {
        $jsLink .= '<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.10/jquery-ui.js"></script>';
        $jsLink .= '<script type="text/javascript" src="'.$REX['HTDOCS_PATH'].'files/addons/'.$mypage.'/js/backend_datepicker.js"></script>'."\n";
    }
    $jsLink .= '<link rel="stylesheet" media="screen" href="'.$REX['HTDOCS_PATH'].'files/addons/'.$mypage.'/css/backend.css" />'."\n";
    $jsLink .= '<link rel="stylesheet" media="screen" href="'.$REX['HTDOCS_PATH'].'files/addons/'.$mypage.'/css/tablesorter.css" />'."\n";
    $jsLink .= '<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css" />';
    $extpoint = 'PAGE_HEADER';    
    
	$REX['ADDON'][$mypage]['SUBPAGES'] = array (
        array('', 'Aktuelle Artikel'),
        array('archive', "Archiv"),
        array('cats', "Kategorien"),
        array('conf', "Konfiguration"),
        array('mod', "Modul-Installation"),
    );
}

rex_register_extension($extpoint, create_function('$params', 'return $params[\'subject\'].\'' . $jsLink . '\';'));