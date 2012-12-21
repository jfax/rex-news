<?php
/**
 * News Addon 
 * @author Jens Fuchs <fuchs at d-mind.de>
 * @project Redaxo-News-Addon
 * @date 05.11.2012
 */

$Basedir = dirname(__FILE__);
$entry_id = !empty($entry_id) ? (int) $entry_id : 0;
$mode = !empty($mode) ? (string) $mode: '';

if ($func == '')
{

	$list = rex_list::factory('
				SELECT id, 
				name  
				FROM '. TBL_NEWS_CATS .'
				ORDER BY id'
				,'50','',false,'rex_list_extended'
				);

    $list->addTableColumnGroup(array(40, '*'));
    $imgHeader = '<a href="'. $list->getUrl(array('func' => 'add', 'clang' => $clang)) .'"><img src="media/metainfo_plus.gif" alt="Neuen Datensatz hinzufügen" title="Neuen Datensatz hinzufügen" /></a>';
    $list->addColumn($imgHeader, '###'.'id###', 0, array('<th class="rex-icon">###VALUE###</th>','<td class="rex-small">###VALUE###</td>'));
    $list->setColumnLabel('title','Titel');
	$list->removeColumn('id');
	$list->setColumnSortable('name');
	$list->setColumnLabel('name', 'Name');
    $list->addColumn('function', $I18N->msg('edit'));
	$list->setColumnLabel('function', 'Editieren');
	$list->setColumnParams('function', array('func' => 'edit', 'id' => '###id###', 'clang' => $clang));
	$list->show();
}


// Hinzufuegen und Editieren
if($func == "add" || $func == "edit")
{
	$legend = "Kategorien anlegen";
	if ($func == 'edit')
		$legend = "Kategorien editieren";

//  function factory($tableName, $fieldset, $whereCondition, $method = 'post', $debug = false, $class = null)
	$form = rex_form::factory(TBL_NEWS_CATS, $legend, 'id='.$id, 'post', false, 'rex_form_extended2');
	if($func == 'edit') $form->addParam('id', $id);

	$field =& $form->addTextField('name', NULL, array());
	$field->setLabel('Titel');
	$form->showFormWithId();
}
?>