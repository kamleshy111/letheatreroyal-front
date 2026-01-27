<?php
/* Smarty version 4.5.4, created on 2024-11-16 07:26:34
  from '/web/theatreroyal/letheatreroyal.com/smarty/templates/js.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.4',
  'unifunc' => 'content_67388f7ae622b3_50211946',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3f749507a9ea5f8b31f166e076d3a581fee27272' => 
    array (
      0 => '/web/theatreroyal/letheatreroyal.com/smarty/templates/js.tpl',
      1 => 1718666110,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_67388f7ae622b3_50211946 (Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
 src="/js/core.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="/js/script.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/localization/messages_fr.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js"><?php echo '</script'; ?>
>

<?php echo '<script'; ?>
 src="https://js.stripe.com/v3/"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="/js/stripe.js?v=<?php echo $_smarty_tpl->tpl_vars['serial']->value;?>
"><?php echo '</script'; ?>
>

<?php if (($_smarty_tpl->tpl_vars['status']->value != "dev")) {?>
    <?php echo '<script'; ?>
 src="https://www.google.com/recaptcha/api.js?render=6LcHSvspAAAAAJWY35Wy-5cfWGsSto5R4Sehciix"><?php echo '</script'; ?>
>
<?php }?>

<?php echo '<script'; ?>
 src="/js/js.js?v=<?php echo $_smarty_tpl->tpl_vars['serial']->value;?>
"><?php echo '</script'; ?>
>
<?php if ((file_exists(((string)$_smarty_tpl->tpl_vars['WWW_PATH']->value)."/js/".((string)$_smarty_tpl->tpl_vars['page']->value).".js"))) {?>
    <?php echo '<script'; ?>
 src="/js/<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
.js?v=<?php echo $_smarty_tpl->tpl_vars['serial']->value;?>
"><?php echo '</script'; ?>
>
<?php }
}
}
