<?php
/* Smarty version 4.5.4, created on 2025-05-21 18:36:45
  from '/home/letheatreroyal/public_html/smarty/templates/home.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.4',
  'unifunc' => 'content_682e557d3e56b2_30476844',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3031b88de14ff52f8d999aaec664075debc793c7' => 
    array (
      0 => '/home/letheatreroyal/public_html/smarty/templates/home.tpl',
      1 => 1668640930,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:carousel.tpl' => 1,
  ),
),false)) {
function content_682e557d3e56b2_30476844 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:carousel.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<section class="section section-md bg-white text-center text-sm-left novi-background" id="home">
    <div class="shell">
        <div class="range range-50 range-md-justify range-sm-middle">
            <div class="cell-md-6 cell-lg-5 wow blurIn" data-wow-duration="1.5s" data-wow-offset="100" data-wow-delay="0"><?php echo $_smarty_tpl->tpl_vars['homeText']->value->text;?>
</div>
            <div class="cell-md-6 cell-lg-6 wow blurIn" data-wow-duration="1.5s" data-wow-offset="100" data-wow-delay="0">
                <?php if (($_smarty_tpl->tpl_vars['homeText']->value->textImage)) {?>
                    <div class="bg-smear">
                        <figure><img src="/media/<?php echo $_smarty_tpl->tpl_vars['homeText']->value->textImage;?>
" alt="<?php echo $_smarty_tpl->tpl_vars['homeText']->value->title;?>
" /></figure>
                    </div>
                <?php }?>
            </div>
        </div>
    </div>
</section><?php }
}
