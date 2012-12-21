<?php
/**
 * News Addon 
 * @author fuchs@d-mind.de Jens Fuchs
 * @package redaxo4
 * @version $Id: help.inc.php,v 1.0 2008/06/11
 */
 
if ( !isset( $mode)) $mode = '';
switch ( $mode) {
   case 'changelog': $file = '_changelog.txt'; break;
   default: $file = '_readme.txt'; 
}

echo str_replace( '+', '&nbsp;&nbsp;+', nl2br( file_get_contents( dirname( __FILE__) .'/'. $file)));