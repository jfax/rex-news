<?php
/*
 * Addon News fuer REDAXO
 * Konfigurationsmodul für News-Ausgabe
 *
 * @author Jens Fuchs <fuchs at d-mind.de>
 * @project Redaxo-News-Addon
 * @date 15.11.2012
 */
?>
<strong>Listenansicht oder Detailausgabe?</strong><br />
<?php
$dbg = new rex_select();
$dbg->setName("VALUE[6]");
$dbg->setId("specialHide");
$dbg->setSize(1);
$dbg->addOption("Liste","list");
$dbg->addOption("Detail","detail");
$dbg->setSelected("REX_VALUE[6]");
echo $dbg->get();
?>
<script type="text/javascript">
jQuery(function($) {
	$('#specialHide').change(function() {
		if ($(this).attr('value') == "detail") {
			$('#folContainer').hide();
		} else {
			$('#folContainer').show();
		}
	});
});
</script>
<div id="folContainer">
    <br />
    <br />
    <strong>Falls Listenansicht, Artikel f&uuml;r Detailansicht w&auml;hlen</strong><br />
    REX_LINK_BUTTON[7]
    <br />

    <strong>Flag Startseite</strong><br />
    <?php
    $dbg = new rex_select();
    $dbg->setName("VALUE[18]");
    $dbg->setSize(1);
    $dbg->addOption("Artikel mit und ohne Flag Startseite ausgeben","0");
    $dbg->addOption("nur Artikel mit Flag Startseite ausgeben","1");
	$dbg->addOption("nur Artikel ohne Flag Startseite ausgeben","2");
    $dbg->setSelected("REX_VALUE[18]");
    echo $dbg->get();
    ?>
    <br />
    <br />

    <strong>Debug-Modus</strong><br />
    <?php
    $dbg = new rex_select();
    $dbg->setName("VALUE[5]");
    $dbg->setSize(1);
    $dbg->setStyle("width:100px;");
    $dbg->addOption("aus","0");
    $dbg->addOption("an","1");
    $dbg->setSelected("REX_VALUE[5]");
    echo $dbg->get();
    ?>
    <br />
    <br />

    <strong>Aktuell/Archiv</strong><br />
    <?php
    $dbg = new rex_select();
    $dbg->setName("VALUE[4]");
    $dbg->setSize(1);
    $dbg->addOption("nur Aktuelle News","0");
    $dbg->addOption("nur Archivierte News","1");
    $dbg->addOption("beides","2");
    $dbg->setSelected("REX_VALUE[4]");
    echo $dbg->get();
    ?>
    <br />
    <br />

    <strong>Einschr&auml;nkung auf Sprache</strong><br />
    <?php
    $dbg = new rex_select();
    $dbg->setName("VALUE[2]");
    $dbg->setSize(1);
    $dbg->addOption("alle Sprachen ausgeben","0");
    $dbg->addOption("nur Aktuelle Sprache","1");
    $dbg->setSelected("REX_VALUE[2]");
    echo $dbg->get();
    ?>
    <br />
    <br />

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

    <strong>Sortierung</strong><br />
    <?php
    $dbg = new rex_select();
    $dbg->setName("VALUE[19]");
    $dbg->setSize(1);
    $dbg->addOption("Neueste oben","DESC");
    $dbg->addOption("Älteste oben","ASC");
    $dbg->setSelected("REX_VALUE[19]");
    echo $dbg->get();
    ?>
    <br />
    <br />
    
    <strong>Anzahl der Artikel pro Seite</strong><br />
    <input name="VALUE[1]" value="REX_VALUE[1]" style="size:50px;" /><br />
    <br />

    <strong>Blaettern-Funktion</strong><br />
    <?php
    $dbg = new rex_select();
    $dbg->setName("VALUE[10]");
    $dbg->setSize(1);
    $dbg->setStyle("width:100px;");
    $dbg->addOption("aus","0");
    $dbg->addOption("an","1");
    $dbg->setSelected("REX_VALUE[10]");
    echo $dbg->get();
    ?>
    <br />
    <br />
    <strong>Nur freigeschaltete News ausgeben?</strong><br />
    <?php
    $dbg = new rex_select();
    $dbg->setName("VALUE[8]");
    $dbg->setSize(1);
    $dbg->addOption("nur freigeschaltete","1");
    $dbg->addOption("nur nicht freigeschaltete","0");
    $dbg->addOption("beides","2");
    $dbg->setSelected("REX_VALUE[8]");
    echo $dbg->get();
    ?>
    <br />
    <br />
    
    <strong>Template (/news/view/templates/)</strong><br />
    <?php
    $dbg = new rex_select();
    $dbg->setName("VALUE[14]");
    $dbg->setSize(1);
	$dir = opendir($REX['INCLUDE_PATH'].'/addons/news/view/templates/');
	$files = array();
	while ($files[] = readdir($dir));
	sort($files);
	closedir($dir);
	foreach ($files as $file) {
		if ($file != "." && $file != "..") {
			$dbg->addOption($file, $file);
		}
	}
    $dbg->setSelected("REX_VALUE[14]");
    echo $dbg->get();
    ?>
</div>