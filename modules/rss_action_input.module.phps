<?php
/*
 * Addon News fuer REDAXO
 * RSS-Ausgabe Steuerung
 *
 * @author Jens Fuchs <fuchs at d-mind.de>
 * @project Redaxo-News-Addon
 * @date 18.01.2013
 */

// Action, Presave add und edit, muss mit Modul RSS verknuepft werden
$value_id = 15;
$value_sep = '~~';
$value = $_POST['VALUE'][15];

  if(is_array($value))
  {
    $str_value = implode($value_sep, $value);
  }
  else
  {
    $str_value = $value;
  }
  $REX_ACTION['VALUE'][15] = $str_value;
// -------------- END OF CONFIG
?>