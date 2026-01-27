<?php
/* Smarty version 4.5.4, created on 2026-01-12 09:29:34
  from '/home/letheatreroyal/public_html/smarty/templates/transactionSummary.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.4',
  'unifunc' => 'content_6965054e2cd6e7_75051010',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a54f125c21e8935e9100897dcf477bbca2b8dbc7' => 
    array (
      0 => '/home/letheatreroyal/public_html/smarty/templates/transactionSummary.tpl',
      1 => 1718651758,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6965054e2cd6e7_75051010 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/home/letheatreroyal/composer/vendor/smarty/smarty/libs/plugins/modifier.number_format.php','function'=>'smarty_modifier_number_format',),));
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
