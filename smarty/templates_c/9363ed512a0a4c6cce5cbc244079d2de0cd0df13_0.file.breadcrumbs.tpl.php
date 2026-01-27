<?php
/* Smarty version 4.5.4, created on 2025-05-21 18:39:25
  from '/home/letheatreroyal/public_html/smarty/templates/breadcrumbs.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.4',
  'unifunc' => 'content_682e561db3d722_30150677',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9363ed512a0a4c6cce5cbc244079d2de0cd0df13' => 
    array (
      0 => '/home/letheatreroyal/public_html/smarty/templates/breadcrumbs.tpl',
      1 => 1667751660,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_682e561db3d722_30150677 (Smarty_Internal_Template $_smarty_tpl) {
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
