<?php
/* Smarty version 4.5.4, created on 2024-11-16 07:27:06
  from '/web/theatreroyal/letheatreroyal.com/smarty/templates/form/creditPayment.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.4',
  'unifunc' => 'content_67388f9a252838_66089298',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5a9e836a4dde44cbdf12901ab9021bc195eda52f' => 
    array (
      0 => '/web/theatreroyal/letheatreroyal.com/smarty/templates/form/creditPayment.tpl',
      1 => 1669486101,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_67388f9a252838_66089298 (Smarty_Internal_Template $_smarty_tpl) {
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
