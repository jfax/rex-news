<?php /* Smarty version Smarty-3.1.12, created on 2012-10-10 17:12:51
         compiled from "template/suche/out/templates/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:147839221750758f0ecd1548-02684746%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9d19212f1d31383cfe46a5a1f95835cb4026c407' => 
    array (
      0 => 'template/suche/out/templates/index.tpl',
      1 => 1349881969,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '147839221750758f0ecd1548-02684746',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_50758f0edc80f6_34954314',
  'variables' => 
  array (
    'searchword' => 0,
    'xml' => 0,
    'pagination' => 0,
    'list' => 0,
    'hx' => 0,
    'utf8' => 0,
    'wert' => 0,
    'show_found' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50758f0edc80f6_34954314')) {function content_50758f0edc80f6_34954314($_smarty_tpl) {?><?php  $_config = new Smarty_Internal_Config("suche.conf", $_smarty_tpl->smarty, $_smarty_tpl);$_config->loadConfigVars("setup", 'local'); ?>

<h3 class="heading"><small>Suchtreffer f&uuml;r</small> <?php echo $_smarty_tpl->tpl_vars['searchword']->value;?>
 <small>(<?php if ($_smarty_tpl->tpl_vars['xml']->value->facets->documentcount>0){?><?php echo $_smarty_tpl->tpl_vars['xml']->value->facets->documentcount;?>
<?php }else{ ?>leider keine <?php }?> Treffer)</small></h3>

<div class="search_page">
	<?php echo $_smarty_tpl->tpl_vars['pagination']->value;?>

	<div class="search_content">
		<div class="search_panel clearfix">
			<?php  $_smarty_tpl->tpl_vars['list'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['list']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['xml']->value->results; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['list']->key => $_smarty_tpl->tpl_vars['list']->value){
$_smarty_tpl->tpl_vars['list']->_loop = true;
?>
				<div class="search_item clearfix">
					<h4>
						<?php if ($_smarty_tpl->tpl_vars['list']->value->document->h1!=''&&$_smarty_tpl->tpl_vars['hx']->value=='h1'){?>
						<a href="<?php echo $_smarty_tpl->tpl_vars['list']->value->document->url;?>
" class="sepV_a">
							<?php if ($_smarty_tpl->tpl_vars['utf8']->value){?>
							<?php echo utf8_decode($_smarty_tpl->tpl_vars['list']->value->document->h1);?>
</a> <small>(<?php echo utf8_decode($_smarty_tpl->tpl_vars['list']->value->document->title);?>
)
							<?php }else{ ?>
							<?php echo $_smarty_tpl->tpl_vars['list']->value->document->h1;?>
</a> <small>(<?php echo $_smarty_tpl->tpl_vars['list']->value->document->title;?>
)
							<?php }?>
						</small>
						<?php }elseif($_smarty_tpl->tpl_vars['list']->value->document->h2!=''&&$_smarty_tpl->tpl_vars['hx']->value=='h2'){?>
						<a href="<?php echo $_smarty_tpl->tpl_vars['list']->value->document->url;?>
" class="sepV_a">
							<?php if ($_smarty_tpl->tpl_vars['utf8']->value){?>
							<?php echo utf8_decode($_smarty_tpl->tpl_vars['list']->value->document->h2);?>
</a> <small>(<?php echo utf8_decode($_smarty_tpl->tpl_vars['list']->value->document->title);?>
)</small>
							<?php }else{ ?>
							<?php echo $_smarty_tpl->tpl_vars['list']->value->document->h2;?>
</a> <small>(<?php echo $_smarty_tpl->tpl_vars['list']->value->document->title;?>
)</small>
							<?php }?>
						<?php }else{ ?>
						<a href="<?php echo $_smarty_tpl->tpl_vars['list']->value->document->url;?>
" class="sepV_a"><?php if ($_smarty_tpl->tpl_vars['utf8']->value){?><?php echo utf8_decode($_smarty_tpl->tpl_vars['list']->value->document->title);?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['list']->value->document->title;?>
<?php }?></a></small>
						<?php }?>
					</h4>
                    <p class="sepH_b item_description">
						<?php  $_smarty_tpl->tpl_vars['wert'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['wert']->_loop = false;
 $_smarty_tpl->tpl_vars['schluessel'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['list']->value->highlight->content; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['wert']->key => $_smarty_tpl->tpl_vars['wert']->value){
$_smarty_tpl->tpl_vars['wert']->_loop = true;
 $_smarty_tpl->tpl_vars['schluessel']->value = $_smarty_tpl->tpl_vars['wert']->key;
?>
							<?php if ($_smarty_tpl->tpl_vars['utf8']->value){?><?php echo utf8_decode($_smarty_tpl->tpl_vars['wert']->value);?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['wert']->value;?>
<?php }?> ...
						<?php } ?>
                    </p>
                    <?php if ($_smarty_tpl->tpl_vars['show_found']->value==1){?><small>Gefunden bei <?php echo $_smarty_tpl->tpl_vars['list']->value->document->site;?>
</small><?php }?>
				</div>
			<?php } ?>
		</div>
	</div>
</div>
<?php }} ?>