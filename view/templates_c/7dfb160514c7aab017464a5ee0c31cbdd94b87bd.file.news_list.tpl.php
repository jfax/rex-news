<?php /* Smarty version Smarty-3.1.12, created on 2012-11-22 14:38:22
         compiled from "redaxo\include\addons\news\view\templates\news_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1461250a5ef053f97f8-50289127%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7dfb160514c7aab017464a5ee0c31cbdd94b87bd' => 
    array (
      0 => 'redaxo\\include\\addons\\news\\view\\templates\\news_list.tpl',
      1 => 1353490920,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1461250a5ef053f97f8-50289127',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_50a5ef05533458_27345737',
  'variables' => 
  array (
    'pager' => 0,
    'data' => 0,
    'list' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50a5ef05533458_27345737')) {function content_50a5ef05533458_27345737($_smarty_tpl) {?>
<?php if ($_smarty_tpl->tpl_vars['pager']->value['jumplist']){?><?php echo $_smarty_tpl->getSubTemplate ('pager.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }?>
<div class="news-list-container">
    <?php  $_smarty_tpl->tpl_vars['list'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['list']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['data']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['list']->key => $_smarty_tpl->tpl_vars['list']->value){
$_smarty_tpl->tpl_vars['list']->_loop = true;
?>
    <div class="news-list-item news-list-item-id<?php echo $_smarty_tpl->tpl_vars['list']->value['id'];?>
">
        <div class="news-list-info">
            <span class="news-list-date"><?php echo $_smarty_tpl->tpl_vars['list']->value['date'];?>
</span>
        </div>
        <div class="news-list-content">
            <h2><a href="<?php echo $_smarty_tpl->tpl_vars['list']->value['url'];?>
" title="zum Artikel: <?php echo $_smarty_tpl->tpl_vars['list']->value['name'];?>
"><?php echo $_smarty_tpl->tpl_vars['list']->value['name'];?>
</a></h2>
            <?php if ($_smarty_tpl->tpl_vars['list']->value['image']){?><div class="float_left"><?php echo $_smarty_tpl->tpl_vars['list']->value['image'];?>
</div><?php }?>
            <?php if ($_smarty_tpl->tpl_vars['list']->value['teaser']){?><p><?php echo $_smarty_tpl->tpl_vars['list']->value['teaser'];?>
</p><?php }?>
        </div>
    </div>
    <?php }
if (!$_smarty_tpl->tpl_vars['list']->_loop) {
?>
        <p>Ooops, aktuell liegen keine Meldungen vor. Das kann sich jedoch täglich wieder ändern. Schauen Sie also bald wieder vorbei oder abonnieren Sie unser RSS-Feed</p>
    <?php } ?>
</div><?php }} ?>