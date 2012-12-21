<?php
/*
 * Addon News fuer REDAXO
 * Ausgabemodul für RSS-Import
 *
 * @author Jens Fuchs <fuchs at d-mind.de>
 * @project Redaxo-News-Addon
 * @date 15.11.2012
 */
if ($REX['GG'])
{
	if (!class_exists('rssGetter')) require $REX['INCLUDE_PATH']."/addons/news/classes/class.rssGetter.inc.php"; 
    $t = new rssGetter;
    $t->url = "REX_VALUE[1]";
    $t->blaettern = "REX_VALUE[10]";
	$t->anzahl = "REX_VALUE[2]";
    $t->execute();
} else {
	print "URL: REX_VALUE[1]";
}
?>
