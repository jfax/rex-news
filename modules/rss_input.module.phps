<?php
/*
 * Addon News fuer REDAXO
 * RSS-Ausgabe Steuerung
 *
 * @author Jens Fuchs <fuchs at d-mind.de>
 * @project Redaxo-News-Addon
 * @date 15.11.2012
 * 
 * 18.01.2013: Moeglichkeit, mehrere Kategorien auszuwaehlen
 * Dazu muss unbedingt beiliegende Action (Presave, Add, Eddit) angelegt und mit dem Modul verknuepft werden
 */
?> 
<strong>Root-Verzeichnis des Projektes (http://www.domain.com) mit abschl. "/" hinten</strong><br />
<input type="text" name="VALUE[1]" value="REX_VALUE[1]" style="width:250px;" />
<br /><br />
<strong>Titel des RSS-Feeds</strong><br />
<input type="text" name="VALUE[2]" value="REX_VALUE[2]" style="width:250px;" />
<br /><br />
<strong>Einsch&auml;nkung auf Kategorie (bei mehreren Strg-Taste gedrueckt halten)</strong><br />
<?php
$qry = 'SELECT id, name FROM '.$REX['TABLE_PREFIX'].'336_news_cats ORDER BY name';
$sql = new rex_sql();
$results = $sql->getArray($qry);
$dbg = new rex_select();
$dbg->setName("VALUE[15][]");
$dbg->setMultiple(true);
$dbg->setSize(6);
$value15 = explode("~~", "REX_VALUE[15]");
$dbg->addOption('Alle',999);
if (is_array($results)) 
{
	foreach($results as $result) 
	{
		$dbg->addOption($result['name'],$result['id']);
        if (in_array($result['id'], $value15))
        {
            $dbg->setSelected($result['id']);
        }
	}
} 
if (in_array(999, $value15))
{
    $dbg->setSelected(999);
}
echo $dbg->get();
?>
<br />
<br />
<strong>UTF8-Decodierung des Titels (bei fehlerhafter Ausgabe umstellen)?</strong><br />
<?php
$dbg = new rex_select();
$dbg->setName("VALUE[18]");
$dbg->setSize(1);
$dbg->addOption('Ja', 0);
$dbg->addOption('Nein', 1);
$dbg->setSelected("REX_VALUE[18]");
echo $dbg->get();
?>
<br />
<br />
<strong>Description des RSS-Feeds</strong><br />
<input type="text" name="VALUE[3]" value="REX_VALUE[3]" style="width:250px;" />
<br /><br />
<strong>Absolute URL des RSS-Feeds</strong><br />
<input type="text" name="VALUE[4]" value="REX_VALUE[4]" style="width:250px;" />
<br /><br />
<strong>Newsdetailartikel w�hlen</strong><br />
REX_LINK_BUTTON[1]
<br />
<strong>Firmenlogo</strong><br />
REX_MEDIA_BUTTON[1]