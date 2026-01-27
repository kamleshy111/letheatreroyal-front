<?php
/* Smarty version 4.5.4, created on 2024-11-16 07:27:04
  from '/web/theatreroyal/letheatreroyal.com/smarty/templates/breadcrumbs.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.4',
  'unifunc' => 'content_67388f98c53252_51846923',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '805cf48aeb98a9d947d88d05f4f84031be1dd9ae' => 
    array (
      0 => '/web/theatreroyal/letheatreroyal.com/smarty/templates/breadcrumbs.tpl',
      1 => 1667748059,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_67388f98c53252_51846923 (Smarty_Internal_Template $_smarty_tpl) {
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
