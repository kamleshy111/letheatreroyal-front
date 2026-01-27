<?php
/* Smarty version 4.5.6, created on 2026-01-19 06:25:04
  from '/home/kmxwwmbzse/tr/smarty/templates/home.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.6',
  'unifunc' => 'content_696e149028ef99_74906604',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0c93be8094d588b258ac8c52f8beb454e7536df7' => 
    array (
      0 => '/home/kmxwwmbzse/tr/smarty/templates/home.tpl',
      1 => 1768743512,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:carousel.tpl' => 1,
  ),
),false)) {
function content_696e149028ef99_74906604 (Smarty_Internal_Template $_smarty_tpl) {
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
