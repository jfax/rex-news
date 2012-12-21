<?php
/*
 * Addon News fuer REDAXO
 * Eingabemodul für RSS-Import
 *
 * @author Jens Fuchs <fuchs at d-mind.de>
 * @project Redaxo-News-Addon
 * @date 15.11.2012
 */
?>
<strong>URL für RSS-Feed eingeben (Achtung: Aktuell wird nur RSS 1.0/2.0 untestützt)</strong>:<br />
<input type="text" name="VALUE[1]" value="REX_VALUE[1]" />
<br />
<br />
<strong>Blaettern-Funktion</strong><br />
<?php
$dbg = new rex_select();
$dbg->setName("VALUE[10]");
$dbg->setSize(1);
$dbg->setStyle("width:100px;");
$dbg->addOption("an","1");
$dbg->addOption("aus","0");
$dbg->setSelected("REX_VALUE[10]");
echo $dbg->get();
?>
<br />
<br />
<strong>Anzahl der Listeneinträge, bevor geblätter wird</strong>:<br />
<input type="text" name="VALUE[2]" style="width:80px;" value="REX_VALUE[2]" />
