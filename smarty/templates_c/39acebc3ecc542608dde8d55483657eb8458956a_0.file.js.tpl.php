<?php
/* Smarty version 4.5.6, created on 2026-01-19 06:25:04
  from '/home/kmxwwmbzse/tr/smarty/templates/js.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.6',
  'unifunc' => 'content_696e14902bf630_95229490',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '39acebc3ecc542608dde8d55483657eb8458956a' => 
    array (
      0 => '/home/kmxwwmbzse/tr/smarty/templates/js.tpl',
      1 => 1768743512,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_696e14902bf630_95229490 (Smarty_Internal_Template $_smarty_tpl) {
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
