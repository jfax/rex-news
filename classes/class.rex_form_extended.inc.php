<?php

/**
 * Klasse zum erstellen von Listen
 * @package redaxo4
 * @version svn:$Id$
 */

class rex_form_news_extended extends rex_form
{
  
  var $clangs;
  var $timeElements;
  var $timestampElements;
  
  var $languageDependent;
  
  function rex_form_extends($tableName, $fieldset, $whereCondition, $method = 'post', $debug = false)
  {
	  $this->clangs = array();
	  $this->timeElements = array();
	  $this->timestampElements = array();
	  $this->languageDependent = array();
  	parent::rex_form($tableName, $fieldset, $whereCondition, $method, $debug);
  }
  
  function setLanguageDependent($idField, $clangField)
  {
  	if ($idField != '')
	  	$this->languageDependent['id'] = $idField;
	
	  if ($clangField != '')
	  	$this->languageDependent['clang'] = $clangField;
  }
  
  function &addClangFields($clang_field, $clang_fields = array())
  {	
		$this->clangs[$clang_field] = $clang_fields;
  }
  
  // --------- Fields

  function &addDateField($name, $value = null, $attributes = array())
  {	
  	$this->timestampElements[] = $name;
    if(!isset($attributes['class']))
    	$attributes['class'] = 'rex-form-select-date';
    $attributes['internal::fieldClass'] = 'rex_form_date_element';
    $field = $this->addField('', $name, $value, $attributes, true);
    return $field;
  }

  function &addDateTimeField($name, $value = null, $attributes = array())
  {	
  	$this->timestampElements[] = $name;
    if(!isset($attributes['class']))
    	$attributes['class'] = 'rex-form-select-date';
    $attributes['internal::fieldClass'] = 'rex_form_datetime_element';
    $field = $this->addField('', $name, $value, $attributes, true);
    return $field;
  }

  function &addTimeField($name, $value = null, $attributes = array())
  {	
  	$this->timeElements[] = $name;
    if(!isset($attributes['class']))
    	$attributes['class'] = 'rex-form-select-date';
    $attributes['internal::fieldClass'] = 'rex_form_time_element';
    $field = $this->addField('', $name, $value, $attributes, true);
    return $field;
  }
	
	/**
   * Callbackfunktion, damit in subklassen der Value noch beeinflusst werden kann
   * kurz vorm speichern
   */
  function preSave($fieldsetName, $fieldName, $fieldValue, &$saveSql)
  {
		$elements = $this->getTimestampElements();
		if (is_array($elements) AND $elements[0] != '')
		{
			if($fieldsetName == $this->getFieldsetName() && in_array($fieldName, $elements))
			{
				$hour = '0';
				if (isset($fieldValue['hour']))
					$hour = $fieldValue['hour'];
				
				$minute = '0';
				if (isset($fieldValue['minute']))
					$minute = $fieldValue['minute'];
					
				$fieldValue = mktime($hour, $minute, '0', $fieldValue['month'], $fieldValue['day'], $fieldValue['year']);
				
			}
		}
		
		$elements = $this->getTimeElements();
		if (is_array($elements) AND $elements[0] != '')
		{
			if($fieldsetName == $this->getFieldsetName() && in_array($fieldName, $elements))
			{
				$hour = '00';
				if (isset($fieldValue['hour']))
				{
					$hour = $fieldValue['hour'];
				}
				
				$minute = ':00';
				if (isset($fieldValue['minute']))
				{
					$minute = $fieldValue['minute'];
						
					$minute = ':'.$minute;
				}
				
				$second = ':00';
				if (isset($fieldValue['second']))
				{
					$second = $fieldValue['second'];
						
					$second = ':'.$second;
				}
					
				$fieldValue = $hour.$minute.$second;
				
			}
		}
		return parent::preSave($fieldsetName, $fieldName, $fieldValue, $saveSql);
  }
  

  /**
   * Speichert das Formular
   *
   * Gibt true zur�ck wenn alles ok war, false bei einem allgemeinen Fehler oder
   * einen String mit einer Fehlermeldung.
   */
  function save()
  {
  	global $REX;
  	
		if (isset($this->languageDependent['id']) AND isset($this->languageDependent['clang']) AND $this->mode == 'add')
		{
			$sql = rex_sql::getInstance();
				
			foreach($REX['CLANG'] as $key => $val)
			{
				$sql->debugsql = $this->debug;
				$sql->setTable($this->tableName);
				if (!isset ($id) or !$id)
					$id = $sql->setNewId($this->languageDependent['id']);
				else
					$sql->setValue($this->languageDependent['id'], $id);
					
		    $sql->setValue($this->languageDependent['clang'], $key);
				foreach($this->getFieldsets() as $fieldsetName)
				{
					// POST-Werte ermitteln
					$fieldValues = $this->fieldsetPostValues($fieldsetName);
					foreach($fieldValues as $fieldName => $fieldValue)
					{
						// Callback, um die Values vor dem Speichern noch beeinflussen zu k�nnen
						$fieldValue = $this->preSave($fieldsetName, $fieldName, $fieldValue, $sql);
		
						if (is_array($fieldValue))
							$fieldValue = implode('|+|', $fieldValue);
		
						// Element heraussuchen
						$element = $this->getElement($fieldsetName, $fieldName);
		
						// Den POST-Wert als Value in das Feld speichern
						// Da generell alles von REDAXO escaped wird, hier slashes entfernen
						$element->setValue(stripslashes($fieldValue));
		
						// Den POST-Wert in die DB speichern (inkl. slahes)
						$sql->setValue($fieldName, $fieldValue);
					}
				}
				
				if ($sql->insert())
					$msg = true;
				else
					$msg = false;
			}
			
			return $msg;
		}
		else
		{
			return parent::save();
		}
  }
  
  
  function getTimestampElements()
  {
  	return  $this->timestampElements;
  }
  
  function getTimeElements()
  {
  	return  $this->timeElements;
  }
  
}


class rex_form_date_element extends rex_form_element
{
  var $select_day;
  var $select_month;
  var $select_year;
  var $style_year;

  // 1. Parameter nicht genutzt, muss aber hier stehen,
  // wg einheitlicher Konstrukturparameter
  function rex_form_date_element($tag = '', &$table, $attributes = array())
  {
    parent::rex_form_element('', $table, $attributes);

    $this->select_day = new rex_select();
    $this->select_month = new rex_select();
    $this->select_year = new rex_select();
    
    
    $this->style_year = 'rex-form-select-year';
  }

  function formatElement()
  {
  	$value = $this->getValue();
    if ($value == '')
    	$value = time();
    
    $style = 'class="rex-form-select-date"';
        
    $name = $this->getAttribute('name');
    $id = $this->getFieldName();
    	
		$this->select_year->addOptions(range(date('Y'),date('Y')+10), true);
		$this->select_year->setName($name.'[year]');
		$this->select_year->setId($id);
		$this->select_year->setSize(1);
		$this->select_year->setStyle('class="'.$this->style_year.'"');
		$this->select_year->setSelected(date('Y', $value));

		$this->select_month->addOptions(range(1,12), true);
		$this->select_month->setName($name.'[month]');
		$this->select_month->setId($id.'-mm');
		$this->select_month->setSize(1);
		$this->select_month->setStyle($style);
		$this->select_month->setSelected(date('m', $value));

		$this->select_day->addOptions(range(1,31), true);
		$this->select_day->setName($name.'[day]');
		$this->select_day->setId($id.'-dd');
		$this->select_day->setSize(1);
		$this->select_day->setStyle($style);
		$this->select_day->setSelected(date('j', $value));
		
    return $this->select_day->get() . $this->select_month->get() . $this->select_year->get();
  }

  function addDatepicker()
  {	
  	$this->style_year = 'w3em split-date '.$this->style_year;
  }

  function &getSelect()
  {	
  	$return = $this->select_day->get() . $this->select_month->get() . $this->select_year->get();
    return $return;
  }
}


class rex_form_datetime_element extends rex_form_date_element
{
  var $select_hour;
  var $select_minute;
  var $select_second;

  // 1. Parameter nicht genutzt, muss aber hier stehen,
  // wg einheitlicher Konstrukturparameter
  function rex_form_datetime_element($tag = '', &$table, $attributes = array())
  {
    parent::rex_form_date_element('', $table, $attributes);

    $this->select_hour = new rex_select();
    $this->select_minute = new rex_select();
    $this->select_second = new rex_select();
  }

  function formatElement()
  {
  	$value = $this->getValue();
    
    $style = 'class="rex-form-select-date"';
        
    $name = $this->getName();

		for($i = '0'; $i <= '23'; $i++)
		{
			if ($i <= 9)
				$i = '0'.$i;
				
			$this->select_hour->addOption($i, $i);
		}
		$this->select_hour->setName($name.'[hour]');
		$this->select_hour->setSize(1);
		$this->select_hour->setStyle($style);
		if ($value != '')
			$this->select_hour->setSelected(date('H', $value));

		for($i = '0'; $i <= '59'; $i+=$this->step_minute)
		{
			if ($i <= 9)
				$i = '0'.$i;

			$this->select_minute->addOption($i, $i);
		}
//		$this->select_minute->addOptions(range(0,59), true);
		$this->select_minute->setName($name.'[minute]');
		$this->select_minute->setSize(1);
		$this->select_minute->setStyle($style);
		if ($value != '')
			$this->select_minute->setSelected(date('m', $value));
		
		$return = parent::formatElement() . ' - ' . $this->select_hour->get() . $this->select_minute->get();
    return $return;
  }

  function &getSelect()
  {	
		$return = parent::formatElement() . ' - ' . $this->select_hour->get() . $this->select_minute->get();
    return $return;
  }
}



class rex_form_time_element extends rex_form_element
{
  var $select_hour;
  var $select_minute;
  var $select_second;
  
  var $show_seconds;
  
  var $step_hour;
  var $step_minute;

  // 1. Parameter nicht genutzt, muss aber hier stehen,
  // wg einheitlicher Konstrukturparameter
  function rex_form_time_element($tag = '', &$table, $attributes = array())
  {
    parent::rex_form_element('', $table, $attributes);

		$this->step_hour = '1';
		$this->step_minute = '1';
    $this->show_seconds = false;
    
    $this->select_hour = new rex_select();
    $this->select_minute = new rex_select();
    $this->select_second = new rex_select();
  }

  function formatElement()
  {
  	$value = $this->getValue();
  	if ($value == '')
  		$value = '00:00';
  		
  	$value = explode(':', $value);

    $style = 'class="rex-form-select-date"';
        
    $name = $this->getAttribute('name');
		
		
		for($i = '0'; $i <= '23'; $i+=$this->step_hour)
		{
			if ($i <= 9)
				$i = '0'.$i;
				
			$this->select_hour->addOption($i, $i);
		}
		$this->select_hour->setName($name.'[hour]');
		$this->select_hour->setSize(1);
		$this->select_hour->setStyle($style);
		if ($value != '')
			$this->select_hour->setSelected($value[0]);
		
		for($i = '0'; $i <= '59'; $i+=$this->step_minute)
		{
			if ($i <= 9)
				$i = '0'.$i;

			$this->select_minute->addOption($i, $i);
		}
		$this->select_minute->setName($name.'[minute]');
		$this->select_minute->setSize(1);
		$this->select_minute->setStyle($style);
		if ($value != '')
			$this->select_minute->setSelected($value[1]);
			
		
		$return = $this->select_hour->get() . ' : ' . $this->select_minute->get();
		
		if ($this->show_seconds)
		{
			for($i = '0'; $i <= '59'; $i++)
			{
				if ($i <= 9)
					$i = '0'.$i;
					
				$this->select_second->addOption($i, $i);
			}
			$this->select_second->setName($name.'[minute]');
			$this->select_second->setSize(1);
			$this->select_second->setStyle($style);
			if ($value != '')
				$this->select_second->setSelected(date('s', $value));
				
			$return .= ' : ' . $this->select_second->get();
		}
		
    return $return;
  }
  
  function setHourStep($val)
  {	
    $this->step_hour = $val;
  }
  
  function setMinuteStep($val)
  {	
    $this->step_minute = $val;
  }
  
  function addSeconds()
  {	
    $this->show_seconds = true;
  }

  function &getSelect()
  {	
		$return = $this->select_hour->get() . ' : ' . $this->select_minute->get();
		if ($this->show_seconds)
		{
			$return .= ' : ' . $this->select_second->get();
		}
    return $return;
  }
}



?>