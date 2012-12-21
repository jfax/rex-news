<?php /* Smarty version Smarty-3.1.12, created on 2012-11-16 08:55:30
         compiled from "redaxo\include\addons\news\view\templates\pager.tpl" */ ?>
<?php /*%%SmartyHeaderCode:598150a519ba17dd65-98416426%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6db806a597bf635bea37f52e5c6212f34c058898' => 
    array (
      0 => 'redaxo\\include\\addons\\news\\view\\templates\\pager.tpl',
      1 => 1353052214,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '598150a519ba17dd65-98416426',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_50a519ba1f41b5_04533780',
  'variables' => 
  array (
    'pager' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50a519ba1f41b5_04533780')) {function content_50a519ba1f41b5_04533780($_smarty_tpl) {?>
<div class="pager">
    <div class="pager_elements">
        <?php echo $_smarty_tpl->tpl_vars['pager']->value['jumplist'];?>

    </div>
    <?php if ($_smarty_tpl->tpl_vars['pager']->value['start']){?>
    <div class="pager_info">
        Zeige Artikel <?php echo $_smarty_tpl->tpl_vars['pager']->value['start'];?>
-<?php echo $_smarty_tpl->tpl_vars['pager']->value['end'];?>
 von <?php echo $_smarty_tpl->tpl_vars['pager']->value['gesamt'];?>

    </div>
    <?php }?>
    <div style="clear:both;"></div>    
</div><?php }} ?>