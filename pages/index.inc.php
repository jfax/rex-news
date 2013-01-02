<?php
/**
 * News Addon 
 * @author Jens Fuchs <fuchs at d-mind.de>
 * @project Redaxo-News-Addon
 * @date 05.11.2012
 */

error_reporting(E_ALL ^ E_NOTICE);

$Basedir = dirname(__FILE__);

require_once $REX['INCLUDE_PATH'] . "/addons/news/classes/class.rex_list_extended.inc.php";
require_once $REX['INCLUDE_PATH'] . "/addons/news/classes/class.rex_form_extended.inc.php";
require_once $REX['INCLUDE_PATH'] . "/addons/news/classes/class.rex_form556_extended.inc.php";
require_once $REX['INCLUDE_PATH'] . "/addons/news/conf/conf.php";
require_once $REX['INCLUDE_PATH'] . "/addons/news/functions/functions.inc.php";

require $REX['INCLUDE_PATH'] . "/layout/top.php";

// Request Paramater
$id = rex_request('id', 'int');
if ($id == 0)
    $id = rex_request($prefix_field . 'id', 'int');

$func = rex_request('func', 'string'); 
$subpage = rex_request('subpage', 'string'); 
$entry_id = rex_request('entry_id', 'string'); 
$mode = rex_request('mode', 'string'); 

$subpages = array(
    array('', 'Aktuelle Artikel'),
    array('archive', "Archivierte Artikel"),
    array('offline', "Offline Artikel"),
    array('cats', "Kategorien"),
    array('conf', "Konfiguration"),
    array('mod', "Modul-Installation"),
);

rex_title("News/Presse", $subpages);

if (!isset($subpage))
    $subpage = '';
if (!isset($func))
    $func = '';

switch ($subpage) {
    case 'mod' :
        $file = $Basedir . '/install.inc.php';
        break;
    case 'cats' :
        $file = $Basedir . '/cats.inc.php';
        break;
    case 'cats' :
        $file = $Basedir . '/entries.inc.php';
        break;
    case 'conf' :
        $file = $Basedir . '/conf.inc.php';
        break;
    default:
        $file = $Basedir . '/entries.inc.php';
}

// Allgemeine Funktionen aufrufen bei Listenansicht (Offline stellen etc.)
switch ($func) {
    case 'setstatus': 
        $oid = rex_request('oid', 'int');
        $statusfield = rex_request('statusfield', 'string');
        $oldstatus = rex_request('oldstatus', 'int');
        $minstatus = rex_request('minstatus', 'int', 0);
        $maxstatus = rex_request('maxstatus', 'int');
        if (setStatus(TBL_NEWS, $oid, $statusfield, $oldstatus, $minstatus, $maxstatus))
            echo rex_info('Statusupdate erfolgreich');
        else
            echo rex_warning('Statusupdate nicht erfolgreich');
        $func = '';
        break;

    case 'delete': 
        $postparams = implode(",",$_POST['ids']);
        $sql = new rex_sql;
        $sql->setTable(TBL_NEWS);
        $sql->setWhere('id IN ('. $postparams.')');
        $success = $sql->delete();
        if ($sql->getRows()>0) 
            echo rex_info('Die Datensätze wurden gelöscht');
        else
            echo rex_warning('Die Datensätze konnten nicht gelöscht werden');
        $func = '';
        break;
}

require $file;
require $REX['INCLUDE_PATH'] . "/layout/bottom.php";