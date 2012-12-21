<?php
// erweitert die OPF-Klasse um 
// ein weiteres Datenfeld, da hier Daten schnell in der Form
// ddmmyy eingegeben werden sollen

class rex_form_extended2 extends rex_form_extended
{
  function addDateFieldNew($name, $value = null, $attributes = array())
  {
    $attributes['internal::fieldClass'] = 'rex_a350_form_date_element';
    $attributes['class'] = 'rex-form-text';
    $field =& $this->addField('input', $name, $value, $attributes, true);
    return $field;
  }

  // dem Formular bei der Ausgabe von rex_form eine ID mitgeben
  // damit mit jQuery validiert werden kann 
  // wenn hier eine andere ID gewaehlt wird, muss das in der config.inc.php angepasst werden
  function showFormWithId($formid='rex-form-edit-id')
  {
	ob_start();
	parent::show();
	$return_header = ob_get_contents();
	ob_end_clean();
	print str_replace("<form action=", "<form id=\"".$formid."\" action=", $return_header);
  }
}

class rex_a350_form_date_element extends rex_form_element
{
  // 1. Parameter nicht genutzt, muss aber hier stehen,
  // wg einheitlicher Konstrukturparameter
  function rex_a350_form_date_element($tag = '', &$table, $attributes = array())
  {
    parent::rex_form_element($tag, $table, $attributes);
  }


  function getValue()
  {
#    if (preg_match('/^[0-9]*$/',$this->value))
#      return ($this->value==0) ? '' : strftime('%d.%m.%Y',$this->value);
    return $this->value;
  }
  
  function formatElement()
  {
    $output = parent::formatElement();
    $attr = $this->getAttributes();
    $id = $attr['id'];
    /*
    $output .= '
      <script type="text/javascript">
      <!--
      jQuery(function($) {
        $("#'.$id.'").datepicker(
            {
                numberOfMonths: 2, 
                showButtonPanel: true, 
                appendText: \'(yyyy-mm-dd)\', 
                dateFormat: \'yy-mm-dd\', 
                showOn: \'button\', 
                buttonImage: \'../files/addons/news/images/calendar.gif\', 
                buttonImageOnly: true
            }        
         )
      });
      //-->
      </script>';
     */
    return $output;
  }
}