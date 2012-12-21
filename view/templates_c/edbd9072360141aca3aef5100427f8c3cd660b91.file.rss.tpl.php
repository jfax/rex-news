<?php /* Smarty version Smarty-3.1.12, created on 2012-11-16 17:47:45
         compiled from "redaxo\include\addons\news\view\templates\rss.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2196150a4e6a252ee39-37660686%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'edbd9072360141aca3aef5100427f8c3cd660b91' => 
    array (
      0 => 'redaxo\\include\\addons\\news\\view\\templates\\rss.tpl',
      1 => 1353052191,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2196150a4e6a252ee39-37660686',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_50a4e6a2719091_50825359',
  'variables' => 
  array (
    'itemh1' => 0,
    'itemDesc' => 0,
    'pager' => 0,
    'data' => 0,
    'list' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50a4e6a2719091_50825359')) {function content_50a4e6a2719091_50825359($_smarty_tpl) {?>
<?php if ($_smarty_tpl->tpl_vars['itemh1']->value){?><h1><?php echo $_smarty_tpl->tpl_vars['itemh1']->value;?>
</h1><?php }?>
<?php if ($_smarty_tpl->tpl_vars['itemDesc']->value){?><h2><?php echo $_smarty_tpl->tpl_vars['itemDesc']->value;?>
</h2><?php }?>
<?php if ($_smarty_tpl->tpl_vars['pager']->value){?><?php echo $_smarty_tpl->getSubTemplate ('pager.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }?>
<div class="news-list-container">
    <?php  $_smarty_tpl->tpl_vars['list'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['list']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['data']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['list']->key => $_smarty_tpl->tpl_vars['list']->value){
$_smarty_tpl->tpl_vars['list']->_loop = true;
?>
        <div class="news-list-item">
            <?php if ($_smarty_tpl->tpl_vars['list']->value['enclosure']!=''){?><div class="float_left"><a href="<?php echo $_smarty_tpl->tpl_vars['list']->value['url'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['list']->value['enclosure'];?>
" alt="" /></a></div><?php }?>
            <div class="news-content">
                <h3 class="h3teaser"><span class="news-name"><a href="<?php echo $_smarty_tpl->tpl_vars['list']->value['url'];?>
"><?php echo $_smarty_tpl->tpl_vars['list']->value['title'];?>
</a></span></h3>
                <span class="news-date"><?php echo $_smarty_tpl->tpl_vars['list']->value['pubDate'];?>
</span> &ndash; <?php echo $_smarty_tpl->tpl_vars['list']->value['description'];?>

            </div>
            <div style="clear:both"></div>
        </div>
    <?php } ?>
</div><?php }} ?>