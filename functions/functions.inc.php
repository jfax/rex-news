<?php
/**
 * News Addon 
 * @author Jens Fuchs <fuchs at d-mind.de>
 * @project Redaxo-News-Addon
 * 
 * Hilfsfunktionen Backend 
 * 
 * @date 05.11.2012
 */


/**
 * @author Jens Fuchs <fuchs at d-mind.de>
 * @project Redaxo-News-Addon
 * @date 05.11.2012
 * @return boolean
 * Wird in Listenuebersicht fuer Statusaenderung benoetigt entries.inc.php
 */
function setStatus($table, $id, $statusfield, $oldstatus, $minstatus, $maxstatus) {
    $newstatus = ($oldstatus >= $maxstatus) ? $minstatus : $oldstatus + 1;
    $sql = rex_sql::getInstance();
    $sql->debugsql = false;
    $sql->setTable(rex_request('table'));
    $sql->setWhere('id = ' . $id);
    $sql->setValue($statusfield, $newstatus);
    if ($sql->update()) {
        return true;
    }
    return false;
}

function delete($id, $table) {
    $sql = rex_sql::getInstance();
    if (DEBUG)
        $sql->debugsql = true;
    $sql->setTable(rex_request('table'));
    $sql->setWhere('id = ' . $id);
    if ($sql->delete()) {
        return true;
    }
    return false;
}

function value_in_string($needle, $string) {
    $haystack = explode("|+|", $string);
    if (in_array($needle, $haystack))
        return true;
    else
        return false;
}

function countParentCats($id, $table = TBL_REISEN_CATS) {
    $qry = 'SELECT count(*) as TOTAL FROM ' . $table . ' WHERE parent=' . $id;
    $sql = new rex_sql();
    $sql->setQuery($qry);
    $items = $sql->getArray();
    if ($sql->getValue('TOTAL') > 0)
        return $sql->getValue('TOTAL');
    else
        return "keine";
}


/**
 * @author Jens Fuchs <fuchs at d-mind.de>
 * @project Redaxo-News-Addon
 * @date 05.11.2012
 * @param int, (string)
 * @return string
 * huebsche Ampel anstelle von 1-2-3
 */
function displayAmpel($id, $table = TBL_REISEN_TERMINE) {
    global $REX;
    $qry = 'SELECT amount as TOTAL FROM ' . $table . ' WHERE id=' . $id;
    $sql = new rex_sql();
    $sql->setQuery($qry);
    $items = $sql->getArray();
    if ($sql->getValue('TOTAL') > 0)
        if ($sql->getValue('TOTAL') == 1)
            return "<img src=\"".$REX['HTDOCS_PATH']."files/addons/news/images/ampel_gruen.png\" alt=\"\" />";
    if ($sql->getValue('TOTAL') == 2)
        return "<img src=\"".$REX['HTDOCS_PATH']."files/addons/news/images/ampel_gelb.png\" alt=\"\" />";
    if ($sql->getValue('TOTAL') == 3)
        return "<img src=\"".$REX['HTDOCS_PATH']."files/addons/news/images/ampel_rot.png\" alt=\"\" />";
    else
        return "nicht gesetzt";
}


/**
 * @author Jens Fuchs <fuchs at d-mind.de>
 * @project Redaxo-News-Addon
 * @date 05.11.2012
 * @param int, (string)
 * @return string
 * status aktiv  - inaktiv huebscher bei klick
 */
function displayStatus($id, $table = TBL_NEWS) {
    global $REX;
    $qry = 'SELECT status as TOTAL FROM ' . $table . ' WHERE id=' . $id;
    $sql = new rex_sql();
    $sql->setQuery($qry);
    $items = $sql->getArray();
    if ($sql->getValue('TOTAL') == 1)
        return "<img src=\"".$REX['HTDOCS_PATH']."files/addons/news/images/ampel_gruen.png\" alt=\"\" />";
    else
        return "<img src=\"".$REX['HTDOCS_PATH']."/files/addons/news/images/ampel_rot.png\" alt=\"\" />";
}


/**
 * @author Jens Fuchs <fuchs at d-mind.de>
 * @project Redaxo-News-Addon
 * @date 05.11.2012
 * @param int, (string)
 * @return string
 * archiv aktiv  - inaktiv huebscher bei klick
 */
function displayArchive($id, $table = TBL_NEWS) {
    global $REX;
    $qry = 'SELECT archive as TOTAL FROM ' . $table . ' WHERE id=' . $id;
    $sql = new rex_sql();
    $sql->setQuery($qry);
    $items = $sql->getArray();
    if ($sql->getValue('TOTAL') == 1)
        return "<img title=\"aus dem Archiv herausnehmen\" src=\"".$REX['HTDOCS_PATH']."/files/addons/news/images/icon_arrow_halfup.gif\" alt=\"\" />";
    else
        return "<img src=\"".$REX['HTDOCS_PATH']."/files/addons/news/images/item_or.gif\" title=\"ins Archiv verschieben\" alt=\"\" />";
}


/**
 * @author Jens Fuchs <fuchs at d-mind.de>
 * @project Redaxo-News-Addon
 * @date 16.11.2012
 * @param int
 * @return string
 * Button zum archivieren
 */
function buttonSetToArchive($id) {
    global $REX;
    return "<a href=\"index.php?&page=news&toarchive=".$id."\"><img src=\"".$REX['HTDOCS_PATH']."/files/addons/news/images/item_or.gif\" title=\"ins Archiv verschieben\" alt=\"\" /></a>";
}


/**
 * @author Jens Fuchs <fuchs at d-mind.de>
 * @project Redaxo-News-Addon
 * @date 16.11.2012
 * @param int
 * @return 
 * Setzt das archive_date eines Artikels neu und verschiebt ihn somit ins Archiv
 */
function setToArchive($id) {
    $sql = rex_sql::getInstance();
    $sql->debugsql = false;
    $sql->setTable(TBL_NEWS);
    $sql->setWhere('id = ' . $id);
    $sql->setValue('archive_date', date('Y-m-d'));
    if ($sql->update()) {
        return true;
    }
    return false;
}


/**
 * @author Jens Fuchs <fuchs at d-mind.de>
 * @project Redaxo-News-Addon
 * @date 16.11.2012
 * @param int, (string)
 * @return string
 */
function displayClang($id) {
    global $REX;
    foreach($REX['CLANG'] as $k => $v) {
        if ($k==$id) return $v;
    }
}


/**
 * @author Jens Fuchs <fuchs at d-mind.de>
 * @project Redaxo-News-Addon
 * @date 05.11.2012
 * @param int, (string)
 * @return string
 * Startseite aktiv  - inaktiv huebscher bei klick
 */
function displayStartseite($id, $table = TBL_NEWS) {
    global $REX;
    $qry = 'SELECT flag as TOTAL FROM ' . $table . ' WHERE id=' . $id;
    $sql = new rex_sql();
    $sql->setQuery($qry);
    $items = $sql->getArray();
    if ($sql->getValue('TOTAL') == 1)
        return "<img src=\"".$REX['HTDOCS_PATH']."/files/addons/news/images/ampel_gruen.png\" alt=\"\" />";
    else
        return "<img src=\"".$REX['HTDOCS_PATH']."/files/addons/news/images/ampel_rot.png\" alt=\"\" />";
}

// Datumformatierung fuer Listenausgabe Buchungstermine Backend
function formatNewDate($input) {
    $inputArr = explode("-", $input);
    $error="";
    (str_replace("-", "", $input) > date("Ymd")) ? $error = '<span style="color:red;font-style:italic">' : $error = "<span>";
    return $error.$inputArr[2] . "." . $inputArr[1] . "." . $inputArr[0]."</span>";
}

function displayArticle($input) {
    return substr($input, 0, 100) . "...";
}


/**
 * @author Jens Fuchs <fuchs at d-mind.de>
 * @project Redaxo-News-Addon
 * @date 12.11.2012
 * @param int
 * @return string
 */
function printCopyOnly($id) {
	return '<a href="index.php?&page=news&subpage=&func=add&addEntry='.$id.'"><img src="../files/addons/news/images/icon_copy.gif" alt="" title="Kopieren" /></a>';
}


/**
 * @author Jens Fuchs <fuchs at d-mind.de>
 * @project Redaxo-News-Addon
 * @date 12.11.2012
 * @param int
 * @return 
 */
function news_copyArticle($addEntry)
{

	$qry = 'SELECT * FROM '.TBL_NEWS.' WHERE id='.$addEntry;
	$sql = new rex_sql();
	$sql->debugsql=true;
	$data = $sql->getArray($qry);
	$fields = array('name', 'online_date', 'archive_date', 'offline_date', 'teaser', 'article', 'author', 'image', 'image_descr', 'thumb', 'image_header', 'filelist', 'category', 'flag');
	#print_r($fields);
	
	$keys=$values="";
	$j=1;
	foreach ($fields as $value)
	{
		$keys .= $value;
		$values .= "'".$data[0][$value]."'";
		if ($j<sizeof($fields)) 
		{
			$keys .= ", ";
			$values .= ", ";
		}
		$j++;
	}
	$qry = 'INSERT INTO '.TBL_NEWS.' ('.$keys.') VALUES ('.$values.')';

	$k = new rex_sql;
	$k->setQuery($qry);
    
	if ($k->getRows()==1) 
	{
		$last_insert_id = $k->last_insert_id;
		header('Location: index.php?page=news&func=edit&id='.$last_insert_id.'&clang=0');
	} else 
	{
		print rex_message('Der Datensatz konnte nicht übernommen werden', 'rex-warning', 'div');
	}
}


/**
 * @author Jens Fuchs <fuchs at d-mind.de>
 * @project Redaxo-News-Addon
 * @date 12.11.2012
 * @param string
 * @return string
 */
function replace_conf_keys($key) {
    $replace = array(
        'max_items' => 'Maximale Anzahl an Zeichen, die im Feld Teaser eingegeben werden dürfen',
        'image_list_type' => 'Name des Bildtyps im Addon "Image Manager" für die Bildausgabe in der Listenübersicht (dort ist auch z. B. die Breite zu definieren), für Facebook-Like-Bilder (og:image) ist zu beachten, dass das Bild mind. 200px auf 200px sein sollte (http://developers.facebook.com/docs/reference/plugins/like/)',
        'image_detail_type' => 'Name des Bildtyps im Addon "Image Manager" für die Bildausgabe in der Detailansicht',
        'image_default_opengraph' => 'Absolute URL des Default-Logos, das für Facebook-likes verwendet wird (Logo?), sofern kein anderes Bild vorhanden ist',
        'rewrite' => 'SEO-freundliches Umschreiben der Newsartikel ermöglichen (alpha)? Erfordert den Eintrag in der .htaccess:<br><code>RewriteCond %{REQUEST_URI}  /(.*)/([0-9]+)/([0-9]+)/([0-9a-zA-Z+_-]+).html$<br>RewriteRule ^(.*/)(.*)/(.*)/(.*).html$ index.php?article_id=$2&newsid=$3 [L]</code>.<br>In aktuellem Projekt war im Haupttemplate noch vonnöten, vor dem Aufruf von $this->getArticle() noch folgendes einzufügen: <br><code>if (rex_request(\'article_id\', \'int\')>0) { <br>$this->setArticleId(rex_request(\'article_id\', \'int\'));<br> }</code>'
    );
    return $replace[$key];
}


/*
 * @author Jens Fuchs <fuchs at d-mind.de>
 * @project Redaxo-News-Addon
 * @date 12.11.2012
 * @param int
 * @return string
 */
function echo_js_for_counter($characterSize) {
    return "
        <script type=\"text/javascript\">
        jQuery(document).ready(function() {
            var options = {
                'maxCharacterSize': $characterSize,
                'originalStyle': 'originalDisplayInfo',
                'warningStyle': 'warningDisplayInfo',
                'warningNumber': 10,
                'displayFormat': '#input Zeichen | #left Zeichen übrig | #words Wörter'
            };
            jQuery('#rex_336_news_News_editieren_teaser').textareaCount(options);
        });
        </script>
    ";
}

/*
 * @author Jens Fuchs, fuchs@d-mind.de
 * @date 2013-04-32
 * @param id
 * @return string
 */
function displaySticky($id, $table = TBL_NEWS)
{
	$qry = 'SELECT stickyUntil FROM '.$table.' WHERE id='.$id;
	$sql = new rex_sql();
    $sql->setQuery($qry);
    $items = $sql->getArray();
	if (strtotime($sql->getValue('stickyUntil')) >= time()) return "<em>".$sql->getValue('stickyUntil')."</em>";
	
}
