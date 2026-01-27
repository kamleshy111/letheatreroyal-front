<?php
/* Smarty version 4.5.4, created on 2025-10-14 09:45:10
  from '/home/letheatreroyal/public_html/smarty/templates/form/contact.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.4',
  'unifunc' => 'content_68ee53e6862d36_34223303',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '68d445be61f55870348ada2327fb663185b03684' => 
    array (
      0 => '/home/letheatreroyal/public_html/smarty/templates/form/contact.tpl',
      1 => 1667750928,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68ee53e6862d36_34223303 (Smarty_Internal_Template $_smarty_tpl) {
?><form data-form-output="form-output-global" data-form-type="contactFrm" id="contactFrm" method="post" action="">
    <div class="range range-sm-bottom spacing-20 novi-excluded">
        <div class="cell-sm-6 form-wrap">
            <input class="form-input required" id="name" type="text" name="name" />
            <label class="form-label" for="name">Votre nom</label>
        </div>
        <div class="cell-sm-6 form-wrap">
            <input class="form-input required email" id="email" type="email" name="email" />
            <label class="form-label" for="email">Votre courriel</label>
        </div>
        <div class="cell-sm-12 form-wrap">
            <input class="form-input required" id="subject" type="text" name="subject" />
            <label class="form-label" for="subject">Sujet</label>
        </div>
        <div class="cell-xs-12 form-wrap">
            <textarea class="form-input required" id="message" name="message"></textarea>
            <label class="form-label" for="message">Message</label>
        </div>
        <div class="cell-sm-6">
            <button class="button button-primary button-square button-block" type="submit"><span>Envoyer votre message</span></button>
        </div>
    </div>
</form>
<div id="notification" class="success"></div><?php }
}
