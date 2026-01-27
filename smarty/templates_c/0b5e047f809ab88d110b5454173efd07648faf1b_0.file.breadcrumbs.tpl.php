<?php
/* Smarty version 4.5.6, created on 2026-01-19 06:27:05
  from '/home/kmxwwmbzse/tr/smarty/templates/breadcrumbs.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.6',
  'unifunc' => 'content_696e150935b9d0_89940985',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0b5e047f809ab88d110b5454173efd07648faf1b' => 
    array (
      0 => '/home/kmxwwmbzse/tr/smarty/templates/breadcrumbs.tpl',
      1 => 1768743512,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_696e150935b9d0_89940985 (Smarty_Internal_Template $_smarty_tpl) {
?><section class="section-md text-center bg-image breadcrumbs-01">
    <div class="shell shell-fluid">
        <div class="range range-xs-center">
            <div class="cell-xs-12 cell-xl-11">
                <h2 class="text-white"><?php echo $_smarty_tpl->tpl_vars['breadcrumbTitle']->value;?>
</h2>
                <ul class="breadcrumbs-custom">
                    <li><a href="/">Accueil</a></li>
                    <li class="active"><?php echo $_smarty_tpl->tpl_vars['breadcrumbTitle']->value;?>
</li>
                </ul>
            </div>
        </div>
    </div>
</section><?php }
}
