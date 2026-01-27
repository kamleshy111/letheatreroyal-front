<?php
/* Smarty version 4.5.4, created on 2024-11-16 07:26:34
  from '/web/theatreroyal/letheatreroyal.com/smarty/templates/form/footerContact.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.4',
  'unifunc' => 'content_67388f7ae4ff19_37127255',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '05462f063f4ada319b0cac6da258f2b26d7bd73b' => 
    array (
      0 => '/web/theatreroyal/letheatreroyal.com/smarty/templates/form/footerContact.tpl',
      1 => 1667743168,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_67388f7ae4ff19_37127255 (Smarty_Internal_Template $_smarty_tpl) {
?><form class="rd-mailform text-left contact-form" id="footerCcontactFrm" method="post" action="#">
    <input type="hidden" name="token" autocomplete="off" value="<?php echo $_smarty_tpl->tpl_vars['csrfToken']->value;?>
" />
    <div class="form-wrap">
        <label class="form-label" for="contact-name">Votre nom:</label>
        <input class="form-input required" id="contact-name" type="text" name="name" />
    </div>
    <div class="form-wrap">
        <label class="form-label" for="contact-email">Votre courriel:</label>
        <input class="form-input required email" id="contact-email" type="email" name="email" />
    </div>
    <div class="form-wrap">
        <label class="form-label" for="contact-subject">Sujet:</label>
        <input class="form-input required" id="contact-subject" type="text" name="subject" />
    </div>
    <div class="form-wrap">
        <label class="form-label" for="contact-message">Votre message:</label>
        <textarea class="form-input required" id="contact-message" name="message"></textarea>
    </div>
    <div class="form-button group-sm text-center text-lg-left">
        <button class="button button-primary button-square button-lg" type="submit"><span>Envoyer</span></button>
    </div>
</form>
<div id="footerCcontactNotification" class="success"></div><?php }
}
