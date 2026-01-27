<?php
/* Smarty version 4.5.4, created on 2025-05-21 18:36:45
  from '/home/letheatreroyal/public_html/smarty/templates/form/footerContact.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.4',
  'unifunc' => 'content_682e557d400150_66191380',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f0149fd186aa2ec5eab54266519c1cbc909479a7' => 
    array (
      0 => '/home/letheatreroyal/public_html/smarty/templates/form/footerContact.tpl',
      1 => 1667746768,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_682e557d400150_66191380 (Smarty_Internal_Template $_smarty_tpl) {
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
