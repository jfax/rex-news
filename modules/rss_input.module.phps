<?php
/*
 * Addon News fuer REDAXO
 * RSS-Ausgabe Steuerung
 *
 * @author Jens Fuchs <fuchs at d-mind.de>
 * @project Redaxo-News-Addon
 * @date 15.11.2012
 */
?> 
<strong>Root-Verzeichnis des Projektes (http://www.domain.com)</strong><br />
<input type="text" name="VALUE[1]" value="REX_VALUE[1]" style="width:250px;" />
<br /><br />
<strong>Titel des RSS-Feeds</strong><br />
<input type="text" name="VALUE[2]" value="REX_VALUE[2]" style="width:250px;" />
<br /><br />
<strong>Einsch&auml;nkung auf Kategorie</strong><br />
<?php
$qry = 'SELECT id, name FROM '.$REX['TABLE_PREFIX'].'336_news_cats ORDER BY name';
$sql = new rex_sql();
$results = $sql->getArray($qry);
$dbg = new rex_select();
$dbg->setName("VALUE[15]");
$dbg->setSize(1);
$dbg->addOption('Alle',999);
if (is_array($results)) 
{
	foreach($results as $result) 
	{
		$dbg->addOption($result['name'],$result['id']);
	}
} 
$dbg->setSelected("REX_VALUE[15]");
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
<strong>Newsdetailartikel wählen</strong><br />
REX_LINK_BUTTON[1]
<br />
<strong>Firmenlogo</strong><br />
REX_MEDIA_BUTTON[1]