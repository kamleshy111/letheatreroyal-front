<?php
/* Smarty version 4.5.6, created on 2026-01-19 06:28:28
  from '/home/kmxwwmbzse/tr/smarty/templates/transactionSummary.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.6',
  'unifunc' => 'content_696e155c0bf283_14241659',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '810f94ea2f33b225d5d5a01c2b107a07c397bcb9' => 
    array (
      0 => '/home/kmxwwmbzse/tr/smarty/templates/transactionSummary.tpl',
      1 => 1768743512,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_696e155c0bf283_14241659 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/home/kmxwwmbzse/tr/vendor/smarty/smarty/libs/plugins/modifier.number_format.php','function'=>'smarty_modifier_number_format',),));
?>
<h5>Sommaire de la transaction</h5>
<ul>
    <li class="subTotalTxt"><label>Sous-total</label> <span><?php echo smarty_modifier_number_format($_smarty_tpl->tpl_vars['subTotal']->value,2,"."," ");?>
</span></li>
    <li class="gstTxt"><label>TPS</label> <span><?php echo smarty_modifier_number_format($_smarty_tpl->tpl_vars['gst']->value,2,"."," ");?>
</span></li>
    <li class="pstTxt"><label>TVQ</label> <span><?php echo smarty_modifier_number_format($_smarty_tpl->tpl_vars['pst']->value,2,"."," ");?>
</span></li>
    <li class="totalTxt"><label>Total</label> <span><?php echo smarty_modifier_number_format($_smarty_tpl->tpl_vars['total']->value,2,"."," ");?>
</span></li>
</ul>
<input type="hidden" id="amount<?php echo ucfirst($_smarty_tpl->tpl_vars['t']->value);?>
" name="amount" value="<?php echo $_smarty_tpl->tpl_vars['subTotal']->value;?>
" autocomplete="off" />
<input type="hidden" id="stripeToken<?php echo ucfirst($_smarty_tpl->tpl_vars['t']->value);?>
" name="stripeToken" value="" autocomplete="off" />
<input type="hidden" id="stripeDescription<?php echo ucfirst($_smarty_tpl->tpl_vars['t']->value);?>
" name="stripeDescription" value="<?php echo $_smarty_tpl->tpl_vars['stripeDescription']->value;?>
" autocomplete="off" />
<input type="hidden" id="currency<?php echo ucfirst($_smarty_tpl->tpl_vars['t']->value);?>
" name="currency" value="CAD" autocomplete="off" />
<input type="hidden" id="subTotal<?php echo ucfirst($_smarty_tpl->tpl_vars['t']->value);?>
" name="subTotal" value="<?php echo smarty_modifier_number_format($_smarty_tpl->tpl_vars['subTotal']->value,2,".",'');?>
" autocomplete="off" />
<input type="hidden" id="gst<?php echo ucfirst($_smarty_tpl->tpl_vars['t']->value);?>
" name="gst" value="<?php echo smarty_modifier_number_format($_smarty_tpl->tpl_vars['gst']->value,2,".",'');?>
" autocomplete="off" />
<input type="hidden" id="pst<?php echo ucfirst($_smarty_tpl->tpl_vars['t']->value);?>
" name="pst" value="<?php echo smarty_modifier_number_format($_smarty_tpl->tpl_vars['pst']->value,2,".",'');?>
" autocomplete="off" />
<input type="hidden" id="total<?php echo ucfirst($_smarty_tpl->tpl_vars['t']->value);?>
" name="total" value="<?php echo smarty_modifier_number_format($_smarty_tpl->tpl_vars['total']->value,2,".",'');?>
" autocomplete="off" />
<input type="hidden" id="monthlyPayment<?php echo ucfirst($_smarty_tpl->tpl_vars['t']->value);?>
" name="monthlyPayment" value="<?php echo smarty_modifier_number_format($_smarty_tpl->tpl_vars['monthlyPayment']->value,2,".",'');?>
" autocomplete="off" /><?php }
}
