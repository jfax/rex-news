<?php /* Smarty version Smarty-3.1.12, created on 2012-11-22 14:41:24
         compiled from "redaxo\include\addons\news\view\templates\news_detail.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1564250a5216ecd0683-48302020%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '528f43882f2118a49659bd657a837e72a773d698' => 
    array (
      0 => 'redaxo\\include\\addons\\news\\view\\templates\\news_detail.tpl',
      1 => 1353591683,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1564250a5216ecd0683-48302020',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_50a5216ed02b40_03924314',
  'variables' => 
  array (
    'data' => 0,
    'list' => 0,
    'images' => 0,
    'file' => 0,
    'files' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50a5216ed02b40_03924314')) {function content_50a5216ed02b40_03924314($_smarty_tpl) {?>
<div class="news_detail">
    <?php  $_smarty_tpl->tpl_vars['list'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['list']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['data']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['list']->key => $_smarty_tpl->tpl_vars['list']->value){
$_smarty_tpl->tpl_vars['list']->_loop = true;
?>
        <?php if ($_smarty_tpl->tpl_vars['list']->value['name']){?><h1><?php echo $_smarty_tpl->tpl_vars['list']->value['name'];?>
</h1><?php }?>
        <?php if ($_smarty_tpl->tpl_vars['list']->value['source']){?><span class="news-source"><?php echo $_smarty_tpl->tpl_vars['list']->value['source'];?>
</span><?php }?>
        <?php if ($_smarty_tpl->tpl_vars['list']->value['teaser']){?><h3 class="h3teaser"><?php }?>
        <?php if ($_smarty_tpl->tpl_vars['list']->value['date']){?><span class="news-date"><?php echo $_smarty_tpl->tpl_vars['list']->value['date'];?>
</span> &ndash; <?php }?>
        <?php if ($_smarty_tpl->tpl_vars['list']->value['teaser']){?><?php echo $_smarty_tpl->tpl_vars['list']->value['teaser'];?>
</h3><?php }?>
        <?php if ($_smarty_tpl->tpl_vars['list']->value['text']){?><div class="news_detail_article"><?php echo $_smarty_tpl->tpl_vars['list']->value['text'];?>
</div><?php }?>
        <?php if ($_smarty_tpl->tpl_vars['list']->value['bilder']){?><div class="imagesContainer"><?php echo $_smarty_tpl->tpl_vars['list']->value['bilder'];?>
</div><?php }?>
        <?php if ($_smarty_tpl->tpl_vars['images']->value>0){?>
            <div class="imagesContainer">
                <?php  $_smarty_tpl->tpl_vars['file'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['file']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['images']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['file']->key => $_smarty_tpl->tpl_vars['file']->value){
$_smarty_tpl->tpl_vars['file']->_loop = true;
?>
                    <div class="image"><a href="files/<?php echo $_smarty_tpl->tpl_vars['file']->value['file'];?>
" rel="fancybox"><img src="index.php?rex_img_type=rex_mediabutton_preview&amp;rex_img_file=<?php echo $_smarty_tpl->tpl_vars['file']->value['file'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['file']->value['item'];?>
" /></a></div>
                    <!--
                    <div>(<?php echo $_smarty_tpl->tpl_vars['file']->value['size'];?>
)</div>
                    <?php if ($_smarty_tpl->tpl_vars['file']->value['description']){?><div class="news_description"><?php echo $_smarty_tpl->tpl_vars['file']->value['description'];?>
</div><?php }?>
                    <?php if ($_smarty_tpl->tpl_vars['file']->value['copyright']){?><div class="news_copyright"><?php echo $_smarty_tpl->tpl_vars['file']->value['copyright'];?>
</div><?php }?>
                    <?php if ($_smarty_tpl->tpl_vars['file']->value['date']){?><div class="news_updatedate"><?php echo $_smarty_tpl->tpl_vars['file']->value['date'];?>
 <?php echo $_smarty_tpl->tpl_vars['file']->value['time'];?>
 Uhr</div><?php }?>
                    <?php if ($_smarty_tpl->tpl_vars['file']->value['typ']){?><div class="news_typ"><?php echo $_smarty_tpl->tpl_vars['file']->value['typ'];?>
</div><?php }?>
                    //-->
                <?php } ?>
            </div>
        <?php }?>
        <?php if ($_smarty_tpl->tpl_vars['files']->value>0){?>
            <div class="downloadContainer">
                <h2>Download</h2>
                <ul>
                    <?php  $_smarty_tpl->tpl_vars['file'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['file']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['files']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['file']->key => $_smarty_tpl->tpl_vars['file']->value){
$_smarty_tpl->tpl_vars['file']->_loop = true;
?>
                        <li>
                            <a href="files/<?php echo $_smarty_tpl->tpl_vars['file']->value['file'];?>
"><?php echo $_smarty_tpl->tpl_vars['file']->value['item'];?>
</a> (<?php echo $_smarty_tpl->tpl_vars['file']->value['size'];?>
)
                            <?php if ($_smarty_tpl->tpl_vars['file']->value['description']){?><div class="news_description"><?php echo $_smarty_tpl->tpl_vars['file']->value['description'];?>
</div><?php }?>
                            <?php if ($_smarty_tpl->tpl_vars['file']->value['copyright']){?><div class="news_copyright"><?php echo $_smarty_tpl->tpl_vars['file']->value['copyright'];?>
</div><?php }?>
                            <?php if ($_smarty_tpl->tpl_vars['file']->value['date']){?><div class="news_updatedate"><?php echo $_smarty_tpl->tpl_vars['file']->value['date'];?>
 <?php echo $_smarty_tpl->tpl_vars['file']->value['time'];?>
 Uhr</div><?php }?>
                            <?php if ($_smarty_tpl->tpl_vars['file']->value['typ']){?><div class="news_typ"><?php echo $_smarty_tpl->tpl_vars['file']->value['typ'];?>
</div><?php }?>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        <?php }?>
        <?php if ($_smarty_tpl->tpl_vars['list']->value['keywords']){?><div class="keywords"><em>Dieser Artikel wurde verschlagwortet mit: <?php echo $_smarty_tpl->tpl_vars['list']->value['keywords'];?>
</em></div><?php }?>        
        <?php if ($_smarty_tpl->tpl_vars['list']->value['back']){?><div class="back"><a href="javascript:history.back();">&lt; <?php echo $_smarty_tpl->tpl_vars['list']->value['back'];?>
</a></div><?php }?>
    <?php } ?>
    <div style="clear:both"></div>
</div><!-- /news --><?php }} ?>