<?php
/* Smarty version 4.5.4, created on 2026-01-12 09:29:34
  from '/home/letheatreroyal/public_html/smarty/templates/form/creditPayment.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.4',
  'unifunc' => 'content_6965054ef374d4_72976999',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b65c5d36a654ff5cf5c6b172e73d254d3a64c63b' => 
    array (
      0 => '/home/letheatreroyal/public_html/smarty/templates/form/creditPayment.tpl',
      1 => 1669489702,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6965054ef374d4_72976999 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="row form-row">
    <div class="form-group col-sm-12 col-xs-12">
        <label for="card-element"></label>
        <div id="card-element"></div>
        <div id="card-errors" role="alert"></div>
    </div>
</div>
<?php if (($_smarty_tpl->tpl_vars['loadStripe']->value == "Y")) {?>
    <?php echo '<script'; ?>
 src="/js/stripe.js"><?php echo '</script'; ?>
>
<?php }
}
}
