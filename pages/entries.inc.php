<?php
/**
 * News Addon 
 * @author Jens Fuchs <fuchs at d-mind.de>
 * @project Redaxo-News-Addon
 * @date 05.11.2012
 */

global $REX_NEWS_CONF;

$Basedir = dirname(__FILE__);
$entry_id = !empty($entry_id) ? (int) $entry_id : 0;
$mode = !empty($mode) ? (string) $mode : '';
$addEntry = rex_request('addEntry', 'int');

if (($func == 'add') and ($addEntry>0))
{
    // Artikel kopieren
    news_copyArticle($addEntry);
}
if (rex_request('toarchive', 'int')>0)
{
    // Artkel archivieren
    setToArchive(rex_request('toarchive', 'int'));
}

if ($func == '') {
    ?>
    <div class="rex-toolbar rex-toolbar-has-form">
        <div class="rex-toolbar-content">
            <div class="rex-form">
                <form action="index.php" method="get" class="rex-fl-lft" style="margin-left:5px">
                    <fieldset>
                        <input type="hidden" name="page" value="<?php print rex_request('page'); ?>" />
                        <input type="hidden" name="subpage" value="<?php print rex_request('subpage'); ?>" />
                        <label for="filter">Filter:</label> &nbsp;
                        <?php
                        $select = new rex_select();
                        $select->setName('filter');
                        $select->setAttribute('onchange', 'this.form.submit();');
                        $select->setSize(1);
                        $select->setMultiple(false);
                        $select->setStyle("width:250px;");
                        $select->addOption("Alle anzeigen", 999);
                        $select->addOption("nur News, die den Status \"online\" haben", 101);
                        $select->addOption("nur News, die den Status \"auf Startseite\" haben", 102);
                        $qry = 'SELECT id, name from ' . TBL_NEWS_CATS;
                        $sql = new rex_sql();
                        $data = $sql->getArray($qry);
                        if (is_array($data) && sizeof($data) > 0) {
                            foreach ($data as $row) {
                                $select->addOption("nur aus ".$row['name'], $row['id']);
                            }
                        }
                        if (sizeof($REX['CLANG'])>1) {
                            foreach($REX['CLANG'] as $k => $v) {
                                $select->addOption("nur folgende Sprache: ".$v, 'clang_'.$k);
                            }
                        }
                        $select->setSelected(rex_request('filter'));
                        echo $select->get();
                        ?>
                    </fieldset>
                </form>
            </div>
            <div class="rex-clearer"></div>
        </div>
    </div>
    <div id="addon_news">
        <?php
        $filter = rex_request('filter');
        if (($filter > 0) and ($filter <> 999)) 
        {
            switch ($filter) {
                case 101:
                    $addSql = " AND status=1";
                    break;
                case 102:
                    $addSql = " AND flag=1";
                    break;
                case $filter < 101:
                    $addSql = " AND category LIKE \"%|".$filter."|%\"";
                    break;
                default:
                    $addSql = "";
                    break;
            }
        } 
        // Filter auf Sprachen, string, bei mehr Sprachen erweitern
        else 
        {
             switch ($filter) {
                case 'clang_0':
                    $addSql = " AND clang=0";
                    break;
                case 'clang_1':
                    $addSql = " AND clang=1";
                    break;
                case 'clang_2':
                    $addSql = " AND clang=2";
                    break;
                case 'clang_3':
                    $addSql = " AND clang=3";
                    break;
                case 'clang_4':
                    $addSql = " AND clang=4";
                    break;
                case 'clang_5':
                    $addSql = " AND clang=5";
                    break;
             }
        }

        
        if ($subpage=="offline")
        {
            $list = rex_list::factory('
                    SELECT id, 
                    name, 
                    online_date, 
                    clang, 
                    status, 
                    createdate 
                    FROM ' . TBL_NEWS . '
                    WHERE (offline_date != "0000-00-00" AND (REPLACE(offline_date, "-", "") <= CURDATE() + 0))
                    ' . $addSql . '
                    ORDER BY online_date desc'
                     , '5000', '', false, 'rex_list_extended'
            );
            $list->addTableColumnGroup(array(20, '*', 80, 40, 60, 60, 60, 60));
        }
        else if ($subpage=="archive")
        {
            $list = rex_list::factory('
                    SELECT id, 
                    name, 
                    online_date, 
                    clang, 
                    status, 
                    createdate 
                    FROM ' . TBL_NEWS . '
                    WHERE (
                        (
                            ((offline_date != "0000-00-00") AND (REPLACE(offline_date, "-", "") > CURDATE() + 0))
                            OR (offline_date = "0000-00-00")
                        )
                        AND
                        ((archive_date != "0000-00-00") AND REPLACE(archive_date, "-", "") <= CURDATE() + 0)
                    )
                    ' . $addSql . '
                    ORDER BY online_date desc'
                     , '5000', '', false, 'rex_list_extended'
            );
            $list->addTableColumnGroup(array(20, '*', 80, 40, 60, 60, 60, 60));
        }
        else
        {
            $list = rex_list::factory('
                    SELECT id, 
                    name, 
                    online_date, 
                    clang, 
                    status, 
                    flag, 
                    category, 
                    createdate 
                    FROM ' . TBL_NEWS . '
                    WHERE (
                        (offline_date = "0000-00-00" OR (REPLACE(offline_date, "-", "") > CURDATE() + 0))
                        AND
                        ((archive_date = "0000-00-00") OR REPLACE(archive_date, "-", "") > CURDATE() + 0)
                    )
                    ' . $addSql . '
                    ORDER BY online_date desc'
                     , '5000', '', false, 'rex_list_extended'
            );
            $list->addTableColumnGroup(array(20, '*', 80, 40, 60, 60, 60, 60));
        }

        $imgHeader = '<a href="' . $list->getUrl(array('func' => 'add', 'clang' => $clang)) . '"><img src="media/metainfo_plus.gif" alt="' . $I18N->msg('b_504_add') . '" title="' . $I18N->msg('b_504_add') . '" /></a>';

        $list->addColumn($imgHeader, '###' . 'id###', 0, array('<th class="rex-icon">###VALUE###</th>', '<td class="rex-small">###VALUE###</td>'));

        $list->setColumnLabel('article', 'Artikel');
        $list->setColumnLabel('name', 'Name');

        $list->removeColumn('id');
        
        $list->setColumnLabel('online_date','Datum');
        $list->setColumnFormat('online_date', 'custom',
            create_function(
              '$params',
              '$list = $params["list"];
               return $list->getColumnName("date", formatNewDate($list->getValue("online_date")));'
            )
        );        

        $list->addColumn('function', $I18N->msg('edit'));
        $list->setColumnLabel('function', 'Funktion');
        $list->setColumnParams('function', array('func' => 'edit', 'id' => '###id###', 'clang' => $clang));

        $list->addColumn('checkboxes', '', -1, array("<th><input onclick=\"return window.confirm('Die Datensätze wirklich löschen?');\" type=\"submit\" value=\"L&ouml;schen\" /><input type=\"hidden\" value=\"delete\" name=\"func\" /></th>",'<td style="text-align:center;">###VALUE###</td>'));
        $list->setColumnFormat('checkboxes', 'custom',
            create_function(
              '$params',
              'global $I18N;
               $list = $params["list"];
               return "<input type=\"checkbox\" name=\"ids[]\" value=\"".$list->getValue("id")."\" />";'
            )
        );

        $list->setColumnLabel('clang', 'Sprache');
        $list->setColumnFormat('clang', 'custom', create_function(
                '$params', '$list = $params["list"];
                return $list->getColumnName("clang", displayClang($list->getValue("clang")));'
            )
        );
        
        $list->setColumnLabel('status', 'Status');
        $list->setStatusColumn('status', TBL_NEWS);
        $list->setColumnFormat('status', 'custom', create_function(
                '$params', '$list = $params["list"];
                return $list->getColumnLink("status", displayStatus($list->getValue("id")));'
            )
        );

        $list->setColumnLabel('createdate','Kopieren');
        $list->setColumnFormat('createdate', 'custom',
            create_function(
              '$params',
              '$list = $params["list"];
               return $list->getColumnName("country", printCopyOnly($list->getValue("id")));'
            )
        );
        $list->setColumnParams('createdate', array('addEntry' => '###id###', 'clang' => $clang));	

        $list->setColumnLabel('flag', 'Startseite');
        $list->setStatusColumn('flag', TBL_NEWS);
        $list->setColumnFormat('flag', 'custom', create_function(
                   '$params', '$list = $params["list"];
                   return $list->getColumnLink("flag", displayStartseite($list->getValue("id")));'
                )
        );

        $list->setColumnLabel('category', 'Archiv');
        $list->setStatusColumn('category', TBL_NEWS);
        $list->setColumnFormat('category', 'custom', create_function(
                    '$params', '$list = $params["list"];
                    return $list->getColumnLink("archive", buttonSetToArchive($list->getValue("id")));'
                )
        );

        $list->setColumnFormat('article', 'custom', create_function(
                    '$params', '$list = $params["list"];
                    return displayArticle($list->getValue("article"));'
                )
        );

        $list->setColumnSortable('name');

        $list->show();
}


// Hinzufuegen und Editieren

if ($func == "add" || $func == "edit") {

    // JS fuer Counter einfuegen
    print echo_js_for_counter($REX_NEWS_CONF['max_items']);
    
    $legend = "News anlegen";
    if ($func == 'edit')
        $legend = "News editieren";

    //  function factory($tableName, $fieldset, $whereCondition, $method = 'post', $debug = false, $class = null)
    $form = rex_form::factory(TBL_NEWS, $legend, 'id=' . $id, 'post', false, 'rex_form_news_extended2');
    $form->addParam('clang', $clang);

    if ($func == 'edit')
        $form->addParam('id', $id);

    // kategorie
    $field = $form->addSelectField('category');
    $field->setLabel("Kategorie");
    $select = $field->getSelect();
    $select->setMultiple(true);
    $select->setSize(3);
    $select->addOption("Bitte wählen", 99999);
    $qry = 'SELECT id, name from ' . TBL_NEWS_CATS;
    $sql = new rex_sql();
    $data = $sql->getArray($qry);
    if (is_array($data) && sizeof($data) > 0) {
        foreach ($data as $row) {
            $select->addOption($row['name'], $row['id']);
        }
    }

    // Sprache
    if (sizeof($REX['CLANG'])>1)
    {
        $field = $form->addSelectField('clang');
        $field->setLabel("Sprache");
        $select = $field->getSelect();
        $select->setMultiple(false);
        $select->setSize(1);
        foreach($REX['CLANG'] as $k => $v) {
            $select->addOption($v, $k);
        }
    }
    
    $field = $form->addDateFieldNew('online_date', NULL, array('style' => 'width:80px; margin-right:5px;'));
    $field->setLabel('Online von');
    $field = $form->addDateFieldNew('archive_date', NULL, array('style' => 'width:80px; margin-right:5px;'));
    $field->setLabel('Archiv ab');
    $field = $form->addDateFieldNew('offline_date', NULL, array('maxlength' => 10, 'style' => 'width:80px; margin-right:5px;'));
    $field->setLabel('Offline ab');

    // Status
    $field = $form->addSelectField('status');
    $field->setLabel("Status");
    $select = $field->getSelect();
    $select->setMultiple(false);
    $select->setSize(1);
    $select->addOption("in Arbeit", 0);
    $select->addOption("freigegeben", 1);

   // Startseite
    $field = $form->addSelectField('flag');
    $field->setLabel("Auf Startseite");
    $select = $field->getSelect();
    $select->setMultiple(false);
    $select->setSize(1);
    $select->addOption("nein", 0);
    $select->addOption("ja", 1);

    $field = $form->addTextareaField('name', NULL, array('rows' => 2));
    $field->setLabel('Titel');

    // Thumbnail
    $field = $form->addMediaField('thumb');
    $field->setLabel('Aufmacher/Foto (Breite siehe Image Manger, Typ: '.$REX_NEWS_CONF['image_list_type'].')');

    $field = $form->addTextareaField('teaser', NULL, array('rows' => 4));
    $field->setLabel('Teaser');

    $field = $form->addTextareaField('keywords', NULL, array('rows' => 4));
    $field->setLabel('Verschlagwortung (bitte getrennt durch Kommas)');

    $field = $form->addTextareaField('article', NULL, array('rows' => 16, 'style' => 'width:98%', 'class' => 'markitup-text'));
    if (class_exists('a287_markitup'))
    a287_markitup::markitup('textarea.markitup-text', 'h1,h2,h3,h4,separator,bold,italic,separator,listbullet,listnumeric,separator,intlink,extlink,separator,mailtolink,separator,filelink', '540', '380');
    $field->setLabel('Artikel');

    // Bilder
    //$field = $form->addMedialistField('image_header');
    //$field->setLabel('Bilder f&uuml;r Header');

    // Bilder
    $field = $form->addMedialistField('image');
    $field->setLabel('Bilder');

    // Files
    $field = $form->addMedialistField('filelist');
    $field->setLabel('Dateien');

    // Createdate
   $field = $form->addHiddenField('createdate',date('c'));

    $form->showFormWithId();
}
?></div>